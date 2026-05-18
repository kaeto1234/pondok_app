<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YayasanInfo extends Model
{
    protected $table = 'yayasan_info';
    
    protected $fillable = [
        'nama_yayasan',
        'alamat',
        'telepon',
        'email',
        'whatsapp',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'google_maps',
        'logo',
        'favicon',
    ];
}