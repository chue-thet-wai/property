<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblOwner extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'lastname',
        'companyname',
        'phonenumber',
        'secondcontact',
        'email',
        'address',
        'remark',
        'is_delete',
        'created_by',
        'updated_by',
    ];

    public function property(){
        return $this->hasMany(TblProperty::class, 'owner_id');
    }
    public function property_rent(){
        return $this->hasMany(PropertyRent::class, 'owner_id');
    }
}
