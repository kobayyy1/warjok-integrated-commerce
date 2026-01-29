<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Management - Admin Panel</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div id="sidebar"
            class="w-64 bg-gray-900 text-white transition-all duration-300 fixed h-full md:relative z-40 -translate-x-full md:translate-x-0">
            <!-- Logo -->
            <div class="flex items-center justify-between p-6 border-b border-gray-700">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-cube text-2xl text-blue-500"></i>
                    <span class="text-xl font-bold">Admin Panel</span>
                </div>
                <button id="closeSidebar" class="md:hidden text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Menu Items -->
            @include('admin.dashboard.navbar')

            <!-- User Profile at Bottom -->
            <div class="absolute bottom-0 w-full p-4 border-t border-gray-700">
                <div
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition-colors cursor-pointer">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=0D8ABC&color=fff"
                        alt="User" class="w-10 h-10 rounded-full">
                    <div class="flex-1">
                        <p class="text-sm font-semibold">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-400">{{ auth()->user()->store->name ?? 'Super Admin' }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-red-800 transition-colors">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-md p-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button id="toggleSidebar" class="md:hidden text-2xl text-gray-700">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-2xl font-bold text-gray-800">Product Management</h1>
                </div>
                <div class="flex items-center space-x-6">
                    <button class="relative text-gray-600 hover:text-gray-900">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full"></span>
                    </button>
                    <button class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-cog text-xl"></i>
                    </button>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto p-6">
                <!-- Alert Messages -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Products Table -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-900">Daftar Produk</h2>
                        <a href="{{ route('admin.products.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors inline-flex items-center">
                            <i class="fas fa-plus mr-2"></i> Tambah Produk
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Gambar</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Produk</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Harga</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Stok</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($products as $product)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $product->id }}</td>
                                        <td class="px-6 py-4">
                                            @if ($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}" 
                                                    class="w-12 h-12 object-cover rounded border border-gray-200">
                                            @else
                                                <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                                    <i class="fas fa-image text-gray-400"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $product->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 font-semibold">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ $product->stock }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $product->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                    class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:bg-blue-100 rounded-lg transition-all duration-200"
                                                    title="Edit Produk">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <!-- Tombol Delete -->
                                                <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                    method="POST"
                                                    class="inline-block"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ $product->name }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:bg-red-100 rounded-lg transition-all duration-200"
                                                        title="Hapus Produk">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center text-gray-500">
                                                <i class="fas fa-box-open text-6xl mb-4 text-gray-300"></i>
                                                <p class="text-lg font-semibold mb-2">Belum ada produk</p>
                                                <p class="text-sm mb-4">Mulai tambahkan produk pertama Anda</p>
                                                <a href="{{ route('admin.products.create') }}"
                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors inline-flex items-center">
                                                    <i class="fas fa-plus mr-2"></i> Tambah Produk
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($products->hasPages())
                        <div class="p-4 border-t border-gray-200">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Sidebar Toggle
        const toggleSidebar = document.getElementById('toggleSidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const sidebar = document.getElementById('sidebar');

        if (toggleSidebar) {
            toggleSidebar.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });
        }

        if (closeSidebar) {
            closeSidebar.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
            });
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 768) {
                if (!sidebar.contains(e.target) && !toggleSidebar.contains(e.target)) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });

        // Auto hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.3s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);

        // Close alert manually
        document.querySelectorAll('[role="alert"]').forEach(alert => {
            const closeBtn = document.createElement('button');
            closeBtn.innerHTML = '&times;';
            closeBtn.className = 'absolute top-0 right-0 px-4 py-3 text-xl font-bold';
            closeBtn.onclick = () => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            };
            alert.appendChild(closeBtn);
        });
    </script>
</body>

</html>