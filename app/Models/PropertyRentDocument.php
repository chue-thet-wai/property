<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRentDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_rent_id',
        'confidential_documents',      
    ];
}
