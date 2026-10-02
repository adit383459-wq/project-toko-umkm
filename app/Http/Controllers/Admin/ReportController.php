<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesReportExport;

class ReportController extends Controller
{
    public function excel(Request $request)
    {
        $periode = $request->input('periode', 'bulan');

        return Excel::download(
            new SalesReportExport($periode),
            'laporan-penjualan-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    public function pdf(Request $request)
    {
        $periode = $request->input('periode', 'bulan');

        $start = match ($periode) {
            'hari' => now()->startOfDay(),
            '7hari' => now()->subDays(6)->startOfDay(),
            default => now()->startOfMonth(),
        };

        $end = now()->endOfDay();

        $ordersQuery = Order::whereBetween(
            'created_at',
            [$start, $end]
        )->whereIn('status', [
            'baru',
            'diproses',
            'selesai'
        ]);

        $totalOrders = (clone $ordersQuery)->count();

        $totalRevenue = (clone $ordersQuery)->sum('total');

        $itemsSold = OrderItem::whereHas('order', function ($query) use ($start, $end) {
                $query->whereBetween('created_at', [$start, $end])
                    ->whereIn('status', [
                        'baru',
                        'diproses',
                        'selesai'
                    ]);
            })
            ->sum('jumlah');

        $topProducts = OrderItem::select(
                'nama_produk',
                DB::raw('SUM(jumlah) as total_terjual'),
                DB::raw('SUM(subtotal) as total_penjualan')
            )
            ->whereHas('order', function ($query) use ($start, $end) {
                $query->whereBetween('created_at', [$start, $end])
                    ->whereIn('status', [
                        'baru',
                        'diproses',
                        'selesai'
                    ]);
            })
            ->groupBy('nama_produk')
            ->orderByDesc('total_terjual')
            ->take(10)
            ->get();

        $pdf = Pdf::loadView('admin.reports.pdf', compact(
            'periode',
            'start',
            'end',
            'totalOrders',
            'totalRevenue',
            'itemsSold',
            'topProducts'
        ));

        return $pdf->download(
            'laporan-penjualan-' . now()->format('Y-m-d') . '.pdf'
        );
    }
}
