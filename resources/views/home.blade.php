<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Warung Pojok</title>

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Styles -->
    @include('mieayam.style')
    @include('HeroSection.Homestyle')
</head>

<body>
    <!-- ========================================
         NAVBAR SECTION
    ========================================= -->
    <!-- ========================================
     NAVBAR SECTION
========================================= -->
<nav class="navbar">
    <div class="nav-container">
        <a href="{{ route('home') }}" class="logo">WARUNG POJOK</a>
        
        <div class="hamburger" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        
        <ul class="nav-menu" id="navMenu">
            <li><a href="#home">Home</a></li>
            <li><a href="#products">Products</a></li>
            <li><a href="#footer">Contact</a></li>
            
            <!-- Auth Buttons -->
            @auth
                <!-- Jika sudah login, tampilkan nama user dan logout -->
                <li class="nav-user-menu">
                    <div class="user-dropdown">
                        <button class="user-button" onclick="toggleUserDropdown(event)">
                            <div class="user-avatar">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="user-name">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="user-dropdown-menu" id="userDropdownMenu">
                            <div class="dropdown-header">
                                <div class="dropdown-user-info">
                                    <p class="dropdown-user-name">{{ auth()->user()->name }}</p>
                                    <p class="dropdown-user-email">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-user"></i>
                                <span>Profile</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="POST" class="dropdown-form">
                                @csrf
                                <button type="submit" class="dropdown-item logout-item">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            @else
                <!-- Jika belum login, tampilkan button Login & Register -->
                <li class="nav-auth-buttons">
                    <a href="{{ route('login.user') }}" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                </li>
                <li class="nav-auth-buttons">
                    <a href="{{ route('register') }}" class="btn-register">
                        <i class="fas fa-user-plus"></i>
                        <span>Register</span>
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<!-- Additional Styles for Auth Buttons -->
<style>
    /* Auth Buttons Styling */
    .nav-auth-buttons {
        display: flex;
        align-items: center;
    }

    .btn-login,
    .btn-register {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-login {
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.8);
        color: white;
    }

    .btn-login:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
    }

    .btn-register {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: 2px solid transparent;
        color: white;
    }

    .btn-register:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    /* User Menu Styling */
    .nav-user-menu {
        position: relative;
    }

    .user-dropdown {
        position: relative;
    }

    .user-button {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 8px 16px;
        border-radius: 25px;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .user-button:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.5);
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
    }

    .user-name {
        max-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .user-button i {
        font-size: 12px;
        transition: transform 0.3s ease;
    }

    .user-button.active i {
        transform: rotate(180deg);
    }

    /* Dropdown Menu */
    .user-dropdown-menu {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        min-width: 220px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .user-dropdown-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-header {
        padding: 16px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px 12px 0 0;
    }

    .dropdown-user-info {
        color: white;
    }

    .dropdown-user-name {
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 4px;
    }

    .dropdown-user-email {
        font-size: 12px;
        opacity: 0.9;
    }

    .dropdown-divider {
        height: 1px;
        background: #e5e7eb;
        margin: 8px 0;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        color: #374151;
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 14px;
        font-weight: 500;
    }

    .dropdown-item:hover {
        background: #f3f4f6;
        color: #667eea;
    }

    .dropdown-item i {
        width: 18px;
        text-align: center;
        font-size: 16px;
    }

    .dropdown-form {
        margin: 0;
    }

    .logout-item {
        width: 100%;
        border: none;
        background: none;
        cursor: pointer;
        text-align: left;
        color: #ef4444;
    }

    .logout-item:hover {
        background: #fef2f2;
        color: #dc2626;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .nav-menu.active .nav-auth-buttons {
            width: 100%;
            margin-top: 10px;
        }

        .nav-menu.active .btn-login,
        .nav-menu.active .btn-register {
            width: 100%;
            justify-content: center;
            padding: 12px 20px;
        }

        .nav-menu.active .nav-user-menu {
            width: 100%;
            margin-top: 10px;
        }

        .nav-menu.active .user-button {
            width: 100%;
            justify-content: center;
        }

        .user-dropdown-menu {
            right: 0;
            left: 0;
            margin: 0 16px;
        }
    }

    /* Ensure icons are visible */
    .btn-login i,
    .btn-register i {
        font-size: 14px;
    }
</style>

<!-- JavaScript for User Dropdown -->
<script>
    function toggleUserDropdown(event) {
        event.stopPropagation();
        const button = event.currentTarget;
        const menu = document.getElementById('userDropdownMenu');
        
        button.classList.toggle('active');
        menu.classList.toggle('show');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const userMenu = document.querySelector('.user-dropdown-menu');
        const userButton = document.querySelector('.user-button');
        
        if (userMenu && !userMenu.contains(event.target) && !userButton.contains(event.target)) {
            userMenu.classList.remove('show');
            if (userButton) {
                userButton.classList.remove('active');
            }
        }
    });

    // Close dropdown when pressing ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const userMenu = document.querySelector('.user-dropdown-menu');
            const userButton = document.querySelector('.user-button');
            
            if (userMenu) {
                userMenu.classList.remove('show');
            }
            if (userButton) {
                userButton.classList.remove('active');
            }
        }
    });
