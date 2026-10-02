<?php

namespace App\Exports;

use App\Models\OrderItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected string $periode;

    public function __construct(string $periode = 'bulan')
    {
        $this->periode = $periode;
    }

    public function collection(): Collection
    {
        $start = match ($this->periode) {
            'hari' => now()->startOfDay(),
            '7hari' => now()->subDays(6)->startOfDay(),
            default => now()->startOfMonth(),
        };

        $end = now()->endOfDay();

        return OrderItem::select(
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
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Produk',
            'Jumlah Terjual',
            'Total Penjualan',
        ];
    }

    public function map($row): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $row->nama_produk,
            $row->total_terjual,
            $row->total_penjualan,
        ];
    }
}
