<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
  private $productRepository;
  private $categoryRepository;

  public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
  {
    $this->productRepository = $productRepository;
    $this->categoryRepository = $categoryRepository;
  }

  /**
   * Menampilkan daftar produk dengan pagination dan pencarian.
   */
  public function index()
  {
    $perPage = 10;
    $search = request()->query('search');
    $products = $this->productRepository->getAll($perPage, $search);

    return view('products.index', compact('products', 'search'));
  }

  /**
   * Menampilkan form untuk membuat produk baru.
   */
  public function create()
  {
    $categories = $this->categoryRepository->getAll();
    return view('products.create', compact('categories'));
  }

  /**
   * Menyimpan produk baru ke database.
   */
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'category_id' => 'required|exists:categories,id',
      'type' => 'nullable|string|max:255',
      'code' => 'required|string|unique:products,code|max:50',
      'description' => 'nullable|string',
      'price' => 'required|numeric|min:0',
      'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $picturePath = $request->hasFile('picture')
      ? $request->file('picture')->store('products', 'public')
      : null;

    $this->productRepository->create($request->all(), $picturePath);

    return redirect()->route('products.index')->with('success', 'Product created successfully!');
  }

  /**
   * Menampilkan form edit untuk produk tertentu.
   */
  public function edit($id)
  {
    $product = $this->productRepository->findById($id);
    if (!$product) {
      return redirect()->route('products.index')->with('error', 'Product not found!');
    }

    $categories = $this->categoryRepository->getAll();
    return view('products.edit', compact('product', 'categories'));
  }

  /**
   * Memperbarui produk yang ada.
   */
  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'category_id' => 'required|exists:categories,id',
      'type' => 'nullable|string|max:255',
      'code' => 'required|string|max:50|unique:products,code,' . $id,
      'description' => 'nullable|string',
      'price' => 'required|numeric|min:0',
      'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = $this->productRepository->findById($id);
    if (!$product) {
      return redirect()->route('products.index')->with('error', 'Product not found!');
    }

    $picturePath = $product->picture;
    if ($request->hasFile('picture')) {
      // Hapus gambar lama jika ada
      if ($product->picture) {
        Storage::delete($product->picture);
      }
      $picturePath = $request->file('picture')->store('products');
    }

    $updated = $this->productRepository->update($id, $request->all(), $picturePath);

    if (!$updated) {
      return redirect()->route('products.index')->with('error', 'Failed to update product!');
    }

    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
  }

  /**
   * Menghapus produk dari database.
   */
  public function destroy($id)
  {
    $product = $this->productRepository->findById($id);
    if (!$product) {
      return redirect()->route('products.index')->with('error', 'Product not found!');
    }

    // Hapus gambar dari storage jika ada
    if ($product->picture) {
      Storage::delete($product->picture);
    }

    $deleted = $this->productRepository->delete($id);

    if (!$deleted) {
      return redirect()->route('products.index')->with('error', 'Failed to delete product!');
    }

    return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
  }
}
