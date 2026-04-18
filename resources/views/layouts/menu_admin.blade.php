<nav class="flex-1 overflow-y-auto py-4 px-4 relative z-10">

    {{-- Menu Utama --}}
    <div class="space-y-1">
        <span class="text-xs font-semibold text-blue-200 uppercase tracking-wider px-3 mb-2 block">Menu Utama</span>

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 text-white backdrop-blur-sm' : 'text-blue-100 hover:bg-white/10' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        {{-- Manajemen Bencana --}}
        <a href="{{ route('admin.bencana.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.bencana*') ? 'bg-white/20 text-white backdrop-blur-sm' : 'text-blue-100 hover:bg-white/10' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
            </svg>
            <span class="font-medium">Data Bencana</span>
        </a>

        {{-- Data Korban --}}
        <a href="{{ route('admin.korban.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.korban*') ? 'bg-white/20 text-white backdrop-blur-sm' : 'text-blue-100 hover:bg-white/10' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="font-medium">Data Korban</span>
        </a>

        {{-- Triase --}}
        <a href="{{ route('admin.triase.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.triase*') ? 'bg-white/20 text-white backdrop-blur-sm' : 'text-blue-100 hover:bg-white/10' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            <span class="font-medium">Triase</span>
        </a>

        {{-- Pemeriksaan Medis --}}
        <a href="{{ route('admin.pemeriksaan.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.pemeriksaan*') ? 'bg-white/20 text-white backdrop-blur-sm' : 'text-blue-100 hover:bg-white/10' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="font-medium">Pemeriksaan Medis</span>
        </a>

        {{-- Rujukan --}}
        <a href="{{ route('admin.rujukan.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.rujukan*') ? 'bg-white/20 text-white backdrop-blur-sm' : 'text-blue-100 hover:bg-white/10' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
            </svg>
            <span class="font-medium">Rujukan</span>
        </a>

        {{-- Rumah Sakit --}}
        <a href="{{ route('admin.rumahsakit.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.rumahsakit*') ? 'bg-white/20 text-white backdrop-blur-sm' : 'text-blue-100 hover:bg-white/10' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <span class="font-medium">Rumah Sakit</span>
        </a>

        {{-- Laporan --}}
        <a href="{{ route('admin.laporan') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.laporan*') ? 'bg-white/20 text-white backdrop-blur-sm' : 'text-blue-100 hover:bg-white/10' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="font-medium">Laporan</span>
        </a>
    </div>

    {{-- Menu Pengaturan --}}
    <div class="mt-6 pt-4 border-t border-white/10 space-y-1">
        <span class="text-xs font-semibold text-blue-200 uppercase tracking-wider px-3 mb-2 block">Pengaturan</span>

        {{-- Manajemen User --}}
        <a href="{{ route('admin.users.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.users*') ? 'bg-white/20 text-white backdrop-blur-sm' : 'text-blue-100 hover:bg-white/10' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
            </svg>
            <span class="font-medium">Manajemen User</span>
        </a>

        {{-- API Dokumentasi --}}
        <a href="{{ route('admin.api-docs') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.api-docs*') ? 'bg-white/20 text-white backdrop-blur-sm' : 'text-blue-100 hover:bg-white/10' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
            </svg>
            <span class="font-medium">API Dokumentasi</span>
        </a>



    </div>

</nav>