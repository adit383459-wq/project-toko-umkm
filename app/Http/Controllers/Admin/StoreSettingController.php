<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreSettingController extends Controller
{
    public function edit()
    {
        $store = StoreSetting::first();

        if (!$store) {
            $store = StoreSetting::create([
                'nama_toko' => 'Toko UMKM Pro',
                'slogan' => 'Belanja Hemat Cuan Nikmat',
                'warna_utama' => '#1769ff',
                'warna_kedua' => '#ffd400',
            ]);
        }

        return view('admin.store-settings', compact('store'));
    }

    public function update(Request $request)
    {
        $store = StoreSetting::first();

        $validated = $request->validate([
            'nama_toko' => 'required|string|max:100',
            'slogan' => 'nullable|string|max:150',
            'whatsapp' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:100',
            'alamat' => 'nullable|string',
            'instagram' => 'nullable|string|max:100',
            'tiktok' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'warna_utama' => 'required|string|max:20',
            'warna_kedua' => 'required|string|max:20',

            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            if ($store->logo && Storage::disk('public')->exists($store->logo)) {
                Storage::disk('public')->delete($store->logo);
            }

            $validated['logo'] = $request
                ->file('logo')
                ->store('toko/logo', 'public');
        }

        if ($request->hasFile('banner')) {
            if ($store->banner && Storage::disk('public')->exists($store->banner)) {
                Storage::disk('public')->delete($store->banner);
            }

            $validated['banner'] = $request
                ->file('banner')
                ->store('toko/banner', 'public');
        }

        $store->update($validated);

        return back()->with(
            'success',
            'Pengaturan toko berhasil diperbarui.'
        );
    }
}
