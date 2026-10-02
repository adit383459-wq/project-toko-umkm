<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('nama')->after('id');
            $table->string('slug')->unique()->after('nama');
            $table->text('deskripsi')->nullable()->after('slug');
            $table->decimal('harga', 15, 2)->default(0)->after('deskripsi');
            $table->decimal('harga_coret', 15, 2)->nullable()->after('harga');
            $table->integer('stok')->default(0)->after('harga_coret');
            $table->string('kategori')->nullable()->after('stok');
            $table->string('gambar')->nullable()->after('kategori');
            $table->boolean('aktif')->default(true)->after('gambar');
            $table->boolean('unggulan')->default(false)->after('aktif');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropUnique(['slug']);

            $table->dropColumn([
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
            ]);
        });
    }
};
