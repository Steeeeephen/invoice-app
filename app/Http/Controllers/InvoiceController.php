<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;

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
        $invoices = Invoice::orderBy('invoice_number', 'desc')->get();
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
        // This ensures we don't allow invoice creation for a non-existent customer
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $this->authorize('update', $invoice);
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
        $invoice->update(['status' => 'sent']);
        return redirect()->route('invoices.show', $invoice)->with('success', 'Invoice sent.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
