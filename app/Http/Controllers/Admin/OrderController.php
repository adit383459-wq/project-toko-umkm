<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));
        $status = $request->input('status', '');

        $statusCounts = [
            'baru' => Order::where('status', 'baru')->count(),
            'diproses' => Order::where('status', 'diproses')->count(),
            'selesai' => Order::where('status', 'selesai')->count(),
            'dibatalkan' => Order::where('status', 'dibatalkan')->count(),
        ];

        $orders = Order::with('items')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('kode_pesanan', 'like', "%{$search}%")
                        ->orWhere('nama_pembeli', 'like', "%{$search}%")
                        ->orWhere('whatsapp', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.orders.index', compact(
            'orders',
            'search',
            'status',
            'statusCounts'
        ));
    }

    public function show(Order $order)
    {
        $order->load('items');

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:baru,diproses,selesai,dibatalkan',
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return back()->with(
            'success',
            'Status pesanan berhasil diperbarui.'
        );
    }
}
