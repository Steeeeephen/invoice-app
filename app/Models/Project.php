<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'customer_id',
        'title',
        'description',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }
}
