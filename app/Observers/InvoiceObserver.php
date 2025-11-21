<?php

namespace App\Observers;

use App\Models\Invoice;

class InvoiceObserver
{

    // 'creating' is not a default method so this was added. This is so the invoice number is set before the entry is saved.
    public function creating(Invoice $invoice): void
    {

        // This is my method for setting the invoice number of a new invoice.
        $count = Invoice::count(); // Gets the total number of invoices in the database.
        $invoice->invoice_number = 'INV-' . (1000 + $count); // Sets the number of the new invoice to the count plus 1000.

        \Log::info('Setting invoice_number to: ' . $invoice->invoice_number);
    }

    /**
     * Handle the Invoice "created" event.
     */
    public function created(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "updated" event.
     */
    public function updated(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "deleted" event.
     */
    public function deleted(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "restored" event.
     */
    public function restored(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "force deleted" event.
     */
    public function forceDeleted(Invoice $invoice): void
    {
        //
    }
}
