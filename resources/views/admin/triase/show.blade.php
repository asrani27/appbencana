@extends('layouts.admin')

@section('title', 'Detail Triase')
@section('page-title', 'Detail Triase')
@section('page-subtitle', 'Informasi lengkap data triase')

@section('content')
{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.triase.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span>Kembali ke Daftar</span>
    </a>
</div>

{{-- Detail Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-300 bg-gradient-to-r from-blue-600 to-indigo-600">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                    {{ strtoupper(substr($triase->korban->nama ?? 'N', 0, 1)) }}
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white">{{ $triase->korban->nama ?? 'N/A' }}</h3>
                    <p class="text-blue-100 text-sm">Detail Informasi Triase</p>
                </div>
            </div>
            @php
            $kategoriClasses = [
                'merah' => 'bg-red-500 text-white',
                'kuning' => 'bg-yellow-500 text-white',
                'hijau' => 'bg-green-500 text-white',
                'hitam' => 'bg-gray-800 text-white',
            ];
            $kategoriLabels = [
                'merah' => 'Merah - Prioritas Tinggi',
                'kuning' => 'Kuning - Prioritas Sedang',
                'hijau' => 'Hijau - Prioritas Rendah',
                'hitam' => 'Hitam - Meninggal',
            ];
            $kategoriClass = $kategoriClasses[$triase->kategori] ?? 'bg-gray-500 text-white';
            @endphp
            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $kategoriClass }}">
                {{ $kategoriLabels[$triase->kategori] ?? ucfirst($triase->kategori) }}
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
                        <span class="text-sm font-medium text-gray-800">{{ $triase->korban->nama ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">JK:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $triase->korban->jenis_kelamin ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Umur:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $triase->korban->umur ?? '-' }} tahun</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Bencana:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $triase->korban->bencana->nama_bencana ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            {{-- Detail Triase --}}
            <div class="space-y-4">
                {{-- Kategori --}}
                <div class="space-y-1">
                    <label class="text-sm font-medium text-gray-500">Kategori Triase</label>
                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-semibold {{ $kategoriClass }}">
                        {{ $kategoriLabels[$triase->kategori] ?? ucfirst($triase->kategori) }}
                    </span>
                </div>

                {{-- Petugas --}}
                <div class="space-y-1">
                    <label class="text-sm font-medium text-gray-500">Petugas</label>
                    <p class="text-gray-800 font-medium">{{ $triase->creator->username ?? '-' }}</p>
                </div>

                {{-- Tanggal --}}
                <div class="space-y-1">
                    <label class="text-sm font-medium text-gray-500">Tanggal Triase</label>
                    <p class="text-gray-700">{{ $triase->created_at->locale('id')->translatedFormat('d F Y, H:i') }}</p>
                </div>
            </div>

            {{-- Keterangan --}}
            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-500">Keterangan</label>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700">{{ $triase->keterangan ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="px-6 py-4 border-t border-gray-300 bg-gray-50 flex items-center justify-between">
        <div class="text-sm text-gray-500">
            Dibuat: {{ $triase->created_at->locale('id')->translatedFormat('d M Y, H:i') }}
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.triase.edit', $triase->id) }}"
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