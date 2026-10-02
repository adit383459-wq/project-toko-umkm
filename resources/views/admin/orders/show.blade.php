@extends('admin.categories.layout')

@section('content')

<div class="wrap">

    {{-- HEADER --}}
    <div class="head">
        <div>
            <h1>📦 Detail Pesanan</h1>
            <div class="sub">
                Lihat informasi dan kelola status pesanan pelanggan.
            </div>
        </div>

        <a href="{{ route('admin.orders.index') }}" class="btn">
            ← Kembali
        </a>
    </div>


    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif


    {{-- RINGKASAN --}}
    <div class="summary">

        <div>
            <span class="label">Kode Pesanan</span>
            <strong class="kode">
                {{ $order->kode_pesanan }}
            </strong>
        </div>

        <div class="summary-right">
            <span class="label">Status</span>

            <span class="status status-{{ $order->status }}">
                @switch($order->status)
                    @case('baru')
                        🟡 Baru
                        @break
                    @case('diproses')
                        🔵 Diproses
                        @break
                    @case('selesai')
                        🟢 Selesai
                        @break
                    @case('dibatalkan')
                        🔴 Dibatalkan
                        @break
                @endswitch
            </span>
        </div>

    </div>


    {{-- GRID UTAMA --}}
    <div class="grid">


        {{-- KIRI --}}
        <div>


            {{-- PEMBELI --}}
            
@if($order->whatsapp)
    @php
        $wa = preg_replace('/[^0-9]/', '', $order->whatsapp);

        if (str_starts_with($wa, '0')) {
            $wa = '62' . substr($wa, 1);
        }

        $waMessage = "Halo {$order->nama_pembeli}, kami dari toko ingin mengonfirmasi pesanan {$order->kode_pesanan}.";
        $waUrl = 'https://wa.me/' . $wa . '?text=' . urlencode($waMessage);
    @endphp

    <div style="margin-bottom:18px;padding:16px 18px;border-radius:16px;background:#ecfdf5;border:1px solid #bbf7d0;display:flex;align-items:center;justify-content:space-between;gap:15px;flex-wrap:wrap;">

        <div>
            <div style="font-weight:900;color:#166534;font-size:14px;">
                💬 Hubungi Pembeli
            </div>

            <div style="margin-top:4px;color:#15803d;font-size:12px;">
                WhatsApp: {{ $order->whatsapp }}
            </div>
        </div>

        <a
            href="{{ $waUrl }}"
            target="_blank"
            rel="noopener"
            style="display:inline-flex;align-items:center;gap:7px;text-decoration:none;padding:11px 16px;border-radius:12px;background:#16a34a;color:#fff;font-size:13px;font-weight:900;"
        >
            💬 Hubungi Pembeli via WhatsApp
        </a>

    </div>
@endif

