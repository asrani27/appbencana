@extends('layouts.admin')

@section('title', 'Detail Korban')
@section('page-title', 'Detail Korban')
@section('page-subtitle', 'Informasi lengkap data korban')

@section('content')
{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.korban.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span>Kembali ke Daftar</span>
    </a>
</div>

{{-- Detail Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-300 bg-gradient-to-r from-orange-500 to-red-600">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                {{ strtoupper(substr($korban->nama ?? 'TN', 0, 1)) }}
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">{{ $korban->nama ?? 'Tidak Dikenal' }}</h3>
                <p class="text-orange-100 text-sm">Detail Informasi Korban</p>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Bencana --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Bencana</label>
                <p class="text-gray-800 font-medium">{{ $korban->bencana->nama_bencana ?? '-' }}</p>
            </div>

            {{-- Jenis Kelamin --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Jenis Kelamin</label>
                <p class="text-gray-800">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium {{ $korban->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                        {{ $korban->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </span>
                </p>
            </div>

            {{-- Umur --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Umur</label>
                <p class="text-gray-800 font-medium">{{ $korban->umur ?? '-' }} Tahun</p>
            </div>

            {{-- Status Identitas --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Status Identitas</label>
                <p class="text-gray-800">
                    @php
                    $statusClasses = [
                        'dikenal' => 'bg-green-100 text-green-700',
                        'tidak_dikenal' => 'bg-gray-100 text-gray-700',
                    ];
                    $statusLabels = [
                        'dikenal' => 'Dikenal',
                        'tidak_dikenal' => 'Tidak Dikenal',
                    ];
                    $statusClass = $statusClasses[$korban->status_identitas] ?? 'bg-gray-100 text-gray-700';
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium {{ $statusClass }}">
                        {{ $statusLabels[$korban->status_identitas] ?? ucfirst($korban->status_identitas) }}
                    </span>
                </p>
            </div>

            {{-- Lokasi Ditemukan --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Lokasi Ditemukan</label>
                <p class="text-gray-700">{{ $korban->lokasi_ditemukan ?? '-' }}</p>
            </div>

            {{-- Tanggal Ditemukan --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Tanggal Ditemukan</label>
                <p class="text-gray-700">
                    {{ $korban->tanggal_ditemukan ? \Carbon\Carbon::parse($korban->tanggal_ditemukan)->locale('id')->translatedFormat('d F Y') : '-' }}
                </p>
            </div>

            {{-- Kondisi Awal --}}
            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-500">Kondisi Awal</label>
                <p class="text-gray-700">{{ $korban->kondisi_awal ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="px-6 py-4 border-t border-gray-300 bg-gray-50 flex items-center justify-between">
        <div class="text-sm text-gray-500">
            Dibuat: {{ $korban->created_at->locale('id')->translatedFormat('d M Y, H:i') }}
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.korban.edit', $korban->id) }}"
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