<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Bali Pure Manufacturer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gray-100">

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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

    <!-- Container -->
    <div class="container mx-auto px-6 py-10 flex flex-col md:flex-row gap-6">

        <!-- Detail Produk -->
        <div class="md:w-1/3 bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-900">Detail Produk</h2>
            <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->name }}"
                class="w-full h-48 object-cover rounded-lg mt-3">
            <h3 class="text-lg font-semibold text-gray-800 mt-3">{{ $product->name }}</h3>
            <p class="text-blue-500 font-bold text-lg">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
        </div>

        <!-- Form Order -->
        <div class="md:w-2/3 bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-900">Form Pemesanan</h2>
            <form id="orderForm" class="mt-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="mb-4">
                    <label class="block text-gray-700">Jumlah</label>
                    <input type="number" name="quantity" min="1" value="1" required
                        class="w-full px-4 py-2 border rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Nama Anda</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">No. HP</label>
                    <input type="text" name="phone" required class="w-full px-4 py-2 border rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Kode Pos</label>
                    <input type="text" name="postal_code" required class="w-full px-4 py-2 border rounded-lg">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Alamat</label>
                    <textarea name="address" required class="w-full px-4 py-2 border rounded-lg"></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 text-white py-3 rounded-lg font-semibold hover:bg-blue-600 transition duration-300">
                    Pesan Sekarang
                </button>
            </form>
        </div>
    </div>

    <!-- Floating WhatsApp Button (Kotak Rounded) -->
    <a href="https://wa.me/6281234567890" target="_blank"
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

    <!-- Midtrans Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            event.preventDefault(); // Mencegah submit langsung

            let formData = new FormData(this);

            fetch("{{ route('submitOrder') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.snap_token && data.order_number) {
                        snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                alert("Pembayaran sukses!");
                                console.log(result);

                                // Redirect ke order details dengan Laravel route helper
                                let redirectUrl = `{{ route('order.details', ':orderNumber') }}`
                                    .replace(':orderNumber', data.order_number);
                                window.location.href = redirectUrl;
                            },
                            onPending: function(result) {
                                alert("Menunggu pembayaran!");
                                console.log(result);
                            },
                            onError: function(result) {
                                alert("Pembayaran gagal!");
                                console.log(result);
                            }
                        });
                    } else {
                        alert("Gagal membuat transaksi! Order number tidak ditemukan.");
                        console.error(data);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan saat menghubungi server!");
                });
        });
    </script>

</body>

</html>
