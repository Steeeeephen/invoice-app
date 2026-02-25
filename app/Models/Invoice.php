<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    protected static function booted()
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
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
