<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interface\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $this->categoryRepository->create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->findById($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found!');
        }

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $updated = $this->categoryRepository->update($id, $request->all());

        if (!$updated) {
            return redirect()->route('categories.index')->with('error', 'Failed to update category!');
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $deleted = $this->categoryRepository->delete($id);

        if (!$deleted) {
            return redirect()->route('categories.index')->with('error', 'Failed to delete category!');
        }

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
