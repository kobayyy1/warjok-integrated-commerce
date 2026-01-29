@extends('layouts.pages')

<head>
    @section('head')
    @endsection
    @include('ropang.style')
</head>

<body class="bg-gray-50 text-gray-900">
    @section('body')
        <!-- Back to Home Button - Fixed Position -->
        <div class="fixed top-4 left-4 z-50">
            <a href="{{ route('home') }}"
                class="group flex items-center gap-2 bg-white/95 backdrop-blur-sm hover:bg-purple-600 text-stone-800 hover:text-white px-5 py-3 rounded-full font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 border border-stone-200">
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        <!-- Banner Carousel Section - Only show if banners exist -->
        @if ($banners && $banners->count() > 0)
            <section class="relative w-full overflow-hidden border-b-8 border-purple-600 shadow-2xl">
                <!-- Decorative top border -->
                <div
                    class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-purple-600 via-indigo-500 to-purple-600 z-30">
                </div>

                <!-- Corner decorations -->
                <div class="absolute top-0 left-0 w-32 h-32 border-t-4 border-l-4 border-purple-500 z-20 opacity-50"></div>
                <div class="absolute top-0 right-0 w-32 h-32 border-t-4 border-r-4 border-purple-500 z-20 opacity-50"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 border-b-4 border-l-4 border-purple-500 z-20 opacity-50">
                </div>
                <div class="absolute bottom-0 right-0 w-32 h-32 border-b-4 border-r-4 border-purple-500 z-20 opacity-50">
                </div>

                <div class="banner-carousel relative h-[500px] md:h-[650px]">
                    @foreach ($banners as $index => $banner)
                        <div class="banner-slide absolute inset-0 transition-all duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 scale-100' : 'opacity-0 scale-105' }}"
                            data-slide="{{ $index }}">
                            <!-- Decorative frame inside -->
                            <div
                                class="absolute inset-4 md:inset-8 border-2 border-purple-400/30 rounded-lg z-10 pointer-events-none">
                                <!-- Animated corner accents -->
                                <div
                                    class="absolute -top-2 -left-2 w-8 h-8 border-t-4 border-l-4 border-purple-500 rounded-tl-lg">
                                </div>
                                <div
                                    class="absolute -top-2 -right-2 w-8 h-8 border-t-4 border-r-4 border-purple-500 rounded-tr-lg">
                                </div>
                                <div
                                    class="absolute -bottom-2 -left-2 w-8 h-8 border-b-4 border-l-4 border-purple-500 rounded-bl-lg">
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 w-8 h-8 border-b-4 border-r-4 border-purple-500 rounded-br-lg">
                                </div>
                            </div>

                            <!-- Banner Image with Parallax Effect -->
                            <div class="absolute inset-0 transform transition-transform duration-700">
                                <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}"
                                    class="w-full h-full object-cover" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-stone-900/80 via-purple-900/60 to-transparent">
                                </div>
                                <!-- Vignette effect -->
                                <div class="absolute inset-0 shadow-inner-strong"></div>
                            </div>

                            <!-- Banner Content with Enhanced Animation -->
                            <div class="relative z-10 h-full flex items-center">
                                <div class="container mx-auto px-6 md:px-12">
                                    <div class="max-w-3xl relative">
                                        <!-- Decorative line accent -->
                                        <div
                                            class="absolute -left-6 top-0 bottom-0 w-1 bg-gradient-to-b from-transparent via-purple-500 to-transparent">
                                        </div>

                                        <div
                                            class="mb-4 inline-flex items-center gap-2 px-5 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 backdrop-blur-sm rounded-full shadow-lg border border-purple-400/30">
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
                                                class="group inline-flex items-center gap-3 bg-purple-600 hover:bg-indigo-600 text-white font-bold px-10 py-4 rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-2xl animate-slide-in-left-delay-2">
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

                    <!-- Navigation Arrows (if more than 1 banner) -->
                    @if ($banners->count() > 1)
                        <button
                            class="banner-nav banner-prev absolute left-6 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-purple-600 backdrop-blur-md text-white p-4 rounded-full transition-all duration-300 hover:scale-110 group">
                            <i class="fas fa-chevron-left text-2xl transition-transform group-hover:-translate-x-1"></i>
                        </button>
                        <button
                            class="banner-nav banner-next absolute right-6 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-purple-600 backdrop-blur-md text-white p-4 rounded-full transition-all duration-300 hover:scale-110 group">
                            <i class="fas fa-chevron-right text-2xl transition-transform group-hover:translate-x-1"></i>
                        </button>

                        <!-- Enhanced Dots Indicator -->
                        <div
                            class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-3 bg-black/20 backdrop-blur-md px-6 py-3 rounded-full">
                            @foreach ($banners as $index => $banner)
                                <button
                                    class="banner-dot h-3 rounded-full transition-all duration-300 hover:scale-110 {{ $index === 0 ? 'bg-purple-600 w-10' : 'bg-white/60 hover:bg-white/80 w-3' }}"
                                    data-slide="{{ $index }}">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>

            <!-- Banner Carousel Script with Smooth Transitions -->
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
                            dot.classList.remove('bg-purple-600', 'w-10');
                            dot.classList.add('bg-white/60', 'w-3');
                        });

                        setTimeout(() => {
                            slides[index].classList.remove('opacity-0', 'scale-105');
                            slides[index].classList.add('opacity-100', 'scale-100');
                        }, 50);

                        if (dots[index]) {
                            dots[index].classList.remove('bg-white/60', 'w-3');
                            dots[index].classList.add('bg-purple-600', 'w-10');
                        }

                        currentSlide = index;

                        setTimeout(() => {
                            isTransitioning = false;
                        }, 1000);
                    }

                    function nextSlide() {
                        const next = (currentSlide + 1) % slides.length;
                        showSlide(next);
                    }

                    function prevSlide() {
                        const prev = (currentSlide - 1 + slides.length) % slides.length;
                        showSlide(prev);
                    }

                    function startAutoPlay() {
                        if (slides.length > 1) {
                            autoPlayInterval = setInterval(nextSlide, 6000);
                        }
                    }

                    function stopAutoPlay() {
                        clearInterval(autoPlayInterval);
                    }

                    if (nextBtn) {
                        nextBtn.addEventListener('click', () => {
                            stopAutoPlay();
                            nextSlide();
                            startAutoPlay();
                        });
                    }

                    if (prevBtn) {
                        prevBtn.addEventListener('click', () => {
                            stopAutoPlay();
                            prevSlide();
                            startAutoPlay();
                        });
                    }

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

            <!-- Promo Headline - Placed after banner -->
            <div
                class="bg-gradient-to-r from-purple-600 via-indigo-500 to-purple-600 text-white py-4 px-4 text-center shadow-lg">
                <div class="max-w-7xl mx-auto flex items-center justify-center gap-3">
                    <span class="text-2xl">🔥</span>
                    <p class="text-sm md:text-base font-semibold">
                        Kuliner Jalanan Legendaris Sejak 2010 | Buka Setiap Hari 18:00 - 23:00 WIB
                    </p>
                </div>
            </div>
        @else
            <!-- Hero Section (Default when no banners) -->
            <section class="hero-pattern relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-900/30 to-indigo-900/30"></div>
                <div class="relative max-w-7xl mx-auto px-4 py-32 sm:py-40">
                    <div class="text-center">
                        <div class="inline-block mb-6">
                            <span
                                class="bg-purple-500/20 text-purple-300 px-6 py-2 rounded-full text-sm font-semibold backdrop-blur-sm border border-purple-500/30">
                                🔥 Kuliner Jalanan Legendaris Sejak 2010
                            </span>
                        </div>
                        <h1 class="text-6xl sm:text-7xl md:text-8xl font-bold text-white mb-6 tracking-tight">
                            Ropang<br>
                            <span
                                class="bg-gradient-to-r from-purple-400 via-pink-400 to-indigo-400 bg-clip-text text-transparent">
                                Ancur
                            </span>
                        </h1>
                        <p class="text-xl sm:text-2xl text-gray-300 mb-10 max-w-3xl mx-auto leading-relaxed">
                            Sensasi pedas yang bikin nagih! Roti bakar dengan topping melimpah dan sambal khas yang ancur
                            banget
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <a href="#menu"
                                class="group bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-10 py-4 rounded-xl font-semibold text-lg hover:shadow-2xl hover:shadow-purple-500/50 transition-all duration-300 transform hover:-translate-y-1">
                                Lihat Menu
                                <span class="inline-block ml-2 group-hover:translate-x-1 transition-transform">→</span>
                            </a>
                            <a href="#tentang"
                                class="bg-white/10 backdrop-blur-sm text-white px-10 py-4 rounded-xl font-semibold text-lg border-2 border-white/20 hover:bg-white/20 transition-all duration-300">
                                Tentang Kami
                            </a>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0">
                    <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
                            fill="#f9fafb" />
                    </svg>
                </div>
            </section>
        @endif

        <!-- PROMO SECTION - NEW ADDITION -->
        <section class="py-20 px-4 bg-gradient-to-br from-purple-50 via-white to-indigo-50 relative overflow-hidden">
            <!-- Decorative background elements -->
            <div
                class="absolute top-0 left-0 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob">
            </div>
            <div
                class="absolute top-0 right-0 w-72 h-72 bg-indigo-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute bottom-0 left-1/2 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-4000">
            </div>

            <div class="max-w-4xl mx-auto relative z-10">
                <!-- Section Header -->
                <div class="text-center mb-12">
                    <div
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-red-500 to-orange-500 text-white px-6 py-2 rounded-full mb-4 shadow-lg animate-bounce-slow">
                        <span class="text-2xl">🎁</span>
                        <span class="font-bold text-sm tracking-wider">PROMO SPESIAL</span>
                        <span class="text-2xl">🎁</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-3">
                        Penawaran <span class="gradient-text">Terbatas!</span>
                    </h2>
                    <p class="text-gray-600 text-lg mb-8">Jangan lewatkan kesempatan emas untuk menikmati promo menarik kami
                    </p>
                </div>

                <!-- CTA Button -->
                <div class="text-center">
                    <a href="{{ route('promo.index') }}"
                        class="group inline-flex items-center gap-4 bg-gradient-to-r from-purple-600 via-indigo-600 to-purple-600 text-white font-bold px-12 py-5 rounded-2xl text-lg shadow-2xl hover:shadow-purple-500/50 transition-all duration-300 transform hover:scale-110 hover:-translate-y-1 relative overflow-hidden">
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

        <!-- Add animation styles -->
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

        <!-- Tentang Kami / Deskripsi -->
        <section id="tentang" class="py-24 px-4 bg-gray-50">
            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="inline-block mb-4">
                            <span class="text-purple-600 font-semibold text-sm tracking-wider uppercase">Tentang
                                Kami</span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                            Lebih Dari Sekadar
                            <span class="gradient-text"> Roti Bakar</span>
                        </h2>
                        <div class="space-y-4 text-gray-600 text-lg leading-relaxed">
                            <p>
                                <strong class="text-gray-900">Ropang Ancur</strong> adalah destinasi kuliner yang
                                menghadirkan konsep roti bakar modern dengan sentuhan jalanan yang autentik. Kami memadukan
                                inovasi dengan cita rasa tradisional yang khas.
                            </p>
                            <p>
                                Setiap produk kami dibuat fresh on order dengan bahan-bahan premium dan sambal spesial yang
                                menjadi signature kami. "Ancur" bukan berarti rusak, tapi ancur dalam artian <strong
                                    class="text-gray-900">enak banget sampai bikin ketagihan!</strong>
                            </p>
                            <p>
                                Kami percaya bahwa makanan jalanan bisa disajikan dengan kualitas premium dan pengalaman
                                yang memorable. Dari pelanggan pertama hingga sekarang, kepuasan Anda adalah motivasi
                                terbesar kami.
                            </p>
                        </div>
                        <div class="mt-8 grid grid-cols-3 gap-6">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-purple-600 mb-1">15+</div>
                                <div class="text-sm text-gray-600">Tahun Berdiri</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-purple-600 mb-1">50K+</div>
                                <div class="text-sm text-gray-600">Pelanggan Setia</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-purple-600 mb-1">25+</div>
                                <div class="text-sm text-gray-600">Varian Menu</div>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <div
                            class="aspect-square bg-gray-200 rounded-3xl flex items-center justify-center relative overflow-hidden shadow-2xl">
                            <img src="{{ asset('ROPANG/lopang.jpeg') }}" alt="Roti Bakar Ropang Ancur"
                                class="w-full h-full object-cover rounded-3xl">
                        </div>
                        <div
                            class="absolute -bottom-6 -right-6 bg-gradient-to-br from-purple-600 to-indigo-600 text-white p-6 rounded-2xl shadow-xl">
                            <div class="text-sm font-semibold mb-1">Rating Pelanggan</div>
                            <div class="flex items-center gap-2">
                                <span class="text-3xl font-bold">4.9</span>
                                <span class="text-2xl">⭐</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- List Menu -->
        <section id="menu" class="py-24 px-4 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <span class="text-purple-600 font-semibold text-sm tracking-wider uppercase mb-3 block">Menu
                        Kami</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        Menu <span class="gradient-text">Favorit</span>
                    </h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-purple-600 to-indigo-600 mx-auto mb-6"></div>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                        Pilihan menu yang siap memanjakan selera Anda dengan cita rasa yang tak terlupakan
                    </p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8" id="menuGrid">
                    @forelse($products as $index => $product)
                        <div
                            class="menu-item {{ $index >= 3 ? 'hidden' : '' }} bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-200">
                            <div class="h-56 bg-cover bg-center"
                                style="background-image: url('{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=600' }}');">
                            </div>
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h3>
                                    @if ($index === 0)
                                        <span class="bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-full">BEST
                                            SELLER</span>
                                    @elseif($index === 1)
                                        <span
                                            class="bg-purple-100 text-purple-600 text-xs font-bold px-3 py-1 rounded-full">POPULER</span>
                                    @elseif($index === 2)
                                        <span
                                            class="bg-green-100 text-green-600 text-xs font-bold px-3 py-1 rounded-full">NEW</span>
                                    @endif
                                </div>
                                <p class="text-gray-600 mb-4 leading-relaxed">
                                    {{ $product->description ?? 'Nikmati kelezatan roti bakar pilihan kami dengan topping istimewa' }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-sm {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $product->stock > 0 ? 'Tersedia' : 'Habis' }}
                                    </span>
                                </div>
                                @if ($product->stock > 0 && $product->stock <= 10)
                                    <div class="mt-2">
                                        <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">
                                            Stok terbatas
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <div class="text-6xl mb-4">🍞</div>
                                <p class="text-lg font-semibold mb-2">Menu sedang disiapkan</p>
                                <p class="text-sm">Mohon tunggu, kami sedang memperbarui menu kami</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if ($products->count() > 3)
                    <div class="text-center mt-12">
                        <button id="viewAllBtn"
                            class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold px-12 py-4 rounded-xl text-lg hover:shadow-2xl hover:shadow-purple-500/50 transition-all duration-300 transform hover:-translate-y-1">
                            Lihat Menu Lengkap
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
                            hiddenItems.forEach(item => {
                                item.classList.remove('hidden');
                            });
                            btn.textContent = 'Tampilkan Lebih Sedikit';
                        } else {
                            const allItems = document.querySelectorAll('.menu-item');
                            for (let i = 3; i < allItems.length; i++) {
                                allItems[i].classList.add('hidden');
                            }
                            btn.textContent = 'Lihat Menu Lengkap';

                            document.getElementById('menu').scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    });
                }
            </script>
        </section>

        <!-- Sejarah -->
        <section id="sejarah"
            class="py-20 px-4 bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900 text-white relative overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-10 w-64 h-64 bg-purple-500 rounded-full filter blur-3xl"></div>
                <div class="absolute bottom-20 right-10 w-64 h-64 bg-indigo-500 rounded-full filter blur-3xl"></div>
            </div>

            <div class="max-w-6xl mx-auto relative z-10">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <span class="text-purple-400 font-semibold text-sm tracking-wider uppercase mb-3 block">Our
                        Journey</span>
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">
                        Perjalanan <span class="gradient-text">Kami</span>
                    </h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-purple-600 to-indigo-600 mx-auto mb-6"></div>
                    <p class="text-gray-300 text-lg max-w-2xl mx-auto">
                        Dari gerobak sederhana hingga menjadi destinasi kuliner favorit
                    </p>
                </div>

                <!-- Timeline -->
                <div class="space-y-16">
                    <!-- 2010 - Awal Mula -->
                    <div class="flex flex-col md:flex-row gap-8 items-center">
                        <div class="md:w-1/3 order-2 md:order-1">
                            <div class="relative group">
                                <div
                                    class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-300">
                                </div>
                                <div class="relative aspect-square rounded-2xl overflow-hidden shadow-2xl">
                                    <img src="{{ asset('ROPANG/GEROBAK.jpeg') }}" alt="Gerobak Ropang Ancur 2010"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                                </div>
                            </div>
                        </div>
                        <div class="md:w-2/3 order-1 md:order-2">
                            <div
                                class="bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/20 hover:bg-white/15 transition duration-300">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full px-6 py-2">
                                        <span class="text-2xl font-bold">2010</span>
                                    </div>
                                    <h3 class="text-2xl font-bold text-purple-400">Awal Mula</h3>
                                </div>
                                <p class="text-gray-300 leading-relaxed">
                                    Dimulai dari sebuah gerobak sederhana di pinggir jalan, dengan modal yang jauh dari kata
                                    berlebih.
                                    Hanya satu kompor, satu wajan, dan satu resep sambal rahasia—warisan keluarga yang
                                    dijaga dengan sepenuh hati.
                                    Setiap malam, aroma roti bakar mengepul menjadi saksi perjuangan, sementara harapan
                                    besar diselipkan di setiap sajian.
                                </p>
                                <div class="mt-4 flex items-center gap-2 text-purple-400">
                                    <span class="text-2xl">🍞</span>
                                    <span class="text-sm font-semibold">Era Gerobak Jalanan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 2025 - Masa Kini -->
                    <div class="flex flex-col md:flex-row-reverse gap-8 items-center">
                        <div class="md:w-1/3 order-2">
                            <div class="relative group">
                                <div
                                    class="absolute -inset-1 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-300">
                                </div>
                                <div class="relative aspect-square rounded-2xl overflow-hidden shadow-2xl">
                                    <img src="{{ asset('ROPANG/GERMAL.jpeg') }}" alt="Ropang Ancur Modern 2025"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                                </div>
                            </div>
                        </div>
                        <div class="md:w-2/3 order-1">
                            <div
                                class="bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/20 hover:bg-white/15 transition duration-300">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full px-6 py-2">
                                        <span class="text-2xl font-bold">2025</span>
                                    </div>
                                    <h3 class="text-2xl font-bold text-indigo-400">Menjadi Ikon</h3>
                                </div>
                                <p class="text-gray-300 leading-relaxed">
                                    Lima belas tahun perjalanan bukanlah waktu yang singkat. Dari gerobak sederhana hingga
                                    hari ini,
                                    Ropang Ancur tumbuh menjadi destinasi wajib bagi para pencinta kuliner malam. Setiap
                                    malam ratusan porsi
                                    tersaji dengan kualitas yang konsisten. Komitmen kami tetap sama: menghadirkan roti
                                    bakar terbaik dengan
                                    harga terjangkau untuk semua kalangan.
                                </p>
                                <div class="mt-4 flex items-center gap-2 text-indigo-400">
                                    <span class="text-2xl">🏆</span>
                                    <span class="text-sm font-semibold">Ikon Kuliner Jalanan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Summary -->
                <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div
                        class="bg-white/10 backdrop-blur-sm p-6 rounded-xl text-center border border-white/20 hover:bg-white/15 transition duration-300">
                        <div class="text-3xl font-bold text-purple-400 mb-2">15+</div>
                        <div class="text-sm text-gray-300">Tahun Pengalaman</div>
                    </div>
                    <div
                        class="bg-white/10 backdrop-blur-sm p-6 rounded-xl text-center border border-white/20 hover:bg-white/15 transition duration-300">
                        <div class="text-3xl font-bold text-indigo-400 mb-2">50K+</div>
                        <div class="text-sm text-gray-300">Pelanggan Setia</div>
                    </div>
                    <div
                        class="bg-white/10 backdrop-blur-sm p-6 rounded-xl text-center border border-white/20 hover:bg-white/15 transition duration-300">
                        <div class="text-3xl font-bold text-pink-400 mb-2">25+</div>
                        <div class="text-sm text-gray-300">Varian Menu</div>
                    </div>
                    <div
                        class="bg-white/10 backdrop-blur-sm p-6 rounded-xl text-center border border-white/20 hover:bg-white/15 transition duration-300">
                        <div class="text-3xl font-bold text-yellow-400 mb-2">500+</div>
                        <div class="text-sm text-gray-300">Porsi per Hari</div>
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
        <footer class="bg-gray-900 text-gray-300">
            <div class="max-w-7xl mx-auto px-4 py-16">
                <div class="grid md:grid-cols-4 gap-12 mb-12">
                    <!-- Brand -->
                    <div class="md:col-span-2">
                        <h3 class="text-3xl font-bold text-white mb-4">
                            Ropang <span
                                class="bg-gradient-to-r from-purple-400 to-indigo-400 bg-clip-text text-transparent">Ancur</span>
                        </h3>
                        <p class="text-gray-400 mb-6 leading-relaxed">
                            Cita rasa jalanan yang legendaris. Kami hadirkan sensasi pedas dan gurih yang bikin nagih sejak
                            2010. Setiap gigitan adalah pengalaman!
                        </p>
                        <div class="flex gap-4">
                            <a href="#"
                                class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center hover:bg-gradient-to-br hover:from-purple-600 hover:to-indigo-600 transition-all duration-300 transform hover:scale-110">
                                <span class="text-xl">📘</span>
                            </a>
                            <a href="#"
                                class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center hover:bg-gradient-to-br hover:from-purple-600 hover:to-indigo-600 transition-all duration-300 transform hover:scale-110">
                                <span class="text-xl">📷</span>
                            </a>
                            <a href="#"
                                class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center hover:bg-gradient-to-br hover:from-purple-600 hover:to-indigo-600 transition-all duration-300 transform hover:scale-110">
                                <span class="text-xl">💬</span>
                            </a>
                        </div>
                    </div>

                    <!-- Kontak -->
                    <div>
                        <h4 class="text-white font-bold mb-6">Hubungi Kami</h4>
                        <div class="space-y-3 text-sm">
                            <p>📍 Jl. Makan Lezat No. 42</p>
                            <p> Kota Kuliner, ID 12345</p>
                            <p>📞 +62 812-3456-7890</p>
                            <p>⏰ Buka: 18:00 - 23:00</p>
                        </div>
                    </div>

                    <!-- Links -->
                    <div>
                        <h4 class="text-white font-bold mb-6">Menu</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#menu" class="hover:text-purple-400 transition">Lihat Menu</a></li>
                            <li><a href="#tentang" class="hover:text-purple-400 transition">Tentang Kami</a></li>
                            <li><a href="#sejarah" class="hover:text-purple-400 transition">Sejarah</a></li>
                            <li><a href="{{ route('promo.index') }}" class="hover:text-purple-400 transition">Promo</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-400">
                    <p>&copy; 2025 Ropang Ancur. Semua hak dilindungi. Made with ❤️ by Ropang Ancur Team</p>
                </div>
            </div>
        </footer>

        <script>
            function loadMoreMenu() {
                const extraItems = document.querySelectorAll('.menu-item-extra');
                const btn = document.getElementById('loadMoreBtn');

                extraItems.forEach(item => {
                    item.classList.toggle('hidden');
                });

                if (extraItems[0].classList.contains('hidden')) {
                    btn.innerHTML = 'Lihat Menu Lengkap <span class="inline-block ml-2">+</span>';
                } else {
                    btn.innerHTML = 'Sembunyikan <span class="inline-block ml-2">−</span>';
                }
            }
        </script>
    @endsection
</body>
