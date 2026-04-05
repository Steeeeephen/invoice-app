<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceCreated;
use App\Models\Customer;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * @method authorize(string $string, Invoice $invoice)
 */
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $invoices = Invoice::orderBy('invoice_number', 'desc')->get();
        $status = request('status');
        $query = Invoice::query();

        if($status) {
            $query->whereIn('status', [$status]);
        }

        $invoices = $query->orderBy('invoice_number', 'desc')->get();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Retrieve the 'customer' query parameter from the URL (e.g., /invoices/create?customer=5)
        $customerId = $request->get('customer');

        // Find the Customer model by ID or throw a 404 if not found
        // This ensures I don't allow invoice creation for a non-existent customer
        $customer = Customer::findOrFail($customerId);

        // Pass the customer and a new empty Invoice instance to the view
        // 'invoice' is used to prefill the form (e.g., old values or default empty fields)
        return view('invoices.create', [
            'customer' => $customer,
            'invoice' => new Invoice(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'invoice_amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'customer_id' => 'required|exists:customers,id',
            'due_date' => 'nullable|date',
        ]);

        $invoice = Invoice::create($incomingFields);
        return redirect()->route('invoices.show', $invoice->id)->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load(['customer', 'project']);
        return view('invoices.show', compact('invoice'));
    }

    public function download(Invoice $invoice)
    {
        $invoice->load(['customer', 'project']);
        $pdf = Pdf::loadView('pdf.invoice', compact('invoice'));
        return $pdf->download($invoice->invoice_number . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        if(!auth()->user()->can('update', $invoice)) {
            return redirect()->back()->with('error', 'You cannot edit this invoice.');
        }

        $invoice->load(['customer', 'project']);
        return view('invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Invoice $invoice, Request $request)
    {
        $this->authorize('update', $invoice);
        $incomingFields = $request->validate([
            'invoice_amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        $incomingFields['amount_due'] = $incomingFields['invoice_amount'];
        $invoice->update($incomingFields);

        return redirect()
            ->route('invoices.show', $invoice)
            ->with('success', 'Invoice updated successfully.');
    }

    public function send(Invoice $invoice) {
//        $this->authorize('send', $invoice);
        $invoice->update(['status' => 'sent']);

        $pdf = Pdf::loadView('pdf.invoice', compact('invoice'));
        $pdfData = $pdf->output(); // raw binary string

        Mail::to($invoice->customer->email)->send(
            new InvoiceCreated($invoice, $pdfData)
        );

        return redirect()->route('invoices.show', $invoice)->with('success', 'Invoice sent.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public Function paymentForm(Invoice $invoice) {
        if(!auth()->user()->can('pay', $invoice)) {
            return redirect()->back()->with('error', 'You can not process payment on this invoice.');
        }
        return view('invoices.payment', compact('invoice'));
    }

    public function processPayment(Request $request, Invoice $invoice) {
        $this->authorize('pay', $invoice);
        $paymentAmount = request()->validate([
            'payment_amount' => ['required', 'numeric', 'min:1', 'max:' . $invoice->amount_due],
        ]);

        $invoice->update(['amount_due' => $invoice->amount_due - $paymentAmount['payment_amount']]);
        return redirect()->route('invoices.show', $invoice)->with('success', 'Invoice payment successful.');
    }
}
