<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Midtrans\Config;
use Midtrans\Transaction;
use Midtrans\Snap;
use Illuminate\Http\Request;
use App\Repositories\Interface\ProductRepositoryInterface;

class WebController extends Controller
{
  private $productRepository;

  public function __construct(ProductRepositoryInterface $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function index()
  {
    $galleries = Gallery::latest()->take(6)->get()->map(function ($gallery) {
      // Ubah path gambar menjadi URL lengkap
      $gallery->picture = url('storage/' . $gallery->picture);
      return $gallery;
    });

    $featuredProducts = $this->productRepository->getAll(3, null);
    $featuredProducts->getCollection()->transform(function ($product) {
      $product->picture = $product->picture ? url('storage/' . $product->picture) : null;
      return $product;
    });

    return response()->json([
      'featured_products' => $featuredProducts->items(), // Hilangkan metadata pagination
      'galleries' => $galleries
    ]);
  }

  public function products(Request $request)
  {
    $perPage = 12;
    $search = $request->query('search');
    $products = $this->productRepository->getAll($perPage, $search);

    return response()->json([
      'products' => $products,
      'search' => $search
    ]);
  }

  public function showOrderForm($id)
  {
    $product = Product::findOrFail($id);
    $orderNumber = 'ORD-' . strtoupper(uniqid());

    return response()->json([
      'product' => $product,
      'order_number' => $orderNumber
    ]);
  }

  public function submitOrder(Request $request)
  {
    $validated = $request->validate([
      'product_id' => 'required|exists:products,id',
      'quantity' => 'required|integer|min:1',
      'name' => 'required|string|max:255',
      'phone' => 'required|string|max:20',
      'postal_code' => 'required|string|max:10',
      'address' => 'required|string|max:500',
      'address_detail' => 'nullable|string|max:500',
    ]);

    $product = Product::findOrFail($request->product_id);
    $totalAmount = $product->price * $request->quantity;
    $orderNumber = 'ORD-' . strtoupper(uniqid());

    $order = Order::create([
      'order_number'   => $orderNumber,
      'product_id'     => $request->product_id,
      'quantity'       => $request->quantity,
      'total'          => $totalAmount,
      'name'           => $request->name,
      'phone'          => $request->phone,
      'postal_code'    => $request->postal_code,
      'address'        => $request->address,
      'address_detail' => $request->address_detail,
      'status'         => 'pending',
    ]);

    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production', false);
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $midtransParams = [
      'transaction_details' => [
        'order_id' => $orderNumber,
        'gross_amount' => $totalAmount,
      ],
      'customer_details' => [
        'first_name' => $validated['name'],
        'phone' => $validated['phone'],
        'billing_address' => [
          'address' => $validated['address'],
          'postal_code' => $validated['postal_code'],
        ]
      ],
      'item_details' => [
        [
          'id' => $product->id,
          'price' => $product->price,
          'quantity' => $request->quantity,
          'name' => $product->name,
        ]
      ]
    ];

    try {
      $snapToken = Snap::getSnapToken($midtransParams);

      $order->update(['snap_token' => $snapToken]);

      return response()->json([
        'message' => 'Order successfully created',
        'snap_token' => $snapToken,
        'order_number' => $orderNumber
      ]);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Failed to create transaction: ' . $e->getMessage()], 500);
    }
  }

  public function showOrderDetails($orderNumber)
  {
    $order = Order::where('order_number', $orderNumber)->firstOrFail();
    return response()->json($order);
  }

  public function downloadReceipt($orderNumber)
  {
    $order = Order::where('order_number', $orderNumber)->firstOrFail();
    $pdf = Pdf::loadView('pdf.receipt', compact('order'));
    $filename = 'receipt-' . $order->order_number . '.pdf';

    return response()->json([
      'message' => 'Download link available',
      'pdf_url' => url('/storage/receipts/' . $filename)
    ]);
  }
}
