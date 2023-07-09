<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRentImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_rent_id',
        'image',      
    ];
}
