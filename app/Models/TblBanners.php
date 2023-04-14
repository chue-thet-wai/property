<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblBanners extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'img',
        'banner_type',
        'created_by',
        'updated_by',
    ];
}
