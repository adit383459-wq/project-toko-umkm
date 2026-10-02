<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Keranjang - {{ $store->nama_toko ?? 'Toko UMKM Pro' }}</title>

    <style>
        :root {
            --primary: {{ $store->warna_utama ?? '#1769ff' }};
            --secondary: {{ $store->warna_kedua ?? '#ffd400' }};
            --text: #172033;
            --muted: #788397;
            --border: #e7ebf2;
            --bg: #f6f8fc;
            --white: #ffffff;
            --danger: #dc4b4b;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
            background:
                radial-gradient(
                    circle at top right,
                    rgba(23, 105, 255, .08),
                    transparent 35%
                ),
                var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input {
            font: inherit;
        }

        .page {
            width: min(1180px, calc(100% - 32px));
            margin: auto;
            padding: 28px 0 55px;
        }

        /* HEADER */

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-logo,
        .brand-placeholder {
            width: 48px;
            height: 48px;
            flex: 0 0 48px;
            border-radius: 15px;
        }

        .brand-logo {
            object-fit: cover;
            background: #fff;
            border: 1px solid var(--border);
        }

        .brand-placeholder {
            display: grid;
            place-items: center;
            background:
                linear-gradient(
                    135deg,
                    var(--primary),
                    var(--secondary)
                );
            font-size: 23px;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 950;
            letter-spacing: -.5px;
        }

        .brand-slogan {
            margin-top: 2px;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 15px;
            border-radius: 12px;
            background: #fff;
            border: 1px solid var(--border);
            font-size: 12px;
            font-weight: 900;
            transition: .2s ease;
        }

        .back-btn:hover {
            transform: translateY(-1px);
            border-color: rgba(23, 105, 255, .3);
        }

        /* HEADING */

        .heading {
            margin-bottom: 24px;
        }

        .eyebrow {
            margin-bottom: 7px;
            color: var(--primary);
            font-size: 10px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        h1 {
            font-size: clamp(28px, 5vw, 42px);
            line-height: 1.05;
            letter-spacing: -1.5px;
        }

        .heading p {
            margin-top: 9px;
            color: var(--muted);
            font-size: 13px;
        }

        /* ALERT */

        .alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border-radius: 14px;
            font-size: 12px;
            font-weight: 800;
        }

        .alert.success {
            background: #effaf4;
            border: 1px solid #ccefdc;
            color: #208453;
        }

        .alert.error {
            background: #fff4f4;
            border: 1px solid #ffd6d6;
            color: #b33a3a;
        }

        /* EMPTY */

        .empty-card {
            padding: 55px 25px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 25px;
            box-shadow: 0 16px 45px rgba(24, 43, 78, .06);
            text-align: center;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 18px;
            display: grid;
            place-items: center;
            border-radius: 25px;
            background:
                linear-gradient(
                    135deg,
                    rgba(23, 105, 255, .08),
                    rgba(255, 212, 0, .13)
                );
            font-size: 37px;
        }

        .empty-card h2 {
            font-size: 21px;
            font-weight: 950;
        }

        .empty-card p {
            max-width: 430px;
            margin: 8px auto 20px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .shop-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 45px;
            padding: 0 18px;
            border-radius: 13px;
            background: var(--primary);
            color: #fff;
            font-size: 12px;
            font-weight: 950;
            box-shadow: 0 10px 25px rgba(23, 105, 255, .16);
        }

        /* MAIN */

        .cart-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(310px, .8fr);
            gap: 22px;
            align-items: start;
        }

        .card {
            background: rgba(255, 255, 255, .97);
            border: 1px solid var(--border);
            border-radius: 24px;
            box-shadow: 0 16px 45px rgba(24, 43, 78, .06);
        }

        .card-header {
            padding: 20px 22px;
            border-bottom: 1px solid var(--border);
        }

        .card-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 950;
        }

        .item-count {
            padding: 6px 9px;
            border-radius: 999px;
            background: #eef4ff;
            color: var(--primary);
            font-size: 9px;
            font-weight: 950;
        }

        .card-subtitle {
            margin-top: 5px;
            color: var(--muted);
            font-size: 11px;
        }

        /* CART ITEMS */

        .cart-items {
            padding: 16px;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 82px minmax(0, 1fr) auto;
            gap: 15px;
            align-items: center;
            padding: 13px;
            margin-bottom: 11px;
            border: 1px solid var(--border);
            border-radius: 18px;
            background: #fff;
            transition: .2s ease;
        }

        .cart-item:last-child {
            margin-bottom: 0;
        }

        .cart-item:hover {
            border-color: rgba(23, 105, 255, .2);
            box-shadow: 0 8px 25px rgba(23, 105, 255, .05);
        }

        .product-image {
            width: 82px;
            height: 82px;
            overflow: hidden;
            border-radius: 15px;
            background: #f1f4f8;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        .no-image {
            width: 100%;
            height: 100%;
            display: grid;
            place-items: center;
            font-size: 30px;
        }

        .product-name {
            font-size: 14px;
            font-weight: 950;
            line-height: 1.35;
        }

        .product-price {
            margin-top: 5px;
            color: var(--primary);
            font-size: 12px;
            font-weight: 950;
        }

        .product-meta {
            margin-top: 4px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 700;
        }

        /* QUANTITY */

        .quantity-form {
            margin-top: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .quantity-box {
            display: flex;
            align-items: center;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 11px;
            background: #fafbfc;
        }

        .quantity-btn {
            width: 32px;
            height: 32px;
            display: grid;
            place-items: center;
            border: 0;
            background: transparent;
            color: var(--text);
            font-size: 16px;
            font-weight: 900;
            cursor: pointer;
        }

        .quantity-btn:hover {
            background: #eef4ff;
            color: var(--primary);
        }

        .quantity-input {
            width: 38px;
            height: 32px;
            border: 0;
            outline: none;
            background: transparent;
            text-align: center;
            color: var(--text);
            font-size: 11px;
            font-weight: 900;
        }

        .update-btn {
            min-height: 32px;
            padding: 0 10px;
            border: 0;
            border-radius: 9px;
            background: #eef4ff;
            color: var(--primary);
            font-size: 9px;
            font-weight: 950;
            cursor: pointer;
        }

        .update-btn:hover {
            background: #e3edff;
        }

        /* ITEM TOTAL */

        .item-side {
            min-width: 110px;
            text-align: right;
        }

        .item-subtotal {
            font-size: 14px;
            font-weight: 950;
        }

        .remove-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 10px;
            color: var(--danger);
            font-size: 9px;
            font-weight: 900;
        }

        .remove-btn:hover {
            text-decoration: underline;
        }

        /* SUMMARY */

        .summary-body {
            padding: 18px;
        }

        .summary-line {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 12px;
        }

        .summary-label {
            color: var(--muted);
            font-size: 11px;
            font-weight: 750;
        }

        .summary-value {
            font-size: 12px;
            font-weight: 900;
        }

        .summary-total {
            margin-top: 17px;
            padding: 17px;
            border-radius: 17px;
            background:
                linear-gradient(
                    135deg,
                    rgba(23, 105, 255, .07),
                    rgba(255, 212, 0, .10)
                );
            border: 1px solid rgba(23, 105, 255, .08);
        }

        .summary-total-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .summary-total-label {
            color: var(--muted);
            font-size: 11px;
            font-weight: 800;
        }

        .summary-total-value {
            font-size: 21px;
            font-weight: 950;
        }

        .checkout-btn {
            width: 100%;
            min-height: 50px;
            margin-top: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: var(--primary);
            color: #fff;
            font-size: 12px;
            font-weight: 950;
            box-shadow: 0 12px 28px rgba(23, 105, 255, .17);
            transition: .2s ease;
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            filter: brightness(.97);
        }

        .continue-btn {
            width: 100%;
            min-height: 43px;
            margin-top: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: #fff;
            color: var(--text);
            font-size: 11px;
            font-weight: 900;
        }

        .clear-btn {
            display: block;
            margin: 16px auto 0;
            border: 0;
            background: transparent;
            color: var(--danger);
            font-size: 10px;
            font-weight: 850;
            cursor: pointer;
        }

        .clear-btn:hover {
            text-decoration: underline;
        }

        .secure-note {
            margin-top: 13px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 700;
            text-align: center;
            line-height: 1.5;
        }

        /* RESPONSIVE */

        @media (max-width: 850px) {
            .cart-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .page {
                width: min(100% - 22px, 600px);
                padding-top: 16px;
            }

            .topbar {
                margin-bottom: 24px;
            }

            .brand-logo,
            .brand-placeholder {
                width: 42px;
                height: 42px;
                flex-basis: 42px;
            }

            .brand-name {
                font-size: 15px;
            }

            .brand-slogan {
                font-size: 9px;
            }

            .back-btn {
                min-height: 38px;
                padding: 0 11px;
                font-size: 10px;
            }

            h1 {
                font-size: 31px;
            }

            .card {
                border-radius: 19px;
            }

            .card-header {
                padding: 17px;
            }

            .cart-items {
                padding: 11px;
            }

            .cart-item {
                grid-template-columns: 65px minmax(0, 1fr);
                gap: 11px;
                padding: 10px;
            }

            .product-image {
                width: 65px;
                height: 65px;
            }

            .item-side {
                grid-column: 2;
                min-width: 0;
                display: flex;
                align-items: center;
                justify-content: space-between;
                text-align: left;
            }

            .item-subtotal {
                font-size: 13px;
            }

            .remove-btn {
                margin-top: 0;
            }

            .quantity-form {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

<div class="page">

    {{-- HEADER --}}
    <header class="topbar">

        <a href="{{ route('home') }}" class="brand">

            @if(!empty($store?->logo))

                <img
                    src="{{ asset('storage/' . $store->logo) }}"
                    alt="Logo {{ $store->nama_toko }}"
                    class="brand-logo"
                >

            @else

                <div class="brand-placeholder">
                    🛍️
                </div>

            @endif

            <div>
                <div class="brand-name">
                    {{ $store->nama_toko ?? 'Toko UMKM Pro' }}
                </div>

                <div class="brand-slogan">
                    {{ $store->slogan ?? 'Belanja Hemat Cuan Nikmat' }}
                </div>
            </div>

        </a>

        <a href="{{ route('home') }}" class="back-btn">
            ← Belanja Lagi
        </a>

    </header>


    {{-- TITLE --}}
    <section class="heading">

        <div class="eyebrow">
            Shopping Cart
        </div>

        <h1>
            Keranjang
        </h1>

        <p>
            Periksa produk yang ingin kamu beli sebelum melanjutkan checkout.
        </p>

    </section>


    {{-- ALERT --}}
    @if(session('success'))

        <div class="alert success">
            ✓ {{ session('success') }}
        </div>

    @endif

    @if(session('error'))

        <div class="alert error">
            {{ session('error') }}
        </div>

    @endif


    @if(empty($cart))

        {{-- EMPTY CART --}}

        <section class="empty-card">

            <div class="empty-icon">
                🛒
            </div>

            <h2>
                Keranjang masih kosong
            </h2>

            <p>
                Belum ada produk yang kamu tambahkan.
                Yuk lihat produk pilihan dan tambahkan ke keranjang.
            </p>

            <a href="{{ route('home') }}" class="shop-btn">
                🛍️ Mulai Belanja
            </a>

        </section>

    @else

        <div class="cart-grid">

            {{-- PRODUCTS --}}
            <section class="card">

                <div class="card-header">

                    <div class="card-title-row">

                        <div class="card-title">
                            Produk Pilihan
                        </div>

                        <div class="item-count">
                            {{ collect($cart)->sum('jumlah') }} item
                        </div>

                    </div>

                    <div class="card-subtitle">
                        Atur jumlah produk sesuai kebutuhanmu.
                    </div>

                </div>


                <div class="cart-items">

                    @foreach($cart as $item)

                        <article class="cart-item">

                            {{-- IMAGE --}}
                            <div class="product-image">

                                @if(!empty($item['gambar']))

                                    <img
                                        src="{{ asset('storage/' . $item['gambar']) }}"
                                        alt="{{ $item['nama'] }}"
                                    >

                                @else

                                    <div class="no-image">
                                        🛍️
                                    </div>

                                @endif

                            </div>


                            {{-- INFO --}}
                            <div>

                                <div class="product-name">
                                    {{ $item['nama'] }}
                                </div>

                                <div class="product-price">
                                    Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                </div>

                                <div class="product-meta">
                                    Harga per produk
                                </div>


                                {{-- QUANTITY --}}
                                <form
                                    action="{{ route('cart.update', $item['id']) }}"
                                    method="POST"
                                    class="quantity-form"
                                >

                                    @csrf

                                    <div class="quantity-box">

                                        <button
                                            type="button"
                                            class="quantity-btn"
                                            onclick="changeQty(this, -1)"
                                        >
                                            −
                                        </button>

                                        <input
                                            type="number"
                                            name="jumlah"
                                            class="quantity-input"
                                            value="{{ $item['jumlah'] }}"
                                            min="1"
                                        >

                                        <button
                                            type="button"
                                            class="quantity-btn"
                                            onclick="changeQty(this, 1)"
                                        >
                                            +
                                        </button>

                                    </div>

                                    <button
                                        type="submit"
                                        class="update-btn"
                                    >
                                        Update
                                    </button>

                                </form>

                            </div>


                            {{-- SUBTOTAL --}}
                            <div class="item-side">

                                <div class="item-subtotal">
                                    Rp
                                    {{ number_format(
                                        $item['harga'] * $item['jumlah'],
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </div>

                                <a
                                    href="{{ route('cart.remove', $item['id']) }}"
                                    class="remove-btn"
                                >
                                    🗑 Hapus
                                </a>

                            </div>

                        </article>

                    @endforeach

                </div>

            </section>


            {{-- SUMMARY --}}
            <aside class="card">

                <div class="card-header">

                    <div class="card-title">
                        Ringkasan Belanja
                    </div>

                    <div class="card-subtitle">
                        Total pesanan kamu
                    </div>

                </div>

                <div class="summary-body">

                    <div class="summary-line">

                        <span class="summary-label">
                            Jumlah item
                        </span>

                        <span class="summary-value">
                            {{ collect($cart)->sum('jumlah') }}
                        </span>

                    </div>


                    <div class="summary-line">

                        <span class="summary-label">
                            Produk
                        </span>

                        <span class="summary-value">
                            {{ count($cart) }}
                        </span>

                    </div>


                    <div class="summary-total">

                        <div class="summary-total-row">

                            <span class="summary-total-label">
                                Total Pembayaran
                            </span>

                            <span class="summary-total-value">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>

                        </div>

                    </div>


                    <a
                        href="{{ route('checkout.index') }}"
                        class="checkout-btn"
                    >
                        Lanjut ke Checkout →
                    </a>


                    <a
                        href="{{ route('home') }}"
                        class="continue-btn"
                    >
                        ← Tambah Produk Lagi
                    </a>


                    <a
                        href="{{ route('cart.clear') }}"
                        class="clear-btn"
                        onclick="return confirm('Kosongkan semua isi keranjang?')"
                    >
                        Kosongkan Keranjang
                    </a>


                    <div class="secure-note">
                        🔒 Pesanan akan dikonfirmasi melalui WhatsApp toko.
                    </div>

                </div>

            </aside>

        </div>

    @endif

</div>


<script>
    function changeQty(button, amount) {
        const form = button.closest('form');
        const input = form.querySelector('.quantity-input');

        let value = parseInt(input.value || 1);

        value += amount;

        if (value < 1) {
            value = 1;
        }

        input.value = value;
    }
</script>

</body>
</html>
