<x-layouts.app :title="__('Products')">
    <div class="max-w-6xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Products</h1>
            <a href="{{ route('products.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                + Add Product
            </a>
        </div>

        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow mb-4">
            <form action="{{ route('products.index') }}" method="GET" class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Search product..." class="w-full px-4 py-2 border rounded-lg bg-white dark:bg-gray-800 dark:text-white">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                    Search
                </button>
            </form>
        </div>

        <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
            <thead>
                <tr class="bg-gray-200 dark:bg-gray-700">
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Category</th>
                    <th class="border px-4 py-2">Type</th>
                    <th class="border px-4 py-2">Code</th>
                    <th class="border px-4 py-2">Price</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="text-center border-t dark:border-gray-600">
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2">{{ $product->category->name }}</td>
                        <td class="px-4 py-2">{{ ucfirst($product->type) }}</td>
                        <td class="px-4 py-2">{{ $product->code }}</td>
                        <td class="px-4 py-2">Rp. {{ number_format($product->price, 2) }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">Edit</a>
                            <button onclick="confirmDelete({{ $product->id }})" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                Delete
                            </button>
                            <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" class="hidden">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>

    {{-- SweetAlert for Delete Confirmation --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</x-layouts.app>
