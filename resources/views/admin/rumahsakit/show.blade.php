@extends('layouts.admin')

@section('title', 'Detail Rumah Sakit')
@section('page-title', 'Detail Rumah Sakit')
@section('page-subtitle', 'Informasi lengkap data rumah sakit')

@section('content')
{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.rumahsakit.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span>Kembali ke Daftar</span>
    </a>
</div>

{{-- Detail Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-300 bg-gradient-to-r from-red-600 to-rose-600">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">{{ $rumahSakit->nama }}</h3>
                <p class="text-red-100 text-sm">Detail Informasi Rumah Sakit</p>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Nama Rumah Sakit</label>
                <p class="text-gray-800 font-medium text-lg">{{ $rumahSakit->nama }}</p>
            </div>

            {{-- Kapasitas IGD --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Kapasitas IGD</label>
                <p class="text-gray-800">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-semibold bg-blue-100 text-blue-700">
                        {{ $rumahSakit->kapasitas_igd ?? 0 }} Orang
                    </span>
                </p>
            </div>

            {{-- Alamat --}}
            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-500">Alamat</label>
                <div class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <p class="text-gray-700">{{ $rumahSakit->alamat }}</p>
                </div>
            </div>

            {{-- No. HP --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Nomor Telepon</label>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <p class="text-gray-700">{{ $rumahSakit->no_hp ?? '-' }}</p>
                </div>
            </div>

            {{-- Koordinat --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Koordinat</label>
                @if($rumahSakit->latitude && $rumahSakit->longitude)
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    <p class="text-gray-700">{{ $rumahSakit->latitude }}, {{ $rumahSakit->longitude }}</p>
                </div>
                @else
                <p class="text-gray-400">Tidak tersedia</p>
                @endif
            </div>

            {{-- Statistik --}}
            <div class="md:col-span-2">
                <label class="text-sm font-medium text-gray-500 mb-3 block">Statistik Rujukan</label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-yellow-50 p-4 rounded-xl border border-yellow-200">
                        <p class="text-xs text-yellow-600 mb-1">Total Dirujuk</p>
                        <p class="text-2xl font-bold text-yellow-700">{{ $rumahSakit->rujukan()->where('status', 'dirujuk')->count() }}</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-xl border border-blue-200">
                        <p class="text-xs text-blue-600 mb-1">Diterima</p>
                        <p class="text-2xl font-bold text-blue-700">{{ $rumahSakit->rujukan()->where('status', 'diterima')->count() }}</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-xl border border-green-200">
                        <p class="text-xs text-green-600 mb-1">Selesai</p>
                        <p class="text-2xl font-bold text-green-700">{{ $rumahSakit->rujukan()->where('status', 'selesai')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="px-6 py-4 border-t border-gray-300 bg-gray-50 flex items-center justify-between">
        <div class="text-sm text-gray-500">
            @if($rumahSakit->created_at)
            Dibuat: {{ $rumahSakit->created_at->locale('id')->translatedFormat('d M Y, H:i') }}
            @endif
            @if($rumahSakit->updated_at && $rumahSakit->updated_at != $rumahSakit->created_at)
            | Diperbarui: {{ $rumahSakit->updated_at->locale('id')->translatedFormat('d M Y, H:i') }}
            @endif
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.rumahsakit.edit', ['rumahsakit' => $rumahSakit->id]) }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit
            </a>
        </div>
    </div>
</div>
@endsection