@extends('admin.categories.layout')

@section('content')

<div style="max-width:1200px;margin:0 auto;padding:25px 20px 40px;">

    <div style="display:flex;align-items:center;justify-content:space-between;gap:15px;flex-wrap:wrap;margin-bottom:22px;">
        <div>
            <h1 style="margin:0;font-size:26px;font-weight:950;color:#111827;">
                📈 Laporan Penjualan
            </h1>

            <div style="margin-top:6px;color:#64748b;font-size:13px;">
                Pantau performa penjualan toko berdasarkan periode.
            </div>
        </div>

        <div style="display:flex;gap:8px;flex-wrap:wrap;">

            <a
                href="{{ route('admin.reports.excel', ['periode' => $periode]) }}"
                style="text-decoration:none;padding:10px 15px;border-radius:12px;background:#15803d;color:#fff;font-size:13px;font-weight:800;"
            >
                📊 Export Excel
            </a>

            <a
                href="{{ route('admin.reports.pdf', ['periode' => $periode]) }}"
                style="text-decoration:none;padding:10px 15px;border-radius:12px;background:#16a34a;color:#fff;font-size:13px;font-weight:800;"
            >
                📄 Export PDF
            </a>

            <a
                href="{{ route('admin.dashboard') }}"
                style="text-decoration:none;padding:10px 15px;border-radius:12px;background:#111827;color:#fff;font-size:13px;font-weight:800;"
            >
                ← Dashboard
            </a>

        </div>
    </div>

    <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:20px;">

        @foreach([
            'hari' => 'Hari Ini',
            '7hari' => '7 Hari',
            'bulan' => 'Bulan Ini'
        ] as $value => $label)

            <a
                href="{{ route('admin.reports.index', ['periode' => $value]) }}"
                style="
                    text-decoration:none;
                    padding:10px 15px;
                    border-radius:11px;
                    font-size:12px;
                    font-weight:900;
                    {{ $periode === $value
                        ? 'background:#111827;color:#fff;'
                        : 'background:#fff;color:#334155;border:1px solid #e2e8f0;' }}
                "
            >
                {{ $label }}
            </a>

        @endforeach

    </div>

    <div style="margin-bottom:18px;color:#64748b;font-size:12px;">
        Periode:
        <strong style="color:#334155;">
            {{ $start->format('d M Y') }} — {{ $end->format('d M Y') }}
        </strong>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px;margin-bottom:25px;">

        <div style="background:#fff;border:1px solid #e5e7eb;border-radius:17px;padding:20px;box-shadow:0 7px 22px rgba(15,23,42,.05);">
            <div style="font-size:12px;font-weight:800;color:#64748b;">
                OMZET
            </div>

            <div style="margin-top:8px;font-size:25px;font-weight:950;color:#111827;">
                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </div>
        </div>

        <div style="background:#fff;border:1px solid #e5e7eb;border-radius:17px;padding:20px;box-shadow:0 7px 22px rgba(15,23,42,.05);">
            <div style="font-size:12px;font-weight:800;color:#64748b;">
                PESANAN
            </div>

            <div style="margin-top:8px;font-size:30px;font-weight:950;color:#111827;">
                {{ $totalOrders }}
            </div>
        </div>

        <div style="background:#fff;border:1px solid #e5e7eb;border-radius:17px;padding:20px;box-shadow:0 7px 22px rgba(15,23,42,.05);">
            <div style="font-size:12px;font-weight:800;color:#64748b;">
                BARANG TERJUAL
            </div>

            <div style="margin-top:8px;font-size:30px;font-weight:950;color:#111827;">
                {{ $itemsSold }}
            </div>
        </div>

    </div>

    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:18px;overflow:hidden;box-shadow:0 8px 25px rgba(15,23,42,.05);">

        <div style="padding:18px;border-bottom:1px solid #f1f5f9;">
            <div style="font-size:18px;font-weight:950;color:#111827;">
                🏆 Produk Terlaris
            </div>

            <div style="margin-top:4px;color:#64748b;font-size:12px;">
                Berdasarkan jumlah barang yang terjual pada periode ini.
            </div>
        </div>

        @forelse($topProducts as $index => $product)

            <div style="display:flex;align-items:center;gap:15px;padding:16px 18px;border-bottom:1px solid #f1f5f9;">

                <div style="width:38px;height:38px;border-radius:12px;background:#f8fafc;display:flex;align-items:center;justify-content:center;font-weight:950;color:#475569;">
                    {{ $index + 1 }}
                </div>

                <div style="flex:1;min-width:0;">
                    <div style="font-weight:900;color:#111827;font-size:14px;">
                        {{ $product->nama_produk }}
                    </div>

                    <div style="margin-top:4px;color:#64748b;font-size:12px;">
                        {{ $product->total_terjual }} barang terjual
                    </div>
                </div>

                <div style="font-weight:900;color:#111827;font-size:14px;">
                    Rp {{ number_format($product->total_penjualan, 0, ',', '.') }}
                </div>

            </div>

        @empty

            <div style="padding:40px 20px;text-align:center;color:#64748b;">
                <div style="font-size:35px;">📊</div>

                <div style="margin-top:8px;font-weight:900;color:#334155;">
                    Belum ada penjualan
                </div>

                <div style="margin-top:4px;font-size:12px;">
                    Data laporan akan muncul setelah ada pesanan.
                </div>
            </div>

        @endforelse

    </div>

</div>

<style>
@media (max-width: 700px) {
    div[style*="grid-template-columns:repeat(3"] {
        grid-template-columns:1fr !important;
    }
}
</style>

@endsection
