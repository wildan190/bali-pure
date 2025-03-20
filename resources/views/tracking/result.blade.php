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
            <a href="https://balipuremanufacturer.id" class="flex items-center space-x-3">
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
            <div class="w-64 bg-white h-full shadow-lg p-6 fixed top-0 right-0 transform transition-all duration-300"
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

    <!-- Container Detail Pesanan -->
    <div class="flex justify-center items-center min-h-screen p-4">
        <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-lg">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Detail Pesanan</h2>
                <p class="text-gray-500">Berikut informasi pesanan Anda:</p>
            </div>

            <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow">
                <div class="mb-3">
                    <p class="text-lg font-semibold">Order ID:</p>
                    <p class="text-blue-600 text-lg font-bold">{{ $order->order_number }}</p>
                </div>

                <div class="grid grid-cols-1 gap-2 text-gray-700">
                    <p><strong>Nama:</strong> {{ $order->name }}</p>
                    <p><strong>Telepon:</strong> {{ $order->phone }}</p>
                    <p><strong>Alamat:</strong> {{ $order->address }}, {{ $order->postal_code }}</p>
                    <p><strong>Status:</strong>
                        <span
                            class="px-3 py-1 rounded-full text-white font-semibold text-sm
                            {{ $order->status == 'paid' ? 'bg-green-500' : ($order->status == 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="mt-6 flex justify-between">
                <a href="{{ route('tracking') }}"
                    class="bg-gray-600 text-white px-5 py-2 rounded-lg shadow-md hover:bg-gray-700 transition">
                    <i class="fas fa-search"></i> Cari Lagi
                </a>

                <a href="{{ route('order.receipt', $order->order_number) }}"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
                    <i class="fas fa-file-alt"></i> Download Struk
                </a>
            </div>
        </div>
    </div>

    <!-- Floating WhatsApp Button (Kotak Rounded) -->
    <a href="https://wa.me/6288987580851" target="_blank"
        class="fixed bottom-6 right-6 bg-green-500 text-white px-5 py-3 rounded-lg shadow-lg flex items-center space-x-3 hover:bg-green-600 transition duration-300">
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="font-semibold hidden md:block">Chat via WhatsApp</span>
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
