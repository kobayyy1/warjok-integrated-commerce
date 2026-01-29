<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Koprol Coffee</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-amber-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-coffee text-white text-3xl"></i>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-gray-900">Tambah Produk Baru</h2>
                <p class="mt-2 text-gray-600">Isi form di bawah untuk menambahkan produk kopi</p>
            </div>

            <!-- Alert Success -->
            <div id="alertSuccess" class="hidden mb-6 bg-green-50 border border-green-200 text-green-800 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <div>
                        <p class="font-semibold">Berhasil!</p>
                        <p class="text-sm" id="successMessage"></p>
                    </div>
                </div>
            </div>

            <!-- Alert Error -->
            <div id="alertError" class="hidden mb-6 bg-red-50 border border-red-200 text-red-800 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                    <div>
                        <p class="font-semibold">Error!</p>
                        <p class="text-sm" id="errorMessage"></p>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <form id="createProductForm" enctype="multipart/form-data">
                    @csrf
                    <div class="p-8 space-y-6">
                        
                        <!-- Nama Produk -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-mug-hot text-amber-600 mr-2"></i>Nama Produk *
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                required
                                placeholder="Contoh: Kopi Susu Koproll"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all"
                            >
                            <p class="mt-1 text-xs text-gray-500">Maksimal 255 karakter</p>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-align-left text-amber-600 mr-2"></i>Deskripsi *
                            </label>
                            <textarea 
                                id="description" 
                                name="description" 
                                rows="4"
                                required
                                placeholder="Ceritakan tentang produk kopi ini..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all resize-none"
                            ></textarea>
                            <p class="mt-1 text-xs text-gray-500">Jelaskan keunikan dan rasa produk</p>
                        </div>

                        <!-- Harga -->
                        <div>
                            <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-tag text-amber-600 mr-2"></i>Harga *
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-gray-500 font-semibold">Rp</span>
                                <input 
                                    type="number" 
                                    id="price" 
                                    name="price" 
                                    required
                                    min="0"
                                    step="1000"
                                    placeholder="0"
                                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all"
                                >
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Masukkan harga dalam rupiah (kelipatan 1000)</p>
                        </div>

                        <!-- Upload Gambar -->
                        <div>
                            <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-image text-amber-600 mr-2"></i>Gambar Produk
                            </label>
                            <div class="mt-2">
                                <div class="flex items-center justify-center w-full">
                                    <label for="image" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all">
                                        <div id="uploadPlaceholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 mb-4"></i>
                                            <p class="mb-2 text-sm text-gray-500">
                                                <span class="font-semibold">Klik untuk upload</span> atau drag and drop
                                            </p>
                                            <p class="text-xs text-gray-500">PNG, JPG, JPEG, GIF (MAX. 2MB)</p>
                                        </div>
                                        <div id="imagePreview" class="hidden w-full h-full p-4">
                                            <img id="preview" src="" alt="Preview" class="w-full h-full object-contain rounded-lg">
                                        </div>
                                        <input 
                                            id="image" 
                                            name="image" 
                                            type="file" 
                                            class="hidden" 
                                            accept="image/png,image/jpeg,image/jpg,image/gif"
                                            onchange="previewImage(event)"
                                        />
                                    </label>
                                </div>
                                <p class="mt-2 text-xs text-gray-500">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Gambar akan ditampilkan di website Koprol Coffee
                                </p>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                            <div class="flex">
                                <i class="fas fa-lightbulb text-amber-600 mt-1 mr-3"></i>
                                <div class="text-sm text-amber-800">
                                    <p class="font-semibold mb-1">Tips:</p>
                                    <ul class="list-disc list-inside space-y-1 text-xs">
                                        <li>Gunakan nama yang menarik dan mudah diingat</li>
                                        <li>Deskripsikan rasa dan keunikan produk dengan jelas</li>
                                        <li>Upload gambar berkualitas tinggi untuk tampilan yang menarik</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Form Actions -->
                    <div class="bg-gray-50 px-8 py-4 flex flex-col sm:flex-row gap-3 sm:gap-4">
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="flex-1 bg-amber-600 hover:bg-amber-700 text-white font-bold py-3 px-6 rounded-lg transition-all transform hover:scale-105 shadow-lg flex items-center justify-center"
                        >
                            <i class="fas fa-save mr-2"></i>
                            <span id="submitText">Simpan Produk</span>
                            <i class="fas fa-spinner fa-spin ml-2 hidden" id="loadingSpinner"></i>
                        </button>
                        <a 
                            href="{{ route('admin.dashboard') }}" 
                            class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg transition-all text-center flex items-center justify-center"
                        >
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>

            <!-- Preview Card -->
            <div id="previewCard" class="hidden mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 bg-gradient-to-r from-amber-500 to-amber-600">
                    <h3 class="text-white font-bold text-lg flex items-center">
                        <i class="fas fa-eye mr-2"></i>
                        Preview Produk
                    </h3>
                </div>
                <div class="p-6">
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg">
                        <div id="previewImageContainer" class="h-56 bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-5xl"></i>
                        </div>
                        <div class="p-6">
                            <h3 id="previewName" class="text-2xl font-bold text-gray-800 mb-2">-</h3>
                            <p id="previewDescription" class="text-gray-600 mb-4">-</p>
                            <div class="flex justify-between items-center">
                                <span id="previewPrice" class="text-amber-700 font-bold text-xl">Rp 0</span>
                                <span class="text-sm text-gray-500">★★★★★</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview Image Function
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                // Validate file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    showError('Ukuran gambar terlalu besar. Maksimal 2MB');
                    event.target.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('uploadPlaceholder').classList.add('hidden');
                    document.getElementById('imagePreview').classList.remove('hidden');
                    document.getElementById('preview').src = e.target.result;
                    
                    // Update preview card
                    updatePreview();
                }
                reader.readAsDataURL(file);
            }
        }

        // Update Preview Card
        function updatePreview() {
            const name = document.getElementById('name').value;
            const description = document.getElementById('description').value;
            const price = document.getElementById('price').value;
            const imageSrc = document.getElementById('preview').src;

            if (name || description || price) {
                document.getElementById('previewCard').classList.remove('hidden');
                
                document.getElementById('previewName').textContent = name || '-';
                document.getElementById('previewDescription').textContent = description || '-';
                document.getElementById('previewPrice').textContent = price ? 
                    'Rp ' + parseInt(price).toLocaleString('id-ID') : 'Rp 0';
                
                if (imageSrc && imageSrc !== window.location.href) {
                    const container = document.getElementById('previewImageContainer');
                    container.innerHTML = `<img src="${imageSrc}" class="w-full h-full object-cover">`;
                }
            }
        }

        // Listen to input changes for live preview
        document.getElementById('name').addEventListener('input', updatePreview);
        document.getElementById('description').addEventListener('input', updatePreview);
        document.getElementById('price').addEventListener('input', updatePreview);

        // Show Success Alert
        function showSuccess(message) {
            const alert = document.getElementById('alertSuccess');
            document.getElementById('successMessage').textContent = message;
            alert.classList.remove('hidden');
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                alert.classList.add('hidden');
            }, 5000);
        }

        // Show Error Alert
        function showError(message) {
            const alert = document.getElementById('alertError');
            document.getElementById('errorMessage').textContent = message;
            alert.classList.remove('hidden');
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                alert.classList.add('hidden');
            }, 5000);
        }

        // Form Submit Handler
        document.getElementById('createProductForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            
            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            submitText.textContent = 'Menyimpan...';
            loadingSpinner.classList.remove('hidden');
            
            // Hide previous alerts
            document.getElementById('alertSuccess').classList.add('hidden');
            document.getElementById('alertError').classList.add('hidden');
            
            try {
                const formData = new FormData(this);
                
                const response = await fetch('/api/products', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formData
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    showSuccess(data.message || 'Produk berhasil ditambahkan!');
                    
                    // Reset form
                    this.reset();
                    document.getElementById('uploadPlaceholder').classList.remove('hidden');
                    document.getElementById('imagePreview').classList.add('hidden');
                    document.getElementById('previewCard').classList.add('hidden');
                    
                    // Redirect after 2 seconds
                    setTimeout(() => {
                        window.location.href = '{{ route("admin.dashboard") }}';
                    }, 2000);
                } else {
                    let errorMsg = data.message || 'Terjadi kesalahan';
                    
                    // Handle validation errors
                    if (data.errors) {
                        errorMsg = Object.values(data.errors).flat().join(', ');
                    }
                    
                    showError(errorMsg);
                }
            } catch (error) {
                console.error('Error:', error);
                showError('Terjadi kesalahan saat menghubungi server');
            } finally {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                submitText.textContent = 'Simpan Produk';
                loadingSpinner.classList.add('hidden');
            }
        });

        // Format currency input
        document.getElementById('price').addEventListener('input', function(e) {
            let value = e.target.value;
            // Remove non-numeric characters
            value = value.replace(/\D/g, '');
            e.target.value = value;
        });
    </script>
</body>
</html>