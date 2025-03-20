<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Pesanan - Bali Pure Manufacturer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center mb-4">Lacak Pesanan Anda</h2>

        <!-- Notifikasi Jika Pesanan Tidak Ditemukan -->
        @if (session('error'))
            <div class="bg-red-100 text-red-600 p-3 mb-4 rounded text-center">
                {{ session('error') }}
            </div>
        @endif

        <!-- Formulir Pencarian -->
        <form action="{{ route('order.tracking') }}" method="POST" class="space-y-4">
            @csrf
            <input type="text" name="search" placeholder="Masukkan Nomor Order atau Telepon"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Cari Pesanan
            </button>
        </form>

        <!-- Jika Ada Hasil Pencarian -->
        @if (isset($order))
            <div class="mt-6 p-4 bg-gray-100 rounded-lg">
                <h3 class="text-lg font-semibold text-center">Detail Pesanan</h3>
                <p><strong>Order ID:</strong> {{ $order->order_number }}</p>
                <p><strong>Nama:</strong> {{ $order->name }}</p>
                <p><strong>Telepon:</strong> {{ $order->phone }}</p>
                <p><strong>Alamat:</strong> {{ $order->address }}, {{ $order->postal_code }}</p>
                <p><strong>Status:</strong>
                    <span
                        class="px-2 py-1 rounded-full text-white text-sm {{ $order->status == 'paid' ? 'bg-green-500' : 'bg-yellow-500' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
            </div>
        @endif
    </div>
</body>

</html>
