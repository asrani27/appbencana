<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Rekam Medis Bencana">
    <title>Login - Sistem Rekam Medis Bencana</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/logo_baru.jpeg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 25%, #3b82f6 50%, #60a5fa 75%, #93c5fd 100%);
            min-height: 100vh;
        }
    </style>
</head>

<body class="min-h-screen">

    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- Left Side - Branding Section (Hidden on mobile, visible on lg+) -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            <!-- Decorative Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <defs>
                        <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                            <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5" />
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid)" />
                </svg>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute top-20 right-32 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-20 w-48 h-48 bg-blue-400/20 rounded-full blur-2xl"></div>
            <div
                class="absolute top-1/2 left-1/3 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-blue-300/10 rounded-full blur-3xl">
            </div>

            <!-- Content -->
            <div class="relative z-10 flex flex-col justify-center px-12 xl:px-20">
                <!-- Logo Area -->
                <div class="mb-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-24 h-24 bg-white rounded-2xl shadow-lg flex items-center justify-center p-2">
                            <img src="{{ asset('logo/logo_baru.jpeg') }}" alt="Logo"
                                class="w-full h-full object-contain">
                        </div>
                        <div>
                            <h1 class="text-5xl font-bold text-white">RME</h1>
                            <p class="text-sm text-blue-200">Rekam Medis Elektronik Bencana</p>
                        </div>
                    </div>
                </div>

                <!-- Main Text -->
                <h2 class="text-4xl xl:text-5xl font-bold leading-tight mb-6 text-white">
                    Sistem Rekam Medis Elektronik Bencana<br />

                </h2>

                <p class="text-lg text-blue-200 mb-8 max-w-md">
                    Platform informasi berbasis web untuk mengelola data rekam medis korban bencana secara terintegrasi
                    dan efisien.
                </p>

                <!-- Feature List -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="font-medium text-white">Pencatatan Data Korban</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="font-medium text-white">Pemantauan Status Kesehatan</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="font-medium text-white">Laporan & Analisis Data</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form (Merged with left side, no visible divider) -->
        <div class="flex-1 flex items-center justify-center p-6 sm:p-12 relative overflow-hidden">
            <!-- Decorative Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <defs>
                        <pattern id="grid2" width="10" height="10" patternUnits="userSpaceOnUse">
                            <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5" />
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid2)" />
                </svg>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute bottom-20 right-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute top-20 left-0 w-48 h-48 bg-blue-400/20 rounded-full blur-2xl"></div>

            <div class="w-full max-w-md relative z-10">

                <!-- Mobile Logo (Only visible on mobile) -->
                <div class="lg:hidden text-center mb-8">
                    <div class="inline-flex items-center gap-3 mb-4">
                        <div class="w-16 h-16 bg-white rounded-2xl shadow-lg flex items-center justify-center p-2">
                            <img src="{{ asset('logo/logo_baru.jpeg') }}" alt="Logo"
                                class="w-full h-full object-contain">
                        </div>
                    </div>
                    <h1 class="text-xl font-bold text-white">Sistem Rekam Medis Bencana</h1>
                    <p class="text-sm text-blue-200 mt-1">SRMB - Sistem Informasi Rekam Medis</p>
                </div>

                <!-- Login Card with White Background -->
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-4 border-b-2 border-black-600">
                        <h3 class="text-xl font-semibold">Selamat Datang</h3>
                        <p class="text-blue-800 text-sm mt-1">Silakan masuk untuk melanjutkan</p>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">

                        <!-- Error Messages -->
                        @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="text-sm text-red-700">
                                    <p class="font-medium">Login gagal</p>
                                    <p class="mt-1">{{ $errors->first() }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if (session('status'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-green-700">{{ session('status') }}</span>
                            </div>
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-yellow-700">{{ session('error') }}</span>
                            </div>
                        </div>
                        @endif

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                            @csrf

                            <!-- Username Field -->
                            <div>
                                <label for="username" class="block text-sm font-semibold text-blue-900 mb-2">
                                    Username
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="username" id="username" value="{{ old('username') }}"
                                        required autofocus autocomplete="username" placeholder="Masukkan username"
                                        class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-blue-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 focus:bg-white transition-all duration-200 @error('username') border-red-400 @enderror" />
                                </div>
                                @error('username')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div>
                                <label for="password" class="block text-sm font-semibold text-blue-900 mb-2">
                                    Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input type="password" name="password" id="password" required
                                        autocomplete="current-password" placeholder="Masukkan password"
                                        class="w-full pl-12 pr-12 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-blue-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 focus:bg-white transition-all duration-200 @error('password') border-red-400 @enderror" />
                                    <!-- Toggle Password Visibility -->
                                    <button type="button" onclick="togglePassword()"
                                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-blue-600 transition-colors">
                                        <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <svg id="eye-off-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="flex items-center justify-between">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked'
                                        : '' }}
                                        class="w-4 h-4 text-blue-600 bg-gray-50 border-gray-300 rounded focus:ring-blue-400 focus:ring-2" />
                                    <span class="text-sm text-blue-700">Ingat saya</span>
                                </label>
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                    Lupa password?
                                </a>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full py-3.5 px-4 bg-blue-600 text-white hover:bg-blue-700 font-semibold rounded-xl shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition-all duration-200 flex items-center justify-center gap-2">
                                <span>Masuk</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </form>

                        <!-- Register Link -->
                        @if (Route::has('register'))
                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600">
                                Belum punya akun?
                                <a href="{{ route('register') }}"
                                    class="text-blue-600 hover:text-blue-800 font-semibold hover:underline">
                                    Daftar sekarang
                                </a>
                            </p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-8 text-center">
                    <p class="text-sm text-white/60">
                        &copy; {{ date('Y') }} Sistem Rekam Medis Elektronik Bencana
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Toggle Script -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeOffIcon = document.getElementById('eye-off-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        }
    </script>
</body>

</html>