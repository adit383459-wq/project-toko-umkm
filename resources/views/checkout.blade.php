<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout - {{ $store->nama_toko ?? 'Toko UMKM Pro' }}</title>

    <style>
        :root {
            --primary: {{ $store->warna_utama ?? '#1769ff' }};
            --secondary: {{ $store->warna_kedua ?? '#ffd400' }};
            --text: #172033;
            --muted: #788397;
            --border: #e7ebf2;
            --bg: #f6f8fc;
            --white: #ffffff;
            --success: #20a464;
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

        .page {
            width: min(1180px, calc(100% - 32px));
            margin: auto;
            padding: 28px 0 50px;
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

        .brand-logo {
            width: 48px;
            height: 48px;
            border-radius: 15px;
            object-fit: cover;
            background: #fff;
            border: 1px solid var(--border);
        }

        .brand-placeholder {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            border-radius: 15px;
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
            color: var(--text);
            font-size: 12px;
            font-weight: 900;
            transition: .2s ease;
        }

        .back-btn:hover {
            transform: translateY(-1px);
            border-color: rgba(23, 105, 255, .3);
        }

        /* TITLE */

        .heading {
            margin-bottom: 24px;
        }

        .eyebrow {
            color: var(--primary);
            font-size: 10px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 7px;
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
            padding: 13px 15px;
            margin-bottom: 18px;
            border-radius: 14px;
            background: #fff4f4;
            border: 1px solid #ffd6d6;
            color: #b33a3a;
            font-size: 12px;
            font-weight: 800;
        }

        /* LAYOUT */

        .checkout-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(330px, .85fr);
            gap: 22px;
            align-items: start;
        }

        .card {
            background: rgba(255, 255, 255, .96);
            border: 1px solid var(--border);
            border-radius: 24px;
            box-shadow: 0 16px 45px rgba(24, 43, 78, .06);
        }

        .card-header {
            padding: 21px 22px 16px;
            border-bottom: 1px solid var(--border);
        }

        .card-title {
            font-size: 16px;
            font-weight: 950;
        }

        .card-subtitle {
            margin-top: 5px;
            color: var(--muted);
            font-size: 11px;
        }

        /* FORM */

        .form-body {
            padding: 22px;
        }

        .field {
            margin-bottom: 17px;
        }

        .field:last-child {
            margin-bottom: 0;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #414b5d;
            font-size: 11px;
            font-weight: 900;
        }

        input,
        textarea {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 13px;
            outline: none;
            background: #fbfcfe;
            color: var(--text);
            font: inherit;
            font-size: 13px;
            padding: 13px 14px;
            transition: .2s ease;
        }

        textarea {
            min-height: 105px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(23, 105, 255, .08);
        }

        .required {
            color: #e34a4a;
        }

        .error {
            margin-top: 5px;
            color: #d54848;
            font-size: 10px;
            font-weight: 700;
        }

        /* PRODUCTS */

        .summary-body {
            padding: 18px;
        }

        .product-list {
            display: grid;
            gap: 12px;
        }

        .product-item {
            display: flex;
            gap: 12px;
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 17px;
            background: #fff;
        }

        .product-image {
            width: 65px;
            height: 65px;
            flex: 0 0 65px;
            border-radius: 13px;
            overflow: hidden;
            background: #f1f4f8;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-image {
            width: 100%;
            height: 100%;
            display: grid;
            place-items: center;
            font-size: 25px;
        }

        .product-info {
            min-width: 0;
            flex: 1;
        }

        .product-name {
            font-size: 13px;
            font-weight: 900;
            line-height: 1.3;
        }

        .product-qty {
            margin-top: 5px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 700;
        }

        .product-price {
            margin-top: 7px;
            color: var(--primary);
            font-size: 12px;
            font-weight: 950;
        }

        /* TOTAL */

        .total-box {
            margin-top: 16px;
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

        .total-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .total-label {
            color: var(--muted);
            font-size: 11px;
            font-weight: 800;
        }

        .total-value {
            color: var(--text);
            font-size: 21px;
            font-weight: 950;
        }

        /* BUTTON */

        .submit-btn {
            width: 100%;
            min-height: 52px;
            margin-top: 18px;
            border: 0;
            border-radius: 15px;
            background: #20a464;
            color: #fff;
            font-size: 13px;
            font-weight: 950;
            cursor: pointer;
            box-shadow: 0 12px 28px rgba(32, 164, 100, .18);
            transition: .2s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            filter: brightness(.97);
        }

        .secure-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 12px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 700;
            text-align: center;
        }

        /* STORE INFO */

        .store-info {
            margin-top: 15px;
            padding: 14px;
            border-radius: 15px;
            background: #fafbfc;
            border: 1px solid var(--border);
        }

        .store-info-title {
            margin-bottom: 5px;
            font-size: 11px;
            font-weight: 950;
        }

        .store-info-text {
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
        }

        /* RESPONSIVE */

        @media (max-width: 850px) {
            .checkout-grid {
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

            .card-header,
            .form-body {
                padding: 17px;
            }

            .summary-body {
                padding: 13px;
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

        <a href="{{ route('cart.index') }}" class="back-btn">
            ← Keranjang
        </a>

    </header>


    {{-- TITLE --}}
    <section class="heading">

        <div class="eyebrow">
            Secure Checkout
        </div>

        <h1>
            Checkout
        </h1>

        <p>
            Lengkapi data pesananmu sebelum mengirim order ke toko.
        </p>

    </section>


    {{-- ERROR --}}
    @if(session('error'))

        <div class="alert">
            {{ session('error') }}
        </div>

    @endif


    @if($errors->any())

        <div class="alert">
            <strong>Periksa kembali data pesanan.</strong>
        </div>

    @endif


    <form
        action="{{ route('checkout.process') }}"
        method="POST"
    >

        @csrf

        <div class="checkout-grid">

            {{-- DATA PEMBELI --}}
            <section class="card">

                <div class="card-header">

                    <div class="card-title">
                        Data Pembeli
                    </div>

                    <div class="card-subtitle">
                        Isi informasi penerima pesanan dengan benar.
                    </div>

                </div>

                <div class="form-body">

                    {{-- NAMA --}}
                    <div class="field">

                        <label for="nama">
                            Nama Lengkap
                            <span class="required">*</span>
                        </label>

                        <input
                            id="nama"
                            type="text"
                            name="nama"
                            value="{{ old('nama') }}"
                            placeholder="Masukkan nama lengkap"
                            required
                        >

                        @error('nama')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- WHATSAPP --}}
                    <div class="field">

                        <label for="whatsapp">
                            Nomor WhatsApp
                            <span class="required">*</span>
                        </label>

                        <input
                            id="whatsapp"
                            type="tel"
                            name="whatsapp"
                            value="{{ old('whatsapp') }}"
                            placeholder="Contoh: 081234567890"
                            required
                        >

                        @error('whatsapp')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- ALAMAT --}}
                    <div class="field">

                        <label for="alamat">
                            Alamat Pengiriman
                            <span class="required">*</span>
                        </label>

                        <textarea
                            id="alamat"
                            name="alamat"
                            placeholder="Contoh: Kp. ..., Desa ..., Kecamatan ..., Kabupaten ..."
                            required
                        >{{ old('alamat') }}</textarea>

                        @error('alamat')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- CATATAN --}}
                    <div class="field">

                        <label for="catatan">
                            Catatan Pesanan
                            <span style="font-weight:700;color:#9ba3b0;">
                                (opsional)
                            </span>
                        </label>

                        <textarea
                            id="catatan"
                            name="catatan"
                            placeholder="Contoh: Tolong dikemas dengan aman..."
                        >{{ old('catatan') }}</textarea>

                        @error('catatan')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="store-info">

                        <div class="store-info-title">
                            📦 Informasi Pengiriman
                        </div>

                        <div class="store-info-text">
                            Setelah menekan tombol pesan, detail order
                            akan dikirim melalui WhatsApp toko.
                        </div>

                    </div>

                </div>

            </section>


            {{-- RINGKASAN --}}
            <aside class="card">

                <div class="card-header">

                    <div class="card-title">
                        Ringkasan Pesanan
                    </div>

                    <div class="card-subtitle">
                        {{ count($cart) }} produk dalam pesanan
                    </div>

                </div>

                <div class="summary-body">

                    <div class="product-list">

                        @foreach($cart as $item)

                            <div class="product-item">

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

                                <div class="product-info">

                                    <div class="product-name">
                                        {{ $item['nama'] }}
                                    </div>

                                    <div class="product-qty">
                                        {{ $item['jumlah'] }} ×
                                        Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                    </div>

                                    <div class="product-price">

                                        Rp
                                        {{ number_format(
                                            $item['harga'] * $item['jumlah'],
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>


                    <div class="total-box">

                        <div class="total-row">

                            <div class="total-label">
                                Total Pembayaran
                            </div>

                            <div class="total-value">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </div>

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="submit-btn"
                    >
                        💬 Pesan via WhatsApp
                    </button>

                    <div class="secure-note">
                        🔒 Data pesanan digunakan untuk proses pembelian.
                    </div>

                </div>

            </aside>

        </div>

    </form>

</div>

</body>
</html>
