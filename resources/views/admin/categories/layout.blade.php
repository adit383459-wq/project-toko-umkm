<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Admin' }} - Toko UMKM Pro</title>

    <style>

        * {
            box-sizing:border-box;
        }

        body {
            margin:0;
            font-family:Arial,sans-serif;
            background:#f5f7fb;
            color:#172033;
        }

        .top {
            background:#fff;
            padding:14px 20px;
            border-bottom:1px solid #e8ecf3;
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:18px;
            position:sticky;
            top:0;
            z-index:20;
        }

        .brand {
            font-size:20px;
            font-weight:900;
            color:#1769ff;
            white-space:nowrap;
        }

        .nav {
            display:flex;
            align-items:center;
            gap:6px;
            flex-wrap:wrap;
            justify-content:flex-end;
        }

        .nav a {
            text-decoration:none;
            color:#596579;
            font-size:12px;
            font-weight:800;
            padding:9px 11px;
            border-radius:9px;
            transition:.15s;
        }

        .nav a:hover {
            background:#f1f5ff;
            color:#1769ff;
        }

        .nav .orders {
            background:#edf4ff;
            color:#1769ff;
        }

        .wrap {
            max-width:1050px;
            margin:30px auto;
            padding:0 18px;
        }

        .head {
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:15px;
            margin-bottom:22px;
        }

        h1 {
            margin:0;
            font-size:28px;
        }

        .sub {
            color:#7b8494;
            margin-top:6px;
            font-size:14px;
        }

        .btn {
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:11px 16px;
            border-radius:11px;
            text-decoration:none;
            border:0;
            cursor:pointer;
            font-weight:800;
            font-size:13px;
        }

        .primary {
            background:#1769ff;
            color:white;
        }

        .card {
            background:white;
            border:1px solid #e9edf4;
            border-radius:18px;
            overflow:hidden;
            box-shadow:0 8px 30px rgba(20,35,70,.05);
        }

        table {
            width:100%;
            border-collapse:collapse;
        }

        th,td {
            padding:15px 17px;
            text-align:left;
            border-bottom:1px solid #eef1f5;
            font-size:14px;
        }

        th {
            font-size:12px;
            color:#7a8495;
            text-transform:uppercase;
        }

        .badge {
            display:inline-flex;
            padding:5px 9px;
            border-radius:999px;
            font-size:11px;
            font-weight:800;
        }

        .on {
            background:#e8f8ef;
            color:#16834b;
        }

        .off {
            background:#fff0f0;
            color:#c23b3b;
        }

        .actions {
            display:flex;
            gap:7px;
            flex-wrap:wrap;
        }

        .edit {
            background:#edf4ff;
            color:#1769ff;
        }

        .delete {
            background:#fff0f0;
            color:#d43b3b;
        }

        .empty {
            text-align:center;
            padding:45px;
            color:#7b8494;
        }

        .form-card {
            max-width:650px;
            margin:auto;
            background:white;
            border:1px solid #e9edf4;
            border-radius:18px;
            padding:25px;
            box-shadow:0 8px 30px rgba(20,35,70,.05);
        }

        label {
            display:block;
            font-size:13px;
            font-weight:800;
            margin-bottom:7px;
        }

        input,textarea {
            width:100%;
            padding:12px 13px;
            border:1px solid #dfe4ec;
            border-radius:10px;
            outline:none;
            font:inherit;
            margin-bottom:17px;
        }

        input:focus,textarea:focus {
            border-color:#1769ff;
        }

        textarea {
            min-height:120px;
            resize:vertical;
        }

        .check {
            display:flex;
            align-items:center;
            gap:8px;
            margin-bottom:20px;
        }

        .check input {
            width:auto;
            margin:0;
        }

        .error {
            color:#d43b3b;
            font-size:12px;
            margin-top:-10px;
            margin-bottom:12px;
        }

        @media(max-width:850px) {

            .top {
                align-items:flex-start;
                flex-direction:column;
            }

            .nav {
                width:100%;
                justify-content:flex-start;
                overflow-x:auto;
                flex-wrap:nowrap;
                padding-bottom:2px;
            }

            .nav a {
                white-space:nowrap;
            }

        }

        @media(max-width:700px) {

            .head {
                align-items:flex-start;
                flex-direction:column;
            }

            .card {
                overflow-x:auto;
            }

            table {
                min-width:650px;
            }

            .wrap {
                margin-top:22px;
            }

        }

    </style>
</head>

<body>

<header class="top">

    <div class="brand">
        Toko UMKM Pro
    </div>

    <nav class="nav">

        <a href="{{ route('admin.dashboard') }}">
            🏠 Dashboard
        </a>

        <a href="{{ route('admin.products.index') }}">
            🛍️ Produk
        </a>

        <a href="{{ route('admin.categories.index') }}">
            📁 Kategori
        </a>

        <a
            href="{{ route('admin.reports.index') }}"
            style="display:inline-flex;align-items:center;gap:5px;"
        >
            📈 Laporan
        </a>

        <a
            href="{{ route('admin.orders.index') }}"
            class="orders"
            style="display:inline-flex;align-items:center;gap:5px;"
        >
            📦 Pesanan

            @php
                $newOrdersMenu = \App\Models\Order::where('status', 'baru')->count();
            @endphp

            @if($newOrdersMenu > 0)
                <span style="display:inline-flex;align-items:center;justify-content:center;min-width:19px;height:19px;padding:0 5px;border-radius:999px;background:#e53935;color:#fff;font-size:10px;font-weight:900;">
                    {{ $newOrdersMenu }}
                </span>
            @endif
        </a>

        <a href="{{ route('admin.store-settings.edit') }}">
            ⚙️ Pengaturan
        </a>

    </nav>

</header>


@yield('content')


</body>
</html>
