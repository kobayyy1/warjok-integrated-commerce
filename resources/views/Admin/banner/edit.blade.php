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
                <h1 class="text-3xl font-bold text-gray-800">Edit Banner</h1>
            </div>
            @if(!auth()->user()->isSuperAdmin())
                <p class="text-gray-600 mt-1 ml-32">{{ auth()->user()->store->name }}</p>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if(auth()->user()->isSuperAdmin())
                    <div class="mb-6">
                        <label for="store_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Toko <span class="text-red-500">*</span>
                        </label>
                        <select name="store_id" id="store_id" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('store_id') border-red-500 @enderror">
                            <option value="">Pilih Toko</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}" 
                                        {{ old('store_id', $banner->store_id) == $store->id ? 'selected' : '' }}>
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
                           value="{{ old('title', $banner->title) }}"
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
                              placeholder="Deskripsi banner...">{{ old('description', $banner->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Banner
                    </label>
                    
                    <div class="mb-3">
                        <img src="{{ $banner->image_url }}" alt="Current Banner" class="max-w-xs rounded shadow">
                        <p class="text-sm text-gray-600 mt-1">Gambar saat ini</p>
                    </div>
                    
                    <input type="file" name="image" id="image" accept