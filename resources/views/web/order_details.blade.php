<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Bali Pure Manufacturer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gray-50">

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-4" x-data="{ open: false }">
        <div class="container mx-auto flex justify-between items-center px-6">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <img src="{{ asset('assets/img/logo.jpeg') }}" alt="Logo Bali Pure Manufacturer"
                    class="h-12 w-auto rounded-full">
                <span class="text-xl font-bold text-gray-800">Bali Pure Manufacturer</span>
            </a>

            <!-- Menu Desktop -->
            <div class="hidden md:flex space-x-6">
                <a href="#about" class="text-gray-600 hover:text-blue-600 font-semibold transition">About Us</a>
                <a href="#services" class="text-gray-600 hover:text-blue-600 font-semibold transition">Keunggulan</a>
                <a href="#products" class="text-gray-600 hover:text-blue-600 font-semibold transition">Produk</a>
                <a href="#contact" class="text-gray-600 hover:text-blue-600 font-semibold transition">Contact</a>
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
                <button @click="open = false" class="text-gray-600 absolute top-4 right-4">
                    <i class="fas fa-times text-2xl"></i>
                </button>

                <div class="text-center mt-6">
                    <h2 class="text-2xl font-bold text-gray-800">Menu</h2>
                </div>

                <nav class="mt-8 space-y-4">
                    <a href="#about" class="block text-gray-800 hover:text-blue-500 font-semibold transition">About
                        Us</a>
                    <a href="#services"
                        class="block text-gray-800 hover:text-blue-500 font-semibold transition">Keunggulan</a>
                    <a href="#products"
                        class="block text-gray-800 hover:text-blue-500 font-semibold transition">Produk</a>
                    <a href="#contact"
                        class="block text-gray-800 hover:text-blue-500 font-semibold transition">Contact</a>
                </nav>
            </div>
        </div>
    </nav>

    <!-- Detail Pesanan -->
    <div class="max-w-3xl mx-auto mt-10 p-8 bg-white shadow-lg rounded-xl">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Detail Pesanan</h2>

        <div class="bg-gray-100 p-5 rounded-lg">
            <h5 class="text-lg font-semibold text-gray-800">Order #{{ $order->order_number }}</h5>
            <p class="mt-2"><strong>Status:</strong>
                <span
                    class="px-3 py-1 rounded-full text-white text-sm font-semibold
                    {{ $order->status == 'paid' ? 'bg-green-500' : 'bg-yellow-500' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p class="mt-2"><strong>Nama:</strong> {{ $order->name }}</p>
            <p class="mt-1"><strong>Telepon:</strong> {{ $order->phone }}</p>
            <p class="mt-1"><strong>Alamat:</strong> {{ $order->address }}, {{ $order->postal_code }}</p>

            @if ($order->address_detail)
                <p class="mt-1"><strong>Detail Alamat:</strong> {{ $order->address_detail }}</p>
            @endif
        </div>

        <hr class="my-6 border-gray-300">

        <h5 class="text-xl font-semibold text-gray-800">Produk Dipesan</h5>
        <div class="bg-gray-100 p-5 rounded-lg mt-3">
            <p class="mt-1"><strong>Nama Produk:</strong> {{ $order->product->name }}</p>
            <p class="mt-1"><strong>Jumlah:</strong> {{ $order->quantity }}</p>
            <p class="mt-1"><strong>Total Harga:</strong>
                <span class="font-semibold text-blue-600">Rp{{ number_format($order->total, 0, ',', '.') }}</span>
            </p>
        </div>

        <div class="mt-6 flex space-x-4">
            <a href="{{ route('home') }}"
                class="px-5 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                Kembali ke Beranda
            </a>

            <a href="{{ route('order.receipt', $order->order_number) }}"
                class="px-5 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Unduh Struk (PDF)
            </a>
        </div>
    </div>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6281234567890" target="_blank"
        class="fixed bottom-6 right-6 bg-green-500 text-white px-6 py-3 rounded-full shadow-lg flex items-center space-x-3 hover:bg-green-600 transition duration-300">
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="font-semibold hidden md:block">Chat via WhatsApp</span>
    </a>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-10">
        <div class="container mx-auto text-center px-6">
            <h3 class="text-2xl font-semibold">Follow Us</h3>
            <div class="flex justify-center space-x-6 mt-4">
                <a href="#" class="text-gray-400 hover:text-blue-500 text-2xl transition"><i
                        class="fab fa-facebook"></i></a>
                <a href="#" class="text-gray-400 hover:text-pink-500 text-2xl transition"><i
                        class="fab fa-instagram"></i></a>
                <a href="#" class="text-gray-400 hover:text-blue-400 text-2xl transition"><i
                        class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-400 hover:text-blue-700 text-2xl transition"><i
                        class="fab fa-linkedin"></i></a>
            </div>
            <p class="mt-6 text-gray-400">&copy; {{ date('Y') }} Bali Pure Manufacturer. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
