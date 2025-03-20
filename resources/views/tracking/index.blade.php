<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bali Pure Manufacturer</title>

    <!-- Tailwind CSS & Font Awesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-4" x-data="{ open: false }">
        <div class="container mx-auto flex justify-between items-center px-6">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <img src="{{ asset('assets/img/logo.jpeg') }}" alt="Logo" class="h-10 w-auto">
                <span class="text-xl font-bold">Bali Pure Manufacturer</span>
            </a>

            <!-- Menu (Desktop) -->
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('home') }}" class="hover:text-blue-500">About Us</a>
                <a href="{{ route('home') }}" class="hover:text-blue-500">Keunggulan</a>
                <a href="{{ route('home') }}" class="hover:text-blue-500">Produk</a>
                <a href="{{ route('tracking') }}" class="hover:text-blue-500">Order Track</a>
                <a href="{{ route('home') }}" class="hover:text-blue-500">Contact</a>
            </div>

            <!-- Hamburger Menu (Mobile) -->
            <button @click="open = !open" class="md:hidden text-gray-600 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Sidebar (Mobile) -->
        <div x-show="open" @click.away="open = false" class="fixed inset-0 bg-gray-800 bg-opacity-50 z-50">
            <div class="w-64 bg-white h-full shadow-lg p-6 transform transition-all duration-300 ease-in-out fixed top-0 right-0"
                x-bind:class="{ 'translate-x-0': open, 'translate-x-full': !open }">
                <button @click="open = false" class="absolute top-4 right-4 text-gray-600">
                    <i class="fas fa-times text-2xl"></i>
                </button>

                <div class="text-center mt-6">
                    <h2 class="text-2xl font-bold">Menu</h2>
                </div>

                <nav class="mt-8 space-y-4">
                    <a href="{{ route('home') }}" class="block px-4 py-2 hover:bg-gray-100 transition">About Us</a>
                    <a href="{{ route('home') }}" class="block px-4 py-2 hover:bg-gray-100 transition">Keunggulan</a>
                    <a href="{{ route('home') }}" class="block px-4 py-2 hover:bg-gray-100 transition">Produk</a>
                    <a href="{{ route('tracking') }}" class="block px-4 py-2 hover:text-blue-500">Order Track</a>
                    <a href="{{ route('home') }}" class="block px-4 py-2 hover:bg-gray-100 transition">Contact</a>
                </nav>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="container mx-auto px-6 py-16 flex flex-col items-center">
        <div class="w-full max-w-md bg-white p-8 shadow-md rounded-lg">
            <h2 class="text-3xl font-bold text-center">Lacak Pesanan Anda</h2>
            <p class="text-gray-500 text-center mb-6">Masukkan Nomor Pesanan, Nama, atau No. Telepon</p>

            @if (session('error'))
                <p class="text-red-500 text-sm text-center bg-red-100 p-2 rounded-lg">{{ session('error') }}</p>
            @endif

            <form action="{{ route('tracking.search') }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="search" required
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan ID atau Nama">

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Cari Pesanan
                </button>
            </form>
        </div>
    </div>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6281234567890" target="_blank"
        class="fixed bottom-6 right-6 bg-green-500 text-white p-3 rounded-full shadow-lg flex items-center space-x-2 hover:bg-green-600 transition">
        <i class="fab fa-whatsapp text-2xl"></i>
    </a>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6 mt-16">
        <div class="container mx-auto text-center">
            <h3 class="text-xl font-semibold">Follow Us</h3>
            <div class="flex justify-center space-x-6 mt-4">
                <a href="https://facebook.com/balipuremanufacturer" target="_blank"
                    class="text-gray-400 hover:text-blue-500 transition">
                    <i class="fab fa-facebook text-2xl"></i>
                </a>
                <a href="https://instagram.com/balipuremanufacturer" target="_blank"
                    class="text-gray-400 hover:text-pink-500 transition">
                    <i class="fab fa-instagram text-2xl"></i>
                </a>
                <a href="https://twitter.com/balipuremfg" target="_blank"
                    class="text-gray-400 hover:text-blue-400 transition">
                    <i class="fab fa-twitter text-2xl"></i>
                </a>
                <a href="https://linkedin.com/company/balipuremanufacturer" target="_blank"
                    class="text-gray-400 hover:text-blue-700 transition">
                    <i class="fab fa-linkedin text-2xl"></i>
                </a>
            </div>
            <p class="mt-4 text-gray-400">&copy; {{ date('Y') }} Bali Pure Manufacturer. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
