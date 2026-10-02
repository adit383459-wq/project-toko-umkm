<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreSetting extends Model
{
    protected $table = 'store_settings';

    protected $fillable = [
        'nama_toko',
        'slogan',
        'logo',
        'banner',
        'warna_utama',
        'warna_kedua',
        'whatsapp',
        'email',
        'alamat',
        'instagram',
        'tiktok',
        'deskripsi',
    ];
}
