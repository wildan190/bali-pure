<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
  // Menampilkan daftar order
  public function index(Request $request)
  {
    // Ambil query pencarian dari input
    $search = $request->get('search');

    // Query untuk mengambil data orders berdasarkan pencarian
    $orders = Order::query()
      ->when($search, function ($query, $search) {
        return $query->where('order_number', 'like', "%{$search}%")
          ->orWhere('name', 'like', "%{$search}%")
          ->orWhere('phone', 'like', "%{$search}%");
      })
      ->get();

    // Kirim data ke view
    return view('admin.orders.index', compact('orders', 'search'));
  }

  public function updateStatus(Request $request, $id)
  {
    $order = Order::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    return redirect()->route('admin.orders.index')->with('success', 'Status order berhasil diperbarui!');
  }
}
