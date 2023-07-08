<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_mm',
        'category',
        'status',
        'public_status',
        'bank_loan',
        'price',
        'promotion_price',
        'description',
        'description_mm',
        'property_location',
        'detail_address',
        'postal_code',
        'google_map_url',
        'front_area',
        'side_area',
        'square_feet',
        'acre',
        'tenure_property',
        'property_type',
        'floor',
        'master_bedroom',
        'common_room',
        'bathroom',
        'build_year',
        'building_facility',
        'special_features',
        'view_count',
        'feature_photo',
        'remark',
        'created_by',
        'updated_by',
        'owner_id',
    ];

}
