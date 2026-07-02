<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin Dashboard - Sistem Rekam Medis Bencana">
    <title>@yield('title', 'Admin Dashboard') - SRMB</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/logo_baru.jpeg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @stack('styles')
</head>

<body class="bg-gray-50 font-sans">

    <!-- Mobile Header -->
    <header class="lg:hidden fixed top-0 left-0 right-0 bg-white shadow-sm z-40">
        <div class="flex items-center justify-between px-4 py-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center p-1">
                    <img src="{{ asset('logo/logo_baru.jpeg') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="font-bold text-gray-800 text-sm">SRMB</h1>
                    <p class="text-xs text-gray-500">Admin Panel</p>
                </div>
            </div>
            <button onclick="toggleSidebar()" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <svg id="menu-icon" class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="close-icon" class="w-6 h-6 text-gray-600 hidden" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </header>

    <!-- Overlay for mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <!-- Sidebar with Solid Blue Background -->
    <aside id="sidebar"
        class="fixed top-0 left-0 h-full w-72 bg-blue-700 shadow-2xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-50 flex flex-col overflow-hidden">

        <!-- Decorative Elements -->
        <div class="absolute top-20 right-0 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
        <div class="absolute bottom-40 left-0 w-32 h-32 bg-blue-400/10 rounded-full blur-xl"></div>

        <!-- Logo Section -->
        <div class="relative z-10 px-6 py-6">
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center p-2 shadow-lg">
                    <img src="{{ asset('logo/logo_baru.jpeg') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div class="text-white">
                    <h1 class="font-bold text-xl">RME</h1>
                    <p class="text-blue-200 text-xs">Rekam Medis Elektronik Bencana</p>
                </div>
            </div>
        </div>

        <!-- Navigation: dynamically loaded based on user role -->
        @php $role = auth()->user()->role ?? 'admin'; @endphp
        @if ($role === 'admin')
        @include('layouts.menu_admin')
        @elseif ($role === 'petugas')
        @include('layouts.menu_petugas')
        @elseif ($role === 'relawan')
        @include('layouts.menu_relawan')
        @elseif ($role === 'medis')
        @include('layouts.menu_medis')
        @else
        @include('layouts.menu_admin')
        @endif

        <!-- User Profile Section -->
        <div class="relative z-10 border-t border-white/10 p-4">
            <div class="flex items-center gap-3 p-3 bg-white/10 backdrop-blur-sm rounded-xl">
                <div
                    class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-blue-600 font-bold shadow-lg">
                    A
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-white text-sm truncate">Administrator</p>
                    <p class="text-xs text-blue-200 truncate">admin@srmb.id</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mt-3" id="logout-form">
                @csrf
                <button type="button" onclick="confirmLogout()"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-white/10 backdrop-blur-sm text-white hover:bg-white/20 rounded-xl transition-all duration-200 font-medium text-sm border border-white/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="lg:ml-72 min-h-screen pt-16 lg:pt-0">

        <!-- Top Header (Desktop) -->
        <header class="hidden lg:flex items-center justify-between bg-white shadow-sm px-8 py-4 sticky top-0 z-30">
            <div>
                <h2 class="text-xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                <p class="text-sm text-gray-500">@yield('page-subtitle', 'Selamat datang di panel admin')</p>
            </div>
            <div class="flex items-center gap-4">
                <!-- Search -->
                <div class="relative">
                    <input type="text" placeholder="Cari..."
                        class="w-64 pl-10 pr-4 py-2 bg-gray-100 border-0 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <!-- Notifications -->
                <button class="relative p-2 hover:bg-gray-100 rounded-xl transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- User Menu -->
                <div class="flex items-center gap-3 pl-4 border-l border-gray-200">
                    <div class="text-right">
                        <p class="font-semibold text-gray-800 text-sm">Administrator</p>
                        <p class="text-xs text-gray-500">Admin</p>
                    </div>
                    <div
                        class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold cursor-pointer">
                        A
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="p-4 lg:p-8">
            @yield('content')
        </div>
    </main>

    <!-- Mobile Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }

        function confirmLogout() {
            if (confirm('Apakah Anda yakin ingin keluar dari sistem?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>

    @stack('scripts')
</body>

</html>