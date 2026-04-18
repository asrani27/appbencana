@extends('layouts.admin')

@section('title', 'Laporan - Sistem Informasi Bencana')

@section('content')
<div class="p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-boldmb-2">📊 Laporan</h1>
        <p class="text-gray-500">Pilih jenis laporan yang ingin dibuat</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Data Bencana --}}
        <a href="{{ route('admin.laporan.bencana') }}"
            class="bg-gradient-to-br from-red-600 to-red-800 rounded-2xl p-6 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-red-500/30">
            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Data Bencana</h3>
            <p class="text-red-100 text-sm">Laporan semua data bencana yang tercatat dalam sistem</p>
            <div class="mt-4 flex items-center text-white/80 text-sm">
                <span>Lihat Laporan</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </a>

        {{-- Data Korban --}}
        <a href="{{ route('admin.laporan.korban') }}"
            class="bg-gradient-to-br from-orange-600 to-orange-800 rounded-2xl p-6 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-orange-500/30">
            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Data Korban</h3>
            <p class="text-orange-100 text-sm">Laporan data korban bencana berdasarkan filtering</p>
            <div class="mt-4 flex items-center text-white/80 text-sm">
                <span>Lihat Laporan</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </a>

        {{-- Triase --}}
        <a href="{{ route('admin.laporan.triase') }}"
            class="bg-gradient-to-br from-yellow-600 to-yellow-800 rounded-2xl p-6 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-yellow-500/30">
            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Triase</h3>
            <p class="text-yellow-100 text-sm">Laporan categorisasi triase korban bencana</p>
            <div class="mt-4 flex items-center text-white/80 text-sm">
                <span>Lihat Laporan</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </a>

        {{-- Pemeriksaan Medis --}}
        <a href="{{ route('admin.laporan.pemeriksaan') }}"
            class="bg-gradient-to-br from-green-600 to-green-800 rounded-2xl p-6 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-green-500/30">
            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Pemeriksaan Medis</h3>
            <p class="text-green-100 text-sm">Laporan hasil pemeriksaan medis korban</p>
            <div class="mt-4 flex items-center text-white/80 text-sm">
                <span>Lihat Laporan</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </a>

        {{-- Rujukan --}}
        <a href="{{ route('admin.laporan.rujukan') }}"
            class="bg-gradient-to-br from-purple-600 to-purple-800 rounded-2xl p-6 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-purple-500/30">
            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Rujukan</h3>
            <p class="text-purple-100 text-sm">Laporan rujukan korban ke rumah sakit</p>
            <div class="mt-4 flex items-center text-white/80 text-sm">
                <span>Lihat Laporan</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </a>

        {{-- Rumah Sakit --}}
        <a href="{{ route('admin.laporan.rumahsakit') }}"
            class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl p-6 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-blue-500/30">
            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Rumah Sakit</h3>
            <p class="text-blue-100 text-sm">Laporan data rumah sakit rujukan</p>
            <div class="mt-4 flex items-center text-white/80 text-sm">
                <span>Lihat Laporan</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </a>
    </div>
</div>
@endsection