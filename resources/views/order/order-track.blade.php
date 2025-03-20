<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Pesanan - Bali Pure Manufacturer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-4" x-data="{ open: false }">
        <div class="container mx-auto flex justify-between items-center px-6">
            <!-- Logo -->
            <a href="https://balipuremanufacturer.id/" class="flex items-center space-x-3">
                <img src="{{ asset('assets/img/logo.jpeg') }}" alt="Logo Bali Pure Manufacturer" class="h-12 w-auto">
                <span class="text-xl font-bold text-gray-800">Bali Pure Manufacturer</span>
            </a>

            <!-- Menu (Desktop) -->
            <div class="hidden md:flex space-x-6">
                <a href="#about" class="text-gray-600 hover:text-blue-500 font-semibold">About Us</a>
                <a href="#services" class="text-gray-600 hover:text-blue-500 font-semibold">Keunggulan</a>
                <a href="#products" class="text-gray-600 hover:text-blue-500 font-semibold">Produk</a>
                <a href="{{ route('tracking') }}" class="text-gray-600 hover:text-blue-500 font-semibold">Order
                    Track</a>
                <a href="#contact" class="text-gray-600 hover:text-blue-500 font-semibold">Contact</a>
            </div>

            <!-- Hamburger Menu (Mobile) -->
            <button @click="open = !open" class="md:hidden text-gray-600 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Sidebar (Mobile) -->
        <div x-show="open" @click.away="open = false" class="fixed inset-0 bg-gray-800 bg-opacity-75 z-50">
            <div class="w-64 bg-white h-full shadow-lg p-6 transform translate-x-full transition-all duration-300 ease-in-out fixed top-0 right-0"
                x-bind:class="{ 'translate-x-0': open, 'translate-x-full': !open }">
                <!-- Tombol Close -->
                <button @click="open = false" class="text-gray-600 absolute top-4 right-4">
                    <i class="fas fa-times text-2xl"></i>
                </button>

                <!-- Logo Sidebar -->
                <div class="text-center mt-6">
                    <h2 class="text-2xl font-bold text-gray-800">Menu</h2>
                </div>

                <!-- Navigasi Sidebar -->
                <nav class="mt-8 space-y-4">
                    <a href="#about"
                        class="flex items-center space-x-3 text-gray-800 hover:text-blue-500 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-info-circle"></i>
                        <span>About Us</span>
                    </a>
                    <a href="#services"
                        class="flex items-center space-x-3 text-gray-800 hover:text-blue-500 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-star"></i>
                        <span>Keunggulan</span>
                    </a>
                    <a href="#products"
                        class="flex items-center space-x-3 text-gray-800 hover:text-blue-500 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-tshirt"></i>
                        <span>Produk</span>
                    </a>
                    <a href="#contact"
                        class="flex items-center space-x-3 text-gray-800 hover:text-blue-500 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-envelope"></i>
                        <span>Contact</span>
                    </a>
                </nav>
            </div>
        </div>
    </nav>

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

<!-- Floating WhatsApp Button (Kotak Rounded) -->
<a href="https://wa.me/6288987580851" target="_blank"
    class="fixed bottom-6 right-6 bg-green-500 text-white px-5 py-3 rounded-lg shadow-lg flex items-center space-x-3 hover:bg-green-600 transition duration-300">
    <i class="fab fa-whatsapp text-2xl"></i>
    <span class="font-semibold hidden md:block">Chat via WhatsApp</span>
</a>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-8">
    <div class="container mx-auto text-center px-6">
        <h3 class="text-2xl font-semibold">Follow Us</h3>

        <!-- Ikon Sosial Media -->
        <div class="flex justify-center space-x-6 mt-4">
            <a href="https://facebook.com/balipuremanufacturer" target="_blank"
                class="text-gray-400 hover:text-blue-500 text-2xl transition duration-300">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="https://instagram.com/balipuremanufacturer" target="_blank"
                class="text-gray-400 hover:text-pink-500 text-2xl transition duration-300">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://twitter.com/balipuremfg" target="_blank"
                class="text-gray-400 hover:text-blue-400 text-2xl transition duration-300">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://linkedin.com/company/balipuremanufacturer" target="_blank"
                class="text-gray-400 hover:text-blue-700 text-2xl transition duration-300">
                <i class="fab fa-linkedin"></i>
            </a>
        </div>

        <!-- Copyright -->
        <p class="mt-6 text-gray-400">&copy; {{ date('Y') }} Bali Pure Manufacturer. All rights reserved.</p>

    </div>
</footer>

</html>
