<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $fillable = ['division'];

    public function township()
    {
        return $this->hasMany(Township::class,'division_id');
    }
}


