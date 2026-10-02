<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Admin - {{ $store->nama_toko ?? 'Toko UMKM Pro' }}</title>

<style>
*{
    box-sizing:border-box;
}

body{
    margin:0;
    font-family:Arial,Helvetica,sans-serif;
    background:#f5f7fb;
    color:#172033;
}

a{
    text-decoration:none;
}

.topbar{
    background:#fff;
    border-bottom:1px solid #e8edf5;
    padding:14px 22px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    position:sticky;
    top:0;
    z-index:50;
}

.brand{
    display:flex;
    align-items:center;
    gap:11px;
}

.brand-icon{
    width:42px;
    height:42px;
    border-radius:13px;
    background:linear-gradient(135deg,#1769ff,#5c91ff);
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-size:20px;
    box-shadow:0 7px 18px rgba(23,105,255,.18);
}

.brand-title{
    font-size:16px;
    font-weight:900;
}

.brand-sub{
    color:#929baa;
    font-size:10px;
    margin-top:3px;
}

.logout{
    border:1px solid #e1e6ef;
    background:#fff;
    color:#657084;
    border-radius:10px;
    padding:9px 13px;
    font-size:11px;
    font-weight:800;
    cursor:pointer;
}

.logout:hover{
    background:#f8faff;
}

.container{
    width:min(1180px,calc(100% - 30px));
    margin:auto;
    padding:28px 0 60px;
}

.welcome{
    margin-bottom:22px;
}

.welcome small{
    color:#1769ff;
    font-size:10px;
    font-weight:900;
    letter-spacing:1.5px;
    text-transform:uppercase;
}

.welcome h1{
    margin:7px 0 5px;
    font-size:32px;
    letter-spacing:-1.2px;
}

.welcome p{
    margin:0;
    color:#818b9c;
    font-size:13px;
}

.stats{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:14px;
    margin-bottom:18px;
}

.stat{
    background:#fff;
    border:1px solid #e9edf4;
    border-radius:16px;
    padding:17px;
    box-shadow:0 6px 22px rgba(20,35,60,.04);
}

.stat-head{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.stat-label{
    color:#8c96a7;
    font-size:10px;
    font-weight:900;
}

.stat-icon{
    width:34px;
    height:34px;
    border-radius:10px;
    background:#eef5ff;
    display:flex;
    align-items:center;
    justify-content:center;
}

.stat-number{
    margin-top:13px;
    font-size:26px;
    font-weight:900;
}

.stat-note{
    color:#9aa3b1;
    font-size:10px;
    margin-top:3px;
}

.layout{
    display:grid;
    grid-template-columns:1.45fr .9fr;
    gap:16px;
}

.card{
    background:#fff;
    border:1px solid #e9edf4;
    border-radius:17px;
    padding:20px;
    box-shadow:0 6px 22px rgba(20,35,60,.04);
    margin-bottom:16px;
}

.card:last-child{
    margin-bottom:0;
}

.card-title{
    font-size:15px;
    font-weight:900;
}

.card-sub{
    color:#929baa;
    font-size:10px;
    margin-top:4px;
    margin-bottom:17px;
}

.quick-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:10px;
}

.quick-action{
    display:flex;
    align-items:center;
    gap:12px;
    width:100%;
    min-height:68px;
    padding:13px;
    border:1px solid #e8edf5;
    border-radius:14px;
    background:#fff;
    color:#172033;
    transition:.2s;
}

.quick-action:hover{
    border-color:#c9d8ff;
    background:#f8faff;
    transform:translateY(-2px);
    box-shadow:0 8px 20px rgba(23,105,255,.07);
}

.quick-icon{
    width:40px;
    height:40px;
    flex:0 0 40px;
    border-radius:11px;
    background:#eef4ff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:19px;
}

.quick-action strong{
    display:block;
    font-size:12px;
    font-weight:900;
}

.quick-action span:last-child{
    color:#818b9c;
    font-size:9px;
    margin-top:3px;
}

.product-list{
    display:flex;
    flex-direction:column;
    gap:9px;
}

.product-row{
    display:flex;
    align-items:center;
    gap:11px;
    border:1px solid #edf0f5;
    border-radius:13px;
    padding:10px;
}

.product-thumb{
    width:50px;
    height:50px;
    border-radius:11px;
    overflow:hidden;
    background:#f2f5fa;
    flex:0 0 50px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
}

.product-thumb img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.product-info{
    min-width:0;
    flex:1;
}

.product-name{
    font-size:12px;
    font-weight:900;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.product-meta{
    color:#8993a4;
    font-size:9px;
    margin-top:4px;
}

.product-price{
    font-size:11px;
    font-weight:900;
    margin-top:4px;
}

.product-status{
    font-size:9px;
    font-weight:800;
    padding:5px 8px;
    border-radius:999px;
    background:#edf8f1;
    color:#198754;
    white-space:nowrap;
}

.product-status.off{
    background:#fff0f0;
    color:#d33;
}

.product-empty{
    text-align:center;
    padding:28px 15px;
    color:#929baa;
    font-size:11px;
    border:1px dashed #dce2eb;
    border-radius:13px;
}

.card-link{
    display:inline-flex;
    margin-top:12px;
    color:#1769ff;
    font-size:10px;
    font-weight:900;
}

.store-box{
    background:linear-gradient(135deg,#f5f9ff,#edf5ff);
    border:1px solid #dce9ff;
    border-radius:14px;
    padding:16px;
}

.store-name{
    color:#173b82;
    font-size:20px;
    font-weight:900;
}

.store-slogan{
    color:#7b8799;
    font-size:10px;
    margin-top:5px;
}

.store-info{
    display:grid;
    gap:8px;
    margin-top:14px;
}

.info-line{
    display:flex;
    gap:8px;
    color:#69758a;
    font-size:10px;
}

.info-line b{
    color:#25324a;
}

.setting{
    display:block;
    text-align:center;
    background:#1769ff;
    color:#fff;
    border-radius:10px;
    padding:11px;
    margin-top:12px;
    font-size:11px;
    font-weight:900;
}

.setting:hover{
    background:#0e58df;
}

.warning{
    margin-top:12px;
    padding:11px;
    border-radius:10px;
    background:#fff8e8;
    border:1px solid #ffe3a5;
    color:#986700;
    font-size:10px;
}

.category-list{
    display:flex;
    flex-wrap:wrap;
    gap:7px;
}

.category-pill{
    display:inline-flex;
    align-items:center;
    gap:5px;
    padding:8px 10px;
    border-radius:999px;
    background:#f4f7fc;
    border:1px solid #e7ebf2;
    color:#4d5970;
    font-size:9px;
    font-weight:800;
}

.category-pill span{
    color:#1769ff;
}

.footer-note{
    text-align:center;
    color:#a0a8b5;
    font-size:9px;
    margin-top:22px;
}

@media(max-width:850px){
    .stats{
        grid-template-columns:repeat(2,1fr);
    }

    .layout{
        grid-template-columns:1fr;
    }
}

@media(max-width:520px){
    .topbar{
        padding:12px 14px;
    }

    .container{
        width:calc(100% - 20px);
        padding-top:21px;
    }

    .welcome h1{
        font-size:26px;
    }

    .stats{
        gap:9px;
    }

    .stat{
        padding:13px;
        border-radius:13px;
    }

    .stat-number{
        font-size:22px;
    }

    .quick-grid{
        grid-template-columns:1fr;
    }

    .card{
        padding:16px;
    }

    .product-status{
        display:none;
    }

    .brand-title{
        max-width:170px;
        white-space:nowrap;
        overflow:hidden;
        text-overflow:ellipsis;
    }
}

@media (max-width: 850px) {
    div[style*="grid-template-columns:repeat(4,minmax(0,1fr))"] {
        grid-template-columns:repeat(2,minmax(0,1fr)) !important;
    }
}

@media (max-width: 500px) {
    div[style*="grid-template-columns:repeat(4,minmax(0,1fr))"] {
        grid-template-columns:1fr !important;
    }
}

</style>
</head>

<body>

<header class="topbar">

    <div class="brand">
        <div class="brand-icon">🛍️</div>

        <div>
            <div class="brand-title">
                {{ $store->nama_toko ?? 'Toko UMKM Pro' }}
            </div>

            <div class="brand-sub">
                Pusat Kontrol Toko
            </div>
        </div>
    </div>

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button class="logout" type="submit">
            Keluar
        </button>
    </form>

</header>

<main class="container">

    <section class="welcome">
        <small>Admin Control Center</small>

        <h1>Selamat datang 👋</h1>

        <p>
            Semua pengelolaan toko tersedia dari satu dashboard.
        </p>
    </section>


    {{-- STATISTIK --}}

    <section class="stats">

        <div class="stat">
            <div class="stat-head">
                <div class="stat-label">TOTAL PRODUK</div>
                <div class="stat-icon">📦</div>
            </div>

            <div class="stat-number">
                {{ $totalProduk ?? 0 }}
            </div>

            <div class="stat-note">
                Semua produk
            </div>
        </div>


        <div class="stat">
            <div class="stat-head">
                <div class="stat-label">PRODUK AKTIF</div>
                <div class="stat-icon">✓</div>
            </div>

            <div class="stat-number">
                {{ $produkAktif ?? 0 }}
            </div>

            <div class="stat-note">
                Tampil di toko
            </div>
        </div>


        <div class="stat">
            <div class="stat-head">
                <div class="stat-label">STOK MENIPIS</div>
                <div class="stat-icon">⚠️</div>
            </div>

            <div class="stat-number">
                {{ $stokMenipis ?? 0 }}
            </div>

            <div class="stat-note">
                Stok 5 atau kurang
            </div>
        </div>


        <div class="stat">
            <div class="stat-head">
                <div class="stat-label">UNGGULAN</div>
                <div class="stat-icon">⭐</div>
            </div>

            <div class="stat-number">
                {{ $produkUnggulan ?? 0 }}
            </div>

            <div class="stat-note">
                Produk pilihan
            </div>
        </div>

        <div class="stat">
            <div class="stat-head">
                <div class="stat-label">PESANAN BARU</div>
                <div class="stat-icon">🛎️</div>
            </div>

            <div class="stat-number">
                {{ $newOrders ?? 0 }}
            </div>

            <div class="stat-note">
                Menunggu diproses
            </div>
        </div>

    </section>


    <section class="layout">

        <div>

            {{-- MENU UTAMA --}}

            <div class="card">

                <div class="card-title">
                    Kelola Toko
                </div>

                <div class="card-sub">
                    Pilih bagian yang ingin kamu kelola.
                </div>


                <div class="quick-grid">

                    <a href="{{ route('admin.products.index') }}" class="quick-action">
                        <span class="quick-icon">📦</span>
                        <span>
                            <strong>Produk</strong>
                            <span>Tambah, edit, stok & produk unggulan</span>
                        </span>
                    </a>


                    <a href="{{ route('admin.categories.index') }}" class="quick-action">
                        <span class="quick-icon">🏷️</span>
                        <span>
                            <strong>Kategori</strong>
                            <span>Atur kategori produk toko</span>
                        </span>
                    </a>


                    <a href="{{ route('admin.store-settings.edit') }}" class="quick-action">
                        <span class="quick-icon">🎨</span>
                        <span>
                            <strong>Branding Toko</strong>
                            <span>Nama, logo, banner, warna & WA</span>
                        </span>
                    </a>


                    <a href="{{ route('home') }}" class="quick-action">
                        <span class="quick-icon">🌐</span>
                        <span>
                            <strong>Lihat Toko</strong>
                            <span>Preview website toko</span>
                        </span>
                    </a>


                    <a href="{{ route('cart.index') }}" class="quick-action">
                        <span class="quick-icon">🛒</span>
                        <span>
                            <strong>Keranjang</strong>
                            <span>Preview halaman belanja</span>
                        </span>
                    </a>

                </div>

            </div>


            {{-- PRODUK TERBARU --}}

            <div class="card">

                <div class="card-title">
                    Produk Terbaru
                </div>

                <div class="card-sub">
                    Ringkasan produk yang baru ditambahkan.
                </div>

                <div class="product-list">

                    @php
                        $dashboardProducts = \App\Models\Product::latest()->take(5)->get();
                    @endphp

                    @forelse($dashboardProducts as $product)

                        <div class="product-row">

                            <div class="product-thumb">

                                @if($product->gambar)

                                    <img
                                        src="{{ asset('storage/' . $product->gambar) }}"
                                        alt="{{ $product->nama }}"
                                    >

                                @else

                                    📦

                                @endif

                            </div>


                            <div class="product-info">

                                <div class="product-name">
                                    {{ $product->nama }}
                                </div>

                                <div class="product-meta">
                                    {{ $product->kategori ?: 'Tanpa kategori' }}
                                    · Stok {{ $product->stok }}
                                </div>

                                <div class="product-price">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </div>

                            </div>


                            @if($product->aktif)

                                <div class="product-status">
                                    Aktif
                                </div>

                            @else

                                <div class="product-status off">
                                    Nonaktif
                                </div>

                            @endif

                        </div>

                    @empty

                        <div class="product-empty">
                            Belum ada produk.
                        </div>

                    @endforelse

                </div>


                <a href="{{ route('admin.products.create') }}" class="card-link">
                    ＋ Tambah Produk
                </a>

            </div>


            {{-- KATEGORI --}}

            <div class="card">

                <div class="card-title">
                    Kategori Produk
                </div>

                <div class="card-sub">
                    Kategori aktif yang tersedia di toko.
                </div>

                @php
                    $dashboardCategories = \App\Models\Category::where('aktif', true)
                        ->orderBy('nama')
                        ->get();
                @endphp


                @if($dashboardCategories->count())

                    <div class="category-list">

                        @foreach($dashboardCategories as $category)

                            <div class="category-pill">
                                <span>●</span>
                                {{ $category->nama }}
                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="product-empty">
                        Belum ada kategori aktif.
                    </div>

                @endif


                <a href="{{ route('admin.categories.create') }}" class="card-link">
                    ＋ Tambah Kategori
                </a>

            </div>

        </div>


        <div>

            {{-- IDENTITAS TOKO --}}

            <div class="card">

                <div class="card-title">
                    Identitas Toko
                </div>

                <div class="card-sub">
                    Informasi utama toko yang tampil ke pelanggan.
                </div>


                <div class="store-box">

                    <div class="store-name">
                        {{ $store->nama_toko ?? 'Toko UMKM Pro' }}
                    </div>

                    <div class="store-slogan">
                        {{ $store->slogan ?? 'Belanja Hemat Cuan Nikmat' }}
                    </div>


                    <div class="store-info">

                        @if($store->whatsapp ?? null)
                            <div class="info-line">
                                📱 <span>WhatsApp: <b>{{ $store->whatsapp }}</b></span>
                            </div>
                        @endif

                        @if($store->alamat ?? null)
                            <div class="info-line">
                                📍 <span>{{ $store->alamat }}</span>
                            </div>
                        @endif

                        @if($store->email ?? null)
                            <div class="info-line">
                                ✉️ <span>{{ $store->email }}</span>
                            </div>
                        @endif

                    </div>

                </div>


                <a
                    href="{{ route('admin.store-settings.edit') }}"
                    class="setting"
                >
                    ⚙️ Atur Toko
                </a>


                @if(($stokMenipis ?? 0) > 0)

                    <div class="warning">
                        ⚠️ Ada {{ $stokMenipis }} produk dengan stok menipis.
                    </div>

                @endif

            </div>


            {{-- STATUS TOKO --}}

            <div class="card">

                <div class="card-title">
                    Status Toko
                </div>

                <div class="card-sub">
                    Ringkasan kondisi toko saat ini.
                </div>


                <div class="info-line">
                    🟢 <span>Toko online siap digunakan</span>
                </div>

                <div class="info-line" style="margin-top:10px;">
                    📦 <span>{{ $produkAktif ?? 0 }} produk aktif</span>
                </div>

                <div class="info-line" style="margin-top:10px;">
                    🏷️ <span>{{ $dashboardCategories->count() }} kategori aktif</span>
                </div>


                <a
                    href="{{ route('home') }}"
                    class="setting"
                    style="background:#172033;"
                >
                    🌐 Buka Toko
                </a>

            </div>

        </div>

    </section>




    <section style="margin:0 0 25px;padding:0 20px;">
        <div style="max-width:1200px;margin:0 auto;">

            <div style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;">

                <div style="background:#fff;border:1px solid #e5e7eb;border-radius:17px;padding:18px;box-shadow:0 7px 22px rgba(15,23,42,.05);">
                    <div style="font-size:12px;font-weight:800;color:#64748b;">TOTAL OMZET</div>
                    <div style="margin-top:8px;font-size:23px;font-weight:950;color:#111827;">
                        Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}
                    </div>
                    <div style="margin-top:5px;font-size:11px;color:#94a3b8;">
                        Pesanan aktif & selesai
                    </div>
                </div>

                <div style="background:#fff;border:1px solid #e5e7eb;border-radius:17px;padding:18px;box-shadow:0 7px 22px rgba(15,23,42,.05);">
                    <div style="font-size:12px;font-weight:800;color:#64748b;">TOTAL PESANAN</div>
                    <div style="margin-top:8px;font-size:28px;font-weight:950;color:#111827;">
                        {{ $totalOrders ?? 0 }}
                    </div>
                    <div style="margin-top:5px;font-size:11px;color:#94a3b8;">
                        Semua pesanan masuk
                    </div>
                </div>

                <div style="background:#fff;border:1px solid #e5e7eb;border-radius:17px;padding:18px;box-shadow:0 7px 22px rgba(15,23,42,.05);">
                    <div style="font-size:12px;font-weight:800;color:#64748b;">SEDANG DIPROSES</div>
                    <div style="margin-top:8px;font-size:28px;font-weight:950;color:#2563eb;">
                        {{ $processingOrders ?? 0 }}
                    </div>
                    <div style="margin-top:5px;font-size:11px;color:#94a3b8;">
                        Perlu ditangani
                    </div>
                </div>

                <div style="background:#fff;border:1px solid #e5e7eb;border-radius:17px;padding:18px;box-shadow:0 7px 22px rgba(15,23,42,.05);">
                    <div style="font-size:12px;font-weight:800;color:#64748b;">PESANAN BARU</div>
                    <div style="margin-top:8px;font-size:28px;font-weight:950;color:#e53935;">
                        {{ $newOrders ?? 0 }}
                    </div>
                    <div style="margin-top:5px;font-size:11px;color:#94a3b8;">
                        Menunggu diproses
                    </div>
                </div>

            </div>

        </div>
    </section>

    <section style="margin:0 0 30px;padding:0 20px;">
        <div style="max-width:1200px;margin:0 auto;">

            <div style="display:flex;align-items:center;justify-content:space-between;gap:15px;margin-bottom:15px;flex-wrap:wrap;">
                <div>
                    <h2 style="margin:0;font-size:21px;font-weight:900;color:#111827;">
                        🛍️ Pesanan Terbaru
                    </h2>

                    <div style="margin-top:5px;color:#64748b;font-size:13px;">
                        Lima pesanan terakhir yang masuk ke toko.
                    </div>
                </div>

                <a
                    href="{{ route('admin.orders.index') }}"
                    style="text-decoration:none;padding:10px 15px;border-radius:12px;background:#111827;color:#fff;font-size:13px;font-weight:800;"
                >
                    Lihat Semua →
                </a>
            </div>

            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:18px;overflow:hidden;box-shadow:0 8px 25px rgba(15,23,42,.05);">

                @forelse($latestOrders ?? [] as $order)

                    <div style="display:flex;align-items:center;justify-content:space-between;gap:15px;padding:16px 18px;border-bottom:1px solid #f1f5f9;flex-wrap:wrap;">

                        <div style="min-width:190px;flex:1;">
                            <div style="font-weight:900;color:#111827;font-size:14px;">
                                {{ $order->kode_pesanan }}
                            </div>

                            <div style="margin-top:4px;color:#64748b;font-size:12px;">
                                👤 {{ $order->nama_pembeli }}
                            </div>

                            <div style="margin-top:3px;color:#94a3b8;font-size:11px;">
                                🕐 {{ $order->created_at->format('d M Y • H:i') }}
                            </div>
                        </div>

                        <div style="font-weight:900;color:#111827;">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </div>

                        @php
                            $statusStyle = match($order->status) {
                                'baru' => 'background:#fff7ed;color:#c2410c;',
                                'diproses' => 'background:#eff6ff;color:#2563eb;',
                                'selesai' => 'background:#ecfdf5;color:#059669;',
                                'dibatalkan' => 'background:#fef2f2;color:#dc2626;',
                                default => 'background:#f8fafc;color:#64748b;',
                            };

                            $statusLabel = match($order->status) {
                                'baru' => 'Baru',
                                'diproses' => 'Diproses',
                                'selesai' => 'Selesai',
                                'dibatalkan' => 'Dibatalkan',
                                default => ucfirst($order->status),
                            };
                        @endphp

                        <span style="padding:7px 11px;border-radius:999px;font-size:11px;font-weight:900;{{ $statusStyle }}">
                            {{ $statusLabel }}
                        </span>

                        <a
                            href="{{ route('admin.orders.show', $order) }}"
                            style="text-decoration:none;padding:9px 13px;border:1px solid #e2e8f0;border-radius:10px;color:#334155;font-size:12px;font-weight:800;background:#fff;"
                        >
                            Detail
                        </a>

                    </div>

                @empty

                    <div style="padding:35px 20px;text-align:center;color:#64748b;">
                        <div style="font-size:35px;margin-bottom:8px;">📦</div>

                        <div style="font-weight:800;color:#334155;">
                            Belum ada pesanan
                        </div>

                        <div style="font-size:12px;margin-top:4px;">
                            Pesanan pelanggan akan muncul di sini.
                        </div>
                    </div>

                @endforelse

            </div>
        </div>
    </section>


    <section style="margin:0 0 30px;padding:0 20px;">
        <div style="max-width:1200px;margin:0 auto;">

            <div style="margin-bottom:15px;">
                <h2 style="margin:0;font-size:21px;font-weight:900;color:#111827;">
                    📦 Produk Terlaris
                </h2>

                <div style="margin-top:5px;color:#64748b;font-size:13px;">
                    Produk dengan jumlah pembelian terbanyak.
                </div>
            </div>

            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:18px;overflow:hidden;box-shadow:0 8px 25px rgba(15,23,42,.05);">

                @forelse($topProducts ?? [] as $index => $product)

                    <div style="display:flex;align-items:center;gap:15px;padding:16px 18px;border-bottom:1px solid #f1f5f9;flex-wrap:wrap;">

                        <div style="width:38px;height:38px;border-radius:12px;background:#f8fafc;display:flex;align-items:center;justify-content:center;font-size:17px;font-weight:900;color:#475569;flex:none;">
                            {{ $index + 1 }}
                        </div>

                        <div style="flex:1;min-width:150px;">
                            <div style="font-weight:900;color:#111827;font-size:14px;">
                                {{ $product->nama_produk }}
                            </div>

                            <div style="margin-top:4px;color:#64748b;font-size:12px;">
                                {{ $product->total_terjual }} barang terjual
                            </div>
                        </div>

                        <div style="text-align:right;">
                            <div style="font-weight:900;color:#111827;font-size:14px;">
                                Rp {{ number_format($product->total_penjualan, 0, ',', '.') }}
                            </div>

                            <div style="margin-top:3px;color:#94a3b8;font-size:11px;">
                                total penjualan
                            </div>
                        </div>

                    </div>

                @empty

                    <div style="padding:35px 20px;text-align:center;color:#64748b;">
                        <div style="font-size:35px;margin-bottom:8px;">📊</div>

                        <div style="font-weight:800;color:#334155;">
                            Belum ada data penjualan
                        </div>

                        <div style="font-size:12px;margin-top:4px;">
                            Produk terlaris akan muncul setelah ada pesanan.
                        </div>
                    </div>

                @endforelse

            </div>
        </div>
    </section>


    <section style="margin:0 0 30px;padding:0 20px;">
        <div style="max-width:1200px;margin:0 auto;">

            <div style="display:flex;align-items:center;justify-content:space-between;gap:15px;margin-bottom:15px;flex-wrap:wrap;">
                <div>
                    <h2 style="margin:0;font-size:21px;font-weight:900;color:#111827;">
                        ⚠️ Stok Menipis
                    </h2>

                    <div style="margin-top:5px;color:#64748b;font-size:13px;">
                        Produk aktif dengan stok 5 atau kurang.
                    </div>
                </div>

                <a
                    href="{{ route('admin.products.index') }}"
                    style="text-decoration:none;padding:10px 15px;border-radius:12px;background:#111827;color:#fff;font-size:13px;font-weight:800;"
                >
                    Kelola Produk →
                </a>
            </div>

            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:18px;overflow:hidden;box-shadow:0 8px 25px rgba(15,23,42,.05);">

                @forelse($lowStockProducts ?? [] as $product)

                    <div style="display:flex;align-items:center;justify-content:space-between;gap:15px;padding:16px 18px;border-bottom:1px solid #f1f5f9;flex-wrap:wrap;">

                        <div style="flex:1;min-width:180px;">
                            <div style="font-weight:900;color:#111827;font-size:14px;">
                                {{ $product->nama }}
                            </div>

                            @if(!empty($product->kode))
                                <div style="margin-top:4px;color:#94a3b8;font-size:11px;">
                                    SKU: {{ $product->kode }}
                                </div>
                            @endif
                        </div>

                        <div style="padding:8px 12px;border-radius:999px;font-size:12px;font-weight:900;
                            {{ $product->stok <= 2
                                ? 'background:#fef2f2;color:#dc2626;'
                                : 'background:#fff7ed;color:#c2410c;' }}">
                            Stok {{ $product->stok }}
                        </div>

                        <a
                            href="{{ route('admin.products.edit', $product) }}"
                            style="text-decoration:none;padding:9px 13px;border:1px solid #e2e8f0;border-radius:10px;color:#334155;font-size:12px;font-weight:800;background:#fff;"
                        >
                            Edit
                        </a>

                    </div>

                @empty

                    <div style="padding:35px 20px;text-align:center;color:#64748b;">
                        <div style="font-size:35px;margin-bottom:8px;">✅</div>

                        <div style="font-weight:800;color:#334155;">
                            Semua stok aman
                        </div>

                        <div style="font-size:12px;margin-top:4px;">
                            Tidak ada produk aktif dengan stok 5 atau kurang.
                        </div>
                    </div>

                @endforelse

            </div>
        </div>
    </section>

    <div class="footer-note">
        Toko UMKM Pro · Admin Control Center
    </div>

</main>

</body>
</html>
