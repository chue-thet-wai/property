<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblCustomer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phonenumber',
        'email',
        'address',
        'enquiry_type',
        'enquiry_property',
        'from_month',
        'to_month',
        'enquiry_amount',
        'created_by',
        'updated_by',
    ];
}
