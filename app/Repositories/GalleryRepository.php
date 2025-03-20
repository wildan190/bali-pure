<?php

namespace App\Repositories;

use App\Repositories\Interface\GalleryRepositoryInterface;
use App\Models\Gallery;
use Illuminate\Pagination\LengthAwarePaginator;

class GalleryRepository implements GalleryRepositoryInterface
{
    public function getAll(int $perPage, ?string $search): LengthAwarePaginator
    {
        return Gallery::when($search, function ($query, $search) {
            $query->where('title', 'like', "%$search%");
        })->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findById(int $id): ?Gallery
    {
        return Gallery::find($id);
    }

    public function create(array $data): Gallery
    {
        return Gallery::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $gallery = $this->findById($id);
        return $gallery ? $gallery->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $gallery = $this->findById($id);
        return $gallery ? $gallery->delete() : false;
    }
}
