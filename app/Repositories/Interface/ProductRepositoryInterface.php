<?php

namespace App\Repositories\Interface;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAll(int $perPage, ?string $search): LengthAwarePaginator;
    public function findById(int $id): ?Product;
    public function create(array $data, ?string $picturePath): Product;
    public function update(int $id, array $data, ?string $picturePath): bool;
    public function delete(int $id): bool;
}