<div class="card">

                <div class="card-title">
                    <div class="icon">👤</div>

                    <div>
                        <h3>Data Pembeli</h3>
                        <p>Informasi pelanggan yang melakukan pesanan.</p>
                    </div>
                </div>


                <div class="info-grid">

                    <div class="info">
                        <span>Nama Pembeli</span>
                        <strong>{{ $order->nama_pembeli }}</strong>
                    </div>

                    <div class="info">
                        <span>WhatsApp</span>

                        @if($order->whatsapp)

                            <a
                                href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $order->whatsapp)) }}"
                                target="_blank"
                                class="wa"
                            >
                                💬 {{ $order->whatsapp }}
                            </a>

                        @else
                            <strong>-</strong>
                        @endif

                    </div>

                    <div class="info full">
                        <span>Alamat</span>
                        <strong>{{ $order->alamat }}</strong>
                    </div>

                    <div class="info full">
                        <span>Catatan</span>
                        <strong>
                            {{ $order->catatan ?: 'Tidak ada catatan dari pelanggan.' }}
                        </strong>
                    </div>

                    <div class="info full">
                        <span>Waktu Pesanan</span>
                        <strong>
                            {{ $order->created_at->format('d M Y • H:i') }}
                        </strong>
                    </div>

                </div>

            </div>


            {{-- PRODUK --}}
            <div class="card">

                <div class="card-title">
                    <div class="icon">🛍️</div>

                    <div>
                        <h3>Produk Pesanan</h3>
                        <p>Daftar produk yang dibeli pelanggan.</p>
                    </div>
                </div>


                <div class="products">

                    @foreach($order->items as $item)

                        <div class="product">

                            <div class="product-number">
                                {{ $loop->iteration }}
                            </div>

                            <div class="product-info">

                                <strong>
                                    {{ $item->nama_produk }}
                                </strong>

                                <span>
                                    {{ $item->jumlah }} ×
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </span>

                            </div>

                            <strong class="subtotal">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </strong>

                        </div>

                    @endforeach

                </div>


                <div class="total">

                    <span>Total Pesanan</span>

                    <strong>
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </strong>

                </div>

            </div>

        </div>


        {{-- KANAN --}}
        <div>


            {{-- STATUS --}}
            <div class="card">

                <div class="card-title">
                    <div class="icon">🔄</div>

                    <div>
                        <h3>Status Pesanan</h3>
                        <p>Perbarui proses pesanan pelanggan.</p>
                    </div>
                </div>


                <form
                    method="POST"
                    action="{{ route('admin.orders.status', $order) }}"
                >

                    @csrf
                    @method('PATCH')


                    <label class="form-label">
                        Status saat ini
                    </label>

                    <select name="status" class="select">

                        <option value="baru"
                            {{ $order->status === 'baru' ? 'selected' : '' }}>
                            🟡 Baru
                        </option>

                        <option value="diproses"
                            {{ $order->status === 'diproses' ? 'selected' : '' }}>
                            🔵 Diproses
                        </option>

                        <option value="selesai"
                            {{ $order->status === 'selesai' ? 'selected' : '' }}>
                            🟢 Selesai
                        </option>

                        <option value="dibatalkan"
                            {{ $order->status === 'dibatalkan' ? 'selected' : '' }}>
                            🔴 Dibatalkan
                        </option>

                    </select>


                    <button type="submit" class="save">
                        Simpan Status
                    </button>

                </form>

            </div>


            {{-- RINGKASAN --}}
            <div class="card">

                <div class="card-title">
                    <div class="icon">📋</div>

                    <div>
                        <h3>Ringkasan</h3>
                        <p>Informasi singkat pesanan.</p>
                    </div>
                </div>


                <div class="mini-row">
                    <span>Kode</span>
                    <strong>{{ $order->kode_pesanan }}</strong>
                </div>

                <div class="mini-row">
                    <span>Jumlah Produk</span>
                    <strong>{{ $order->items->sum('jumlah') }} item</strong>
                </div>

                <div class="mini-row">
                    <span>Status</span>
                    <strong>{{ ucfirst($order->status) }}</strong>
                </div>

                <div class="mini-row last">
                    <span>Total</span>
                    <strong class="blue">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </strong>
                </div>

            </div>


            {{-- WHATSAPP --}}
            @if($order->whatsapp)

                <a
                    href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $order->whatsapp)) }}"
                    target="_blank"
                    class="whatsapp"
                >
                    <span>💬</span>

                    <div>
                        <strong>Hubungi Pelanggan</strong>
                        <small>Buka percakapan WhatsApp</small>
                    </div>

                    <b>→</b>
                </a>

            @endif

        </div>

    </div>

</div>


