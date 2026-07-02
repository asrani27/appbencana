@extends('layouts.admin')

@section('title', 'Dashboard - SRMB Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang di panel administrasi')

@section('content')

<!-- Welcome Banner -->
<div class="mb-6 lg:mb-8">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-6 lg:p-8 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
        <div class="relative z-10">
            <h3 class="text-2xl lg:text-3xl font-bold mb-2">Selamat Datang, Administrator! 👋</h3>
            <p class="text-blue-100 text-sm lg:text-base">Sistem Rekam Medis Elektronik Bencana - Pantau dan kelola data
                korban
                bencana dengan mudah.</p>
        </div>
    </div>
</div>

<!-- Stats Cards - Menu Utama -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">

    <!-- Data Bencana -->
    <a href="{{ route('admin.bencana.index') }}"
        class="bg-white rounded-2xl p-5 lg:p-6 shadow-sm border border-gray-300 hover:shadow-md hover:border-red-200 transition-all group">
        <div class="flex items-center gap-4">
            <div
                class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform flex-shrink-0">
                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $stats['total_bencana'] }}</h4>
                <p class="text-sm text-gray-500 truncate">Data Bencana</p>
            </div>
            <svg class="w-5 h-5 text-gray-400 group-hover:text-red-500 transition-colors flex-shrink-0" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </a>

    <!-- Data Korban -->
    <a href="{{ route('admin.korban.index') }}"
        class="bg-white rounded-2xl p-5 lg:p-6 shadow-sm border border-gray-300 hover:shadow-md hover:border-blue-200 transition-all group">
        <div class="flex items-center gap-4">
            <div
                class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform flex-shrink-0">
                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $stats['total_korban'] }}</h4>
                <p class="text-sm text-gray-500 truncate">Data Korban</p>
            </div>
            <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors flex-shrink-0" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </a>

    <!-- Triase -->
    <a href="{{ route('admin.triase.index') }}"
        class="bg-white rounded-2xl p-5 lg:p-6 shadow-sm border border-gray-300 hover:shadow-md hover:border-orange-200 transition-all group">
        <div class="flex items-center gap-4">
            <div
                class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform flex-shrink-0">
                <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $stats['total_triase'] }}</h4>
                <p class="text-sm text-gray-500 truncate">Triase</p>
            </div>
            <svg class="w-5 h-5 text-gray-400 group-hover:text-orange-500 transition-colors flex-shrink-0" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </a>

    <!-- Rumah Sakit -->
    <a href="{{ route('admin.rumahsakit.index') }}"
        class="bg-white rounded-2xl p-5 lg:p-6 shadow-sm border border-gray-300 hover:shadow-md hover:border-purple-200 transition-all group">
        <div class="flex items-center gap-4">
            <div
                class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform flex-shrink-0">
                <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $stats['total_rumahsakit'] }}</h4>
                <p class="text-sm text-gray-500 truncate">Rumah Sakit</p>
            </div>
            <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-500 transition-colors flex-shrink-0" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </a>
</div>

