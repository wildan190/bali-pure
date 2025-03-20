<x-layouts.app :title="__('Edit Category')">
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Edit Category</h1>

        {{-- Form --}}
        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-4" id="editCategoryForm">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 dark:text-gray-300">Name</label>
                <input type="text" name="name" value="{{ $category->name }}" required 
                    placeholder="Enter category name"
                    class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300">Description</label>
                <textarea name="description" placeholder="Enter category description"
                    class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">{{ $category->description }}</textarea>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('categories.index') }}" 
                   class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">
                    Back
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>

    {{-- SweetAlert Script --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('editCategoryForm');

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: "Success!",
                    text: "Category has been updated successfully.",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-layouts.app>
