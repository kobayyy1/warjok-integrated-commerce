@extends('admin.panel')

@section('head')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Tambah Produk Baru</h1>
            @if(!auth()->user()->isSuperAdmin())
                <p class="text-gray-600 mt-1">{{ auth()->user()->store->name }}</p>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(auth()->user()->isSuperAdmin())
                    <div class="mb-6">
                        <label for="store_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Toko <span class="text-red-500">*</span>
                        </label>
                        <select name="store_id" id="store_id" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('store_id') border-red-500 @enderror">
                            <option value="">Pilih Toko</option>
                            @foreach(\App\Models\Store::all() as $store)
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
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                           placeholder="Contoh: Indomie Goreng">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="sku" class="block text-sm font-medium text-gray-700 mb-2">
                        SKU <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="sku" id="sku" value="{{ old('sku') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('sku') border-red-500 @enderror"
                           placeholder="Contoh: INDO-001">
                    @error('sku')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                              placeholder="Deskripsi produk...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                            Harga <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('price') border-red-500 @enderror"
                               placeholder="0">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                            Stok <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('stock') border-red-500 @enderror"
                               placeholder="0">
                        @error('stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Produk
                    </label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image') border-red-500 @enderror">
                    <p class="text-gray-500 text-sm mt-1">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Simpan Produk
                    </button>
                    <a href="{{ route('admin.products.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection