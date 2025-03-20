<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bali Pure Manufacturer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gray-100">

    <!-- Tambahkan Alpine.js (jika belum ada) -->
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

    <section id="products" class="py-20">
        <div class="container mx-auto text-center px-6">
            <h2 class="text-5xl font-bold text-gray-900 leading-tight">
                Koleksi <span class="text-blue-500">Eksklusif</span> Kami
            </h2>
            <p class="mt-3 text-lg text-gray-700">
                Temukan pilihan baju renang berkualitas tinggi dengan desain premium & bahan terbaik.
            </p>

            <!-- Form Pencarian -->
            <div class="mt-6 flex justify-center">
                <form action="{{ route('web.products') }}" method="GET" class="w-full md:w-2/3 lg:w-1/2 flex">
                    <input type="text" name="search" placeholder="Cari produk..."
                        class="w-full px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ request()->query('search') }}">
                    <button type="submit"
                        class="px-6 bg-blue-500 text-white font-semibold rounded-r-lg hover:bg-blue-600">
                        Cari
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                @foreach ($products as $product)
                    <div
                        class="relative bg-white shadow-md rounded-lg overflow-hidden transform transition duration-300 hover:scale-105">
                        <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->name }}"
                            class="w-full h-56 object-cover" loading="lazy">
                        <div class="p-5 text-left">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h3>
                            <p class="text-blue-500 font-bold text-lg mt-2">Rp.
                                {{ number_format($product->price, 0, ',', '.') }}</p>
                            <button
                                onclick="openModal('{{ $product->id }}', '{{ $product->name }}', '{{ $product->description }}', '{{ $product->category->name }}', '{{ asset('storage/' . $product->picture) }}', '{{ $product->price }}')"
                                class="block mt-3 text-sm text-blue-600 font-semibold hover:underline">
                                Lihat Detail →
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links('pagination::tailwind') }}
            </div>
        </div>
    </section>

    <!-- Modal Detail Produk -->
    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white w-11/12 md:w-3/5 lg:w-1/2 p-6 rounded-lg shadow-lg flex flex-col md:flex-row relative">
            <!-- Tombol Close -->
            <button onclick="closeModal()"
                class="absolute top-3 right-3 text-gray-600 text-2xl font-bold">&times;</button>

            <!-- Gambar Produk -->
            <div class="md:w-1/2 flex justify-center">
                <img id="modalImage" src="" alt="Product Image" class="w-full h-auto rounded-lg">
            </div>

            <!-- Detail Produk -->
            <div class="md:w-1/2 p-6">
                <h3 id="modalTitle" class="text-2xl font-bold text-gray-800"></h3>
                <p id="modalCategory" class="text-sm text-gray-500 mt-1">Kategori: </p>
                <p id="modalDescription" class="text-gray-600 mt-3"></p>
                <p id="modalPrice" class="text-blue-500 font-bold text-xl mt-3"></p>

                <!-- Tombol Beli -->
                <a id="buyButton" href="#"
                    class="mt-6 block bg-blue-500 text-white text-center px-6 py-3 rounded-lg font-semibold hover:bg-blue-600 transition duration-300">
                    Order Sekarang
                </a>
            </div>
        </div>
    </div>

    <script>
        function openModal(id, name, description, category, image, price) {
            document.getElementById('modalTitle').textContent = name;
            document.getElementById('modalCategory').textContent = "Kategori: " + category;
            document.getElementById('modalDescription').textContent = description;
            document.getElementById('modalImage').src = image;
            document.getElementById('modalPrice').textContent = "Rp. " + new Intl.NumberFormat('id-ID').format(price);
            document.getElementById('buyButton').href = "/web/products/" + id + "/order";
            document.getElementById('productModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('productModal').classList.add('hidden');
        }
    </script>

    <!-- FAQ Section -->
    <section id="faq" class="py-20 bg-gray-100">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-gray-800 text-center">Pertanyaan yang Sering Diajukan (FAQ)</h2>
            <p class="mt-4 text-gray-600 text-center">Temukan jawaban atas pertanyaan yang sering diajukan oleh
                pelanggan kami.</p>

            <div class="mt-10 max-w-3xl mx-auto space-y-6">
                <!-- FAQ 1 -->
                <div x-data="{ open: false }" class="bg-white shadow-lg rounded-lg p-4">
                    <button @click="open = !open"
                        class="flex justify-between items-center w-full text-left text-lg font-semibold text-gray-800">
                        Apa bahan utama yang digunakan dalam produk kami?
                        <i x-bind:class="open ? 'fas fa-minus' : 'fas fa-plus'" class="text-gray-600"></i>
                    </button>
                    <div x-show="open" class="mt-2 text-gray-600">
                        Kami menggunakan bahan berkualitas tinggi seperti **Nylon, Spandex, dan Recycled Fabrics** untuk
                        memastikan kenyamanan dan daya tahan produk kami.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div x-data="{ open: false }" class="bg-white shadow-lg rounded-lg p-4">
                    <button @click="open = !open"
                        class="flex justify-between items-center w-full text-left text-lg font-semibold text-gray-800">
                        Bagaimana cara merawat pakaian renang agar tahan lama?
                        <i x-bind:class="open ? 'fas fa-minus' : 'fas fa-plus'" class="text-gray-600"></i>
                    </button>
                    <div x-show="open" class="mt-2 text-gray-600">
                        Kami menyarankan untuk mencuci dengan tangan menggunakan air dingin dan deterjen lembut. Hindari
                        mesin cuci dan pengering untuk menjaga elastisitas bahan.
                    </div>
                </div>

                <!-- FAQ 3 - Cara Pemesanan -->
                <div x-data="{ open: false }" class="bg-white shadow-lg rounded-lg p-4">
                    <button @click="open = !open"
                        class="flex justify-between items-center w-full text-left text-lg font-semibold text-gray-800">
                        Bagaimana cara melakukan pemesanan?
                        <i x-bind:class="open ? 'fas fa-minus' : 'fas fa-plus'" class="text-gray-600"></i>
                    </button>
                    <div x-show="open" class="mt-2 text-gray-600">
                        Untuk memesan produk kami, silakan ikuti langkah-langkah berikut:
                        <ol class="list-decimal list-inside mt-2">
                            <li>Pilih produk yang Anda inginkan dari katalog kami.</li>
                            <li>Klik tombol "Order" dan isi data pemesanan.</li>
                            <li>Masukkan jumlah (kuantitas) produk yang ingin dibeli.</li>
                            <li>Konfirmasi pesanan dan lanjutkan ke tahap pembayaran.</li>
                        </ol>
                    </div>
                </div>

                <!-- FAQ 4 - Metode Pembayaran -->
                <div x-data="{ open: false }" class="bg-white shadow-lg rounded-lg p-4">
                    <button @click="open = !open"
                        class="flex justify-between items-center w-full text-left text-lg font-semibold text-gray-800">
                        Apa saja metode pembayaran yang tersedia?
                        <i x-bind:class="open ? 'fas fa-minus' : 'fas fa-plus'" class="text-gray-600"></i>
                    </button>
                    <div x-show="open" class="mt-2 text-gray-600">
                        Kami menerima pembayaran melalui **transfer rekening bank**. Setelah melakukan transfer, silakan
                        kirimkan bukti pembayaran melalui WhatsApp kami untuk verifikasi.
                    </div>
                </div>
            </div>
        </div>
    </section>

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

</body>

</html>
