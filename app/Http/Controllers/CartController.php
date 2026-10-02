<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StoreSetting;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        $total = collect($cart)->sum(
            fn ($item) => $item['harga'] * $item['jumlah']
        );

        $store = StoreSetting::first();

        return view('cart', compact('cart', 'total', 'store'));
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH KE KERANJANG
    |--------------------------------------------------------------------------
    */

    public function add(Request $request, Product $product)
    {
        if (!$product->aktif || $product->stok < 1) {
            return back()->with(
                'error',
                'Produk sedang tidak tersedia.'
            );
        }

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['jumlah'] = min(
                $cart[$product->id]['jumlah'] + 1,
                $product->stok
            );
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'nama' => $product->nama,
                'harga' => (float) $product->harga,
                'gambar' => $product->gambar,
                'jumlah' => 1,
            ];
        }

        $request->session()->put('cart', $cart);

        return back()->with(
            'success',
            'Produk masuk ke keranjang 🛒'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | BELI SEKARANG
    |--------------------------------------------------------------------------
    | Tidak memasukkan produk ke cart.
    | Produk disimpan sementara sebagai direct_buy.
    */

    public function buyNow(Request $request, Product $product)
    {
        if (!$product->aktif || $product->stok < 1) {
            return back()->with(
                'error',
                'Produk sedang tidak tersedia.'
            );
        }

        $directBuy = [
            'id' => $product->id,
            'nama' => $product->nama,
            'harga' => (float) $product->harga,
            'gambar' => $product->gambar,
            'jumlah' => 1,
        ];

        $request->session()->put('direct_buy', $directBuy);

        return redirect()->route('checkout.index');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE KERANJANG
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back();
        }

        $product = Product::find($id);

        if (!$product || !$product->aktif || $product->stok < 1) {
            unset($cart[$id]);
        } else {
            $jumlah = max(
                1,
                (int) $request->jumlah
            );

            $cart[$id]['jumlah'] = min(
                $jumlah,
                $product->stok
            );
        }

        $request->session()->put('cart', $cart);

        return back()->with(
            'success',
            'Keranjang diperbarui.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS PRODUK
    |--------------------------------------------------------------------------
    */

    public function remove(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);

        unset($cart[$id]);

        $request->session()->put('cart', $cart);

        return back()->with(
            'success',
            'Produk dihapus.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | KOSONGKAN KERANJANG
    |--------------------------------------------------------------------------
    */

    public function clear(Request $request)
    {
        $request->session()->forget('cart');

        return back()->with(
            'success',
            'Keranjang dikosongkan.'
        );
    }
}
