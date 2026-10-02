<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0 0 6px;
            font-size: 22px;
        }

        .header p {
            margin: 3px 0;
            color: #666;
        }

        .cards {
            width: 100%;
            margin-bottom: 20px;
        }

        .card {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        .card-title {
            font-size: 10px;
            color: #666;
            text-transform: uppercase;
        }

        .card-value {
            font-size: 17px;
            font-weight: bold;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background: #f3f4f6;
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            color: #888;
            font-size: 10px;
        }
    </style>
</head>

<body>

<div class="header">
    <h1>📈 LAPORAN PENJUALAN</h1>

    <p>
        Periode:
        {{ $start->format('d/m/Y H:i') }}
        -
        {{ $end->format('d/m/Y H:i') }}
    </p>

    <p>
        Dicetak:
        {{ now()->format('d/m/Y H:i') }}
    </p>
</div>

<table class="cards">
    <tr>
        <td class="card">
            <div class="card-title">Total Omzet</div>
            <div class="card-value">
                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </div>
        </td>

        <td class="card">
            <div class="card-title">Total Pesanan</div>
            <div class="card-value">
                {{ number_format($totalOrders, 0, ',', '.') }}
            </div>
        </td>

        <td class="card">
            <div class="card-title">Barang Terjual</div>
            <div class="card-value">
                {{ number_format($itemsSold, 0, ',', '.') }}
            </div>
        </td>
    </tr>
</table>

<h3>Produk Terlaris</h3>

<table>
    <thead>
        <tr>
            <th width="8%">No</th>
            <th>Produk</th>
            <th width="18%">Terjual</th>
            <th width="25%">Penjualan</th>
        </tr>
    </thead>

    <tbody>
        @forelse($topProducts as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>

                <td>
                    {{ $product->nama_produk }}
                </td>

                <td>
                    {{ number_format($product->total_terjual, 0, ',', '.') }}
                </td>

                <td class="right">
                    Rp {{ number_format($product->total_penjualan, 0, ',', '.') }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align:center;">
                    Belum ada penjualan pada periode ini.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="footer">
    Toko UMKM Pro · Laporan Penjualan
</div>

</body>
</html>
