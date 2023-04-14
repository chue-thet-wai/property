<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'protype',
        'location',
        'price',
        'squarefeet',
        'address',
        'postalcode',
        'story',
        'bedroom',
        'bathroom',
        'description',
        'feature',
        'outinspace',
        'amenities',
        'availabledate',
        'accessories',
        'decoration',
        'proname',
        'area',
        'condition',
        'developer',
        'tenure',
        'builtyear',
        'created_by',
        'updated_by',
    ];

}
