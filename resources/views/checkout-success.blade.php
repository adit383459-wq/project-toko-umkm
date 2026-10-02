<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Pesanan {{ $order->kode_pesanan }}
        · {{ $store->nama_toko ?? 'Toko UMKM Pro' }}
    </title>

    <style>
        *{
            box-sizing:border-box;
        }

        :root{
            --primary:#1769ff;
            --primary-dark:#0f55d6;
            --green:#15945b;
            --green-soft:#e9f9f1;
            --orange:#b87500;
            --orange-soft:#fff5df;
            --red:#d83c3c;
            --red-soft:#fff0f0;
            --text:#172033;
            --muted:#7c8798;
            --line:#e8edf3;
            --soft:#f7f9fc;
            --white:#fff;
        }

        body{
            margin:0;
            min-height:100vh;
            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Arial,
                sans-serif;
            color:var(--text);
            background:
                radial-gradient(
                    circle at 50% -10%,
                    #eaf2ff 0,
                    #f7f9fc 38%,
                    #eef2f7 100%
                );
        }

        a{
            -webkit-tap-highlight-color:transparent;
        }

        .page{
            width:min(760px, calc(100% - 24px));
            margin:0 auto;
            padding:30px 0 45px;
        }

        /* TOP BRAND */

        .brand{
            display:flex;
            align-items:center;
            justify-content:center;
            gap:9px;
            margin-bottom:25px;
            color:#34425b;
            font-size:13px;
            font-weight:900;
        }

        .brand-icon{
            width:34px;
            height:34px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:11px;
            background:#fff;
            border:1px solid var(--line);
            box-shadow:0 6px 20px rgba(25,45,80,.07);
            font-size:17px;
        }

        /* SUCCESS */

        .success{
            text-align:center;
            padding:10px 0 8px;
        }

        .success-icon{
            position:relative;
            width:82px;
            height:82px;
            margin:0 auto 17px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:50%;
            background:var(--green-soft);
            color:var(--green);
            font-size:40px;
            font-weight:900;
            box-shadow:
                0 12px 30px rgba(21,148,91,.12),
                inset 0 0 0 7px #f5fffa;
        }

        .success h1{
            margin:0;
            font-size:31px;
            line-height:1.2;
            letter-spacing:-.7px;
            font-weight:950;
        }

        .success-text{
            max-width:520px;
            margin:10px auto 0;
            color:var(--muted);
            font-size:13px;
            line-height:1.65;
        }

        /* CARD */

        .card{
            margin-top:17px;
            padding:22px;
            background:var(--white);
            border:1px solid var(--line);
            border-radius:20px;
            box-shadow:0 12px 35px rgba(25,45,80,.065);
        }

        .card-title{
            margin:0;
            font-size:14px;
            font-weight:950;
        }

        .card-subtitle{
            margin-top:5px;
            color:var(--muted);
            font-size:11px;
            line-height:1.5;
        }

        /* ORDER HEADER */

        .order-header{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:18px;
            padding-bottom:18px;
            border-bottom:1px solid var(--line);
        }

        .eyebrow{
            color:#8b95a5;
            font-size:9px;
            font-weight:900;
            letter-spacing:.7px;
            text-transform:uppercase;
        }

        .order-code{
            display:flex;
            align-items:center;
            gap:8px;
            margin-top:6px;
            font-size:18px;
            font-weight:950;
            color:var(--primary);
            word-break:break-all;
        }

        .copy-btn{
            flex:none;
            border:1px solid #dbe5f7;
            background:#f2f6ff;
            color:var(--primary);
            padding:7px 9px;
            border-radius:8px;
            font-size:10px;
            font-weight:900;
            cursor:pointer;
        }

        .copy-btn:active{
            transform:scale(.97);
        }

        .status{
            flex:none;
            display:inline-flex;
            align-items:center;
            gap:6px;
            padding:8px 11px;
            border-radius:999px;
            font-size:10px;
            font-weight:950;
            text-transform:uppercase;
        }

        .status-dot{
            width:6px;
            height:6px;
            border-radius:50%;
            background:currentColor;
        }

        .status-baru{
            color:var(--orange);
            background:var(--orange-soft);
        }

        .status-diproses{
            color:var(--primary);
            background:#edf4ff;
        }

        .status-selesai{
            color:var(--green);
            background:var(--green-soft);
        }

        .status-dibatalkan{
            color:var(--red);
            background:var(--red-soft);
        }

        /* ITEMS */

        .items{
            margin-top:4px;
        }

        .item{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:15px;
            padding:15px 0;
            border-bottom:1px solid #f0f2f5;
        }

        .item:last-child{
            border-bottom:0;
        }

        .item-left{
            min-width:0;
        }

        .item-name{
            color:#253149;
            font-size:13px;
            line-height:1.4;
            font-weight:850;
            word-break:break-word;
        }

        .item-meta{
            margin-top:4px;
            color:#929baa;
            font-size:10px;
        }

        .item-price{
            flex:none;
            color:#202b40;
            font-size:12px;
            font-weight:950;
            white-space:nowrap;
        }

        .total{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:15px;
            margin-top:4px;
            padding-top:17px;
            border-top:1px solid var(--line);
        }

        .total-label{
            color:#6e7a8e;
            font-size:12px;
            font-weight:800;
        }

        .total-price{
            color:#121b2d;
            font-size:21px;
            font-weight:950;
            white-space:nowrap;
        }

        /* BUYER */

        .info-grid{
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:10px;
            margin-top:17px;
        }

        .info{
            min-width:0;
            padding:13px;
            background:var(--soft);
            border:1px solid #edf0f5;
            border-radius:12px;
        }

        .info.full{
            grid-column:1 / -1;
        }

        .info-label{
            margin-bottom:5px;
            color:#8b95a5;
            font-size:9px;
            font-weight:900;
            text-transform:uppercase;
            letter-spacing:.3px;
        }

        .info-value{
            color:#27334a;
            font-size:12px;
            line-height:1.55;
            font-weight:750;
            overflow-wrap:anywhere;
        }

        /* ACTIONS */

        .actions{
            display:grid;
            gap:10px;
            margin-top:19px;
        }

        .btn{
            width:100%;
            min-height:48px;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            border-radius:12px;
            text-decoration:none;
            border:0;
            font-size:12px;
            font-weight:950;
            cursor:pointer;
            transition:.15s ease;
        }

        .btn:active{
            transform:translateY(1px);
        }

        .btn-whatsapp{
            color:#fff;
            background:var(--green);
            box-shadow:0 8px 20px rgba(21,148,91,.18);
        }

        .btn-whatsapp:hover{
            background:#117b4b;
        }

        .btn-shop{
            color:var(--primary);
            background:#edf4ff;
        }

        .btn-shop:hover{
            background:#e2edff;
        }

        /* FOOTER */

        .footer{
            padding:20px 8px 0;
            text-align:center;
            color:#98a1af;
            font-size:10px;
            line-height:1.7;
        }

        .footer strong{
            color:#6d788a;
        }

        /* TOAST */

        .toast{
            position:fixed;
            left:50%;
            bottom:22px;
            z-index:100;
            transform:translate(-50%,20px);
            opacity:0;
            pointer-events:none;
            padding:10px 14px;
            border-radius:999px;
            background:#172033;
            color:#fff;
            font-size:11px;
            font-weight:800;
            box-shadow:0 10px 30px rgba(0,0,0,.2);
            transition:.2s ease;
        }

        .toast.show{
            opacity:1;
            transform:translate(-50%,0);
        }

        /* MOBILE */

        @media(max-width:600px){

            .page{
                width:calc(100% - 18px);
                padding:20px 0 35px;
            }

            .brand{
                margin-bottom:20px;
            }

            .success{
                padding-top:4px;
            }

            .success-icon{
                width:72px;
                height:72px;
                font-size:34px;
            }

            .success h1{
                font-size:25px;
                letter-spacing:-.4px;
            }

            .success-text{
                font-size:12px;
            }

            .card{
                padding:17px;
                border-radius:17px;
            }

            .order-header{
                align-items:flex-start;
                flex-direction:column;
                gap:12px;
            }

            .order-code{
                font-size:16px;
            }

            .status{
                align-self:flex-start;
            }

            .info-grid{
                grid-template-columns:1fr;
            }

            .info.full{
                grid-column:auto;
            }

            .total-price{
                font-size:18px;
            }

            .item-price{
                font-size:11px;
            }
        }
    </style>
