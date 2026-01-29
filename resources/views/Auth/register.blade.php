<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Warung Pojok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .gradient-bg {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #4facfe);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

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

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="glass-effect rounded-2xl shadow-2xl p-8 animate-fade-in-up">
            <!-- Logo/Header -->
            <div class="text-center mb-8">
                <div class="inline-block p-4 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full mb-4">
                    <i class="fas fa-user-plus text-4xl text-white"></i>
                </div>
                <h1
                    class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent mb-2">
                    Daftar Akun Baru
                </h1>
                <p class="text-gray-600">Bergabung dengan Warung Pojok</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                        <span class="font-semibold">Terjadi kesalahan:</span>
                    </div>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Register Form -->
            <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user text-purple-600 mr-2"></i>Nama Lengkap
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                        placeholder="Masukkan nama lengkap" required autofocus>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-purple-600 mr-2"></i>Email
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                        placeholder="nama@email.com" required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-purple-600 mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                            placeholder="Minimal 6 karakter (huruf & angka)" required>
                        <button type="button" onclick="togglePassword('password')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                            <i id="toggleIconPassword" class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Minimal 6 karakter, harus mengandung huruf dan angka</p>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-purple-600 mr-2"></i>Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                            placeholder="Ulangi password" required>
                        <button type="button" onclick="togglePassword('password_confirmation')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                            <i id="toggleIconPasswordConfirmation" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="flex items-start">
                    <input type="checkbox" id="terms" name="terms"
                        class="w-4 h-4 mt-1 text-purple-600 border-gray-300 rounded focus:ring-purple-500" required>
                    <label for="terms" class="ml-2 text-sm text-gray-700">
                        Saya setuju dengan
                        <a href="#" class="text-purple-600 hover:text-purple-800 font-semibold">
                            Syarat & Ketentuan
                        </a>
                        dan
                        <a href="#" class="text-purple-600 hover:text-purple-800 font-semibold">
                            Kebijakan Privasi
                        </a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-purple-600 to-blue-600 text-white font-semibold py-3 rounded-lg hover:from-purple-700 hover:to-blue-700 transform hover:scale-[1.02] transition-all shadow-lg hover:shadow-xl">
                    <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500">atau</span>
                </div>
            </div>

            <!-- Login Link -->
            <div class="text-center">
                <p class="text-gray-600 text-sm">
                    Sudah punya akun?
                    <a href="{{ route('login.user') }}"
                        class="text-purple-600 hover:text-purple-800 font-semibold transition-colors">
                        Masuk di sini
                    </a>
                </p>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-6 pt-6 border-t border-gray-200">
                <a href="{{ route('home') }}"
                    class="text-gray-600 hover:text-purple-600 text-sm transition-colors inline-flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6 text-white/80 text-sm">
            <p>&copy; 2025 Warung Pojok. All rights reserved.</p>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const iconId = fieldId === 'password' ? 'toggleIconPassword' : 'toggleIconPasswordConfirmation';
            const toggleIcon = document.getElementById(iconId);

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const hasLetter = /[a-zA-Z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const isLongEnough = password.length >= 6;

            if (hasLetter && hasNumber && isLongEnough) {
                e.target.classList.remove('border-red-500', 'border-yellow-500');
                e.target.classList.add('border-green-500');
            } else if (password.length > 0) {
                e.target.classList.remove('border-green-500', 'border-red-500');
                e.target.classList.add('border-yellow-500');
            }
        });

        // Confirm password validation
        document.getElementById('password_confirmation').addEventListener('input', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = e.target.value;

            if (confirmPassword === password && confirmPassword.length > 0) {
                e.target.classList.remove('border-red-500');
                e.target.classList.add('border-green-500');
            } else if (confirmPassword.length > 0) {
                e.target.classList.remove('border-green-500');
                e.target.classList.add('border-red-500');
            }
        });
    </script>
</body>

</html>
