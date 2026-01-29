{{-- Function untuk check active menu --}}
@php
    function isActiveMenu($route)
    {
        return request()->routeIs($route) || request()->routeIs($route . '.*');
    }
@endphp

<nav class="mt-6 px-4 space-y-2">
    {{-- Dashboard --}}
    <a href="{{ route('admin.dashboard') }}"
        class="menu-item flex items-center space-x-3 px-4 py-3 rounded-xl mb-2 transition-all {{ isActiveMenu('admin.dashboard') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-500/50' : 'text-gray-300 hover:bg-gray-800/50 hover:text-white' }}">
        <i class="fas fa-chart-line w-5 text-lg"></i>
        <span class="font-medium">Dashboard</span>
    </a>

    {{-- Product --}}
    <a href="{{ route('admin.products.index') }}"
        class="menu-item flex items-center space-x-3 px-4 py-3 rounded-xl mb-2 transition-all {{ isActiveMenu('admin.products') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-500/50' : 'text-gray-300 hover:bg-gray-800/50 hover:text-white' }}">
        <i class="fas fa-box w-5 text-lg"></i>
        <span class="font-medium">Product</span>
    </a>

    {{-- Banner --}}
    <a href="{{ route('admin.banners.index') }}"
        class="menu-item flex items-center space-x-3 px-4 py-3 rounded-xl mb-2 transition-all {{ isActiveMenu('admin.banners') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-500/50' : 'text-gray-300 hover:bg-gray-800/50 hover:text-white' }}">
        <i class="fas fa-image w-5 text-lg"></i>
        <span class="font-medium">Banner</span>
    </a>

    {{-- Promo --}}
    <a href="{{ route('admin.promo.index') }}"
        class="menu-item flex items-center space-x-3 px-4 py-3 rounded-xl mb-2 transition-all {{ isActiveMenu('admin.promos') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-500/50' : 'text-gray-300 hover:bg-gray-800/50 hover:text-white' }}">
        <i class="fas fa-tag w-5 text-lg"></i>
        <span class="font-medium">Promo</span>
    </a>

    {{-- Hero Video --}}
    <a href="{{ route('admin.hero-videos.index') }}"
        class="menu-item flex items-center space-x-3 px-4 py-3 rounded-xl mb-2 transition-all {{ isActiveMenu('admin.hero-videos') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-500/50' : 'text-gray-300 hover:bg-gray-800/50 hover:text-white' }}">
        <i class="fas fa-video w-5 text-lg"></i>
        <span class="font-medium">Hero Video</span>
    </a>
</nav>