</head>

<body>

<div class="page">

    {{-- BRAND --}}

    <div class="brand">
        <div class="brand-icon">🛍️</div>

        <span>
            {{ $store->nama_toko ?? 'Toko UMKM Pro' }}
        </span>
    </div>


    {{-- SUCCESS --}}

    <section class="success">

        <div class="success-icon">
            ✓
        </div>

        <h1>
            Pesanan Berhasil 🎉
        </h1>

        <p class="success-text">
            Pesanan kamu sudah berhasil dicatat.
            Simpan kode pesanan ini untuk memudahkan pengecekan
            dan komunikasi dengan toko.
        </p>

    </section>


    {{-- ORDER --}}

    <section class="card">

        <div class="order-header">

            <div>

                <div class="eyebrow">
                    Kode Pesanan
                </div>

                <div class="order-code">

                    <span id="orderCode">
                        {{ $order->kode_pesanan }}
                    </span>

                    <button
                        type="button"
                        class="copy-btn"
                        onclick="copyOrderCode()"
                    >
                        Salin
                    </button>

                </div>

            </div>


            @php
                $statusClass = match($order->status) {
                    'baru' => 'status-baru',
                    'diproses' => 'status-diproses',
                    'selesai' => 'status-selesai',
                    'dibatalkan' => 'status-dibatalkan',
                    default => 'status-baru',
                };

                $statusLabel = match($order->status) {
                    'baru' => 'Menunggu',
                    'diproses' => 'Diproses',
                    'selesai' => 'Selesai',
                    'dibatalkan' => 'Dibatalkan',
                    default => ucfirst($order->status),
                };
            @endphp

            <div class="status {{ $statusClass }}">
                <span class="status-dot"></span>
                {{ $statusLabel }}
            </div>

        </div>


        {{-- ITEMS --}}

        <div class="items">

            @forelse($order->items as $item)

                <div class="item">

                    <div class="item-left">

                        <div class="item-name">
                            {{ $item->nama_produk }}
                        </div>

                        <div class="item-meta">
                            {{ $item->jumlah }}
                            ×
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </div>

                    </div>

                    <div class="item-price">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </div>

                </div>

            @empty

                <div class="item">
                    <div class="item-meta">
                        Tidak ada detail produk.
                    </div>
                </div>

            @endforelse

        </div>


        {{-- TOTAL --}}

        <div class="total">

            <div class="total-label">
                Total Pesanan
            </div>

            <div class="total-price">
                Rp {{ number_format($order->total, 0, ',', '.') }}
            </div>

        </div>

    </section>


    {{-- BUYER --}}

    <section class="card">

        <div class="card-title">
            Data Pembeli
        </div>

        <div class="card-subtitle">
            Informasi yang digunakan untuk memproses pesanan.
        </div>


        <div class="info-grid">

            <div class="info">

                <div class="info-label">
                    Nama
                </div>

                <div class="info-value">
                    {{ $order->nama_pembeli }}
                </div>

            </div>


            @if($order->whatsapp)

                <div class="info">

                    <div class="info-label">
                        WhatsApp
                    </div>

                    <div class="info-value">
                        {{ $order->whatsapp }}
                    </div>

                </div>

            @endif


            <div class="info full">

                <div class="info-label">
                    Alamat
                </div>

                <div class="info-value">
                    {{ $order->alamat }}
                </div>

            </div>


            @if($order->catatan)

                <div class="info full">

                    <div class="info-label">
                        Catatan
                    </div>

                    <div class="info-value">
                        {{ $order->catatan }}
                    </div>

                </div>

            @endif

        </div>


        {{-- ACTIONS --}}

        <div class="actions">

            @if($waUrl)

                <a
                    href="{{ $waUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-whatsapp"
                >
                    💬 Kirim Pesanan ke WhatsApp
                </a>

            @endif


            <a
                href="{{ route('home') }}"
                class="btn btn-shop"
            >
                🛍️ Kembali ke Toko
            </a>

        </div>

    </section>


    <div class="footer">

        Pesanan kamu saat ini berstatus
        <strong>{{ $statusLabel }}</strong>.

        <br>

        {{ $store->nama_toko ?? 'Toko UMKM Pro' }}
        · Terima kasih sudah berbelanja. ❤️

    </div>

</div>


<div id="toast" class="toast">
    Kode pesanan berhasil disalin ✓
</div>


<script>
function copyOrderCode(){

    const code = document.getElementById('orderCode').innerText.trim();
    const toast = document.getElementById('toast');

    if(navigator.clipboard){

        navigator.clipboard.writeText(code).then(function(){

            toast.classList.add('show');

            setTimeout(function(){
                toast.classList.remove('show');
            }, 1800);

        });

    }else{

        const textarea = document.createElement('textarea');

        textarea.value = code;

        document.body.appendChild(textarea);
        textarea.select();

        document.execCommand('copy');

        textarea.remove();

        toast.classList.add('show');

        setTimeout(function(){
            toast.classList.remove('show');
        }, 1800);
    }
}
</script>

</body>
</html>