<style>

    .alert-success {
        background:#eaf8f0;
        color:#16834b;
        padding:13px 16px;
        border-radius:12px;
        margin-bottom:18px;
        font-size:13px;
        font-weight:800;
    }


    .summary {
        background:#fff;
        border:1px solid #edf0f4;
        border-radius:16px;
        padding:20px;
        margin-bottom:18px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:20px;
        box-shadow:0 4px 18px rgba(20,30,50,.04);
    }


    .label {
        display:block;
        color:#8791a1;
        font-size:11px;
        margin-bottom:6px;
        font-weight:600;
    }


    .kode {
        color:#1769ff;
        font-size:18px;
        letter-spacing:.2px;
    }


    .summary-right {
        text-align:right;
    }


    .status {
        display:inline-flex;
        padding:8px 13px;
        border-radius:999px;
        font-size:12px;
        font-weight:800;
        white-space:nowrap;
    }


    .status-baru {
        background:#fff7df;
        color:#9a6b00;
    }


    .status-diproses {
        background:#eaf2ff;
        color:#1769ff;
    }


    .status-selesai {
        background:#eaf8f0;
        color:#16834b;
    }


    .status-dibatalkan {
        background:#fff0f0;
        color:#d92d20;
    }


    .grid {
        display:grid;
        grid-template-columns:minmax(0,1.55fr) minmax(280px,.75fr);
        gap:18px;
    }


    .card {
        background:#fff;
        border:1px solid #edf0f4;
        border-radius:16px;
        padding:20px;
        margin-bottom:18px;
        box-shadow:0 4px 18px rgba(20,30,50,.04);
    }


    .card-title {
        display:flex;
        align-items:center;
        gap:12px;
        margin-bottom:20px;
    }


    .card-title .icon {
        width:40px;
        height:40px;
        display:flex;
        align-items:center;
        justify-content:center;
        background:#f3f7ff;
        border-radius:11px;
        font-size:19px;
    }


    .card-title h3 {
        margin:0;
        font-size:15px;
        color:#182230;
    }


    .card-title p {
        margin:4px 0 0;
        font-size:11px;
        color:#8791a1;
    }


    .info-grid {
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:12px;
    }


    .info {
        background:#f8fafc;
        border:1px solid #edf0f4;
        border-radius:12px;
        padding:13px;
        min-width:0;
    }


    .info.full {
        grid-column:1 / -1;
    }


    .info span {
        display:block;
        color:#8791a1;
        font-size:11px;
        margin-bottom:6px;
    }


    .info strong {
        display:block;
        color:#253044;
        font-size:13px;
        word-break:break-word;
    }


    .wa {
        color:#16834b;
        font-size:13px;
        font-weight:800;
        text-decoration:none;
    }


    .products {
        border:1px solid #edf0f4;
        border-radius:12px;
        overflow:hidden;
    }


    .product {
        display:flex;
        align-items:center;
        gap:12px;
        padding:14px;
        border-bottom:1px solid #edf0f4;
    }


    .product:last-child {
        border-bottom:0;
    }


    .product-number {
        width:32px;
        height:32px;
        flex:none;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:9px;
        background:#f3f7ff;
        color:#1769ff;
        font-weight:900;
        font-size:12px;
    }


    .product-info {
        flex:1;
        min-width:0;
    }


    .product-info strong {
        display:block;
        color:#253044;
        font-size:13px;
        margin-bottom:4px;
    }


    .product-info span {
        color:#8791a1;
        font-size:11px;
    }


    .subtotal {
        color:#182230;
        font-size:13px;
        white-space:nowrap;
    }


    .total {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-top:18px;
        padding-top:18px;
        border-top:1px solid #edf0f4;
    }


    .total span {
        color:#697386;
        font-weight:700;
        font-size:13px;
    }


    .total strong {
        color:#1769ff;
        font-size:21px;
    }


    .form-label {
        display:block;
        color:#697386;
        font-size:12px;
        font-weight:700;
        margin-bottom:7px;
    }


    .select {
        width:100%;
        box-sizing:border-box;
        padding:12px 13px;
        border:1px solid #dfe4ea;
        border-radius:11px;
        background:#fff;
        color:#253044;
        font-size:13px;
        outline:none;
        margin-bottom:12px;
    }


    .save {
        width:100%;
        border:0;
        border-radius:11px;
        padding:12px;
        background:#1769ff;
        color:#fff;
        font-size:13px;
        font-weight:800;
        cursor:pointer;
    }


    .save:active {
        transform:scale(.99);
    }


    .mini-row {
        display:flex;
        justify-content:space-between;
        gap:15px;
        padding:13px 0;
        border-bottom:1px solid #edf0f4;
        font-size:12px;
    }


    .mini-row span {
        color:#8791a1;
    }


    .mini-row strong {
        color:#253044;
        text-align:right;
        word-break:break-word;
    }


    .mini-row.last {
        border-bottom:0;
        padding-bottom:0;
    }


    .blue {
        color:#1769ff !important;
        font-size:16px;
    }


    .whatsapp {
        display:flex;
        align-items:center;
        gap:12px;
        background:#eaf8f0;
        border:1px solid #ccebd9;
        border-radius:16px;
        padding:15px;
        margin-bottom:18px;
        color:#16834b;
        text-decoration:none;
    }


    .whatsapp > span {
        font-size:22px;
    }


    .whatsapp div {
        flex:1;
    }


    .whatsapp strong {
        display:block;
        font-size:13px;
    }


    .whatsapp small {
        display:block;
        margin-top:3px;
        font-size:11px;
        color:#5d9877;
    }


    .whatsapp b {
        font-size:20px;
    }


    @media(max-width:850px) {

        .grid {
            grid-template-columns:1fr;
        }

    }


    @media(max-width:600px) {

        .summary {
            align-items:flex-start;
            flex-direction:column;
        }

        .summary-right {
            text-align:left;
        }

        .info-grid {
            grid-template-columns:1fr;
        }

        .info.full {
            grid-column:auto;
        }

        .product {
            align-items:flex-start;
        }

        .subtotal {
            font-size:12px;
        }

        .total strong {
            font-size:18px;
        }

    }

</style>

@endsection
