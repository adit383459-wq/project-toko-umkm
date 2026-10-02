<?php

use Illuminate\Support\Facades\Route;
use App\Models\StoreSetting;
use App\Models\Product;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StoreSettingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderTrackingController;

Route::get('/', function () {

    $store = StoreSetting::first();

    if (!$store) {
        $store = StoreSetting::create([
            'nama_toko' => 'Toko UMKM Pro',
            'slogan' => 'Belanja Hemat Cuan Nikmat',
            'warna_utama' => '#1769ff',
            'warna_kedua' => '#ffd400',
            'deskripsi' => 'Temukan produk pilihan terbaik untuk kebutuhanmu.',
        ]);
    }

    $products = Product::where('aktif', true)
        ->latest()
        ->get();

    $featuredProducts = Product::where('aktif', true)
        ->where('unggulan', true)
        ->latest()
        ->get();

    return view('welcome', compact(
        'store',
        'products',
        'featuredProducts'
    ));
})->name('home');


/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/keranjang', [CartController::class, 'index'])
    ->name('cart.index');

Route::get('/keranjang/tambah/{product}', [CartController::class, 'add'])
    ->name('cart.add');
Route::get('/beli-sekarang/{product}', [CartController::class, 'buyNow'])
    ->name('cart.buyNow');

Route::post('/keranjang/update/{id}', [CartController::class, 'update'])
    ->name('cart.update');

Route::get('/keranjang/hapus/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::get('/keranjang/kosongkan', [CartController::class, 'clear'])
    ->name('cart.clear');

Route::get('/admin/login', [
    AuthController::class,
    'showLogin'
])->name('admin.login');

Route::post('/admin/login', [
    AuthController::class,
    'login'
])->name('admin.login.submit');

Route::post('/admin/logout', [
    AuthController::class,
    'logout'
])->name('admin.logout');


/*
|--------------------------------------------------------------------------
| AREA ADMIN
|--------------------------------------------------------------------------
*/


Route::get('/cek-pesanan', [OrderTrackingController::class, 'index'])
    ->name('orders.tracking');

Route::post('/cek-pesanan', [OrderTrackingController::class, 'check'])
    ->name('orders.tracking.check');

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/pesanan', [OrderController::class, 'index'])
        ->name('admin.orders.index');

    Route::get('/pesanan/{order}', [OrderController::class, 'show'])
        ->name('admin.orders.show');

    Route::patch('/pesanan/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('admin.orders.status');
    Route::resource('/categories', CategoryController::class)->names('admin.categories');

    Route::get('/dashboard', function () {
        $newOrders = \App\Models\Order::where('status', 'baru')->count();

        $latestOrders = \App\Models\Order::latest()
            ->take(5)
            ->get();

        $totalOrders = \App\Models\Order::count();

        $processingOrders = \App\Models\Order::where('status', 'diproses')->count();

        $totalRevenue = \App\Models\Order::whereIn('status', [
            'baru',
            'diproses',
            'selesai'
        ])->sum('total');

        $topProducts = \App\Models\OrderItem::select(
                'nama_produk',
                \Illuminate\Support\Facades\DB::raw('SUM(jumlah) as total_terjual'),
                \Illuminate\Support\Facades\DB::raw('SUM(subtotal) as total_penjualan')
            )
            ->whereHas('order', function ($query) {
                $query->whereIn('status', [
                    'baru',
                    'diproses',
                    'selesai'
                ]);
            })
            ->groupBy('nama_produk')
            ->orderByDesc('total_terjual')
            ->take(5)
            ->get();

        $lowStockProducts = \App\Models\Product::where('stok', '<=', 5)
            ->where('aktif', true)
            ->orderBy('stok')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'newOrders',
            'latestOrders',
            'totalOrders',
            'processingOrders',
            'totalRevenue',
            'topProducts',
            'lowStockProducts'
        ));
    })->name('admin.dashboard');


    Route::get('/laporan/export-pdf', [ReportController::class, 'pdf'])
        ->name('admin.reports.pdf');

    Route::get('/laporan/export-excel', [ReportController::class, 'excel'])
        ->name('admin.reports.excel');

    Route::get('/laporan', function (\Illuminate\Http\Request $request) {
        $periode = $request->input('periode', 'bulan');

        $start = match ($periode) {
            'hari' => now()->startOfDay(),
            '7hari' => now()->subDays(6)->startOfDay(),
            default => now()->startOfMonth(),
        };

        $end = now()->endOfDay();

        $ordersQuery = \App\Models\Order::whereBetween(
            'created_at',
            [$start, $end]
        )->whereIn('status', [
            'baru',
            'diproses',
            'selesai'
        ]);

        $totalOrders = (clone $ordersQuery)->count();

        $totalRevenue = (clone $ordersQuery)->sum('total');

        $itemsSold = \App\Models\OrderItem::whereHas('order', function ($query) use ($start, $end) {
                $query->whereBetween('created_at', [$start, $end])
                    ->whereIn('status', [
                        'baru',
                        'diproses',
                        'selesai'
                    ]);
            })
            ->sum('jumlah');

        $topProducts = \App\Models\OrderItem::select(
                'nama_produk',
                \Illuminate\Support\Facades\DB::raw('SUM(jumlah) as total_terjual'),
                \Illuminate\Support\Facades\DB::raw('SUM(subtotal) as total_penjualan')
            )
            ->whereHas('order', function ($query) use ($start, $end) {
                $query->whereBetween('created_at', [$start, $end])
                    ->whereIn('status', [
                        'baru',
                        'diproses',
                        'selesai'
                    ]);
            })
            ->groupBy('nama_produk')
            ->orderByDesc('total_terjual')
            ->take(10)
            ->get();

        return view('admin.reports.index', compact(
            'periode',
            'start',
            'end',
            'totalOrders',
            'totalRevenue',
            'itemsSold',
            'topProducts'
        ));
    })->name('admin.reports.index');

    Route::resource('/products', ProductController::class)
        ->names('admin.products');

    Route::get('/pengaturan-toko', [
        StoreSettingController::class,
        'edit'
    ])->name('admin.store-settings.edit');

    Route::put('/pengaturan-toko', [
        StoreSettingController::class,
        'update'
    ])->name('admin.store-settings.update');

});


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/sukses/{kode}', [CheckoutController::class, 'success'])
    ->name('checkout.success');
