<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class TrackingController extends Controller
{
  public function index()
  {
    return view('tracking.index');
  }

  public function search(Request $request)
  {
    $validated = $request->validate([
      'search' => 'required|string'
    ]);

    $search = $validated['search'];

    $order = Order::where('order_number', $search)
      ->orWhere('phone', $search)
      ->orWhere('name', 'like', '%' . $search . '%')
      ->first();

    if (!$order) {
      return back()->with('error', 'Pesanan tidak ditemukan!');
    }

    return view('tracking.result', compact('order'));
  }
}
