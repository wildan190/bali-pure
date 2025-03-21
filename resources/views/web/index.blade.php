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

    <!-- Hero Section dengan Auto Typing -->
    <header class="relative bg-cover bg-center h-screen flex items-center justify-center text-white"
        style="background-image: url('assets/img/hero.jpg');">

        <div class="bg-black bg-opacity-50 absolute inset-0"></div>

        <div class="relative text-center z-10" x-data="{
            text: '',
            fullText: ['Produsen Baju Renang Custom', 'Kualitas Premium, Desain Eksklusif', 'Dibuat di Bali dengan Standar Tinggi'],
            index: 0,
            wordIndex: 0
        }" x-init="let interval = setInterval(() => {
            if (index < fullText[wordIndex].length) {
                text += fullText[wordIndex][index];
                index++;
            } else {
                setTimeout(() => {
                    text = '';
                    index = 0;
                    wordIndex = (wordIndex + 1) % fullText.length;
                }, 2000);
            }
        }, 100);">

            <h1 class="text-5xl font-bold leading-tight">
                <span x-text="text"></span><span class="animate-pulse">|</span>
            </h1>

            <p class="mt-4 text-lg">
                Produsen baju renang custom di Bali dengan material berkualitas, desain eksklusif, dan standar produksi
                tinggi.
            </p>

            <a href="#contact"
                class="mt-6 inline-block bg-blue-500 text-white px-6 py-3 rounded-full text-lg font-semibold hover:bg-blue-600 transition duration-300 ease-in-out">
                Konsultasi Sekarang
            </a>
        </div>

    </header>

    <!-- About Us Section -->
    <section id="about" class="py-20 bg-gradient-to-b from-white to-gray-100">
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center gap-12">

            <!-- Text Section (Kiri) -->
            <div class="md:w-1/2 text-left md:pr-12">
                <h2 class="text-4xl font-extrabold text-gray-900 leading-tight">
                    <span class="text-blue-600">Produsen Swimwear</span> Premium di Bali
                </h2>
                <p class="mt-4 text-gray-700 text-lg leading-relaxed">
                    Ingin memproduksi swimwear berkualitas tinggi dengan desain eksklusif?
                    <strong class="text-blue-600">Bali Pure Manufacturer</strong> adalah mitra terbaik untuk produksi
                    <span class="font-semibold text-gray-900">pakaian renang custom</span> dengan bahan
                    <strong>premium</strong>,
                    <strong>ramah lingkungan</strong>, dan <strong>standar ekspor</strong>.
                </p>

                <p class="mt-4 text-gray-700 text-lg leading-relaxed">
                    Kami membantu brand lokal & internasional menciptakan koleksi terbaik, dari
                    <span class="font-semibold text-gray-900">bikini, one-piece, rash guard, hingga activewear</span>.
                </p>

                <!-- Langkah Produksi -->
                <h3 class="mt-8 text-2xl font-bold text-gray-900">Bagaimana Proses Produksi?</h3>
                <div class="flex justify-between items-center mt-6 space-x-6">
                    <!-- Konsultasi -->
                    <div class="flex flex-col items-center text-center group">
                        <div
                            class="w-16 h-16 bg-blue-500 text-white flex items-center justify-center rounded-full shadow-lg group-hover:scale-110 transition transform duration-300">
                            <i class="fas fa-comments text-2xl"></i>
                        </div>
                        <p class="mt-3 text-gray-800 font-semibold group-hover:text-blue-600 transition">Konsultasi</p>
                    </div>

                    <!-- Sample -->
                    <div class="flex flex-col items-center text-center group">
                        <div
                            class="w-16 h-16 bg-green-500 text-white flex items-center justify-center rounded-full shadow-lg group-hover:scale-110 transition transform duration-300">
                            <i class="fas fa-tshirt text-2xl"></i>
                        </div>
                        <p class="mt-3 text-gray-800 font-semibold group-hover:text-green-600 transition">Sample</p>
                    </div>

                    <!-- Produksi -->
                    <div class="flex flex-col items-center text-center group">
                        <div
                            class="w-16 h-16 bg-yellow-500 text-white flex items-center justify-center rounded-full shadow-lg group-hover:scale-110 transition transform duration-300">
                            <i class="fas fa-seedling text-2xl"></i>
                        </div>
                        <p class="mt-3 text-gray-800 font-semibold group-hover:text-yellow-600 transition">Produksi</p>
                    </div>

                    <!-- Delivery -->
                    <div class="flex flex-col items-center text-center group">
                        <div
                            class="w-16 h-16 bg-red-500 text-white flex items-center justify-center rounded-full shadow-lg group-hover:scale-110 transition transform duration-300">
                            <i class="fas fa-truck text-2xl"></i>
                        </div>
                        <p class="mt-3 text-gray-800 font-semibold group-hover:text-red-600 transition">Delivery</p>
                    </div>
                </div>
            </div>

            <!-- Gambar (Kanan) -->
            <div class="md:w-1/2 flex justify-end mt-8 md:mt-0 md:pl-12">
                <div class="relative">
                    <img src="{{ asset('assets/img/about.jpg') }}" alt="Produsen Swimwear di Bali"
                        class="w-full h-auto rounded-lg shadow-xl transform hover:scale-105 transition duration-500"
                        loading="lazy">
                    <div class="absolute top-4 left-4 bg-blue-600 text-white px-4 py-1 rounded-lg shadow-md">
                        ⭐ Premium Quality
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- Keunggulan -->
    <section id="services" class="py-20 bg-white">
        <div class="container mx-auto text-center px-6">
            <h2 class="text-4xl font-bold text-gray-800">Mengapa Memilih Kami?</h2>
            <p class="mt-4 text-gray-600">Temukan alasan mengapa banyak brand ternama mempercayakan produksi baju
                renang
                berkualitas kepada kami.</p>

            <div class="flex flex-wrap justify-center gap-y-6 mt-8">
                <!-- Kualitas Premium -->
                <div class="w-full md:w-1/3 p-4">
                    <div class="bg-white p-6 shadow-lg rounded-lg flex flex-col items-center h-full min-h-[220px]">
                        <i class="fas fa-star text-4xl text-yellow-500 mb-4"></i>
                        <h3 class="text-xl font-semibold">Kualitas Premium</h3>
                        <p class="mt-2 text-gray-600 text-center">Dibuat dengan bahan berkualitas tinggi untuk
                            kenyamanan, daya tahan, dan tampilan elegan.</p>
                    </div>
                </div>

                <!-- Ramah Lingkungan -->
                <div class="w-full md:w-1/3 p-4">
                    <div class="bg-white p-6 shadow-lg rounded-lg flex flex-col items-center h-full min-h-[220px]">
                        <i class="fas fa-leaf text-4xl text-green-500 mb-4"></i>
                        <h3 class="text-xl font-semibold">Ramah Lingkungan</h3>
                        <p class="mt-2 text-gray-600 text-center">Menggunakan bahan berkelanjutan & produksi etis untuk
                            masa depan yang lebih hijau.</p>
                    </div>
                </div>

                <!-- Desain Custom -->
                <div class="w-full md:w-1/3 p-4">
                    <div class="bg-white p-6 shadow-lg rounded-lg flex flex-col items-center h-full min-h-[220px]">
                        <i class="fas fa-pencil-ruler text-4xl text-blue-500 mb-4"></i>
                        <h3 class="text-xl font-semibold">Desain Custom</h3>
                        <p class="mt-2 text-gray-600 text-center">Desain eksklusif sesuai brand Anda untuk tampil lebih
                            unik & profesional.</p>
                    </div>
                </div>

                <!-- Harga Kompetitif -->
                <div class="w-full md:w-1/3 p-4">
                    <div class="bg-white p-6 shadow-lg rounded-lg flex flex-col items-center h-full min-h-[220px]">
                        <i class="fas fa-tags text-4xl text-red-500 mb-4"></i>
                        <h3 class="text-xl font-semibold">Harga Kompetitif</h3>
                        <p class="mt-2 text-gray-600 text-center">Harga terbaik tanpa mengorbankan kualitas, ideal
                            untuk pemesanan dalam jumlah besar.</p>
                    </div>
                </div>

                <!-- Produksi Cepat & Pengiriman -->
                <div class="w-full md:w-1/3 p-4">
                    <div class="bg-white p-6 shadow-lg rounded-lg flex flex-col items-center h-full min-h-[220px]">
                        <i class="fas fa-shipping-fast text-4xl text-purple-500 mb-4"></i>
                        <h3 class="text-xl font-semibold">Produksi Cepat & Pengiriman</h3>
                        <p class="mt-2 text-gray-600 text-center">Waktu pengerjaan yang efisien untuk memastikan
                            pesanan Anda tiba tepat waktu.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk dan Layanan -->
    <section id="products" class="py-20 bg-gray-100">
        <div class="container mx-auto text-center px-6">
            <h2 class="text-5xl font-bold text-gray-900 leading-tight">
                Koleksi <span class="text-blue-500">Eksklusif</span> Kami
            </h2>
            <p class="mt-3 text-lg text-gray-700">
                Temukan pilihan baju renang berkualitas tinggi dengan desain premium & bahan terbaik.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                @foreach ($featuredProducts as $product)
                    <div
                        class="relative bg-white shadow-md rounded-lg overflow-hidden transform transition duration-300 hover:scale-105">
                        <img src="{{ url('/product/image/' . $product->picture) }}" alt="{{ $product->name }}"
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

            <!-- Tombol Lihat Semua Produk -->
            <div class="mt-12">
                <a href="{{ route('web.products') }}"
                    class="px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-lg font-semibold rounded-full shadow-md hover:opacity-90 transition duration-300">
                    Lihat Semua Produk
                </a>
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

                <!-- Rating -->
                <div class="flex items-center mt-4">
                    <span class="text-yellow-500 text-xl mr-2">★</span>
                    <span class="text-yellow-500 text-xl mr-2">★</span>
                    <span class="text-yellow-500 text-xl mr-2">★</span>
                    <span class="text-yellow-500 text-xl mr-2">★</span>
                    <span class="text-gray-300 text-xl">★</span>
                    <span class="text-gray-600 ml-2">(4.0/5)</span>
                </div>

                <!-- Tombol Beli -->
                <a id="buyButton" href="#" target="_blank"
                    class="mt-6 block bg-blue-500 text-white text-center px-6 py-3 rounded-lg font-semibold hover:bg-blue-600 transition duration-300">
                    Order Sekarang
                </a>
            </div>
        </div>
    </div>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-white">
        <div class="container mx-auto text-center px-6">
            <h2 class="text-5xl font-bold text-gray-900 leading-tight">
                Galeri <span class="text-blue-500">Eksklusif</span> Kami
            </h2>
            <p class="mt-3 text-lg text-gray-700">
                Lihat koleksi baju renang terbaik kami dalam berbagai gaya dan warna yang elegan.
            </p>

            <!-- Grid Gallery -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-12">
                @foreach ($galleries as $gallery)
                    <div
                        class="relative group overflow-hidden rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
                        <img src="{{ asset('storage/' . $gallery->picture) }}" alt="{{ $gallery->title }}"
                            class="w-full h-64 object-cover rounded-lg" loading="lazy">

                        <!-- Overlay Hover Effect -->
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                            <p class="text-white text-lg font-semibold">{{ $gallery->title }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tombol Lihat Lebih Banyak -->
            <div class="mt-12">
                <a href="{{ route('home') }}"
                    class="px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-lg font-semibold rounded-full shadow-md hover:opacity-90 transition duration-300">
                    Lihat Lebih Banyak
                </a>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="py-20 bg-gray-100">
        <div class="container mx-auto text-center px-6">
            <h2 class="text-4xl font-bold text-gray-800">Apa Kata Pelanggan Kami?</h2>
            <p class="mt-4 text-gray-600">Testimoni dari pelanggan yang puas dengan produk kami.</p>

            <!-- Carousel Testimoni -->
            <div x-data="{
                currentIndex: 0,
                interval: null,
                testimonials: [
                    { name: 'Rina A.', text: 'Produk sangat berkualitas, nyaman dipakai, dan sesuai ekspektasi!', rating: 5 },
                    { name: 'Budi S.', text: 'Pelayanan ramah dan produk custom sesuai keinginan saya.', rating: 4 },
                    { name: 'Siti K.', text: 'Pemesanan mudah dan pengiriman cepat, recommended!', rating: 5 },
                    { name: 'Andi L.', text: 'Kualitas bahan sangat bagus dan harga tetap kompetitif.', rating: 4 },
                    { name: 'Dewi P.', text: 'Sangat puas dengan layanan dan hasil produksinya.', rating: 5 },
                    { name: 'Fajar R.', text: 'Desainnya sangat menarik, sesuai dengan trend terbaru.', rating: 4 }
                ],
                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.testimonials.length;
                },
                prev() {
                    this.currentIndex = (this.currentIndex - 1 + this.testimonials.length) % this.testimonials.length;
                },
                startAutoSlide() {
                    this.interval = setInterval(() => this.next(), 4000);
                },
                stopAutoSlide() {
                    clearInterval(this.interval);
                }
            }" x-init="startAutoSlide()" class="relative mt-8">

                <!-- Container Slider -->
                <div class="overflow-hidden relative w-full">
                    <div class="flex transition-transform duration-700 ease-in-out"
                        :style="'transform: translateX(-' + (currentIndex * 100) + '%)'">

                        <!-- Loop Testimoni -->
                        <template x-for="(testimonial, index) in testimonials" :key="index">
                            <div class="bg-white p-6 shadow-lg rounded-lg w-full sm:w-1/2 md:w-1/3 flex-shrink-0 mx-2">
                                <p class="text-gray-600 italic text-lg" x-text="testimonial.text"></p>
                                <div class="mt-4 flex items-center justify-center">
                                    <template x-for="i in 5">
                                        <i
                                            :class="i <= testimonial.rating ? 'fas fa-star text-yellow-500' :
                                                'far fa-star text-gray-400'"></i>
                                    </template>
                                </div>
                                <h4 class="mt-3 font-semibold text-gray-800 text-lg" x-text="testimonial.name"></h4>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Navigasi Slide -->
                <div class="flex justify-center space-x-4 mt-6">
                    <button @click="prev()"
                        class="px-4 py-2 bg-gray-800 text-white rounded-full hover:bg-gray-900 transition">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button @click="next()"
                        class="px-4 py-2 bg-gray-800 text-white rounded-full hover:bg-gray-900 transition">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <!-- Indikator (Dot Navigation) -->
                <div class="flex justify-center mt-4 space-x-2">
                    <template x-for="(testimonial, index) in testimonials" :key="index">
                        <div @click="currentIndex = index" class="w-3 h-3 rounded-full cursor-pointer"
                            :class="currentIndex === index ? 'bg-blue-500' : 'bg-gray-400'"></div>
                    </template>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-gray-800 text-center">Get in Touch</h2>
            <p class="mt-4 text-gray-600 text-center">We’d love to hear from you! Contact us for inquiries and
                collaborations.</p>

            <div class="flex flex-wrap mt-12 gap-8 justify-center">
                <!-- Contact Information -->
                <div class="w-full md:w-1/3 bg-white p-6 shadow-lg rounded-lg">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Our Office</h3>
                    <div class="space-y-4 text-gray-600">
                        <p class="flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-500 mr-3"></i>
                            Jl. Sunset Road No.88, Kuta, Bali, Indonesia
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-envelope text-blue-500 mr-3"></i>
                            <a href="mailto:info@balipuremanufacturer.com"
                                class="hover:underline">info@balipuremanufacturer.com</a>
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-phone text-blue-500 mr-3"></i>
                            <a href="tel:+6281234567890" class="hover:underline">+62 812 3456 7890</a>
                        </p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="w-full md:w-1/2 bg-white p-6 shadow-lg rounded-lg">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Send Us a Message</h3>
                    <form action="#" method="POST" class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-medium">Your Name</label>
                            <input type="text"
                                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"
                                placeholder="Enter your name">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Your Email</label>
                            <input type="email"
                                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"
                                placeholder="Enter your email">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Message</label>
                            <textarea class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" rows="4"
                                placeholder="Enter your message"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-500 text-white px-6 py-3 rounded-full text-lg font-semibold hover:bg-blue-600 transition duration-300">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

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

</body>

<!-- Script Modal -->
<script>
    function openModal(id, name, description, category, image, price) {
        document.getElementById('modalTitle').innerText = name;
        document.getElementById('modalCategory').innerText = "Kategori: " + category;
        document.getElementById('modalDescription').innerText = description;
        document.getElementById('modalImage').src = image;
        document.getElementById('modalPrice').innerText = "Rp. " + new Intl.NumberFormat('id-ID').format(price);

        // Set tombol beli ke WhatsApp
        let waMessage = encodeURIComponent(
            `Halo, saya tertarik dengan produk *${name}* (Kategori: ${category}) seharga Rp. ${price}. Apakah masih tersedia?`
        );
        document.getElementById('buyButton').href = `https://wa.me/6288987580851?text=${waMessage}`;

        document.getElementById('productModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('productModal').classList.add('hidden');
    }
</script>

</html>
