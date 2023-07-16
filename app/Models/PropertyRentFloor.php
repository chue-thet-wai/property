<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRentFloor extends Model
{
    use HasFactory;
    protected $fillable = ['property_rent_id','floor_id'];
}

