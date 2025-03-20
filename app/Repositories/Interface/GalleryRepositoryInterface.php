<?php

namespace App\Repositories\Interface;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Gallery;

interface GalleryRepositoryInterface
{
    public function getAll(int $perPage, ?string $search): LengthAwarePaginator;
    public function findById(int $id): ?Gallery;
    public function create(array $data): Gallery;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
