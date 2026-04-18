@extends('layouts.admin')

@section('title', 'Detail Bencana')
@section('page-title', 'Detail Bencana')
@section('page-subtitle', 'Informasi lengkap data bencana')

@section('content')
{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.bencana.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span>Kembali ke Daftar</span>
    </a>
</div>

{{-- Detail Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-300 bg-gradient-to-r from-blue-600 to-blue-700">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white">{{ $bencana->nama_bencana }}</h3>
                    <p class="text-blue-100 text-sm">Detail Informasi Bencana</p>
                </div>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $bencana->status == 'aktif' ? 'bg-green-500 text-white' : 'bg-gray-400 text-white' }}">
                {{ $bencana->status == 'aktif' ? 'Aktif' : 'Selesai' }}
            </span>
        </div>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Jenis Bencana --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Jenis Bencana</label>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium bg-orange-100 text-orange-700">
                        @php
                        $jenisLabels = [
                            'gempa' => 'Gempa Bumi',
                            'banjir' => 'Banjir',
                            'tsunami' => 'Tsunami',
                            'kebakaran' => 'Kebakaran',
                            'longsor' => 'Longsor',
                            'puting_beliung' => 'Puting Beliung',
                            'kekeringan' => 'Kekeringan',
                            'lainnya' => 'Lainnya',
                        ];
                        @endphp
                        {{ $jenisLabels[$bencana->jenis_bencana] ?? ucfirst($bencana->jenis_bencana) }}
                    </span>
                </div>
            </div>

            {{-- Lokasi --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Lokasi</label>
                <p class="text-gray-800 font-medium">{{ $bencana->lokasi }}</p>
            </div>

            {{-- Tanggal Kejadian --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Tanggal Kejadian</label>
                <p class="text-gray-800">
                    {{ \Carbon\Carbon::parse($bencana->tanggal_kejadian)->locale('id')->translatedFormat('d F Y') }}
                </p>
            </div>

            {{-- Jumlah Korban --}}
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-500">Jumlah Korban</label>
                <p class="text-gray-800 font-medium">{{ $bencana->korban()->count() }} Orang</p>
            </div>

            {{-- Keterangan --}}
            <div class="space-y-1 md:col-span-2">
                <label class="text-sm font-medium text-gray-500">Keterangan</label>
                <p class="text-gray-700">{{ $bencana->keterangan ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="px-6 py-4 border-t border-gray-300 bg-gray-50 flex items-center justify-between">
        <div class="text-sm text-gray-500">
            Dibuat: {{ $bencana->created_at->locale('id')->translatedFormat('d M Y, H:i') }}
            @if($bencana->updated_at != $bencana->created_at)
            | Diperbarui: {{ $bencana->updated_at->locale('id')->translatedFormat('d M Y, H:i') }}
            @endif
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.bencana.edit', $bencana->id) }}"
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