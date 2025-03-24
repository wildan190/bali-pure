<x-layouts.app :title="__('Daftar Order')">
    <div class="container mx-auto p-4">
        <!-- Judul Halaman -->
        <h1 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">Daftar Order</h1>

        <!-- Formulir Pencarian -->
        <form method="GET" action="{{ route('admin.orders.index') }}" class="mb-4">
            <input type="text" name="search" value="{{ old('search', $search) }}"
                placeholder="Cari Order, Nama, atau Telepon..."
                class="p-2 border rounded-md dark:bg-gray-600 dark:text-white dark:border-gray-500 w-full md:w-1/2">
            <button type="submit"
                class="p-2 mt-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-600 transition duration-200 w-full md:w-auto">Cari</button>
        </form>

        <!-- Menampilkan pesan sukses jika ada -->
        @if (session('success'))
            <div
                class="alert alert-success bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-200 p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Daftar Order -->
        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300 border-b">Order
                            Number</th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300 border-b">Nama
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300 border-b">
                            Telepon</th> <!-- Kolom Telepon -->
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300 border-b">Status
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300 border-b">Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="p-3 text-sm text-gray-700 dark:text-gray-300">{{ $order->order_number }}</td>
                            <td class="p-3 text-sm text-gray-700 dark:text-gray-300">{{ $order->name }}</td>
                            <td class="p-3 text-sm text-gray-700 dark:text-gray-300">
                                <a href="https://wa.me/{{ $order->phone }}" target="_blank"
                                    class="text-blue-500 hover:underline">
                                    {{ $order->phone }}
                                </a>
                            </td>
                            <!-- Menampilkan Telepon -->
                            <td class="p-3 text-sm text-gray-700 dark:text-gray-300 capitalize">{{ $order->status }}
                            </td>
                            <td class="p-3">
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    <div class="flex items-center space-x-2">
                                        <select name="status"
                                            class="p-2 border rounded-md dark:bg-gray-600 dark:text-white dark:border-gray-500">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>
                                                Paid
                                            </option>
                                            <option value="shipped"
                                                {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="cancelled"
                                                {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                            </option>
                                        </select>
                                        <button type="submit"
                                            class="p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-600 transition duration-200">
                                            Update
                                        </button>
                                        {{-- <a href="{{ route('order.receipt', $order->id) }}"
                                            class="p-2 bg-red-500 text-white rounded-md hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-600 transition duration-200">
                                            Cetak Receipt
                                        </a> --}}
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
