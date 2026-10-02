<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\StoreSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $directBuy = $request->session()->get('direct_buy');

        if ($directBuy) {
            $cart = [
                $directBuy['id'] => $directBuy,
            ];

            $checkoutMode = 'direct';
        } else {
            $cart = $request->session()->get('cart', []);

            if (empty($cart)) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', 'Keranjang masih kosong.');
            }

            $checkoutMode = 'cart';
        }

        $total = collect($cart)->sum(
            fn ($item) => $item['harga'] * $item['jumlah']
        );

        $store = StoreSetting::first();

        return view(
            'checkout',
            compact(
                'cart',
                'total',
                'store',
                'checkoutMode'
            )
        );
    }

    public function success($kode)
    {
        $order = Order::with('items')
            ->where('kode_pesanan', $kode)
            ->firstOrFail();

        $store = StoreSetting::first();

        $nomor = preg_replace(
            '/[^0-9]/',
            '',
            $store->whatsapp ?? ''
        );

        if (str_starts_with($nomor, '0')) {
            $nomor = '62' . substr($nomor, 1);
        }

        $pesan = "Halo {$store->nama_toko}, saya ingin memesan:%0A%0A";
        $pesan .= "*Kode Pesanan: {$order->kode_pesanan}*%0A%0A";

        foreach ($order->items as $item) {
            $pesan .= "• {$item->nama_produk} x{$item->jumlah} = Rp "
                . number_format($item->subtotal, 0, ',', '.')
                . "%0A";
        }

        $pesan .= "%0A*Total: Rp "
            . number_format($order->total, 0, ',', '.')
            . "*%0A%0A";

        $pesan .= "Nama: {$order->nama_pembeli}%0A";
        $pesan .= "Alamat: {$order->alamat}%0A";

        if ($order->whatsapp) {
            $pesan .= "WhatsApp: {$order->whatsapp}%0A";
        }

        if ($order->catatan) {
            $pesan .= "Catatan: {$order->catatan}%0A";
        }

        $waUrl = $nomor
            ? "https://wa.me/{$nomor}?text={$pesan}"
            : null;

        return view('checkout-success', compact(
            'order',
            'store',
            'waUrl'
        ));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'whatsapp' => 'nullable|string|max:30',
            'alamat' => 'required|string|max:500',
            'catatan' => 'nullable|string|max:500',
        ]);

        $directBuy = $request->session()->get('direct_buy');

        if ($directBuy) {
            $cart = [
                $directBuy['id'] => $directBuy,
            ];

            $checkoutMode = 'direct';
        } else {
            $cart = $request->session()->get('cart', []);

            $checkoutMode = 'cart';
        }

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Tidak ada produk untuk checkout.');
        }

        $store = StoreSetting::first();

        if (!$store) {
            return back()->with(
                'error',
                'Pengaturan toko belum tersedia.'
            );
        }

        $total = collect($cart)->sum(
            fn ($item) => $item['harga'] * $item['jumlah']
        );

        /*
        |--------------------------------------------------------------------------
        | Buat kode pesanan
        |--------------------------------------------------------------------------
        */

        $kodePesanan = 'ORD-' . now()->format('YmdHis') . '-' . random_int(100, 999);

        /*
        |--------------------------------------------------------------------------
        | Simpan pesanan + item
        |--------------------------------------------------------------------------
        */

        $order = DB::transaction(function () use (
            $validated,
            $cart,
            $total,
            $kodePesanan
        ) {
            $order = Order::create([
                'kode_pesanan' => $kodePesanan,
                'nama_pembeli' => $validated['nama'],
                'whatsapp' => $validated['whatsapp'] ?? null,
                'alamat' => $validated['alamat'],
                'catatan' => $validated['catatan'] ?? null,
                'total' => $total,
                'status' => 'baru',
            ]);

            foreach ($cart as $item) {
                $jumlah = (int) $item['jumlah'];
                $harga = (float) $item['harga'];

                $order->items()->create([
                    'product_id' => $item['id'] ?? null,
                    'nama_produk' => $item['nama'],
                    'harga' => $harga,
                    'jumlah' => $jumlah,
                    'subtotal' => $harga * $jumlah,
                ]);
            }

            return $order;
        });

        /*
        |--------------------------------------------------------------------------
        | Pesan WhatsApp
        |--------------------------------------------------------------------------
        */

        $pesan =
            "Halo {$store->nama_toko}, saya ingin memesan:%0A%0A";

        $pesan .=
            "*Kode Pesanan: {$order->kode_pesanan}*%0A%0A";

        foreach ($cart as $item) {
            $subtotal =
                $item['harga'] * $item['jumlah'];

            $pesan .=
                "• {$item['nama']} x{$item['jumlah']} = Rp "
                . number_format(
                    $subtotal,
                    0,
                    ',',
                    '.'
                )
                . "%0A";
        }

        $pesan .=
            "%0A*Total: Rp "
            . number_format(
                $total,
                0,
                ',',
                '.'
            )
            . "*%0A%0A";

        $pesan .=
            "Nama: {$validated['nama']}%0A";

        if (!empty($validated['whatsapp'])) {
            $pesan .=
                "WhatsApp: {$validated['whatsapp']}%0A";
        }

        $pesan .=
            "Alamat: {$validated['alamat']}%0A";

        if (!empty($validated['catatan'])) {
            $pesan .=
                "Catatan: {$validated['catatan']}%0A";
        }

        $nomor = preg_replace(
            '/[^0-9]/',
            '',
            $store->whatsapp ?? ''
        );

        if (str_starts_with($nomor, '0')) {
            $nomor = '62' . substr($nomor, 1);
        }

        if (!$nomor) {
            return back()->with(
                'error',
                'Nomor WhatsApp toko belum diatur.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Bersihkan sesi setelah pesanan berhasil dibuat
        |--------------------------------------------------------------------------
        */

        if ($checkoutMode === 'direct') {
            $request->session()->forget('direct_buy');
        } else {
            $request->session()->forget('cart');
        }

        return redirect()->route(
            'checkout.success',
            ['kode' => $order->kode_pesanan]
        );
    }
}
