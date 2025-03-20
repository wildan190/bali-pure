<x-layouts.app :title="__('Edit Product')">
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Edit Product</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-4" id="editProductForm">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $product->name }}" placeholder="Enter product name" required class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">

            <select name="category_id" required class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">
                <option value="" disabled>Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <input type="text" name="type" value="{{ $product->type }}" placeholder="Enter product type" class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">

            <input type="text" name="code" value="{{ $product->code }}" placeholder="Enter product code" required class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">

            <textarea name="description" placeholder="Enter product description" class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">{{ $product->description }}</textarea>

            <input type="number" name="price" value="{{ $product->price }}" placeholder="Enter product price" required class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                Update
            </button>
        </form>
    </div>

    {{-- SweetAlert for Success --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('editProductForm').addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: "Success!",
                text: "Product has been updated successfully.",
                icon: "success",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
</x-layouts.app>
