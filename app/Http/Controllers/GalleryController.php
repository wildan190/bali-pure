<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interface\GalleryRepositoryInterface;

class GalleryController extends Controller
{
    protected $galleryRepository;

    public function __construct(GalleryRepositoryInterface $galleryRepository)
    {
        $this->galleryRepository = $galleryRepository;
    }

    public function index()
    {
        $perPage = 10;
        $search = request()->query('search');
        $galleries = $this->galleryRepository->getAll($perPage, $search);

        return view('galleries.index', compact('galleries', 'search'));
    }

    public function create()
    {
        return view('galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload gambar
        $imagePath = $request->file('picture')->store('gallery', 'public');

        $this->galleryRepository->create([
            'title' => $request->title,
            'picture' => $imagePath,
        ]);

        return redirect()->route('galleries.index')->with('success', 'Gallery added successfully!');
    }

    public function edit($id)
    {
        $gallery = $this->galleryRepository->findById($id);
        if (!$gallery) {
            return redirect()->route('galleries.index')->with('error', 'Gallery not found!');
        }

        return view('galleries.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gallery = $this->galleryRepository->findById($id);
        if (!$gallery) {
            return redirect()->route('galleries.index')->with('error', 'Gallery not found!');
        }

        $data = ['title' => $request->title];

        // Jika ada gambar baru, upload dan ganti
        if ($request->hasFile('picture')) {
            $imagePath = $request->file('picture')->store('gallery', 'public');
            $data['picture'] = $imagePath;
        }

        $this->galleryRepository->update($id, $data);

        return redirect()->route('galleries.index')->with('success', 'Gallery updated successfully!');
    }

    public function destroy($id)
    {
        $deleted = $this->galleryRepository->delete($id);

        if (!$deleted) {
            return redirect()->route('galleries.index')->with('error', 'Failed to delete gallery!');
        }

        return redirect()->route('galleries.index')->with('success', 'Gallery deleted successfully!');
    }
}
