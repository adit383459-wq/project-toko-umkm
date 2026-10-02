<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('store_settings', function (Blueprint $table) {
            $table->id();

            $table->string('nama_toko')->default('Toko UMKM Pro');
            $table->string('slogan')->nullable();

            $table->string('logo')->nullable();
            $table->string('banner')->nullable();

            $table->string('warna_utama')->default('#1769ff');
            $table->string('warna_kedua')->default('#ffd400');

            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();

            $table->text('alamat')->nullable();

            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();

            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_settings');
    }
};
