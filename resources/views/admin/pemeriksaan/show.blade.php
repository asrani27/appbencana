@extends('layouts.admin')

@section('title', 'Detail Pemeriksaan')
@section('page-title', 'Detail Pemeriksaan')
@section('page-subtitle', 'Informasi lengkap data pemeriksaan medis')

@section('content')
{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.pemeriksaan.index') }}"
        class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span>Kembali ke Daftar</span>
    </a>
</div>

{{-- Detail Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-300 bg-teal-600">
        <div class="flex items-center gap-4">
            <div
                class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                {{ strtoupper(substr($pemeriksaan->korban->nama ?? '-', 0, 1)) }}
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">{{ $pemeriksaan->korban->nama ?? '-' }}</h3>
                <p class="text-teal-100 text-sm">Detail Pemeriksaan Medis</p>
            </div>
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
                        <span class="text-sm font-medium text-gray-800">{{ $pemeriksaan->korban->nama ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">JK:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $pemeriksaan->korban->jenis_kelamin ?? '-'
                            }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Umur:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $pemeriksaan->korban->umur ?? '-' }}
                            tahun</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Bencana:</span>
                        <span class="text-sm font-medium text-gray-800">{{ $pemeriksaan->korban->bencana->nama_bencana
                            ?? '-' }}</span>
                    </div>
                </div>
            </div>

            {{-- Vital Sign --}}
            <div class="bg-red-50 p-4 rounded-xl border border-red-200">
                <h4 class="text-sm font-semibold text-red-800 mb-3">Vital Sign</h4>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Tekanan Darah</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $pemeriksaan->tekanan_darah ?? '-' }} mmHg</p>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Nadi</p>
                            <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->nadi ?? '-' }} x/menit</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Suhu</p>
                            <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->suhu ? $pemeriksaan->suhu .
                                '°C' : '-' }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Respirasi</p>
                        <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->respirasi ?? '-' }} x/menit</p>
                    </div>
                </div>
            </div>

            {{-- Keluhan --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Keluhan</label>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700">{{ $pemeriksaan->keluhan ?? '-' }}</p>
                </div>
            </div>

            {{-- Diagnosa Awal --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Diagnosa Awal</label>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700">{{ $pemeriksaan->diagnosa_awal ?? '-' }}</p>
                </div>
            </div>

            {{-- Tindakan --}}
            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-500">Tindakan</label>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700">{{ $pemeriksaan->tindakan ?? '-' }}</p>
                </div>
            </div>

            {{-- Petugas --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Petugas</label>
                <p class="text-gray-800 font-medium">{{ $pemeriksaan->petugas->name ?? '-' }}</p>
            </div>

            {{-- Tanggal --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Tanggal Pemeriksaan</label>
                <p class="text-gray-700">{{ $pemeriksaan->created_at->locale('id')->translatedFormat('d F Y, H:i') }}
                </p>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="px-6 py-4 border-t border-gray-300 bg-gray-50 flex items-center justify-between">
        <div class="text-sm text-gray-500">
            Dibuat: {{ $pemeriksaan->created_at->locale('id')->translatedFormat('d M Y, H:i') }}
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.pemeriksaan.edit', $pemeriksaan->id) }}"
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