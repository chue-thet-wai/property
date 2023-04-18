<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblOwner extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phonenumber',
        'email',
        'address',
        'created_by',
        'updated_by',
    ];
}
