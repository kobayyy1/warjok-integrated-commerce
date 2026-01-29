@extends('admin.panel')

@section('head')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <div class="flex items-center gap-4 mb-2">
                <a href="{{ route('admin.banners.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <h1 class="text-3xl font-bold text-gray-800">Tambah Banner Baru</h1>
            </div>
            @if(!auth()->user()->isSuperAdmin())
                <p class="text-gray-600 mt-1 ml-32">{{ auth()->user()->store->name }}</p>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(auth()->user()->isSuperAdmin())
                    <div class="mb-6">
                        <label for="store_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Toko <span class="text-red-500">*</span>
                        </label>
                        <select name="store_id" id="store_id" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('store_id') border-red-500 @enderror">
                            <option value="">Pilih Toko</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                    {{ $store->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('store_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Banner <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" 
                           value="{{ old('title') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                           placeholder="Masukkan judul banner">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                              placeholder="Deskripsi banner...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Banner <span class="text-red-500">*</span>
                    </label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image') border-red-500 @enderror"
                           onchange="previewImage(event)">
                    <p class="text-gray-500 text-sm mt-1">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB</p>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    
                    <div id="imagePreview" class="mt-3 hidden">
                        <img src="" alt="Preview" class="max-w-xs rounded shadow">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="link" class="block text-sm font-medium text-gray-700 mb-2">
                        Link (URL)
                    </label>
                    <input type="url" name="link" id="link" 
                           value="{{ old('link') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('link') border-red-500 @enderror"
                           placeholder="https://example.com">
                    @error('link')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                        Urutan
                    </label>
                    <input type="number" name="order" id="order" 
                           value="{{ old('order', 0) }}" min="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('order') border-red-500 @enderror"
                           placeholder="0">
                    @error('order')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        <i class="fas fa-save mr-2"></i> Simpan Banner
                    </button>
                    <a href="{{ route('admin.banners.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const img = preview.querySelector('img');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
    }
}
</script>
@endsection