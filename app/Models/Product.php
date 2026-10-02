<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'harga_coret',
        'stok',
        'kategori',
        'gambar',
        'aktif',
        'unggulan',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'harga_coret' => 'decimal:2',
        'aktif' => 'boolean',
        'unggulan' => 'boolean',
    ];

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = $value;

        if (!$this->exists || empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori', 'nama');
    }
}
