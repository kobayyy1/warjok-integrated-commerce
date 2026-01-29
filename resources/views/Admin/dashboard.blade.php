<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .stat-card {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .menu-item {
            position: relative;
            overflow: hidden;
        }
        
        .menu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: linear-gradient(180deg, #3b82f6, #8b5cf6);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .menu-item:hover::before,
        .menu-item.active::before {
            transform: scaleY(1);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-blue {
            background: linear-gradient(135deg, #667eea 0%, #3b82f6 100%);
        }
        
        .gradient-green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        
        .gradient-purple {
            background: linear-gradient(135deg, #a855f7 0%, #7c3aed 100%);
        }
        
        .gradient-orange {
            background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
        }
        
        .gradient-pink {
            background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="flex h-screen bg-transparent">
        <!-- Sidebar -->
        <div id="sidebar" class="w-72 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-white transition-all duration-300 fixed h-full md:relative z-40 -translate-x-full md:translate-x-0 shadow-2xl">
            <!-- Logo -->
            <div class="flex items-center justify-between p-6 border-b border-gray-700/50">
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-500 rounded-lg blur-md opacity-50"></div>
                        <i class="fas fa-cube text-3xl text-blue-400 relative"></i>
                    </div>
                    <div>
                        <span class="text-xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">Admin Panel</span>
                        <p class="text-xs text-gray-400">Management System</p>
                    </div>
                </div>
                <button id="closeSidebar" class="md:hidden text-2xl hover:text-red-400 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Menu Items -->

            @include('Admin.Dashboard.navbar')
            {{-- <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="menu-item active flex items-center space-x-3 px-4 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-blue-500 text-white mb-2 transition-all hover:shadow-lg hover:shadow-blue-500/50">
                    <i class="fas fa-chart-line w-5 text-lg"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('admin.products.index') }}"
                    class="menu-item flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-300 hover:bg-gray-800/50 mb-2 transition-all hover:text-white">
                    <i class="fas fa-box w-5 text-lg"></i>
                    <span class="font-medium">Product</span>
                </a>

                <a href="{{ route('admin.banners.index') }}"
                    class="menu-item flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-300 hover:bg-gray-800/50 mb-2 transition-all hover:text-white">
                    <i class="fas fa-image w-5 text-lg"></i>
                    <span class="font-medium">Banner</span>
                </a>

                <a href="{{ route('promo.index') }}"
                    class="menu-item flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-300 hover:bg-gray-800/50 mb-2 transition-all hover:text-white">
                    <i class="fas fa-tag w-5 text-lg"></i>
                    <span class="font-medium">Promo</span>
                </a>

                <a href="{{ route('admin.hero-videos.index') }}"
                    class="menu-item flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-300 hover:bg-gray-800/50 mb-2 transition-all hover:text-white">
                    <i class="fas fa-video w-5 text-lg"></i>
                    <span class="font-medium">Hero Video</span>
                </a>
            </nav> --}}

            <!-- Quick Actions -->
            <div class="px-4 mt-8">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Quick Actions</p>
                <div class="space-y-2">
                    <button class="w-full flex items-center space-x-3 px-4 py-2 rounded-lg text-sm text-gray-300 hover:bg-gray-800/50 transition-all">
                        <i class="fas fa-plus-circle w-4"></i>
                        <span>Add New Product</span>
                    </button>
                    <button class="w-full flex items-center space-x-3 px-4 py-2 rounded-lg text-sm text-gray-300 hover:bg-gray-800/50 transition-all">
                        <i class="fas fa-file-export w-4"></i>
                        <span>Export Data</span>
                    </button>
                </div>
            </div>

            <!-- User Profile at Bottom -->
            <div class="absolute bottom-0 w-full p-4 border-t border-gray-700/50 bg-gray-900/50 backdrop-blur-sm">
                <div class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-gray-800/50 transition-all cursor-pointer">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=667eea&color=fff" 
                             alt="User" class="w-11 h-11 rounded-full ring-2 ring-blue-500/50">
                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-gray-900 rounded-full"></span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">Admin User</p>
                        <p class="text-xs text-gray-400">Super Admin</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-3 rounded-xl text-white bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 transition-all shadow-lg hover:shadow-red-500/50">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white/80 backdrop-blur-md shadow-lg border-b border-gray-200/50 p-4 flex items-center justify-between sticky top-0 z-30">
                <div class="flex items-center space-x-4">
                    <button id="toggleSidebar" class="md:hidden text-2xl text-gray-700 hover:text-blue-600 transition-colors">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Dashboard</h1>
                        <p class="text-xs text-gray-500 mt-0.5">Welcome back, let's manage your store</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                    </button>
                    <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all">
                        <i class="fas fa-cog text-xl"></i>
                    </button>
                    <div class="w-10 h-10 rounded-full gradient-bg flex items-center justify-center text-white font-bold shadow-lg">
                        A
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto p-6">
                <!-- Alert Messages -->
                <div id="successAlert" class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-4 rounded-xl shadow-lg mb-6 hidden animate-fade-in-up">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-check-circle text-2xl"></i>
                        <span class="font-medium">Operation completed successfully!</span>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="stat-card bg-white rounded-2xl shadow-lg p-6 border border-gray-100 animate-fade-in-up" style="animation-delay: 0.1s">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 gradient-blue rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                                <i class="fas fa-box text-2xl text-white"></i>
                            </div>
                            <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">+12%</span>
                        </div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Total Products</p>
                        <p class="text-4xl font-bold text-gray-900">1,234</p>
                        <div class="mt-4 flex items-center text-xs text-gray-500">
                            <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                            <span>+23 dari bulan lalu</span>
                        </div>
                    </div>
                    
                    <div class="stat-card bg-white rounded-2xl shadow-lg p-6 border border-gray-100 animate-fade-in-up" style="animation-delay: 0.2s">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 gradient-green rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                                <i class="fas fa-image text-2xl text-white"></i>
                            </div>
                            <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Active</span>
                        </div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Banners</p>
                        <p class="text-4xl font-bold text-gray-900">45</p>
                        <div class="mt-4 flex items-center text-xs text-gray-500">
                            <i class="fas fa-check-circle text-green-500 mr-1"></i>
                            <span>8 aktif sekarang</span>
                        </div>
                    </div>
                    
                    <div class="stat-card bg-white rounded-2xl shadow-lg p-6 border border-gray-100 animate-fade-in-up" style="animation-delay: 0.3s">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 gradient-purple rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30">
                                <i class="fas fa-tag text-2xl text-white"></i>
                            </div>
                            <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-3 py-1 rounded-full">Live</span>
                        </div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Active Promos</p>
                        <p class="text-4xl font-bold text-gray-900">18</p>
                        <div class="mt-4 flex items-center text-xs text-gray-500">
                            <i class="fas fa-clock text-orange-500 mr-1"></i>
                            <span>3 berakhir minggu ini</span>
                        </div>
                    </div>
                    
                    <div class="stat-card bg-white rounded-2xl shadow-lg p-6 border border-gray-100 animate-fade-in-up" style="animation-delay: 0.4s">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 gradient-orange rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/30">
                                <i class="fas fa-shopping-cart text-2xl text-white"></i>
                            </div>
                            <span class="text-xs font-semibold text-orange-600 bg-orange-50 px-3 py-1 rounded-full">Today</span>
                        </div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Orders Today</p>
                        <p class="text-4xl font-bold text-gray-900">89</p>
                        <div class="mt-4 flex items-center text-xs text-gray-500">
                            <i class="fas fa-fire text-red-500 mr-1"></i>
                            <span>Peak hour: 12:00-13:00</span>
                        </div>
                    </div>
                </div>

                <!-- Chart & Quick Actions Row -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Chart Section -->
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6 border border-gray-100 animate-fade-in-up" style="animation-delay: 0.5s">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Statistik Penjualan</h2>
                                <p class="text-sm text-gray-500 mt-1">Performa 7 hari terakhir</p>
                            </div>
                            <div class="flex space-x-2">
                                <button class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg hover:shadow-lg transition-all">
                                    Week
                                </button>
                                <button class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition-all">
                                    Month
                                </button>
                            </div>
                        </div>
                        <div class="h-64 flex items-center justify-center">
                            <div class="text-center">
                                <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                                    <i class="fas fa-chart-line text-3xl text-white"></i>
                                </div>
                                <p class="text-gray-500 font-medium">Chart akan ditampilkan di sini</p>
                                <p class="text-sm text-gray-400 mt-2">Integrasi dengan Chart.js atau ApexCharts</p>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 animate-fade-in-up" style="animation-delay: 0.6s">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Recent Activity</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 gradient-blue rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-plus text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Produk baru ditambahkan</p>
                                    <p class="text-xs text-gray-500 mt-1">2 menit yang lalu</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 gradient-green rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Promo diaktifkan</p>
                                    <p class="text-xs text-gray-500 mt-1">15 menit yang lalu</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 gradient-purple rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-video text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Hero video diupdate</p>
                                    <p class="text-xs text-gray-500 mt-1">1 jam yang lalu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Action Cards -->
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
                    {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('product.index') }}" 
                           class="group bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all border border-gray-100 animate-fade-in-up" style="animation-delay: 0.7s">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 gradient-blue rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg shadow-blue-500/30">
                                    <i class="fas fa-plus text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Tambah Produk</h4>
                                    <p class="text-sm text-gray-500">Buat produk baru</p>
                                </div>
                            </div> --}}
                        </a>

                        <a href="{{ route('admin.banners.create') }}" 
                           class="group bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all border border-gray-100 animate-fade-in-up" style="animation-delay: 0.8s">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 gradient-green rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg shadow-green-500/30">
                                    <i class="fas fa-image text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 group-hover:text-green-600 transition-colors">Tambah Banner</h4>
                                    <p class="text-sm text-gray-500">Upload banner baru</p>
                                </div>
                            </div>
                        </a>

                        {{-- <a href="{{ route('admin.promos.create') }}" 
                           class="group bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all border border-gray-100 animate-fade-in-up" style="animation-delay: 0.9s">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 gradient-purple rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg shadow-purple-500/30">
                                    <i class="fas fa-tag text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 group-hover:text-purple-600 transition-colors">Tambah Promo</h4>
                                    <p class="text-sm text-gray-500">Buat promo baru</p>
                                </div>
                            </div>
                        </a> --}}

                        <a href="{{ route('admin.hero-videos.index') }}" 
                           class="group bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all border border-gray-100 animate-fade-in-up" style="animation-delay: 1s">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 gradient-pink rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg shadow-pink-500/30">
                                    <i class="fas fa-video text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 group-hover:text-pink-600 transition-colors">Tambah Video</h4>
                                    <p class="text-sm text-gray-500">Upload hero video</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const toggleSidebar = document.getElementById('toggleSidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const sidebar = document.getElementById('sidebar');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });

        // Auto-hide alerts
        setTimeout(() => {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.3s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 768) {
                if (!sidebar.contains(e.target) && !toggleSidebar.contains(e.target)) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });
    </script>
</body>
</html>