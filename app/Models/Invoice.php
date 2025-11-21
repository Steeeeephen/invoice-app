<?php

namespace App\Models;

use App\Observers\InvoiceObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

//#[ObservedBy([InvoiceObserver::Class])]
class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'product_id',
        'description',
        'amount_due',
        'due_date',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
