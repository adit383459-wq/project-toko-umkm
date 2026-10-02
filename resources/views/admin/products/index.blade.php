<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Produk — Toko UMKM Pro</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Inter, Arial, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .topbar {
            background: #ffffff;
            border-bottom: 1px solid #e8ebf2;
            padding: 16px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #1769ff, #5b8cff);
            color: white;
            font-size: 21px;
            box-shadow: 0 8px 20px rgba(23,105,255,.2);
        }

        .brand h1 {
            font-size: 17px;
            font-weight: 800;
        }

        .brand p {
            font-size: 12px;
            color: #7d8799;
            margin-top: 2px;
        }

        .back {
            padding: 10px 15px;
            border: 1px solid #e2e6ee;
            border-radius: 12px;
            background: white;
            color: #536075;
            font-size: 13px;
            font-weight: 700;
        }

        .container {
            max-width: 1250px;
            margin: auto;
            padding: 28px 20px 50px;
        }

        .hero {
            background: linear-gradient(135deg, #111827, #263b66);
            color: white;
            border-radius: 24px;
            padding: 28px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            overflow: hidden;
            position: relative;
        }

        .hero::after {
            content: "";
            width: 220px;
            height: 220px;
            border-radius: 50%;
            position: absolute;
            right: -70px;
            top: -80px;
            background: rgba(255,255,255,.08);
        }

        .hero small {
            color: #9db8ff;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero h2 {
            margin-top: 7px;
            font-size: 30px;
        }

        .hero p {
            color: #c9d3e6;
            margin-top: 7px;
            font-size: 14px;
        }

        .add-btn {
            position: relative;
            z-index: 2;
            background: white;
            color: #1769ff;
            padding: 13px 18px;
            border-radius: 13px;
            font-weight: 800;
            white-space: nowrap;
            box-shadow: 0 10px 25px rgba(0,0,0,.15);
        }

        .alert {
            padding: 14px 17px;
            border-radius: 14px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 700;
        }

        .success {
            background: #e9fbf1;
            color: #16834b;
            border: 1px solid #bcefd1;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 24px;
        }

        .stat {
            background: white;
            border: 1px solid #e8ebf2;
            border-radius: 18px;
            padding: 19px;
            box-shadow: 0 8px 25px rgba(20,30,50,.04);
        }

        .stat-label {
            color: #7d8799;
            font-size: 12px;
            font-weight: 700;
        }

        .stat-value {
            font-size: 27px;
            font-weight: 900;
            margin-top: 5px;
        }

        .products-box {
            background: white;
            border: 1px solid #e8ebf2;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(20,30,50,.04);
        }

        .box-header {
            padding: 20px;
            border-bottom: 1px solid #edf0f5;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .box-header h3 {
            font-size: 18px;
        }

        .box-header span {
            color: #8a94a6;
            font-size: 12px;
        }

        .empty {
            text-align: center;
            padding: 65px 20px;
        }

        .empty-icon {
            width: 75px;
            height: 75px;
            margin: auto;
            border-radius: 24px;
            background: #eef4ff;
            display: grid;
            place-items: center;
            font-size: 32px;
        }

        .empty h3 {
            margin-top: 18px;
            font-size: 19px;
        }

        .empty p {
            color: #7d8799;
            font-size: 13px;
            margin: 7px 0 20px;
        }

        .empty-btn {
            display: inline-block;
            background: #1769ff;
            color: white;
            padding: 12px 18px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 800;
        }

        .product-grid {
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .product {
            border: 1px solid #e9edf4;
            border-radius: 18px;
            overflow: hidden;
            background: white;
            transition: .2s;
        }

        .product:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(20,30,50,.08);
        }

        .product-image {
            height: 190px;
            background: #f1f4f9;
            display: grid;
            place-items: center;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-image {
            font-size: 40px;
            opacity: .5;
        }

        .product-body {
            padding: 15px;
        }

        .category {
            color: #1769ff;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .product-name {
            font-size: 15px;
            font-weight: 800;
            margin-top: 5px;
        }

        .price {
            font-size: 17px;
            font-weight: 900;
            margin-top: 10px;
        }

        .stock {
            font-size: 12px;
            color: #7d8799;
            margin-top: 4px;
        }

        .badges {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            margin-top: 9px;
        }

        .badge {
            font-size: 10px;
            font-weight: 800;
            padding: 5px 8px;
            border-radius: 7px;
            background: #eef4ff;
            color: #1769ff;
        }

        .badge-off {
            background: #fff0f0;
            color: #d63b3b;
        }

        .actions {
            display: flex;
            gap: 7px;
            margin-top: 14px;
        }

        .action {
            flex: 1;
            text-align: center;
            padding: 9px 5px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 800;
            border: 1px solid #e2e6ee;
            background: #fff;
        }

        .edit {
            color: #1769ff;
            background: #f3f7ff;
            border-color: #dbe7ff;
        }

        .delete {
            color: #d63b3b;
            background: #fff5f5;
            border-color: #ffdede;
        }

        @media (max-width: 1000px) {
            .product-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 700px) {
            .hero {
                flex-direction: column;
                align-items: flex-start;
            }

            .hero h2 {
                font-size: 25px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .product-grid {
                grid-template-columns: repeat(2, 1fr);
                padding: 13px;
                gap: 12px;
            }

            .product-image {
                height: 145px;
            }

            .container {
                padding: 18px 12px 35px;
            }

            .topbar {
                padding: 12px 14px;
            }

            .back {
                font-size: 11px;
                padding: 9px 11px;
            }
        }

        @media (max-width: 430px) {
            .product-grid {
                grid-template-columns: 1fr 1fr;
            }

            .product-image {
                height: 125px;
            }

            .product-name {
                font-size: 13px;
            }

            .price {
                font-size: 15px;
            }
        }

        .product-tools {
            padding: 18px 20px;
            border-bottom: 1px solid #edf0f5;
            display: grid;
            grid-template-columns: 1fr 190px 180px;
            gap: 10px;
        }

        .search-wrap {
            display: flex;
            align-items: center;
            gap: 9px;
            min-height: 44px;
            padding: 0 13px;
            border: 1px solid #e1e6ef;
            border-radius: 12px;
            background: #fff;
        }

        .search-wrap span {
            font-size: 15px;
        }

        .search-wrap input {
            width: 100%;
            border: 0;
            outline: 0;
            background: transparent;
            color: #172033;
            font-size: 13px;
        }

        .filter-select {
            min-height: 44px;
            padding: 0 12px;
            border: 1px solid #e1e6ef;
            border-radius: 12px;
            background: #fff;
            color: #172033;
            font-size: 12px;
            font-weight: 700;
            outline: none;
        }

        .filter-select:focus,
        .search-wrap:focus-within {
            border-color: #1769ff;
            box-shadow: 0 0 0 3px rgba(23,105,255,.08);
        }

        .search-empty {
            padding: 45px 20px;
            text-align: center;
            color: #7d8799;
        }

        .search-empty div {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .search-empty strong,
        .search-empty span {
            display: block;
        }

        .search-empty strong {
            color: #172033;
            font-size: 16px;
        }

        .search-empty span {
            margin-top: 5px;
            font-size: 12px;
        }

        @media (max-width: 700px) {
            .product-tools {
                grid-template-columns: 1fr;
                padding: 13px;
            }

            .search-wrap,
            .filter-select {
                min-height: 42px;
            }
        }

    </style>
</head>

<body>

<header class="topbar">

    <div class="brand">
        <div class="brand-icon">🛍️</div>

        <div>
            <h1>Toko UMKM Pro</h1>
            <p>Manajemen Produk</p>
        </div>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="back">
        ← Dashboard
    </a>

</header>


<main class="container">

    <section class="hero">

        <div>
            <small>Product Management</small>

            <h2>Kelola Produk</h2>

            <p>
                Tambahkan produk, atur harga, stok, foto,
                dan status produk toko kamu.
            </p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="add-btn">
            ＋ Tambah Produk
        </a>

    </section>


    @if(session('success'))
        <div class="alert success">
            ✓ {{ session('success') }}
        </div>
    @endif


    <section class="stats">

        <div class="stat">
            <div class="stat-label">TOTAL PRODUK</div>
            <div class="stat-value">
                {{ $products->count() }}
            </div>
        </div>

        <div class="stat">
            <div class="stat-label">PRODUK AKTIF</div>
            <div class="stat-value">
                {{ $products->where('aktif', true)->count() }}
            </div>
        </div>

        <div class="stat">
            <div class="stat-label">PRODUK UNGGULAN</div>
            <div class="stat-value">
                {{ $products->where('unggulan', true)->count() }}
            </div>
        </div>

    </section>


    <section class="products-box">

        <div class="box-header">

            <div>
                <h3>Daftar Produk</h3>

                <span>
                    Semua produk yang tersimpan di toko
                </span>
            </div>

            <span>
                {{ $products->count() }} Produk
            </span>

        </div>


        @if($products->isEmpty())

            <div class="empty">

                <div class="empty-icon">
                    📦
                </div>

                <h3>Belum Ada Produk</h3>

                <p>
                    Mulai tambahkan produk pertama ke toko kamu.
                </p>

                <a
                    href="{{ route('admin.products.create') }}"
                    class="empty-btn"
                >
                    ＋ Tambah Produk
                </a>

            </div>

        @else

            <div class="product-tools">

                <div class="search-wrap">
                    <span>🔎</span>
                    <input
                        type="search"
                        id="productSearch"
                        placeholder="Cari nama produk..."
                        autocomplete="off"
                    >
                </div>

                <select id="categoryFilter" class="filter-select">
                    <option value="">Semua Kategori</option>
                    @foreach($products->pluck('kategori')->filter()->unique()->sort() as $kategori)
                        <option value="{{ strtolower($kategori) }}">
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>

                <select id="statusFilter" class="filter-select">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                    <option value="unggulan">Unggulan</option>
                    <option value="habis">Stok Habis</option>
                </select>

            </div>

            <div id="emptySearch" class="search-empty" style="display:none;">
                <div>🔎</div>
                <strong>Produk tidak ditemukan</strong>
                <span>Coba gunakan kata kunci atau filter lain.</span>
            </div>

            <div class="product-grid" id="productGrid">

                @foreach($products as $product)

                    <article
                        class="product"
                        data-name="{{ strtolower($product->nama) }}"
                        data-category="{{ strtolower($product->kategori ?? '') }}"
                        data-status="{{ $product->aktif ? 'aktif' : 'nonaktif' }}"
                        data-unggulan="{{ $product->unggulan ? 'unggulan' : '' }}"
                        data-stock="{{ $product->stok }}"
                    >

                        <div class="product-image">

                            @if($product->gambar)

                                <img
                                    src="{{ asset('storage/' . $product->gambar) }}"
                                    alt="{{ $product->nama }}"
                                >

                            @else

                                <div class="no-image">
                                    📦
                                </div>

                            @endif

                        </div>


                        <div class="product-body">

                            <div class="category">
                                {{ $product->kategori ?: 'Tanpa Kategori' }}
                            </div>

                            <div class="product-name">
                                {{ $product->nama }}
                            </div>

                            <div class="price">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </div>

                            <div class="stock">
                                Stok: {{ $product->stok }}
                            </div>


                            <div class="badges">

                                @if($product->aktif)
                                    <span class="badge">
                                        ● Aktif
                                    </span>
                                @else
                                    <span class="badge badge-off">
                                        ● Nonaktif
                                    </span>
                                @endif

                                @if($product->unggulan)
                                    <span class="badge">
                                        ⭐ Unggulan
                                    </span>
                                @endif

                            </div>


                            <div class="actions">

                                <a
                                    href="{{ route('admin.products.edit', $product) }}"
                                    class="action edit"
                                >
                                    ✏️ Edit
                                </a>


                                <form
                                    action="{{ route('admin.products.destroy', $product) }}"
                                    method="POST"
                                    style="flex:1"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action delete"
                                        style="width:100%;cursor:pointer"
                                    >
                                        🗑️ Hapus
                                    </button>

                                </form>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        @endif

    </section>

</main>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const search = document.getElementById('productSearch');
    const category = document.getElementById('categoryFilter');
    const status = document.getElementById('statusFilter');
    const cards = document.querySelectorAll('#productGrid .product');
    const empty = document.getElementById('emptySearch');

    function filterProducts() {

        const keyword = (search.value || '').toLowerCase().trim();
        const selectedCategory = (category.value || '').toLowerCase();
        const selectedStatus = (status.value || '').toLowerCase();

        let visible = 0;

        cards.forEach(function (card) {

            const name = card.dataset.name || '';
            const cat = card.dataset.category || '';
            const stat = card.dataset.status || '';
            const unggulan = card.dataset.unggulan || '';
            const stock = Number(card.dataset.stock || 0);

            const matchName = !keyword || name.includes(keyword);
            const matchCategory = !selectedCategory || cat === selectedCategory;

            let matchStatus = true;

            if (selectedStatus === 'aktif') {
                matchStatus = stat === 'aktif';
            }

            if (selectedStatus === 'nonaktif') {
                matchStatus = stat === 'nonaktif';
            }

            if (selectedStatus === 'unggulan') {
                matchStatus = unggulan === 'unggulan';
            }

            if (selectedStatus === 'habis') {
                matchStatus = stock <= 0;
            }

            const show = matchName && matchCategory && matchStatus;

            card.style.display = show ? '' : 'none';

            if (show) visible++;
        });

        empty.style.display = visible === 0 ? 'block' : 'none';
    }

    search.addEventListener('input', filterProducts);
    category.addEventListener('change', filterProducts);
    status.addEventListener('change', filterProducts);

});
</script>

</body>
</html>
