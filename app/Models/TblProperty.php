<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'detail_address',
        'postal_code',
        'google_map_url',
        'front_area',
        'side_area',
        'square_feet',
        'acre',
        'tenure_property',
        'property_type',
        'master_bedroom',
        'common_room',
        'bathroom',
        'build_year',
        'building_facility',
        'special_features',
        'view_count',
        'feature_photo',
        'division',
        'township',
        'ward',
        'remark',
        'created_by',
        'updated_by',
        'owner_id',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(TblOwner::class, 'owner_id');
    }
    

}
