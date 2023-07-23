<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'invoice_id',
        'contract_date',
        'rentout_date',
        'contract_month',
        'owner_id',
        'customer_id',
        'property_id',
        'partner_id',
        'description',
        'deal_price',
        'agent_fee',
        'discount',
        'tax',
        'total',
        'partner_fee',
        'agency_net_amt',
        'is_delete',
        'created_by',
        'updated_by',
    ];

    public function property(){
        return $this->belongsTo(TblProperty::class, 'property_id');
    }

    public function partner(){
        return $this->belongsTo(TblAgent::class, 'partner_id');
    }

    public function owner()
    {
        return $this->belongsTo(TblOwner::class, 'owner_id');
    }

    public function customer()
    {
        return $this->belongsTo(TblOwner::class, 'customer_id');
    }

    public function document()
    {
        return $this->hasMany(InvoiceDocument::class, 'invoice_id');
    }
}
