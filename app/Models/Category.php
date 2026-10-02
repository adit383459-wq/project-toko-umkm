<?php

namespace App\Models;

use App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'aktif',
    ];

    protected static function booted(): void
    {
        static::creating(function ($category) {
            if (!$category->slug) {
                $category->slug = Str::slug($category->nama);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('nama')) {
                $category->slug = Str::slug($category->nama);
            }
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'kategori', 'nama');
    }

}
