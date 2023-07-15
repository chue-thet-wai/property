<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenure extends Model
{
    use HasFactory;
    protected $fillable = ['tenure', 'tenure_mm'];
}
