<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblAgent extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'website',
        'email',
        'phone_no',
        'address',
        'profile_photo',
        'document',
        'remark',
    ];
}
