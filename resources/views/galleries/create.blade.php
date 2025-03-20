<x-layouts.app :title="__('Add Gallery')">
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Add Gallery</h1>

        <form id="createGalleryForm" action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 dark:text-gray-300">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required 
                    class="w-full px-4 py-2 border rounded-lg bg-white dark:bg-gray-800 dark:text-white">
            </div>
            
            <div>
                <label class="block text-gray-700 dark:text-gray-300">Picture</label>
                <input type="file" name="picture" accept="image/*" required 
                    class="w-full px-4 py-2 border rounded-lg bg-white dark:bg-gray-800 dark:text-white">
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                Save Gallery
            </button>
            <a href="{{ route('galleries.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">
                Cancel
            </a>
        </form>
    </div>

    {{-- SweetAlert for Success Notification --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('createGalleryForm').addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: "Success!",
                text: "Gallery has been added successfully.",
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
