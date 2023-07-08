<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblPropertyDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'confidential_documents',    
    ];
}
