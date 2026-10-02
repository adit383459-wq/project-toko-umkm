<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\StoreSetting;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function index()
    {
        $store = StoreSetting::first();

        return view('order-tracking', compact('store'));
    }

    public function check(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:100',
        ]);

        $kode = trim($validated['kode']);

        $order = Order::with('items')
            ->where('kode_pesanan', $kode)
            ->first();

        $store = StoreSetting::first();

        if (!$order) {
            return back()
                ->withInput()
                ->with('error', 'Kode pesanan tidak ditemukan. Periksa kembali kode ORD- kamu.');
        }

        return view('order-tracking', compact(
            'store',
            'order'
        ));
    }
}
