<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

/**
 * @property mixed $Customer
 */
class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'email',
        'phone',
        'street_address',
        'city',
        'state',
        'zip'
    ];

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }
}
