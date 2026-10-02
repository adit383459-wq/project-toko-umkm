@extends('admin.categories.layout')

@section('content')

<style>
    .orders-wrap {
        padding: 8px 0 30px;
    }

    .orders-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: 22px;
    }

    .orders-title h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 900;
        color: #111827;
    }

    .orders-title p {
        margin: 7px 0 0;
        color: #7b8495;
        font-size: 14px;
    }

    .result-count {
        padding: 9px 13px;
        border-radius: 12px;
        background: #f3f4f6;
        color: #4b5563;
        font-size: 12px;
        font-weight: 800;
    }

    .status-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 18px;
    }

    .status-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 17px;
        background: #fff;
        border: 1px solid #e7eaf0;
        border-radius: 18px;
        text-decoration: none;
        color: inherit;
        box-shadow: 0 8px 25px rgba(20, 30, 50, .05);
        transition: .2s;
    }

    .status-card:hover {
        transform: translateY(-2px);
        border-color: #d7dce5;
        box-shadow: 0 12px 30px rgba(20, 30, 50, .08);
    }

    .status-card-icon {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }

    .status-card-icon.orange {
        background: #fff7ed;
    }

    .status-card-icon.blue {
        background: #eff6ff;
    }

    .status-card-icon.green {
        background: #ecfdf5;
    }

    .status-card-icon.red {
        background: #fef2f2;
    }

    .status-card-label {
        color: #7b8495;
        font-size: 11px;
        font-weight: 800;
        margin-bottom: 3px;
    }

    .status-card-number {
        color: #111827;
        font-size: 23px;
        font-weight: 900;
    }

    .filter-card {
        background: #fff;
        border: 1px solid #e7eaf0;
        border-radius: 20px;
        padding: 17px;
        margin-bottom: 18px;
        box-shadow: 0 8px 25px rgba(20, 30, 50, .05);
    }

    .filter-form {
        display: grid;
        grid-template-columns: 1fr 190px auto auto;
        gap: 10px;
    }

    .filter-input,
    .filter-select {
        width: 100%;
        min-height: 45px;
        border: 1px solid #dfe3ea;
        border-radius: 12px;
        padding: 0 13px;
        background: #fff;
        color: #172033;
        outline: none;
        font-size: 13px;
    }

    .filter-input:focus,
    .filter-select:focus {
        border-color: #1769ff;
        box-shadow: 0 0 0 3px rgba(23, 105, 255, .09);
    }

    .filter-btn {
        border: 0;
        border-radius: 12px;
        padding: 0 18px;
        min-height: 45px;
        background: #1769ff;
        color: #fff;
        font-weight: 800;
        cursor: pointer;
    }

    .reset-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 45px;
        padding: 0 16px;
        border-radius: 12px;
        background: #f3f4f6;
        color: #4b5563;
        text-decoration: none;
        font-size: 13px;
        font-weight: 800;
    }

    .orders-table-card {
        background: #fff;
        border: 1px solid #e7eaf0;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(20, 30, 50, .05);
    }

    .orders-table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .orders-table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
    }

    .orders-table th {
        padding: 14px 16px;
        text-align: left;
        background: #f8fafc;
        color: #697386;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .4px;
        white-space: nowrap;
    }

    .orders-table td {
        padding: 16px;
        border-top: 1px solid #eef0f4;
        color: #273142;
        font-size: 13px;
        vertical-align: middle;
    }

    .order-code {
        color: #1769ff;
        font-weight: 900;
    }

    .buyer-name {
        font-weight: 800;
        color: #172033;
    }

    .buyer-wa {
        margin-top: 4px;
        color: #8a91a0;
        font-size: 11px;
    }

    .total-price {
        font-weight: 900;
        white-space: nowrap;
    }

    .status {
        display: inline-flex;
        align-items: center;
        padding: 7px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 900;
        white-space: nowrap;
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

    .detail-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 13px;
        border-radius: 10px;
        background: #111827;
        color: #fff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 800;
    }

    .empty {
        padding: 55px 20px;
        text-align: center;
        color: #7b8495;
    }

    .empty-icon {
        font-size: 38px;
        margin-bottom: 10px;
    }

    .empty-title {
        color: #273142;
        font-weight: 900;
        margin-bottom: 5px;
    }

    .pagination {
        padding: 16px;
        border-top: 1px solid #eef0f4;
    }

    @media (max-width: 1050px) {
        .status-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 850px) {
        .orders-head {
            align-items: flex-start;
            flex-direction: column;
        }

        .filter-form {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 520px) {
        .filter-form {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="orders-wrap">

    <div class="orders-head">
        <div class="orders-title">
            <h1>📦 Pesanan</h1>
            <p>Kelola dan pantau semua pesanan pelanggan.</p>
        </div>

        <div class="result-count">
            {{ $orders->total() }} pesanan
        </div>
    </div>

    <div class="status-grid">

        <a href="{{ route('admin.orders.index', ['status' => 'baru']) }}" class="status-card">
            <div class="status-card-icon orange">🟠</div>
            <div>
                <div class="status-card-label">Pesanan Baru</div>
                <div class="status-card-number">{{ $statusCounts['baru'] ?? 0 }}</div>
            </div>
        </a>

        <a href="{{ route('admin.orders.index', ['status' => 'diproses']) }}" class="status-card">
            <div class="status-card-icon blue">🔵</div>
            <div>
                <div class="status-card-label">Diproses</div>
                <div class="status-card-number">{{ $statusCounts['diproses'] ?? 0 }}</div>
            </div>
        </a>

        <a href="{{ route('admin.orders.index', ['status' => 'selesai']) }}" class="status-card">
            <div class="status-card-icon green">🟢</div>
            <div>
                <div class="status-card-label">Selesai</div>
                <div class="status-card-number">{{ $statusCounts['selesai'] ?? 0 }}</div>
            </div>
        </a>

        <a href="{{ route('admin.orders.index', ['status' => 'dibatalkan']) }}" class="status-card">
            <div class="status-card-icon red">🔴</div>
            <div>
                <div class="status-card-label">Dibatalkan</div>
                <div class="status-card-number">{{ $statusCounts['dibatalkan'] ?? 0 }}</div>
            </div>
        </a>

    </div>

    <div class="filter-card">

        <form
            action="{{ route('admin.orders.index') }}"
            method="GET"
            class="filter-form"
        >

            <input
                type="text"
                name="search"
                class="filter-input"
                value="{{ $search ?? '' }}"
                placeholder="🔎 Cari kode, nama, atau WhatsApp..."
            >

            <select name="status" class="filter-select">

                <option value="">
                    Semua Status
                </option>

                <option
                    value="baru"
                    {{ ($status ?? '') === 'baru' ? 'selected' : '' }}
                >
                    Baru
                </option>

                <option
                    value="diproses"
                    {{ ($status ?? '') === 'diproses' ? 'selected' : '' }}
                >
                    Diproses
                </option>

                <option
                    value="selesai"
                    {{ ($status ?? '') === 'selesai' ? 'selected' : '' }}
                >
                    Selesai
                </option>

                <option
                    value="dibatalkan"
                    {{ ($status ?? '') === 'dibatalkan' ? 'selected' : '' }}
                >
                    Dibatalkan
                </option>

            </select>

            <button type="submit" class="filter-btn">
                Cari
            </button>

            <a
                href="{{ route('admin.orders.index') }}"
                class="reset-btn"
            >
                Reset
            </a>

        </form>

    </div>

    <div class="orders-table-card">

        @if($orders->count())

            <div class="orders-table-wrap">

                <table class="orders-table">

                    <thead>
                        <tr>
                            <th>Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($orders as $order)

                            @php
                                $statusLabel = [
                                    'baru' => 'Baru',
                                    'diproses' => 'Diproses',
                                    'selesai' => 'Selesai',
                                    'dibatalkan' => 'Dibatalkan',
                                ][$order->status] ?? ucfirst($order->status);

                                $statusClass = [
                                    'baru' => 'status-baru',
                                    'diproses' => 'status-diproses',
                                    'selesai' => 'status-selesai',
                                    'dibatalkan' => 'status-dibatalkan',
                                ][$order->status] ?? 'status-baru';
                            @endphp

                            <tr>

                                <td>
                                    <div class="order-code">
                                        {{ $order->kode_pesanan }}
                                    </div>
                                </td>

                                <td>
                                    <div class="buyer-name">
                                        {{ $order->nama_pembeli }}
                                    </div>

                                    @if($order->whatsapp)
                                        <div class="buyer-wa">
                                            {{ $order->whatsapp }}
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    {{ $order->created_at->format('d/m/Y') }}
                                    <br>
                                    <span style="color:#9299a8;font-size:11px;">
                                        {{ $order->created_at->format('H:i') }}
                                    </span>
                                </td>

                                <td>
                                    {{ $order->items->sum('jumlah') }} item
                                </td>

                                <td>
                                    <div class="total-price">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </div>
                                </td>

                                <td>
                                    <span class="status {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>

                                <td>
                                    <a
                                        href="{{ route('admin.orders.show', $order) }}"
                                        class="detail-btn"
                                    >
                                        Detail
                                    </a>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            @if($orders->hasPages())
                <div class="pagination">
                    {{ $orders->links() }}
                </div>
            @endif

        @else

            <div class="empty">

                <div class="empty-icon">
                    📭
                </div>

                <div class="empty-title">
                    Pesanan tidak ditemukan
                </div>

                <div>
                    Coba ubah kata pencarian atau filter status.
                </div>

            </div>

        @endif

    </div>

</div>

@endsection
