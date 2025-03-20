<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Midtrans\Config;
use Midtrans\Snap;
use App\Repositories\Interface\ProductRepositoryInterface;

class ApiController extends Controller
{
  private $productRepository;

  public function __construct(ProductRepositoryInterface $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  // Get homepage data (Featured Products & Galleries)
  public function index()
  {
    $galleries = Gallery::latest()->take(6)->get();
    $featuredProducts = $this->productRepository->getAll(3, null);

    return response()->json([
      'featured_products' => $featuredProducts,
      'galleries' => $galleries,
    ]);
  }

  // Get all products with optional search
  public function products(Request $request)
  {
    $perPage = 12;
    $search = $request->query('search');
    $products = $this->productRepository->getAll($perPage, $search);

    return response()->json($products);
  }

  // Show product details for ordering
  public function showProduct($id)
  {
    $product = Product::findOrFail($id);
    return response()->json($product);
  }

  // Submit an order
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
      'order_number' => $orderNumber,
      'product_id' => $request->product_id,
      'quantity' => $request->quantity,
      'total' => $totalAmount,
      'name' => $request->name,
      'phone' => $request->phone,
      'postal_code' => $request->postal_code,
      'address' => $request->address,
      'address_detail' => $request->address_detail,
      'status' => 'pending',
    ]);

    // Midtrans Configuration
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production', false);
    Config::$isSanitized = true;
    Config::$is3ds = true;

    // Create Midtrans transaction
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
        ],
      ],
      'item_details' => [
        [
          'id' => $product->id,
          'price' => $product->price,
          'quantity' => $request->quantity,
          'name' => $product->name,
        ],
      ],
    ];

    try {
      $snapToken = Snap::getSnapToken($midtransParams);
      $order->update(['snap_token' => $snapToken]);

      return response()->json([
        'order_number' => $orderNumber,
        'snap_token' => $snapToken,
      ]);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Transaction failed: ' . $e->getMessage()], 500);
    }
  }

  // Get order details
  public function showOrder($orderNumber)
  {
    $order = Order::where('order_number', $orderNumber)->firstOrFail();
    return response()->json($order);
  }

  // Download receipt as PDF
  public function downloadReceipt($orderNumber)
  {
    $order = Order::where('order_number', $orderNumber)->firstOrFail();
    $pdf = Pdf::loadView('pdf.receipt', compact('order'));
    $filename = 'receipt-' . $order->order_number . '.pdf';

    return response()->json([
      'download_url' => route('api.receipt.download', ['orderNumber' => $orderNumber])
    ]);
  }
}
