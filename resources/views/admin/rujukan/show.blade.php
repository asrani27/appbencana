@extends('layouts.admin')

@section('title', 'Detail Rujukan')
@section('page-title', 'Detail Rujukan')
@section('page-subtitle', 'Informasi lengkap data rujukan')

@section('content')
{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.rujukan.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span>Kembali ke Daftar</span>
    </a>
</div>

{{-- Detail Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-300 bg-gradient-to-r from-purple-600 to-pink-600">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                    {{ strtoupper(substr($rujukan->korban->nama ?? '-', 0, 1)) }}
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white">{{ $rujukan->korban->nama ?? '-' }}</h3>
                    <p class="text-purple-100 text-sm">Detail Rujukan</p>
                </div>
            </div>
            @php
            $statusClasses = [
                'dirujuk' => 'bg-yellow-500 text-white',
                'diterima' => 'bg-blue-500 text-white',
                'selesai' => 'bg-green-500 text-white',
            ];
            $statusLabels = [
                'dirujuk' => 'Dirujuk',
                'diterima' => 'Diterima',
                'selesai' => 'Selesai',
            ];
            $statusClass = $statusClasses[$rujukan->status] ?? 'bg-gray-500 text-white';
            @endphp
            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $statusClass }}">
                {{ $statusLabels[$rujukan->status] ?? ucfirst($rujukan->status) }}
            </span>
        </div>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Data Korban --}}
            <div class="bg-blue-50 p-4 rounded-xl border border-blue-200">
                <h4 class="text-sm font-semibold text-blue-800 mb-3">Data Korban</h4>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Nama:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $rujukan->korban->nama ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">JK:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $rujukan->korban->jenis_kelamin ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Umur:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $rujukan->korban->umur ?? '-' }} tahun</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Bencana:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $rujukan->korban->bencana->nama_bencana ?? '-' }}</span>
                    </div>
                </div>
            </div>

            {{-- Rumah Sakit Tujuan --}}
            <div class="bg-red-50 p-4 rounded-xl border border-red-200">
                <h4 class="text-sm font-semibold text-red-800 mb-3">Rumah Sakit Tujuan</h4>
                <div class="space-y-2">
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $rujukan->rumahSakit->nama ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="text-sm text-gray-700">{{ $rujukan->rumahSakit->alamat ?? '-' }}</p>
                    </div>
                    @if($rujukan->rumahSakit->no_hp)
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <p class="text-sm text-gray-700">{{ $rujukan->rumahSakit->no_hp }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Status --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Status Rujukan</label>
                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-semibold {{ $statusClass }}">
                    {{ $statusLabels[$rujukan->status] ?? ucfirst($rujukan->status) }}
                </span>
            </div>

            {{-- Waktu Rujuk --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Waktu Rujuk</label>
                <p class="text-gray-700">
                    {{ $rujukan->waktu_rujuk ? \Carbon\Carbon::parse($rujukan->waktu_rujuk)->locale('id')->translatedFormat('d F Y, H:i') : '-' }}
                </p>
            </div>

            {{-- Catatan --}}
            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-500">Catatan</label>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700">{{ $rujukan->catatan ?? '-' }}</p>
                </div>
            </div>

            {{-- Tanggal --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Tanggal Dibuat</label>
                <p class="text-gray-700">{{ $rujukan->created_at->locale('id')->translatedFormat('d F Y, H:i') }}</p>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="px-6 py-4 border-t border-gray-300 bg-gray-50 flex items-center justify-between">
        <div class="text-sm text-gray-500">
            Dibuat: {{ $rujukan->created_at->locale('id')->translatedFormat('d M Y, H:i') }}
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.rujukan.edit', $rujukan->id) }}"
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