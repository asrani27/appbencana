<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - Sistem Rekam Medis Bencana</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/logo_baru.jpeg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col justify-between">

    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-sm">
        <div class="max-w-4xl mx-auto px-4 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center p-1">
                    <img src="{{ asset('logo/logo_baru.jpeg') }}" alt="Logo" class="w-full h-full object-contain rounded-lg">
                </div>
                <div>
                    <a href="{{ url('/') }}" class="text-lg font-bold text-slate-900 hover:text-blue-600">SRMB</a>
                    <p class="text-xs text-slate-500 hidden sm:block">Sistem Rekam Medis Bencana</p>
                </div>
            </div>
            <nav>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-100 rounded-lg">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="flex-grow py-12 px-4">
        <div class="max-w-2xl mx-auto space-y-6">
            
            <div class="text-center space-y-2">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                    Hubungi Kami
                </span>
                <h1 class="text-3xl font-extrabold text-slate-900">Contact Us</h1>
                <p class="text-slate-600 text-sm">Informasi kontak narahubung resmi Sistem Rekam Medis Bencana.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white flex items-center gap-4">
                    <div class="w-14 h-14 bg-white text-blue-600 rounded-2xl flex items-center justify-center font-bold text-2xl shadow">
                        H
                    </div>
                    <div>
                        <div class="text-xs uppercase tracking-wider font-semibold text-blue-200">Kontak Person</div>
                        <h2 class="text-2xl font-bold">Hastin</h2>
                        <p class="text-blue-100 text-sm">Administrator / Support</p>
                    </div>
                </div>

                <div class="p-6 space-y-4">
                    <div class="p-4 bg-slate-50 rounded-xl flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 font-semibold uppercase block">Nama</span>
                            <span class="text-lg font-bold text-slate-800">Hastin</span>
                        </div>
                        <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-emerald-100 text-emerald-800">Aktif</span>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-xl flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div>
                            <span class="text-xs text-slate-400 font-semibold uppercase block">Email</span>
                            <a href="mailto:hastinatasasih87@gmail.com" class="text-base font-semibold text-blue-600 hover:underline">
                                hastinatasasih87@gmail.com
                            </a>
                        </div>
                        <a href="mailto:hastinatasasih87@gmail.com" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-lg w-fit">
                            Kirim Email
                        </a>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-xl flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div>
                            <span class="text-xs text-slate-400 font-semibold uppercase block">Phone</span>
                            <a href="tel:085176736655" class="text-base font-semibold text-slate-800 hover:text-blue-600">
                                0851 7673 6655
                            </a>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="https://wa.me/6285176736655" target="_blank" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-emerald-700 bg-emerald-100 hover:bg-emerald-200 rounded-lg">
                                WhatsApp
                            </a>
                            <a href="tel:085176736655" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-slate-700 bg-slate-200 hover:bg-slate-300 rounded-lg">
                                Telepon
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center pt-2">
                <a href="{{ url('/') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                    &larr; Kembali ke Beranda
                </a>
            </div>

        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 py-4 text-center text-xs text-slate-500">
        <p>&copy; {{ date('Y') }} Sistem Rekam Medis Bencana. All rights reserved.</p>
    </footer>

</body>
</html>