<!-- Second Row Stats -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">

    <!-- Pemeriksaan Medis -->
    <a href="{{ route('admin.pemeriksaan.index') }}"
        class="bg-white rounded-2xl p-5 lg:p-6 shadow-sm border border-gray-300 hover:shadow-md hover:border-green-200 transition-all group">
        <div class="flex items-center gap-4">
            <div
                class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform flex-shrink-0">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $stats['total_pemeriksaan'] }}</h4>
                <p class="text-sm text-gray-500 truncate">Pemeriksaan</p>
            </div>
            <svg class="w-5 h-5 text-gray-400 group-hover:text-green-500 transition-colors flex-shrink-0" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </a>

    <!-- Rujukan -->
    <a href="{{ route('admin.rujukan.index') }}"
        class="bg-white rounded-2xl p-5 lg:p-6 shadow-sm border border-gray-300 hover:shadow-md hover:border-cyan-200 transition-all group">
        <div class="flex items-center gap-4">
            <div
                class="w-14 h-14 bg-cyan-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform flex-shrink-0">
                <svg class="w-7 h-7 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $stats['total_rujukan'] }}</h4>
                <p class="text-sm text-gray-500 truncate">Rujukan</p>
            </div>
            <svg class="w-5 h-5 text-gray-400 group-hover:text-cyan-500 transition-colors flex-shrink-0" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </a>

    <!-- Manajemen User -->
    <a href="{{ route('admin.users.index') }}"
        class="bg-white rounded-2xl p-5 lg:p-6 shadow-sm border border-gray-300 hover:shadow-md hover:border-indigo-200 transition-all group">
        <div class="flex items-center gap-4">
            <div
                class="w-14 h-14 bg-indigo-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform flex-shrink-0">
                <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $stats['total_users'] }}</h4>
                <p class="text-sm text-gray-500 truncate">User</p>
            </div>
            <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-500 transition-colors flex-shrink-0" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </a>

    <!-- Laporan -->
    <a href="{{ route('admin.laporan') }}"
        class="bg-white rounded-2xl p-5 lg:p-6 shadow-sm border border-gray-300 hover:shadow-md hover:border-yellow-200 transition-all group">
        <div class="flex items-center gap-4">
            <div
                class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform flex-shrink-0">
                <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-2xl lg:text-3xl font-bold text-gray-800">-</h4>
                <p class="text-sm text-gray-500 truncate">Laporan</p>
            </div>
            <svg class="w-5 h-5 text-gray-400 group-hover:text-yellow-500 transition-colors flex-shrink-0" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </a>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

    <!-- Recent Disasters Table -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-300">
            <h4 class="font-bold text-gray-800">Data Bencana Terbaru</h4>
            <a href="{{ route('admin.bencana.index') }}"
                class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Nama Bencana</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                            Jenis</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">
                            Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentBencana as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-medium text-gray-800">{{ $item->nama_bencana }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 hidden sm:table-cell">{{ $item->jenis_bencana }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->status === 'Aktif' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 hidden md:table-cell">{{ $item->tanggal_kejadian ?
                            $item->tanggal_kejadian->format('d M Y') : '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data bencana</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sidebar Stats -->
    <div class="space-y-6">

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-300 p-6">
            <h4 class="font-bold text-gray-800 mb-4">Aksi Cepat</h4>
            <div class="space-y-3">
                <a href="{{ route('admin.bencana.create') }}"
                    class="w-full flex items-center gap-3 px-4 py-3 bg-red-50 hover:bg-red-100 text-red-700 rounded-xl transition-colors font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    </svg>
                    <span>Tambah Bencana</span>
                </a>
                <a href="{{ route('admin.korban.create') }}"
                    class="w-full flex items-center gap-3 px-4 py-3 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-xl transition-colors font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <span>Tambah Korban</span>
                </a>
                <a href="{{ route('admin.pemeriksaan.create') }}"
                    class="w-full flex items-center gap-3 px-4 py-3 bg-green-50 hover:bg-green-100 text-green-700 rounded-xl transition-colors font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Pemeriksaan Medis</span>
                </a>
                <a href="{{ route('admin.laporan') }}"
                    class="w-full flex items-center gap-3 px-4 py-3 bg-purple-50 hover:bg-purple-100 text-purple-700 rounded-xl transition-colors font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Buat Laporan</span>
                </a>
            </div>
        </div>

        <!-- Disaster Distribution -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-300 p-6">
            <h4 class="font-bold text-gray-800 mb-4">Distribusi Jenis Bencana</h4>
            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-600">Banjir</span>
                        <span class="text-sm font-semibold text-gray-800">35%</span>
                    </div>
                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-500 rounded-full" style="width: 35%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-600">Gempa Bumi</span>
                        <span class="text-sm font-semibold text-gray-800">25%</span>
                    </div>
                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-orange-500 rounded-full" style="width: 25%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-600">Tsunami</span>
                        <span class="text-sm font-semibold text-gray-800">15%</span>
                    </div>
                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-red-500 rounded-full" style="width: 15%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-600">Letusan Gunung</span>
                        <span class="text-sm font-semibold text-gray-800">15%</span>
                    </div>
                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-purple-500 rounded-full" style="width: 15%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-600">Lainnya</span>
                        <span class="text-sm font-semibold text-gray-800">10%</span>
                    </div>
                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gray-500 rounded-full" style="width: 10%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-300 p-6">
            <h4 class="font-bold text-gray-800 mb-4">Aktivitas Terbaru</h4>
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-800 font-medium">Bencana Banjir Jakarta ditambahkan</p>
                        <p class="text-xs text-gray-500 mt-0.5">1 jam yang lalu</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-800 font-medium">Data korban baru ditambahkan</p>
                        <p class="text-xs text-gray-500 mt-0.5">3 jam yang lalu</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-800 font-medium">Pemeriksaan medis selesai</p>
                        <p class="text-xs text-gray-500 mt-0.5">5 jam yang lalu</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-cyan-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-800 font-medium">Rujukan pasien ke RS Umum</p>
                        <p class="text-xs text-gray-500 mt-0.5">6 jam yang lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    @media (max-width: 1024px) {
        main {
            padding-top: 4rem;
        }
    }
</style>
@endpush