<x-layouts.app :title="__('Categories')">
    <div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        
        {{-- Header --}}
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Categories</h1>
            <a href="{{ route('categories.create') }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                + Add Category
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-500 text-white rounded-lg">{{ session('success') }}</div>
        @endif

        {{-- Table --}}
        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-600">
                        <th class="text-left p-3">Name</th>
                        <th class="text-left p-3">Description</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            <td class="p-3 text-gray-900 dark:text-gray-100">{{ $category->name }}</td>
                            <td class="p-3 text-gray-700 dark:text-gray-300">{{ $category->description }}</td>
                            <td class="p-3 flex justify-center space-x-2">
                                <a href="{{ route('categories.edit', $category->id) }}" 
                                   class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                    Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" 
                                            class="delete-category px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- SweetAlert Script --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-category').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const form = this.closest('form');

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
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</x-layouts.app>
