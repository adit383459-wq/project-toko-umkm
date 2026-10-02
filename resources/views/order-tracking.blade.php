<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cek Status Pesanan - {{ $store->nama_toko ?? 'Toko' }}</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(99,102,241,.16), transparent 35%),
                radial-gradient(circle at bottom right, rgba(236,72,153,.13), transparent 35%),
                #f6f7fb;
            color: #172033;
        }

        .container {
            width: min(720px, calc(100% - 30px));
            margin: 0 auto;
            padding: 35px 0 50px;
        }

        .brand {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo {
            width: 70px;
            height: 70px;
            margin: 0 auto 13px;
            border-radius: 20px;
            object-fit: cover;
            background: white;
            box-shadow: 0 15px 35px rgba(20,30,60,.12);
        }

        .logo-fallback {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        .brand-name {
            margin: 0;
            font-size: 24px;
            font-weight: 900;
        }

        .brand-slogan {
            margin: 6px 0 0;
            color: #737b8c;
            font-size: 14px;
        }

        .card {
            background: rgba(255,255,255,.94);
            border: 1px solid rgba(220,225,235,.8);
            border-radius: 28px;
            padding: 30px;
            box-shadow: 0 25px 70px rgba(30,40,70,.10);
        }

        .title {
            text-align: center;
            margin-bottom: 25px;
        }

        .title-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 14px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eef2ff;
            font-size: 28px;
        }

        h1 {
            margin: 0;
            font-size: 27px;
            font-weight: 900;
        }

        .subtitle {
            margin: 8px auto 0;
            color: #737b8c;
            font-size: 14px;
            line-height: 1.6;
            max-width: 470px;
        }

        .alert {
            padding: 13px 15px;
            border-radius: 14px;
            margin-bottom: 18px;
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            font-size: 14px;
            font-weight: 700;
        }

        .label {
            display: block;
            margin-bottom: 9px;
            font-size: 13px;
            font-weight: 800;
            color: #3f4758;
        }

        .input-wrap {
            display: flex;
            gap: 10px;
        }

        input {
            flex: 1;
            width: 100%;
            padding: 15px 16px;
            border: 1px solid #dce1ea;
            border-radius: 15px;
            outline: none;
            font-size: 15px;
            color: #172033;
            background: #fff;
            transition: .2s;
        }

        input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99,102,241,.10);
        }

        button {
            border: 0;
            padding: 0 21px;
            border-radius: 15px;
            background: #111827;
            color: white;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s;
        }

        button:hover {
            transform: translateY(-1px);
            opacity: .94;
        }

        .hint {
            margin-top: 10px;
            color: #8a91a0;
            font-size: 12px;
        }

        .result {
            margin-top: 28px;
            padding-top: 28px;
            border-top: 1px solid #edf0f5;
        }

        .order-head {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            align-items: center;
            margin-bottom: 22px;
        }

        .order-code {
            font-size: 18px;
            font-weight: 900;
        }

        .status {
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 900;
        }

        .status-baru {
            background: #fff7ed;
            color: #c2410c;
        }

        .status-diproses {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .status-selesai {
            background: #ecfdf5;
            color: #047857;
        }

        .status-dibatalkan {
            background: #fef2f2;
            color: #b91c1c;
        }

        .timeline {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            margin: 25px 0 28px;
            position: relative;
        }

        .timeline::before {
            content: "";
            position: absolute;
            top: 16px;
            left: 16%;
            right: 16%;
            height: 3px;
            background: #e5e7eb;
            z-index: 0;
        }

        .step {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .dot {
            width: 34px;
            height: 34px;
            margin: 0 auto 9px;
            border-radius: 50%;
            background: #e5e7eb;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 900;
            border: 4px solid #fff;
        }

        .step.active .dot {
            background: #111827;
            color: #fff;
        }

        .step.cancel .dot {
            background: #dc2626;
            color: #fff;
        }

        .step-text {
            font-size: 12px;
            font-weight: 800;
            color: #7b8495;
        }

        .step.active .step-text {
            color: #172033;
        }

        .items {
            border: 1px solid #edf0f5;
            border-radius: 18px;
            overflow: hidden;
        }

        .item {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 15px;
            border-bottom: 1px solid #edf0f5;
        }

        .item:last-child {
            border-bottom: 0;
        }

        .item-name {
            font-size: 14px;
            font-weight: 800;
        }

        .item-detail {
            margin-top: 4px;
            font-size: 12px;
            color: #8a91a0;
        }

        .item-price {
            white-space: nowrap;
            font-weight: 900;
            font-size: 14px;
        }

        .total {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding: 16px;
            border-radius: 16px;
            background: #f7f8fb;
        }

        .total strong {
            font-size: 17px;
        }

        .info {
            margin-top: 20px;
            display: grid;
            gap: 10px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f1f5;
            font-size: 13px;
        }

        .info-row span:first-child {
            color: #89909e;
        }

        .info-row span:last-child {
            text-align: right;
            font-weight: 700;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 22px;
            color: #555f72;
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
        }

        .back:hover {
            color: #111827;
        }

        footer {
            text-align: center;
            margin-top: 24px;
            color: #9299a8;
            font-size: 12px;
        }

        @media (max-width: 600px) {
            .container {
                padding-top: 22px;
            }

            .card {
                padding: 22px 17px;
                border-radius: 22px;
            }

            h1 {
                font-size: 23px;
            }

            .input-wrap {
                flex-direction: column;
            }

            button {
                height: 50px;
            }

            .order-head {
                align-items: flex-start;
                flex-direction: column;
            }

            .timeline::before {
                left: 12%;
                right: 12%;
            }

            .info-row {
                flex-direction: column;
                gap: 4px;
            }

            .info-row span:last-child {
                text-align: left;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="brand">

        @if(!empty($store?->logo))
            <img
                src="{{ asset('storage/' . $store->logo) }}"
                class="logo"
                alt="Logo"
            >
        @else
            <div class="logo logo-fallback">🛍️</div>
        @endif

        <h2 class="brand-name">
            {{ $store->nama_toko ?? 'Toko UMKM' }}
        </h2>

        @if(!empty($store?->slogan))
            <p class="brand-slogan">
                {{ $store->slogan }}
            </p>
        @endif
    </div>

    <div class="card">

        <div class="title">
            <div class="title-icon">🔎</div>

            <h1>Cek Status Pesanan</h1>

            <p class="subtitle">
                Masukkan kode pesanan untuk melihat status dan detail pesanan kamu.
            </p>
        </div>

        @if(session('error'))
            <div class="alert">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        <form
            action="{{ route('orders.tracking.check') }}"
            method="POST"
        >
            @csrf

            <label class="label">
                Kode Pesanan
            </label>

            <div class="input-wrap">
                <input
                    type="text"
                    name="kode"
                    value="{{ old('kode', $order->kode_pesanan ?? '') }}"
                    placeholder="Contoh: ORD-20261001111715-846"
                    autocomplete="off"
                    required
                >

                <button type="submit">
                    Cek Sekarang
                </button>
            </div>

            <div class="hint">
                Kode pesanan bisa kamu lihat setelah menyelesaikan checkout.
            </div>
        </form>

        @isset($order)

            @php
                $status = $order->status;

                $statusLabel = [
                    'baru' => 'Menunggu',
                    'diproses' => 'Diproses',
                    'selesai' => 'Selesai',
                    'dibatalkan' => 'Dibatalkan',
                ][$status] ?? ucfirst($status);

                $statusClass = [
                    'baru' => 'status-baru',
                    'diproses' => 'status-diproses',
                    'selesai' => 'status-selesai',
                    'dibatalkan' => 'status-dibatalkan',
                ][$status] ?? 'status-baru';

                $steps = [
                    'baru' => 1,
                    'diproses' => 2,
                    'selesai' => 3,
                ];

                $currentStep = $steps[$status] ?? 0;
            @endphp

            <div class="result">

                <div class="order-head">
                    <div>
                        <div style="font-size:12px;color:#8a91a0;margin-bottom:5px;">
                            Kode Pesanan
                        </div>

                        <div class="order-code">
                            {{ $order->kode_pesanan }}
                        </div>
                    </div>

                    <div class="status {{ $statusClass }}">
                        {{ $statusLabel }}
                    </div>
                </div>

                @if($status === 'dibatalkan')

                    <div class="timeline">

                        <div class="step active">
                            <div class="dot">✓</div>
                            <div class="step-text">Pesanan</div>
                        </div>

                        <div class="step cancel">
                            <div class="dot">×</div>
                            <div class="step-text">Dibatalkan</div>
                        </div>

                        <div class="step">
                            <div class="dot">3</div>
                            <div class="step-text">Selesai</div>
                        </div>

                    </div>

                @else

                    <div class="timeline">

                        <div class="step {{ $currentStep >= 1 ? 'active' : '' }}">
                            <div class="dot">1</div>
                            <div class="step-text">Pesanan</div>
                        </div>

                        <div class="step {{ $currentStep >= 2 ? 'active' : '' }}">
                            <div class="dot">2</div>
                            <div class="step-text">Diproses</div>
                        </div>

                        <div class="step {{ $currentStep >= 3 ? 'active' : '' }}">
                            <div class="dot">3</div>
                            <div class="step-text">Selesai</div>
                        </div>

                    </div>

                @endif

                <div class="items">

                    @foreach($order->items as $item)

                        <div class="item">

                            <div>
                                <div class="item-name">
                                    {{ $item->nama_produk }}
                                </div>

                                <div class="item-detail">
                                    {{ $item->jumlah }} ×
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="item-price">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </div>

                        </div>

                    @endforeach

                </div>

                <div class="total">
                    <span>Total Pesanan</span>

                    <strong>
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </strong>
                </div>

                <div class="info">

                    <div class="info-row">
                        <span>Nama</span>
                        <span>{{ $order->nama_pembeli }}</span>
                    </div>

                    @if($order->whatsapp)
                        <div class="info-row">
                            <span>WhatsApp</span>
                            <span>{{ $order->whatsapp }}</span>
                        </div>
                    @endif

                    <div class="info-row">
                        <span>Alamat</span>
                        <span>{{ $order->alamat }}</span>
                    </div>

                    <div class="info-row">
                        <span>Tanggal</span>
                        <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
                    </div>

                </div>

            </div>

        @endisset

    </div>

    <a
        href="{{ url('/') }}"
        class="back"
    >
        ← Kembali ke Toko
    </a>

    <footer>
        © {{ date('Y') }} {{ $store->nama_toko ?? 'Toko UMKM' }}
    </footer>

</div>

</body>
</html>
