<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainAgencyInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'header',
        'footer',
        'watermark_txt',
        'watermark_img',
        'default_img',
        'home_img',
        'content',
        'content_mm',
        'about_us',
        'about_us_mm',
        'address',
        'address_mm',
        'contact',
        'email',
        'website',
        'viber',
        'whatsapp',
        'facebook',
        'send_message',
        'footer_info',
        'developer_info',
        'created_by',
        'updated_by',
        'is_delete',
    ];

}
