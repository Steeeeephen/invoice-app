<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'project_id',
        'description',
        'invoice_amount',
        'amount_due',
        'due_date',
        'status',
    ];

    protected static function booted(): void
    {
        // Set amount_due to invoice_amount if not explicitly provided
        static::creating(function ($invoice) {
            $invoice->amount_due ??= $invoice->invoice_amount;
        });

        // Note... This would not be ideal for production as there is a brief window where the invoice number is null. Changing this is on the todo list.
        static::created(function ($invoice) {
            // Use 'created' instead of 'creating' so the ID exists
            if (empty($invoice->invoice_number)) {
                $invoice->invoice_number = 'INV-' . str_pad($invoice->id, 4, '0', STR_PAD_LEFT);
                $invoice->saveQuietly(); // Save without triggering events again
            }
        });

        // Adding some logic here to sync invoice status depending on the amount_due column... hopefully this doesn't come back to haunt me...
        // Note: the order of these conditions is intentional.
        // paid/canceled must be checked before partially_paid to avoid conflicts.
        static::updating(function ($invoice) {
            // If the invoice status is either paid or canceled, amount_due will go to 0.
            // Also keeping in mind that status will not be changed by a dropdown menu,
            // invoice status will only be changed based on specific actions... payments, clicking cancel, etc...
            if (in_array($invoice->status, ['paid', 'cancelled'])) {
                $invoice->amount_due = 0;
            }

            if($invoice->amount_due === 0.00){
                $invoice->status = 'paid';
            }

            // When status is changed to paid, and if paid_at is empty, paid_at will be filled with a timestamp at the current time.
            if ($invoice->status === 'paid' && empty($invoice->paid_at)) {
                $invoice->paid_at = now();
            }

            // Finally in cases of partial payment, if amount_due is less than the amount of the invoice but greater than 0,
            // status becomes partially_paid.
            if ($invoice->amount_due > 0 && $invoice->amount_due < $invoice->invoice_amount) {
                $invoice->status = 'partially_paid';
            }
        });
    }

    // Helper function for checking draft status when attempting to edit.
    public function isDraft(): bool {
        return $this->status === 'draft';
    }

    public function isPayable(): bool {
        return in_array($this->status, ['sent', 'partially_paid', 'overdue']);
    }


    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