</script>

    <!-- ========================================
         HERO VIDEO SECTION
    ========================================= -->
    @php
        $backgroundVideo = $heroVideos->where('is_background', true)->where('is_active', true)->first();
        $mainVideos = $heroVideos->where('is_background', false)->where('is_active', true)->sortBy('position')->values();
    @endphp

    <!-- Background Video (Full Screen) -->
    @if($backgroundVideo)
        <div class="video-bg-container">
            <video autoplay muted loop playsinline>
                <source src="{{ asset($backgroundVideo->video_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    @endif

    <!-- Main Hero Section with Videos -->
    @if($mainVideos->count() > 0)
        <section id="home" class="pt-20 pb-8 md:pb-12 px-4 md:px-8 relative z-10 min-h-fit flex flex-col justify-center">
            <div class="max-w-7xl mx-auto w-full hero-content">
                <div class="text-center mb-12 md:mb-16">
                    <!-- Title -->
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-4 drop-shadow-lg animate-fade-in-up">
                        WELCOME TO WARUNG POJOK
                    </h1>

                    <!-- Video Grid - DIPERBAIKI: tambah overflow untuk scroll horizontal di mobile -->
                    <div class="flex flex-col md:flex-row gap-6 md:gap-0 items-stretch justify-center overflow-x-auto pb-4">
                        @foreach($mainVideos as $index => $video)
                            <!-- Video Card {{ $index + 1 }} -->
                            <div class="flex-1 flex flex-col items-center min-w-[250px]" data-video-index="{{ $index }}" data-video-id="{{ $video->id }}">
                                <div class="video-container w-full h-80 md:h-96 mb-4" style="aspect-ratio: 9/16; max-width: 250px;">
                                    <video autoplay muted loop playsinline class="video-element">
                                        <source src="{{ asset($video->video_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <div class="video-overlay">
                                        <button onclick="openModal('video{{ $video->id }}')"
                                                class="bg-white text-purple-600 px-6 py-2 rounded-full font-bold hover:bg-gray-100 transition">
                                            VIEW
                                        </button>
                                    </div>
                                </div>
                                {{-- <h3 class="text-xl font-bold text-white drop-shadow-lg">{{ $video->title }}</h3> --}}
                                {{-- <p class="text-gray-200 text-center text-sm mt-2 drop-shadow-lg">{{ $video->description }}</p> --}}
                            </div>

                            <!-- Divider Line (Desktop Only) -->
                            @if(!$loop->last)
                                <div class="hidden md:flex md:flex-col md:justify-center md:px-6">
                                    <div class="divider-line line-animation" 
                                         style="animation-delay: {{ 0.3 + ($index * 0.2) }}s; width: 2px; height: 100%;">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Indicator: Scroll untuk melihat semua video (Mobile) -->
                    @if($mainVideos->count() > 1)
                        <div class="md:hidden text-white/70 text-xs mt-2">
                            ← Geser untuk melihat semua video →
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Video Modals -->
        @foreach($mainVideos as $video)
            <div id="video{{ $video->id }}Modal" class="modal" onclick="closeModal('video{{ $video->id }}')">
                <div class="modal-content" onclick="event.stopPropagation()">
                    <button class="close-btn" onclick="closeModal('video{{ $video->id }}')">&times;</button>
                    <video controls style="max-width: 500px; max-height: 600px;">
                        <source src="{{ asset($video->video_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        @endforeach
    @endif

    <!-- ========================================
         PRODUCTS SECTION
    ========================================= -->
    <section id="products" class="products-section">
        {{-- <h2 class="section-title">Kenali Warung Pojok</h2> --}}
        <div class="products-container">
            <div class="owl-carousel owl-theme">
                <!-- Koproll Coffee -->
                <div class="product-card">
                    <img src="{{ asset('images/koproll-logo.png') }}" alt="Koproll Coffee Logo" class="product-logo">
                    <div class="product-info">
                        <h3 class="product-name">Koproll Coffee</h3>
                        <p class="product-description">Yang jualan Standup Comedy</p>
                        <a href="{{ route('homeKoproll') }}" class="view-button">VIEW</a>
                    </div>
                </div>

                <!-- Mie Ayam -->
                <div class="product-card">
                    <img src="{{ asset('images/mieayam-logo.jpg') }}" alt="Mie Ayam Logo" class="product-logo">
                    <div class="product-info">
                        <h3 class="product-name">Mie Ayam</h3>
                        <p class="product-description">Yang jual Orang Gede</p>
                        <a href="{{ route('home.mieayam') }}" class="view-button">VIEW</a>
                    </div>
                </div>

                <!-- Roti Bakar -->
                <div class="product-card">
                    <img src="{{ asset('images/roti-logo.jpg') }}" alt="Roti Bakar Logo" class="product-logo">
                    <div class="product-info">
                        <h3 class="product-name">Roti Bakar</h3>
                        <p class="product-description">Yang jual Remaja Masjid</p>
                        <a href="{{ route('home.ropang') }}" class="view-button">VIEW</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================
         FOOTER SECTION
    ========================================= -->
    <footer id="footer" class="bg-gradient-to-r from-indigo-500 via-purple-500 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-10 mb-8 sm:mb-12">
                <!-- Lokasi Kami -->
                <div class="space-y-4">
                    <h4 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Lokasi Kami</h4>
                    <div class="bg-white/10 rounded-lg overflow-hidden cursor-pointer hover:bg-white/20 transition-all relative group"
                         onclick="openMapModal()">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2876939857183!2d106.87493607499806!3d-6.194862!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f51b6b6b6b6b%3A0x1234567890abcdef!2sJl.%20Beton%20No.18%2C%20Kayu%20Putih%2C%20Kec.%20Pulo%20Gadung%2C%20Jakarta%20Timur!5e0!3m2!1sen!2sid!4v1234567890"
                            width="100%" height="180" style="border:0; pointer-events: none;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            class="rounded-lg sm:h-[200px]">
                        </iframe>
                        <div class="absolute inset-0 flex items-center justify-center bg-black/0 group-hover:bg-black/20 transition-all rounded-lg">
                            <span class="text-white text-xs sm:text-sm font-semibold opacity-0 group-hover:opacity-100 bg-indigo-600 px-3 py-1.5 sm:px-4 sm:py-2 rounded-full transition-all">
                                📍 Klik untuk memperbesar
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Company Info -->
                <div class="space-y-4">
                    <h3 class="text-xl sm:text-2xl font-bold">WARUNG POJOK</h3>
                    <p class="text-white/90 leading-relaxed text-sm sm:text-base">
                        Tempat terbaik untuk menemukan berbagai produk berkualitas dengan harga terjangkau. Kami melayani dengan sepenuh hati.
                    </p>
                </div>

                <!-- Products -->
                <div class="space-y-4">
                    <h4 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Produk Kami</h4>
                    <ul class="space-y-2 sm:space-y-3">
                        <li>
                            <a href="{{ route('homeKoproll') }}" class="text-white/90 hover:text-white hover:translate-x-1 inline-block transition-all duration-300 text-sm sm:text-base">
                                Koproll Coffee
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.mieayam') }}" class="text-white/90 hover:text-white hover:translate-x-1 inline-block transition-all duration-300 text-sm sm:text-base">
                                Mie Ayam
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.ropang') }}" class="text-white/90 hover:text-white hover:translate-x-1 inline-block transition-all duration-300 text-sm sm:text-base">
                                Roti Bakar
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="space-y-4">
                    <h4 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Kontak</h4>
                    <ul class="space-y-2 sm:space-y-3 text-white/90 text-sm sm:text-base">
                        <li class="flex items-start gap-2">
                            <span class="text-base sm:text-lg">📍</span>
                            <span>Jl. Beton No.18, RT.8/RW.5, Kayu Putih, Kec. Pulo Gadung, Jakarta Timur 13210</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-base sm:text-lg">📞</span>
                            <span>+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-base sm:text-lg">✉️</span>
                            <span class="break-all">info@warungpojok.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="pt-6 sm:pt-8 border-t border-white/20 text-center text-white/80 text-sm sm:text-base">
                <p>&copy; 2025 Warung Pojok. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- ========================================
         MAP MODAL
    ========================================= -->
    <div id="mapModal" class="fixed inset-0 bg-black/80 z-[9999] hidden items-center justify-center p-2 sm:p-4"
         onclick="closeMapModal()">
        <div class="relative w-full max-w-6xl h-[70vh] sm:h-[80vh] bg-white rounded-lg overflow-hidden shadow-2xl"
             onclick="event.stopPropagation()">
            <button onclick="closeMapModal()"
                    class="absolute top-2 right-2 sm:top-4 sm:right-4 z-10 bg-white text-gray-800 rounded-full w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center hover:bg-gray-100 transition-all shadow-lg text-lg sm:text-xl">
                ✕
            </button>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2876939857183!2d106.87493607499806!3d-6.194862!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f51b6b6b6b6b%3A0x1234567890abcdef!2sJl.%20Beton%20No.18%2C%20Kayu%20Putih%2C%20Kec.%20Pulo%20Gadung%2C%20Jakarta%20Timur!5e0!3m2!1sen!2sid!4v1234567890"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>

    <!-- ========================================
         JAVASCRIPT LIBRARIES
    ========================================= -->
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- ========================================
         CUSTOM JAVASCRIPT
    ========================================= -->
    <script>
        // ==================== OWL CAROUSEL ====================
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 7000,
                autoplayHoverPause: true,
                responsive: {
                    0: { items: 1 },
                    600: { items: 2 },
                    1000: { items: 3 }
                }
            });
        });

        // ==================== VIDEO MODAL FUNCTIONS ====================
        function openModal(videoId) {
            const modalId = videoId + 'Modal';
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
                
                const video = modal.querySelector('video');
                if (video) video.play();
            }
        }

        function closeModal(videoId) {
            const modalId = videoId + 'Modal';
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('show');
                document.body.style.overflow = 'auto';
                
                const video = modal.querySelector('video');
                if (video) {
                    video.pause();
                    video.currentTime = 0;
                }
            }
        }

        // ==================== MAP MODAL FUNCTIONS ====================
        function openMapModal() {
            document.getElementById('mapModal').classList.remove('hidden');
            document.getElementById('mapModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeMapModal() {
            document.getElementById('mapModal').classList.add('hidden');
            document.getElementById('mapModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // ==================== MOBILE MENU ====================
        function toggleMenu() {
            document.getElementById('navMenu').classList.toggle('active');
        }

        // ==================== EVENT LISTENERS ====================
        document.addEventListener('DOMContentLoaded', function() {
            // Close menu when clicking on a link
            document.querySelectorAll('.nav-menu a').forEach(link => {
                link.addEventListener('click', () => {
                    document.getElementById('navMenu').classList.remove('active');
                });
            });

            // Smooth scroll for anchor links
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

            // ==================== VIDEO DEBUG (Simplified) ====================
            console.log('🎥 VIDEO STATUS:');
            document.querySelectorAll('[data-video-index]').forEach((container, idx) => {
                const video = container.querySelector('video');
                const source = video?.querySelector('source');
                console.log(`Video ${idx + 1}: ${container.offsetWidth > 0 ? '✅ Visible' : '❌ Hidden'} (${container.offsetWidth}x${container.offsetHeight}px)`);
                
                if (video) {
                    video.addEventListener('error', () => {
                        console.error(`❌ Video ${idx + 1} failed to load:`, source?.src);
                    });
                    video.addEventListener('loadeddata', () => {
                        console.log(`✅ Video ${idx + 1} loaded:`, source?.src);
                    });
                }
            });
        });

        // Close modals with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Close video modals
                document.querySelectorAll('.modal.show').forEach(modal => {
                    const video = modal.querySelector('video');
                    if (video) {
                        video.pause();
                        video.currentTime = 0;
                    }
                    modal.classList.remove('show');
                    document.body.style.overflow = 'auto';
                });
                
                // Close map modal
                closeMapModal();
            }
        });
    </script>

    <!-- ========================================
         MODAL STYLES (Inline)
    ========================================= -->
    <style>
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            animation: fadeIn 0.3s ease;
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #000;
            padding: 20px;
            border-radius: 15px;
            max-width: 90vw;
            max-height: 90vh;
            position: relative;
            animation: zoomIn 0.3s ease;
        }

        .modal-content video {
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }

        .close-btn {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 28px;
            font-weight: bold;
            color: white;
            cursor: pointer;
            background: rgba(0, 0, 0, 0.5);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
            z-index: 100;
        }

        .close-btn:hover {
            background: rgba(0, 0, 0, 0.8);
        }
    </style>
</body>

</html>