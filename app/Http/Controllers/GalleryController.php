<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interface\GalleryRepositoryInterface;
use Illuminate\Support\Facades\Storage;

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

    $picturePath = null;
    if ($request->hasFile('picture')) {
      $file = $request->file('picture');
      $fileName = time() . '_' . $file->getClientOriginalName();
      $filePath = "gallery/{$fileName}";

      // **🚀 Upload ke Cloudflare R2**
      Storage::disk('s3')->put($filePath, file_get_contents($file), 'public');

      // **🔗 Simpan URL gambar di database**
      $picturePath = env('AWS_URL') . "/{$filePath}";
    }

    $this->galleryRepository->create([
      'title' => $request->title,
      'picture' => $picturePath,
    ]);

    return redirect()->route('galleries.index')->with('success', 'Gallery added successfully!');
  }

  /**
   * Menampilkan form edit
   */
  public function edit($id)
  {
    $gallery = $this->galleryRepository->findById($id);
    if (!$gallery) {
      return redirect()->route('galleries.index')->with('error', 'Gallery not found!');
    }

    return view('galleries.edit', compact('gallery'));
  }

  /**
   * Memperbarui data gallery
   */

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

    $picturePath = $gallery->picture;
    if ($request->hasFile('picture')) {
      $file = $request->file('picture');
      $fileName = time() . '_' . $file->getClientOriginalName();
      $filePath = "gallery/{$fileName}";

      // **🔥 Hapus gambar lama di Cloudflare R2**
      if ($gallery->picture) {
        $oldFilePath = str_replace(env('AWS_URL') . '/', '', $gallery->picture);
        Storage::disk('s3')->delete($oldFilePath);
      }

      // **🚀 Upload gambar baru ke Cloudflare R2**
      Storage::disk('s3')->put($filePath, file_get_contents($file), 'public');

      // **🔗 Simpan URL gambar baru**
      $picturePath = env('AWS_URL') . "/{$filePath}";
    }

    $this->galleryRepository->update($id, [
      'title' => $request->title,
      'picture' => $picturePath,
    ]);

    return redirect()->route('galleries.index')->with('success', 'Gallery updated successfully!');
  }

  /**
   * Menghapus gallery
   */
  public function destroy($id)
  {
    $gallery = $this->galleryRepository->findById($id);
    if (!$gallery) {
      return redirect()->route('galleries.index')->with('error', 'Gallery not found!');
    }

    // **🔥 Hapus gambar dari Cloudflare R2**
    if ($gallery->picture) {
      $path = str_replace(env('AWS_URL') . '/', '', $gallery->picture);
      Storage::disk('s3')->delete($path);
    }

    $deleted = $this->galleryRepository->delete($id);

    if (!$deleted) {
      return redirect()->route('galleries.index')->with('error', 'Failed to delete gallery!');
    }

    return redirect()->route('galleries.index')->with('success', 'Gallery deleted successfully!');
  }
}
