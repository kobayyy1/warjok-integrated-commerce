@extends('layouts.pages')

@section('head')
@endsection
@include('koproll.style')
</head>

<body class="bg-stone-50">
    @section('body')
        <!-- Back to Home Button - Fixed Position -->
        <div class="fixed top-4 left-4 z-50">
            <a href="{{ route('home') }}"
                class="group flex items-center gap-2 bg-white/95 backdrop-blur-sm hover:bg-amber-600 text-stone-800 hover:text-white px-5 py-3 rounded-full font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 border border-stone-200">
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        <!-- Banner Carousel Section - Only show if banners exist -->
        @if ($banners && $banners->count() > 0)
            <section class="relative w-full overflow-hidden border-b-8 border-amber-600 shadow-2xl">
                <!-- Decorative top border -->
                <div
                    class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-amber-600 via-amber-500 to-amber-600 z-30">
                </div>

                <!-- Corner decorations -->
                <div class="absolute top-0 left-0 w-32 h-32 border-t-4 border-l-4 border-amber-500 z-20 opacity-50"></div>
                <div class="absolute top-0 right-0 w-32 h-32 border-t-4 border-r-4 border-amber-500 z-20 opacity-50"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 border-b-4 border-l-4 border-amber-500 z-20 opacity-50">
                </div>
                <div class="absolute bottom-0 right-0 w-32 h-32 border-b-4 border-r-4 border-amber-500 z-20 opacity-50">
                </div>

                <div class="banner-carousel relative h-[500px] md:h-[650px]">
                    @foreach ($banners as $index => $banner)
                        <div class="banner-slide absolute inset-0 transition-all duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 scale-100' : 'opacity-0 scale-105' }}"
                            data-slide="{{ $index }}">
                            <!-- Decorative frame inside -->
                            <div
                                class="absolute inset-4 md:inset-8 border-2 border-amber-400/30 rounded-lg z-10 pointer-events-none">
                                <div
                                    class="absolute -top-2 -left-2 w-8 h-8 border-t-4 border-l-4 border-amber-500 rounded-tl-lg">
                                </div>
                                <div
                                    class="absolute -top-2 -right-2 w-8 h-8 border-t-4 border-r-4 border-amber-500 rounded-tr-lg">
                                </div>
                                <div
                                    class="absolute -bottom-2 -left-2 w-8 h-8 border-b-4 border-l-4 border-amber-500 rounded-bl-lg">
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 w-8 h-8 border-b-4 border-r-4 border-amber-500 rounded-br-lg">
                                </div>
                            </div>

                            <!-- Banner Image with Parallax Effect -->
                            <div class="absolute inset-0 transform transition-transform duration-700">
                                <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}"
                                    class="w-full h-full object-cover" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-stone-900/80 via-amber-900/60 to-transparent">
                                </div>
                                <div class="absolute inset-0 shadow-inner-strong"></div>
                            </div>

                            <!-- Banner Content -->
                            <div class="relative z-10 h-full flex items-center">
                                <div class="container mx-auto px-6 md:px-12">
                                    <div class="max-w-3xl relative">
                                        <div
                                            class="absolute -left-6 top-0 bottom-0 w-1 bg-gradient-to-b from-transparent via-amber-500 to-transparent">
                                        </div>
                                        <div
                                            class="mb-4 inline-flex items-center gap-2 px-5 py-2 bg-gradient-to-r from-amber-600 to-amber-700 backdrop-blur-sm rounded-full shadow-lg border border-amber-400/30">
                                            <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                                            <span class="text-white text-sm font-semibold tracking-wide">PENAWARAN
                                                SPESIAL</span>
                                        </div>
                                        <h2
                                            class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight animate-slide-in-left">
                                            {{ $banner->title }}
                                        </h2>
                                        @if ($banner->description)
                                            <p
                                                class="text-xl md:text-2xl text-stone-100 mb-8 leading-relaxed max-w-2xl animate-slide-in-left-delay">
                                                {{ $banner->description }}
                                            </p>
                                        @endif
                                        @if ($banner->link)
                                            <a href="{{ $banner->link }}"
                                                class="group inline-flex items-center gap-3 bg-amber-600 hover:bg-amber-700 text-white font-bold px-10 py-4 rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-2xl animate-slide-in-left-delay-2">
                                                <span>Lihat Selengkapnya</span>
                                                <i
                                                    class="fas fa-arrow-right transition-transform group-hover:translate-x-1"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Navigation Arrows -->
                    @if ($banners->count() > 1)
                        <button
                            class="banner-nav banner-prev absolute left-6 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-amber-600 backdrop-blur-md text-white p-4 rounded-full transition-all duration-300 hover:scale-110 group">
                            <i class="fas fa-chevron-left text-2xl transition-transform group-hover:-translate-x-1"></i>
                        </button>
                        <button
                            class="banner-nav banner-next absolute right-6 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-amber-600 backdrop-blur-md text-white p-4 rounded-full transition-all duration-300 hover:scale-110 group">
                            <i class="fas fa-chevron-right text-2xl transition-transform group-hover:translate-x-1"></i>
                        </button>

                        <!-- Dots Indicator -->
                        <div
                            class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-3 bg-black/20 backdrop-blur-md px-6 py-3 rounded-full">
                            @foreach ($banners as $index => $banner)
                                <button
                                    class="banner-dot h-3 rounded-full transition-all duration-300 hover:scale-110 {{ $index === 0 ? 'bg-amber-600 w-10' : 'bg-white/60 hover:bg-white/80 w-3' }}"
                                    data-slide="{{ $index }}"></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>

            <!-- Banner Carousel Script -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const slides = document.querySelectorAll('.banner-slide');
                    const dots = document.querySelectorAll('.banner-dot');
                    const prevBtn = document.querySelector('.banner-prev');
                    const nextBtn = document.querySelector('.banner-next');
                    let currentSlide = 0;
                    let autoPlayInterval;
                    let isTransitioning = false;

                    function showSlide(index) {
                        if (isTransitioning) return;
                        isTransitioning = true;

                        slides.forEach(slide => {
                            slide.classList.remove('opacity-100', 'scale-100');
                            slide.classList.add('opacity-0', 'scale-105');
                        });

                        dots.forEach(dot => {
                            dot.classList.remove('bg-amber-600', 'w-10');
                            dot.classList.add('bg-white/60', 'w-3');
                        });

                        setTimeout(() => {
                            slides[index].classList.remove('opacity-0', 'scale-105');
                            slides[index].classList.add('opacity-100', 'scale-100');
                        }, 50);

                        if (dots[index]) {
                            dots[index].classList.remove('bg-white/60', 'w-3');
                            dots[index].classList.add('bg-amber-600', 'w-10');
                        }

                        currentSlide = index;
                        setTimeout(() => {
                            isTransitioning = false;
                        }, 1000);
                    }

                    function nextSlide() {
                        showSlide((currentSlide + 1) % slides.length);
                    }

                    function prevSlide() {
                        showSlide((currentSlide - 1 + slides.length) % slides.length);
                    }

                    function startAutoPlay() {
                        if (slides.length > 1) autoPlayInterval = setInterval(nextSlide, 6000);
                    }

                    function stopAutoPlay() {
                        clearInterval(autoPlayInterval);
                    }

                    if (nextBtn) nextBtn.addEventListener('click', () => {
                        stopAutoPlay();
                        nextSlide();
                        startAutoPlay();
                    });
                    if (prevBtn) prevBtn.addEventListener('click', () => {
                        stopAutoPlay();
                        prevSlide();
                        startAutoPlay();
                    });

                    dots.forEach((dot, index) => {
                        dot.addEventListener('click', () => {
                            stopAutoPlay();
                            showSlide(index);
                            startAutoPlay();
                        });
                    });

                    const carousel = document.querySelector('.banner-carousel');
                    if (carousel) {
                        carousel.addEventListener('mouseenter', stopAutoPlay);
                        carousel.addEventListener('mouseleave', startAutoPlay);
                    }

                    startAutoPlay();
                });
            </script>
        @else
            <!-- Default Hero Section -->
            <section class="relative h-screen flex items-center justify-center overflow-hidden">
                <div class="absolute inset-0 bg-cover bg-center"
                    style="background-image: url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=1600');">
                    <div class="hero-gradient coffee-pattern absolute inset-0"></div>
                </div>

                <div class="relative z-10 text-center text-white px-4 max-w-4xl mx-auto">
                    <h1 class="font-display text-6xl md:text-8xl font-bold mb-6 animate-fade-in">Kopi Koproll</h1>
                    <p class="text-xl md:text-2xl mb-8 text-stone-200 font-light">
                        Nikmati Perjalanan Rasa dari Setiap Biji Kopi Terpilih
                    </p>
                    <div class="flex gap-4 justify-center flex-wrap">
                        <a href="#menu"
                            class="bg-amber-600 hover:bg-amber-700 text-white px-8 py-4 rounded-full font-semibold transition-all transform hover:scale-105 shadow-xl">
                            Lihat Menu
                        </a>
                        <a href="#tentang"
                            class="bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white px-8 py-4 rounded-full font-semibold border-2 border-white/30 transition-all">
                            Tentang Kami
                        </a>
                    </div>
                </div>

                <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </section>
        @endif

        <!-- Owner Profile Section -->
        <section id="tentang" class="py-20 px-4 bg-gradient-to-br from-stone-50 to-amber-50/30">
            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-2 gap-12 items-center" id="contentGrid">
                    <div class="order-2 md:order-1">
                        <div class="inline-block px-4 py-2 bg-amber-100 rounded-full mb-4">
                            <span class="text-amber-800 text-sm font-semibold">TENTANG KAMI</span>
                        </div>
                        <h2 class="font-display text-4xl md:text-5xl font-bold text-stone-800 mb-6 leading-tight">
                            Cerita <span class="text-amber-600">Koproll</span>
                        </h2>
                        <div class="w-20 h-1 bg-gradient-to-r from-amber-600 to-amber-400 mb-8 rounded-full"></div>

                        <div class="space-y-4 text-gray-600 text-lg leading-relaxed">
                            <p class="border-l-4 border-amber-600 pl-4 bg-white/50 py-3 rounded-r-lg">
                                Koprol Coffee berdiri pada tahun 2020, didirikan oleh seorang pemuda bernama Ariosakti,
                                tepat di masa pandemi ketika kondisi serba tidak pasti dan ruang gerak sangat terbatas.
                            </p>

                            <div id="descriptionContent" class="hidden space-y-4">
                                <p class="leading-relaxed">
                                    Memulai usaha di tengah situasi tersebut bukanlah hal yang mudah. Keterbatasan
                                    aktivitas,
                                    perubahan kebiasaan masyarakat, serta tantangan operasional menjadi bagian dari
                                    perjalanan awal.
                                    Namun, justru dari kondisi inilah muncul tekad kuat untuk bertahan dan berkembang.
                                </p>
                                <p class="bg-amber-50 p-4 rounded-lg border-l-4 border-amber-600">
                                    <strong class="text-amber-900">Filosofi Koproll:</strong>
                                    "Datang sebagai customer, pulang sebagai teman" - menciptakan ruang untuk obrolan santai
                                    dan cerita-cerita kecil yang terjalin tanpa jarak.
                                </p>
                                <p class="leading-relaxed">
                                    Koprol Coffee pertama kali dibuka di Jalan Bangunan Barat, sebuah lokasi sederhana yang
                                    menjadi
                                    saksi awal tumbuhnya kedai ini. Di tempat inilah Koprol Coffee mulai membangun
                                    identitasnya,
                                    bukan hanya melalui kopi yang disajikan, tetapi juga melalui interaksi dengan setiap
                                    pelanggan.
                                </p>
                                <p class="leading-relaxed">
                                    Dalam kurun waktu 2020 hingga 2022, kami menjalani berbagai tahap eksplorasi dan
                                    penyempurnaan.
                                    Setiap percobaan menjadi pembelajaran penting dalam membentuk identitas rasa Koprol
                                    Coffee.
                                </p>
                                <div
                                    class="bg-gradient-to-r from-amber-50 to-orange-50 p-6 rounded-xl border border-amber-200">
                                    <h4 class="font-bold text-amber-900 mb-3 flex items-center gap-2">
                                        <span class="text-2xl">☕</span>
                                        Menu Andalan: Kopsus Koprol
                                    </h4>
                                    <p class="text-gray-700 leading-relaxed">
                                        Kopi susu khas yang diracik menggunakan espresso pilihan, creamer, gula aren, fresh
                                        milk,
                                        disajikan dengan es batu dan sentuhan chocolate untuk menciptakan rasa yang seimbang
                                        dan mudah dinikmati berbagai kalangan.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <button id="toggleBtn" onclick="toggleDescription()"
                            class="group mt-8 px-8 py-3 bg-gradient-to-r from-amber-600 to-amber-700 text-white font-semibold rounded-full hover:from-amber-700 hover:to-amber-800 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center gap-2">
                            <span>Baca Selengkapnya</span>
                            <svg class="w-5 h-5 transition-transform group-hover:translate-y-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>

                    <div class="order-1 md:order-2">
                        <div class="relative group">
                            <div
                                class="absolute bg-gradient-to-br from-amber-200 to-amber-300 rounded-2xl transform rotate-3 w-full h-full transition-transform group-hover:rotate-6">
                            </div>
                            <div
                                class="absolute bg-gradient-to-tl from-stone-700 to-stone-600 rounded-2xl transform -rotate-3 w-full h-full transition-transform group-hover:-rotate-6 opacity-20">
                            </div>
                            <img src="{{ asset('images/koproll-logo.png') }}" alt="Koproll Logo"
                                class="relative rounded-2xl shadow-2xl w-full object-cover aspect-square transform transition-all duration-500 group-hover:scale-[1.02] border-4 border-white">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            function toggleDescription() {
                const content = document.getElementById('descriptionContent');
                const btn = document.getElementById('toggleBtn');
                const grid = document.getElementById('contentGrid');

                content.classList.toggle('hidden');

                if (content.classList.contains('hidden')) {
                    btn.innerHTML =
                        '<span>Baca Selengkapnya</span><svg class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>';
                    grid.classList.remove('md:items-start');
                    grid.classList.add('md:items-center');
                } else {
                    btn.innerHTML =
                        '<span>Sembunyikan</span><svg class="w-5 h-5 transition-transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>';
                    grid.classList.remove('md:items-center');
                    grid.classList.add('md:items-start');
                }
            }
        </script>

        <!-- Promo Section -->
        <section class="py-20 px-4 bg-gradient-to-br from-amber-50 via-white to-orange-50 relative overflow-hidden">
            <div
                class="absolute top-0 left-0 w-72 h-72 bg-amber-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob">
            </div>
            <div
                class="absolute top-0 right-0 w-72 h-72 bg-orange-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute bottom-0 left-1/2 w-72 h-72 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-4000">
            </div>

            <div class="max-w-4xl mx-auto relative z-10">
                <div class="text-center mb-12">
                    <div
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-orange-600 text-white px-6 py-2 rounded-full mb-4 shadow-lg animate-bounce-slow">
                        <span class="text-2xl">🎁</span>
                        <span class="font-bold text-sm tracking-wider">PROMO SPESIAL</span>
                        <span class="text-2xl">🎁</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-3">
                        Penawaran <span class="text-amber-600">Terbatas!</span>
                    </h2>
                    <p class="text-gray-600 text-lg mb-8">Jangan lewatkan kesempatan emas untuk menikmati promo menarik
                        kami</p>
                </div>

                <div class="text-center">
                    <a href="{{ route('promo.index') }}"
                        class="group inline-flex items-center gap-4 bg-gradient-to-r from-amber-600 via-orange-600 to-amber-600 text-white font-bold px-12 py-5 rounded-2xl text-lg shadow-2xl hover:shadow-amber-500/50 transition-all duration-300 transform hover:scale-110 hover:-translate-y-1 relative overflow-hidden">
                        <span
                            class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
                        <span class="relative flex items-center gap-2">
                            <span class="text-2xl">🎯</span>
                            <span>Claim Promo</span>
                        </span>
                        <svg class="w-6 h-6 transition-transform group-hover:translate-x-2" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <p class="text-gray-500 text-sm mt-4">*Syarat dan ketentuan berlaku</p>
                </div>
            </div>
        </section>

        <style>
            @keyframes blob {

                0%,
                100% {
                    transform: translate(0, 0) scale(1);
                }

                33% {
                    transform: translate(30px, -50px) scale(1.1);
                }

                66% {
                    transform: translate(-20px, 20px) scale(0.9);
                }
            }

            .animate-blob {
                animation: blob 7s infinite;
            }

            .animation-delay-2000 {
                animation-delay: 2s;
            }

            .animation-delay-4000 {
                animation-delay: 4s;
            }

            @keyframes bounce-slow {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-10px);
                }
            }

            .animate-bounce-slow {
                animation: bounce-slow 2s infinite;
            }
        </style>

        <!-- Menu Section -->
        <section id="menu" class="py-20 px-4 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <div class="inline-block px-4 py-2 bg-amber-100 rounded-full mb-4">
                        <span class="text-amber-800 text-sm font-semibold">MENU KAMI</span>
                    </div>
                    <h2 class="font-display text-4xl md:text-5xl font-bold text-stone-800 mb-4">
                        Menu <span class="text-amber-600">Spesial</span>
                    </h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-amber-600 to-amber-400 mx-auto mb-6 rounded-full"></div>
                    <p class="text-stone-600 text-lg max-w-2xl mx-auto">
                        Setiap menu dirancang dengan hati-hati untuk memberikan pengalaman rasa yang tak terlupakan
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="menuGrid">
                    @forelse($products as $index => $product)
                        <div
                            class="menu-item {{ $index >= 3 ? 'hidden' : '' }} bg-gradient-to-br from-stone-50 to-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 group border border-stone-100">
                            <div class="relative h-56 bg-cover bg-center overflow-hidden"
                                style="background-image: url('{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=600' }}');">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-stone-900/80 to-transparent group-hover:from-amber-900/80 transition-all duration-500">
                                </div>

                                @if ($product->stock > 0 && $product->stock <= 10)
                                    <div
                                        class="absolute top-4 right-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg animate-pulse">
                                        Stok Terbatas!
                                    </div>
                                @elseif ($product->stock == 0)
                                    <div
                                        class="absolute top-4 right-4 bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                        Habis
                                    </div>
                                @endif

                                @if ($index === 0)
                                    <div
                                        class="absolute top-4 left-4 bg-amber-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                        BEST SELLER
                                    </div>
                                @endif
                            </div>

                            <div class="p-6">
                                <h3
                                    class="font-display text-2xl font-bold text-stone-800 mb-2 group-hover:text-amber-700 transition-colors">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-stone-600 mb-4 line-clamp-2 leading-relaxed">
                                    {{ $product->description ?? 'Nikmati kelezatan kopi pilihan kami dengan cita rasa yang khas' }}
                                </p>
                                <div class="flex justify-between items-center pt-4 border-t border-stone-100">
                                    <span class="text-amber-700 font-bold text-xl">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    <span
                                        class="px-3 py-1 rounded-full text-sm font-semibold {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $product->stock > 0 ? 'Tersedia' : 'Habis' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-16">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <div
                                    class="w-24 h-24 bg-gradient-to-br from-amber-100 to-stone-100 rounded-full flex items-center justify-center mb-6">
                                    <span class="text-4xl">☕</span>
                                </div>
                                <p class="text-xl font-semibold mb-2 text-stone-700">Menu sedang disiapkan</p>
                                <p class="text-sm text-stone-500">Mohon tunggu, kami sedang memperbarui menu kami</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if ($products->count() > 3)
                    <div class="text-center mt-12">
                        <button id="viewAllBtn"
                            class="group bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white font-semibold px-10 py-4 rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl inline-flex items-center gap-2">
                            <span>Lihat Semua Menu</span>
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

            <script>
                const viewAllBtn = document.getElementById('viewAllBtn');
                if (viewAllBtn) {
                    viewAllBtn.addEventListener('click', function() {
                        const hiddenItems = document.querySelectorAll('.menu-item.hidden');
                        const btn = this;

                        if (hiddenItems.length > 0) {
                            hiddenItems.forEach(item => item.classList.remove('hidden'));
                            btn.innerHTML =
                                '<span>Tampilkan Lebih Sedikit</span><svg class="w-5 h-5 transition-transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>';
                        } else {
                            const allItems = document.querySelectorAll('.menu-item');
                            for (let i = 3; i < allItems.length; i++) {
                                allItems[i].classList.add('hidden');
                            }
                            btn.innerHTML =
                                '<span>Lihat Semua Menu</span><svg class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>';
                            document.getElementById('menu').scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    });
                }
            </script>
        </section>

        <!-- History Section -->
        <section id="sejarah"
            class="py-20 px-4 bg-gradient-to-br from-stone-800 via-stone-900 to-stone-800 text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-10 w-64 h-64 bg-amber-500 rounded-full filter blur-3xl"></div>
                <div class="absolute bottom-20 right-10 w-64 h-64 bg-orange-500 rounded-full filter blur-3xl"></div>
            </div>

            <div class="max-w-6xl mx-auto relative z-10">
                <div class="text-center mb-16">
                    <span class="text-amber-400 font-semibold text-sm tracking-wider uppercase mb-3 block">Our
                        Journey</span>
                    <h2 class="font-display text-4xl md:text-5xl font-bold mb-4">
                        Perjalanan <span class="text-amber-400">Kami</span>
                    </h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-amber-600 to-amber-400 mx-auto mb-6"></div>
                    <p class="text-stone-300 text-lg max-w-2xl mx-auto">
                        Dari kios kecil hingga menjadi destinasi favorit para pecinta kopi
                    </p>
                </div>

                <div class="space-y-12">
                    <!-- 2020 -->
                    <div class="flex flex-col md:flex-row gap-8 items-center">
                        <div class="md:w-1/4">
                            <div
                                class="bg-gradient-to-br from-amber-600 to-amber-700 rounded-2xl w-32 h-32 flex items-center justify-center mx-auto shadow-xl">
                                <span class="font-display text-4xl font-bold">2020</span>
                            </div>
                        </div>
                        <div
                            class="md:w-3/4 bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/20 hover:bg-white/15 transition duration-300">
                            <h3 class="font-display text-2xl font-bold mb-3 text-amber-400 flex items-center gap-2">
                                <span>🌱</span> Awal Mula
                            </h3>
                            <p class="text-stone-200 leading-relaxed">
                                Dimulai dari sebuah kios kecil di Jalan Bangunan Barat dengan satu mesin espresso dan
                                passion yang besar.
                                Di masa pandemi, kami bertekad untuk menghadirkan secangkir kopi yang hangat dan menghibur.
                            </p>
                        </div>
                    </div>

                    <!-- 2021 -->
                    <div class="flex flex-col md:flex-row-reverse gap-8 items-center">
                        <div class="md:w-1/4">
                            <div
                                class="bg-gradient-to-br from-amber-600 to-amber-700 rounded-2xl w-32 h-32 flex items-center justify-center mx-auto shadow-xl">
                                <span class="font-display text-4xl font-bold">2021</span>
                            </div>
                        </div>
                        <div
                            class="md:w-3/4 bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/20 hover:bg-white/15 transition duration-300">
                            <h3 class="font-display text-2xl font-bold mb-3 text-amber-400 flex items-center gap-2">
                                <span>🔬</span> Eksplorasi Rasa
                            </h3>
                            <p class="text-stone-200 leading-relaxed">
                                Menjalani proses eksplorasi intensif untuk menemukan signature blend kami.
                                Berbagai percobaan dilakukan untuk menciptakan Kopsus Koprol yang kini menjadi menu andalan.
                            </p>
                        </div>
                    </div>

                    <!-- 2023 -->
                    <div class="flex flex-col md:flex-row gap-8 items-center">
                        <div class="md:w-1/4">
                            <div
                                class="bg-gradient-to-br from-amber-600 to-amber-700 rounded-2xl w-32 h-32 flex items-center justify-center mx-auto shadow-xl">
                                <span class="font-display text-4xl font-bold">2023</span>
                            </div>
                        </div>
                        <div
                            class="md:w-3/4 bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/20 hover:bg-white/15 transition duration-300">
                            <h3 class="font-display text-2xl font-bold mb-3 text-amber-400 flex items-center gap-2">
                                <span>📈</span> Berkembang Pesat
                            </h3>
                            <p class="text-stone-200 leading-relaxed">
                                Komunitas pelanggan setia mulai terbentuk. Filosofi "Datang sebagai customer, pulang sebagai
                                teman"
                                semakin mengakar dan menjadi DNA Koprol Coffee.
                            </p>
                        </div>
                    </div>

                    <!-- 2025 -->
                    <div class="flex flex-col md:flex-row-reverse gap-8 items-center">
                        <div class="md:w-1/4">
                            <div
                                class="bg-gradient-to-br from-amber-600 to-amber-700 rounded-2xl w-32 h-32 flex items-center justify-center mx-auto shadow-xl">
                                <span class="font-display text-4xl font-bold">2025</span>
                            </div>
                        </div>
                        <div
                            class="md:w-3/4 bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/20 hover:bg-white/15 transition duration-300">
                            <h3 class="font-display text-2xl font-bold mb-3 text-amber-400 flex items-center gap-2">
                                <span>🏆</span> Masa Kini
                            </h3>
                            <p class="text-stone-200 leading-relaxed">
                                Kini Koprol Coffee telah menjadi destinasi favorit para pecinta kopi.
                                Dengan identitas yang semakin matang, kami terus berkomitmen menghadirkan pengalaman terbaik
                                untuk setiap pelanggan.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl text-center border border-white/20">
                        <div class="text-3xl font-bold text-amber-400 mb-2">5+</div>
                        <div class="text-sm text-stone-300">Tahun Berdiri</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl text-center border border-white/20">
                        <div class="text-3xl font-bold text-amber-400 mb-2">10K+</div>
                        <div class="text-sm text-stone-300">Pelanggan Setia</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl text-center border border-white/20">
                        <div class="text-3xl font-bold text-amber-400 mb-2">20+</div>
                        <div class="text-sm text-stone-300">Varian Menu</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl text-center border border-white/20">
                        <div class="text-3xl font-bold text-amber-400 mb-2">4.9</div>
                        <div class="text-sm text-stone-300">Rating</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Reviews Section -->
        <section class="py-20 px-4 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="font-display text-4xl md:text-5xl font-bold text-stone-800 mb-4">
                        What They Say
                    </h2>
                    <div class="w-20 h-1 bg-amber-600 mx-auto mb-6"></div>
                    <p class="text-stone-600 text-lg max-w-2xl mx-auto">
                        Real stories from our community who love the vibe and our craft
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Review 1 -->
                    <div class="bg-stone-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                        <div class="flex items-center mb-4">
                            <img src="https://i.pravatar.cc/100?img=1" alt="Reviewer"
                                class="w-16 h-16 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold text-stone-800">Fadel Abdul</h4>
                                <p class="text-sm text-stone-500">Content Creator</p>
                            </div>
                        </div>
                        <div class="text-amber-500 mb-3">★★★★★</div>
                        <p class="text-stone-600 italic">
                            "The vibes here are immaculate! Matcha latte-nya creamy, aesthetic banget buat foto. Plus
                            tempatnya cozy, perfect untuk ngerjain konten."
                        </p>
                    </div>

                    <!-- Review 2 -->
                    <div class="bg-stone-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                        <div class="flex items-center mb-4">
                            <img src="https://i.pravatar.cc/100?img=33" alt="Reviewer"
                                class="w-16 h-16 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold text-stone-800">Chang Hendra</h4>
                                <p class="text-sm text-stone-500">Coffee Enthusiast</p>
                            </div>
                        </div>
                        <div class="text-amber-500 mb-3">★★★★★</div>
                        <p class="text-stone-600 italic">
                            "Flat white-nya consistently good! Biji kopinya berkualitas, brewing method juga on point.
                            Tempatnya chill buat hang out atau work from café."
                        </p>
                    </div>

                    <!-- Review 3 -->
                    <div class="bg-stone-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                        <div class="flex items-center mb-4">
                            <img src="https://i.pravatar.cc/100?img=5" alt="Reviewer"
                                class="w-16 h-16 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold text-stone-800">Ady Nugrah</h4>
                                <p class="text-sm text-stone-500">Freelance Designer</p>
                            </div>
                        </div>
                        <div class="text-amber-500 mb-3">★★★★★</div>
                        <p class="text-stone-600 italic">
                            "Love the minimalist interior! Taro smoothie bowl-nya enak, cocok buat brunch. WiFi kenceng,
                            musik playlist-nya juga curated banget."
                        </p>
                    </div>

                    <!-- Review 4 -->
                    <div class="bg-stone-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                        <div class="flex items-center mb-4">
                            <img src="https://i.pravatar.cc/100?img=12" alt="Reviewer"
                                class="w-16 h-16 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold text-stone-800">Raffah Rizz</h4>
                                <p class="text-sm text-stone-500">Startup Founder</p>
                            </div>
                        </div>
                        <div class="text-amber-500 mb-3">★★★★★</div>
                        <p class="text-stone-600 italic">
                            "My go-to spot untuk client meetings! Ambience-nya professional tapi tetep casual. Signature
                            blend espresso-nya strong, bikin produktif!"
                        </p>
                    </div>

                    <!-- Review 5 -->
                    <div class="bg-stone-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                        <div class="flex items-center mb-4">
                            <img src="https://i.pravatar.cc/100?img=45" alt="Reviewer"
                                class="w-16 h-16 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold text-stone-800">Fery Klaten</h4>
                                <p class="text-sm text-stone-500">Social Media Manager</p>
                            </div>
                        </div>
                        <div class="text-amber-500 mb-3">★★★★★</div>
                        <p class="text-stone-600 italic">
                            "Instagrammable corner everywhere! Brown sugar boba milk tea-nya addictive. Staffnya friendly,
                            vibe-nya homey. Definitely coming back!"
                        </p>
                    </div>

                    <!-- Review 6 -->
                    <div class="bg-stone-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                        <div class="flex items-center mb-4">
                            <img src="https://i.pravatar.cc/100?img=68" alt="Reviewer"
                                class="w-16 h-16 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold text-stone-800">Alki Majelis</h4>
                                <p class="text-sm text-stone-500">Digital Marketer</p>
                            </div>
                        </div>
                        <div class="text-amber-500 mb-3">★★★★★</div>
                        <p class="text-stone-600 italic">
                            "Perfect escape dari rutinitas! Iced lemon tea-nya refreshing, croffle-nya crispy. Seating
                            area-nya spacious, bisa lama-lama di sini."
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer -->
        <footer class="bg-stone-900 text-white py-16 px-4">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-4 gap-12 mb-12">
                    <!-- Brand -->
                    <div class="md:col-span-2">
                        <h3 class="font-display text-3xl font-bold mb-4 text-amber-400">Kopi Koproll</h3>
                        <p class="text-stone-400 mb-6 leading-relaxed">
                            Menghadirkan pengalaman kopi terbaik dengan sentuhan personal.
                            Setiap cangkir adalah hasil dari dedikasi dan passion kami terhadap kopi berkualitas.
                        </p>
                        <div class="flex gap-4">
                            <a href="#"
                                class="w-10 h-10 bg-amber-600 hover:bg-amber-700 rounded-full flex items-center justify-center transition-all transform hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-amber-600 hover:bg-amber-700 rounded-full flex items-center justify-center transition-all transform hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-amber-600 hover:bg-amber-700 rounded-full flex items-center justify-center transition-all transform hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="font-display text-lg font-semibold mb-4">Tautan Cepat</h4>
                        <ul class="space-y-3">
                            <li><a href="#tentang" class="text-stone-400 hover:text-amber-500 transition-colors">Tentang
                                    Kami</a></li>
                            <li><a href="#menu" class="text-stone-400 hover:text-amber-500 transition-colors">Menu</a>
                            </li>
                            <li><a href="#sejarah"
                                    class="text-stone-400 hover:text-amber-500 transition-colors">Sejarah</a></li>
                            <li><a href="{{ route('promo.index') }}"
                                    class="text-stone-400 hover:text-amber-500 transition-colors">Promo</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h4 class="font-display text-lg font-semibold mb-4">Hubungi Kami</h4>
                        <ul class="space-y-3 text-stone-400">
                            <li class="flex items-start gap-2">
                                <span>📍</span>
                                <span>Jl. Bangunan Barat<br>Jakarta Selatan, 12345</span>
                            </li>
                            <li class="pt-2">
                                <a href="tel:+6281234567890"
                                    class="hover:text-amber-500 transition-colors flex items-center gap-2">
                                    <span>📞</span> +62 812-3456-7890
                                </a>
                            </li>
                            <li>
                                <a href="mailto:info@kopikoproll.com"
                                    class="hover:text-amber-500 transition-colors flex items-center gap-2">
                                    <span>✉️</span> info@kopikoproll.com
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Bottom Bar -->
                <div class="border-t border-stone-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-stone-400 text-sm">
                        &copy; 2025 Kopi Koproll. All rights reserved.
                    </p>
                    <div class="flex gap-6 text-sm">
                        <a href="#" class="text-stone-400 hover:text-amber-500 transition-colors">Privacy Policy</a>
                        <a href="#" class="text-stone-400 hover:text-amber-500 transition-colors">Terms of
                            Service</a>
                    </div>
                </div>
            </div>
        </footer>
    @endsection
</body>
