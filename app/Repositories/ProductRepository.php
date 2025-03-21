<?php

namespace App\Repositories;

use App\Repositories\Interface\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{
  public function getAll(int $perPage, ?string $search): LengthAwarePaginator
  {
    return Product::when($search, function ($query, $search) {
      $query->where('name', 'like', "%$search%")
        ->orWhere('code', 'like', "%$search%")
        ->orWhere('description', 'like', "%$search%");
    })->orderBy('created_at', 'desc')->paginate($perPage);
  }

  public function findById(int $id): ?Product
  {
    return Product::find($id);
  }

  public function create(array $data, ?string $picturePath): Product
  {
    if ($picturePath) {
      $data['picture'] = $picturePath;
    }
    return Product::create($data);
  }

  public function update(int $id, array $data, ?string $picturePath): bool
  {
    $product = $this->findById($id);
    if (!$product) return false;

    if ($picturePath) {
      // Hapus gambar lama jika ada
      if ($product->picture) {
        Storage::delete($product->picture);
      }
      $data['picture'] = $picturePath;
    }

    return $product->update($data);
  }

  public function delete(int $id): bool
  {
    $product = $this->findById($id);
    if (!$product) return false;

    // Hapus gambar dari storage jika ada
    if ($product->picture) {
      Storage::delete($product->picture);
    }

    return $product->delete();
  }
}
