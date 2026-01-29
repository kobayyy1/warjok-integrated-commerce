@extends('layouts.pages')

<head>
    @section('head')
    @endsection
    @include('mieayam.style')
</head>

<body class="bg-gradient-to-br from-red-50 via-orange-50 to-red-50">
    @section('body')
        <!-- Animated Background Shapes -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="hero-shape w-96 h-96 bg-red-400 float"></div>
            <div class="hero-shape w-72 h-72 bg-orange-400 float" style="animation-delay: 1s;"></div>
            <div class="hero-shape w-80 h-80 bg-red-300 float" style="animation-delay: 2s;"></div>
        </div>

        <!-- Back to Home Button - Fixed Position -->
        <div class="fixed top-4 left-4 z-50">
            <a href="{{ route('home') }}"
                class="group flex items-center gap-2 bg-white/95 backdrop-blur-sm hover:bg-red-600 text-stone-800 hover:text-white px-5 py-3 rounded-full font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 border border-stone-200">
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        <!-- Banner Carousel Section - Only show if banners exist -->
        @if ($banners && $banners->count() > 0)
            <section class="relative w-full overflow-hidden border-b-8 border-red-600 shadow-2xl">
                <!-- Decorative top border -->
                <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-red-600 via-orange-500 to-red-600 z-30">
                </div>

                <!-- Corner decorations -->
                <div class="absolute top-0 left-0 w-32 h-32 border-t-4 border-l-4 border-red-500 z-20 opacity-50"></div>
                <div class="absolute top-0 right-0 w-32 h-32 border-t-4 border-r-4 border-red-500 z-20 opacity-50"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 border-b-4 border-l-4 border-red-500 z-20 opacity-50"></div>
                <div class="absolute bottom-0 right-0 w-32 h-32 border-b-4 border-r-4 border-red-500 z-20 opacity-50"></div>

                <div class="banner-carousel relative h-[500px] md:h-[650px]">
                    @foreach ($banners as $index => $banner)
                        <div class="banner-slide absolute inset-0 transition-all duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 scale-100' : 'opacity-0 scale-105' }}"
                            data-slide="{{ $index }}">
                            <!-- Decorative frame inside -->
                            <div
                                class="absolute inset-4 md:inset-8 border-2 border-red-400/30 rounded-lg z-10 pointer-events-none">
                                <!-- Animated corner accents -->
                                <div
                                    class="absolute -top-2 -left-2 w-8 h-8 border-t-4 border-l-4 border-red-500 rounded-tl-lg">
                                </div>
                                <div
                                    class="absolute -top-2 -right-2 w-8 h-8 border-t-4 border-r-4 border-red-500 rounded-tr-lg">
                                </div>
                                <div
                                    class="absolute -bottom-2 -left-2 w-8 h-8 border-b-4 border-l-4 border-red-500 rounded-bl-lg">
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 w-8 h-8 border-b-4 border-r-4 border-red-500 rounded-br-lg">
                                </div>
                            </div>

                            <!-- Banner Image with Parallax Effect -->
                            <div class="absolute inset-0 transform transition-transform duration-700">
                                <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}"
                                    class="w-full h-full object-cover" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-stone-900/80 via-red-900/60 to-transparent">
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
                                            class="absolute -left-6 top-0 bottom-0 w-1 bg-gradient-to-b from-transparent via-red-500 to-transparent">
                                        </div>

                                        <div
                                            class="mb-4 inline-flex items-center gap-2 px-5 py-2 bg-gradient-to-r from-red-600 to-orange-600 backdrop-blur-sm rounded-full shadow-lg border border-red-400/30">
                                            <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                                            <span class="text-white text-sm font-semibold tracking-wide">PROMO
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
                                                class="group inline-flex items-center gap-3 bg-red-600 hover:bg-orange-600 text-white font-bold px-10 py-4 rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-2xl animate-slide-in-left-delay-2">
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
                            class="banner-nav banner-prev absolute left-6 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-red-600 backdrop-blur-md text-white p-4 rounded-full transition-all duration-300 hover:scale-110 group">
                            <i class="fas fa-chevron-left text-2xl transition-transform group-hover:-translate-x-1"></i>
                        </button>
                        <button
                            class="banner-nav banner-next absolute right-6 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-red-600 backdrop-blur-md text-white p-4 rounded-full transition-all duration-300 hover:scale-110 group">
                            <i class="fas fa-chevron-right text-2xl transition-transform group-hover:translate-x-1"></i>
                        </button>

                        <!-- Enhanced Dots Indicator -->
                        <div
                            class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-3 bg-black/20 backdrop-blur-md px-6 py-3 rounded-full">
                            @foreach ($banners as $index => $banner)
                                <button
                                    class="banner-dot h-3 rounded-full transition-all duration-300 hover:scale-110 {{ $index === 0 ? 'bg-red-600 w-10' : 'bg-white/60 hover:bg-white/80 w-3' }}"
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
                            dot.classList.remove('bg-red-600', 'w-10');
                            dot.classList.add('bg-white/60', 'w-3');
                        });

                        setTimeout(() => {
                            slides[index].classList.remove('opacity-0', 'scale-105');
                            slides[index].classList.add('opacity-100', 'scale-100');
                        }, 50);

                        if (dots[index]) {
                            dots[index].classList.remove('bg-white/60', 'w-3');
                            dots[index].classList.add('bg-red-600', 'w-10');
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
            <div class="bg-gradient-to-r from-red-600 via-orange-500 to-red-500 text-white py-4 px-4 text-center shadow-lg">
                <div class="max-w-7xl mx-auto flex items-center justify-center gap-3">
                    <span class="text-2xl animate-bounce">⏰</span>
                    <p class="text-sm md:text-base font-semibold">
                        Buka Setiap Hari 15:00 - 22:00 WIB | Warung Pojok Mie Ayamlah Siap Menyambut Anda!
                    </p>
                </div>
            </div>
        @else
            <!-- Default Hero Section (when no banners) -->
            <section class="relative py-32 px-4 overflow-hidden">
                <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center relative z-10">
                    <div class="slide-left">
                        <div class="mb-6">
                            <span class="text-red-600 font-bold text-lg">🏪 Warung Legendaris</span>
                        </div>
                        <h1 class="text-6xl md:text-7xl font-bold text-gray-900 mb-6 leading-tight">
                            <span class="gradient-text">Mie Ayamlah</span>
                        </h1>
                        <p class="text-xl text-gray-700 mb-8 leading-relaxed">
                            Semangkuk cerita, seporsi kenyang. Hampir 30 tahun melayani dengan sepenuh hati dan cinta untuk
                            Anda.
                        </p>
                        <div class="flex gap-4 flex-wrap">
                            <a href="#menu"
                                class="bg-gradient-to-r from-red-600 via-orange-500 to-red-500 text-white px-8 py-4 rounded-full font-bold hover:shadow-lg hover:scale-105 transition transform">
                                🍜 Lihat Menu
                            </a>
                            <a href="#tentang"
                                class="border-2 border-red-600 text-red-600 px-8 py-4 rounded-full font-bold hover:bg-orange-50 transition">
                                📖 Tentang Kami
                            </a>
                        </div>
                    </div>
                    <div class="slide-right relative">
                        <div class="relative h-96 md:h-full min-h-80 overflow-hidden rounded-lg shadow-2xl">
                            <img src="{{ asset('images/banner/bannerMie.jpg') }}" alt="Mie Ayam Banner"
                                class="w-full h-full object-cover animate-zoom-pan">
                            <div class="steam steam-1"></div>
                            <div class="steam steam-2"></div>
                            <div class="steam steam-3"></div>
                            <div class="food-particle noodle-1"></div>
                            <div class="food-particle noodle-2"></div>
                            <div class="food-particle chicken-1"></div>
                            <div class="food-particle chicken-2"></div>
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-orange-400/30 via-yellow-400/20 to-red-500/30 animate-warm-glow">
                            </div>
                            <div class="absolute inset-0 pulse-glow rounded-lg"></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Promo Headline - Placed after default hero -->
            <div class="bg-gradient-to-r from-red-600 via-orange-500 to-red-500 text-white py-4 px-4 text-center shadow-lg">
                <div class="max-w-7xl mx-auto flex items-center justify-center gap-3">
                    <span class="text-2xl animate-bounce">⏰</span>
                    <p class="text-sm md:text-base font-semibold">
                        Buka Setiap Hari 15:00 - 22:00 WIB | Warung Pojok Mie Ayamlah Siap Menyambut Anda!
                    </p>
                </div>
            </div>
        @endif

        <!-- Tentang Section -->
        <section id="tentang" class="py-20 px-4 relative z-10">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <span class="text-red-600 font-bold text-lg">🏪 TENTANG KAMI</span>
                    <h2 class="text-5xl font-bold text-gray-900 mt-4 mb-4">Kisah di Balik Setiap Mangkuk</h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-red-600 via-orange-500 to-red-500 mx-auto"></div>
                </div>

                <div class="grid md:grid-cols-3 gap-8 mb-12">
                    <div class="bg-white/80 backdrop-blur p-8 rounded-2xl border-2 border-red-300">
                        <div class="text-5xl mb-4">❤️</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Dibuat Dengan Cinta</h3>
                        <p class="text-gray-700">Setiap mangkuk mie dibuat dengan resep turun-temurun dan sentuhan cinta
                            dari Bu Lastri</p>
                    </div>

                    <div class="bg-white/80 backdrop-blur p-8 rounded-2xl border-2 border-orange-300">
                        <div class="text-5xl mb-4">🌟</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Kualitas Terjamin</h3>
                        <p class="text-gray-700">Menggunakan bahan pilihan terbaik dan bumbu rempah yang telah
                            disempurnakan selama puluhan tahun</p>
                    </div>

                    <div class="bg-white/80 backdrop-blur p-8 rounded-2xl border-2 border-red-300">
                        <div class="text-5xl mb-4">👨‍👩‍👧‍👦</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Seperti Keluarga</h3>
                        <p class="text-gray-700">Di sini Anda bukan hanya pelanggan, tapi bagian dari keluarga besar kami
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Menu Section -->
        <section id="menu" class="py-20 px-4 relative z-10">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <span class="text-red-600 font-bold text-lg">🍜 MENU FAVORIT</span>
                    <h2 class="text-5xl font-bold text-gray-900 mt-4 mb-4">Pilihan Lezat Kami</h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-red-600 via-orange-500 to-red-500 mx-auto"></div>
                    <p class="text-gray-700 text-lg mt-4">Setiap menu dirancang untuk memuaskan lidah Anda</p>
                </div>

                <div class="menu-grid" id="menuGrid">
                    @forelse($products as $index => $product)
                        <div
                            class="menu-card bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl {{ $index >= 3 ? 'hidden' : '' }}">
                            <div
                                class="h-56 bg-gradient-to-br from-red-300 via-orange-300 to-red-400 flex items-center justify-center relative overflow-hidden">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover hover:scale-110 transition duration-300">
                                @else
                                    <img src="{{ asset('mieayam/MieAyam-original.jpeg') }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover hover:scale-110 transition duration-300">
                                @endif
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition"></div>
                            </div>
                            <div class="p-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $product->name }}</h3>
                                <p class="text-gray-700 mb-6">
                                    {{ $product->description ?? 'Menu lezat dengan bahan berkualitas dan resep spesial kami' }}
                                </p>
                                <div class="flex justify-between items-center">
                                    <span class="text-3xl font-bold gradient-text">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    <button data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}"
                                        data-product-price="{{ number_format($product->price, 0, ',', '.') }}"
                                        class="menu-add-btn bg-gradient-to-r from-red-600 via-orange-500 to-red-500 text-white px-4 py-2 rounded-full hover:scale-110 transition {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                        {{ $product->stock > 0 ? '+' : 'Habis' }}
                                    </button>
                                </div>
                                @if ($product->stock > 0 && $product->stock <= 10)
                                    <div class="mt-3">
                                        <span class="text-xs bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full">
                                            ⚠️ Stok terbatas ({{ $product->stock }} tersisa)
                                        </span>
                                    </div>
                                @elseif($product->stock <= 0)
                                    <div class="mt-3">
                                        <span class="text-xs bg-red-100 text-red-800 px-3 py-1 rounded-full">
                                            ❌ Stok habis
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-20">
                            <div class="text-gray-400 mb-4">
                                <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-700 mb-2">Menu Sedang Disiapkan</h3>
                            <p class="text-gray-500">Mohon tunggu, kami sedang memperbarui menu spesial untuk Anda</p>
                        </div>
                    @endforelse
                </div>

                @if ($products->count() > 3)
                    <div class="text-center mt-12">
                        <button id="showMoreBtn"
                            class="btn-show-more bg-gradient-to-r from-red-600 via-orange-500 to-red-500 text-white px-10 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transition">
                            ✨ Lihat Menu Lengkap
                        </button>
                    </div>
                @endif
            </div>
        </section>

        <script>
            const showMoreBtn = document.getElementById('showMoreBtn');
            if (showMoreBtn) {
                const menuGrid = document.getElementById('menuGrid');

                showMoreBtn.addEventListener('click', function() {
                    const hiddenCards = menuGrid.querySelectorAll('.menu-card.hidden');

                    if (hiddenCards.length > 0) {
                        hiddenCards.forEach(card => card.classList.remove('hidden'));
                        showMoreBtn.textContent = '⬆️ Sembunyikan Menu';
                        showMoreBtn.style.background = 'linear-gradient(to right, rgb(139, 0, 0), rgb(220, 38, 38))';
                    } else {
                        const allCards = menuGrid.querySelectorAll('.menu-card');
                        allCards.forEach((card, index) => {
                            if (index >= 3) {
                                card.classList.add('hidden');
                            }
                        });
                        showMoreBtn.textContent = '✨ Lihat Menu Lengkap';
                        showMoreBtn.style.background = 'linear-gradient(to right, rgb(220, 38, 38), rgb(239, 68, 68))';

                        document.getElementById('menu').scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            }

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'slide-in-right 0.6s ease-out forwards';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.menu-card').forEach(card => {
                observer.observe(card);
            });

            document.querySelectorAll('.menu-add-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (this.disabled) return;

                    const menuName = this.getAttribute('data-product-name');
                    const menuPrice = this.getAttribute('data-product-price');

                    alert(`📦 Ditambahkan ke keranjang!\n\n${menuName}\nRp ${menuPrice}`);

                    this.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 200);
                });
            });
        </script>
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
        <footer class="bg-gray-900 text-gray-300 py-12 px-4 relative z-10">
            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-3 gap-8 mb-8">
                    <div>
                        <h3 class="text-white text-xl font-bold mb-4">🍜 Mie Ayamlah</h3>
                        <p class="text-sm leading-relaxed">
                            Melayani dengan sepenuh hati sejak 1995. Cita rasa autentik yang menemani perjalanan hidup Anda.
                        </p>
                    </div>

                    <div id="kontak">
                        <h4 class="text-white font-semibold mb-4">Kontak Kami</h4>
                        <ul class="space-y-2 text-sm">
                            <li>📍 Jl. Sudirman No. 123, Jakarta</li>
                            <li>📞 (021) 1234-5678</li>
                            <li>📧 info@mieayamlah.com</li>
                            <li>🕐 Senin - Minggu: 08.00 - 21.00 WIB</li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-white font-semibold mb-4">Ikuti Kami</h4>
                        <div class="flex gap-4">
                            <a href="#"
                                class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center hover:bg-orange-500 transition">
                                <span>📘</span>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center hover:bg-orange-500 transition">
                                <span>📷</span>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center hover:bg-orange-500 transition">
                                <span>🐦</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-800 pt-8 text-center text-sm">
                    <p>&copy; 2025 Mie Ayamlah. Dibuat dengan ❤️ untuk Anda</p>
                </div>
            </div>
        </footer>
    @endsection
</body>
