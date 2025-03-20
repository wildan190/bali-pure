<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
  public function index()
  {
    // Ambil total pendapatan (hanya yang sudah dibayar)
    $totalRevenue = Order::where('status', 'paid')->sum('total'); // Ganti total_price dengan total

    // Hitung jumlah pembeli unik
    $totalCustomers = Order::where('status', 'paid')->distinct('customer_id')->count('customer_id');

    // Data untuk chart pendapatan bulanan menggunakan strftime untuk SQLite
    $monthlyRevenue = Order::where('status', 'paid')
      ->selectRaw("strftime('%m', created_at) as month, SUM(total) as total")
      ->groupBy('month')
      ->orderBy('month')
      ->pluck('total', 'month');

    // Pastikan bulan-bulan yang belum ada datanya tetap ada di chart
    $monthlyRevenue = collect(range(1, 12))->mapWithKeys(function ($month) use ($monthlyRevenue) {
      return [$month => $monthlyRevenue->get(str_pad($month, 2, '0', STR_PAD_LEFT), 0)];
    });

    // Label bulan (nama bulan dalam format Januari, Februari, dll)
    $months = collect(range(1, 12))->map(function ($month) {
      return Carbon::create()->month($month)->format('F');
    });

    // Total Pendapatan Tahunan
    $yearlyRevenue = Order::where('status', 'paid')
      ->selectRaw("strftime('%Y', created_at) as year, SUM(total) as total")
      ->groupBy('year')
      ->orderBy('year')
      ->pluck('total', 'year');

    // Pastikan tahun yang tidak ada data tetap ada
    $years = collect([Carbon::now()->subYears(2)->year, Carbon::now()->subYear()->year, Carbon::now()->year]);

    // Jika ada tahun yang tidak terisi, set nilai 0
    $yearlyRevenue = $years->mapWithKeys(function ($year) use ($yearlyRevenue) {
      return [$year => $yearlyRevenue->get($year, 0)];
    });

    return view('dashboard', compact('totalRevenue', 'totalCustomers', 'monthlyRevenue', 'months', 'yearlyRevenue', 'years'));
  }
}
