@extends('layouts.admin')

@section('head', isset($heroVideo) ? 'Edit Video Hero' : 'Tambah Video Hero')

@section('body')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                {{ isset($heroVideo) ? 'Edit Video Hero' : 'Tambah Video Hero' }}
            </h1>
            <a href="{{ route('admin.hero-videos.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ isset($heroVideo) ? route('admin.hero-videos.update', $heroVideo) : route('admin.hero-videos.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @if(isset($heroVideo))
                    @method('PUT')
                @endif

                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
                        Judul Video <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title', $heroVideo->title ?? '') }}"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror"
                           required>
                    @error('title')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="3"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"
                              required>{{ old('description', $heroVideo->description ?? '') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video Upload -->
                <div class="mb-4">
                    <label for="video" class="block text-gray-700 text-sm font-bold mb-2">
                        Video File {{ isset($heroVideo) ? '(Kosongkan jika tidak ingin mengubah)' : '' }} <span class="text-red-500">{{ isset($heroVideo) ? '' : '*' }}</span>
                    </label>
                    <input type="file" 
                           name="video" 
                           id="video" 
                           accept="video/mp4,video/mov,video/avi,video/wmv"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('video') border-red-500 @enderror"
                           {{ isset($heroVideo) ? '' : 'required' }}>
                    @if(isset($heroVideo))
                        <p class="text-gray-600 text-xs mt-1">Video saat ini: {{ basename($heroVideo->video_path) }}</p>
                    @endif
                    <p class="text-gray-600 text-xs mt-1">Format: MP4, MOV, AVI, WMV. Max: 100MB</p>
                    @error('video')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Thumbnail Upload -->
                <div class="mb-4">
                    <label for="thumbnail" class="block text-gray-700 text-sm font-bold mb-2">
                        Thumbnail (Opsional)
                    </label>
                    <input type="file" 
                           name="thumbnail" 
                           id="thumbnail" 
                           accept="image/jpeg,image/png,image/jpg,image/gif"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('thumbnail') border-red-500 @enderror">
                    @if(isset($heroVideo) && $heroVideo->thumbnail_path)
                        <p class="text-gray-600 text-xs mt-1">Thumbnail saat ini: {{ basename($heroVideo->thumbnail_path) }}</p>
                    @endif
                    <p class="text-gray-600 text-xs mt-1">Format: JPEG, PNG, JPG, GIF. Max: 2MB</p>
                    @error('thumbnail')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Position -->
                <div class="mb-4">
                    <label for="position" class="block text-gray-700 text-sm font-bold mb-2">
                        Posisi (Urutan) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           name="position" 
                           id="position" 
                           value="{{ old('position', $heroVideo->position ?? 0) }}"
                           min="0"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('position') border-red-500 @enderror"
                           required>
                    <p class="text-gray-600 text-xs mt-1">0 = paling kiri, angka lebih besar = lebih ke kanan</p>
                    @error('position')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Checkboxes -->
                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="is_background" 
                               value="1"
                               {{ old('is_background', $heroVideo->is_background ?? false) ? 'checked' : '' }}
                               class="mr-2">
                        <span class="text-gray-700 text-sm font-bold">Video Background</span>
                    </label>
                    <p class="text-gray-600 text-xs mt-1 ml-6">Centang jika video ini digunakan sebagai background</p>
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="is_active" 
                               value="1"
                               {{ old('is_active', $heroVideo->is_active ?? true) ? 'checked' : '' }}
                               class="mr-2">
                        <span class="text-gray-700 text-sm font-bold">Aktifkan Video</span>
                    </label>
                    <p class="text-gray-600 text-xs mt-1 ml-6">Centang untuk menampilkan video di halaman utama</p>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between">
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        <i class="fas fa-save mr-2"></i> {{ isset($heroVideo) ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
