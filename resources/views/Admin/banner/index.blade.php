@extends('admin.panel')

@section('head')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Kelola Banner</h1>
        </div>
        <a href="{{ route('admin.banners.create') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i> Tambah Banner
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Preview
                    </th>
                    @if(auth()->user()->isSuperAdmin())
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Toko
                    </th>
                    @endif
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Judul
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Deskripsi
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Link
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Urutan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($banners as $banner)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{ $banner->image_url }}" 
                                 alt="{{ $banner->title }}" 
                                 class="w-24 h-16 object-cover rounded">
                        </td>
                        @if(auth()->user()->isSuperAdmin())
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $banner->store->name }}</div>
                        </td>
                        @endif
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $banner->title }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500">{{ Str::limit($banner->description, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($banner->link)
                                <a href="{{ $banner->link }}" target="_blank" class="text-blue-600 hover:text-blue-900 text-sm">
                                    <i class="fas fa-external-link-alt"></i> Link
                                </a>
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $banner->order }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.banners.toggle-status', $banner) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="focus:outline-none">
                                    @if($banner->status === 'active')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 cursor-pointer hover:bg-green-200">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 cursor-pointer hover:bg-red-200">
                                            Nonaktif
                                        </span>
                                    @endif
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.banners.edit', $banner) }}" 
                                   class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:bg-blue-100 rounded-lg transition-all duration-200"
                                   title="Edit Banner">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.banners.destroy', $banner) }}" 
                                      method="POST" 
                                      class="inline-block"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner {{ $banner->title }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:bg-red-100 rounded-lg transition-all duration-200"
                                            title="Hapus Banner">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->isSuperAdmin() ? '8' : '7' }}" 
                            class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <i class="fas fa-image text-6xl mb-4 text-gray-300"></i>
                                <p class="text-lg font-semibold mb-2">Belum ada banner</p>
                                <p class="text-sm mb-4">Mulai tambahkan banner pertama Anda</p>
                                <a href="{{ route('admin.banners.create') }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors inline-flex items-center">
                                    <i class="fas fa-plus mr-2"></i> Tambah Banner
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($banners->hasPages())
        <div class="mt-4">
            {{ $banners->links() }}
        </div>
    @endif
</div>
@endsection