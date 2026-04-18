@extends('layouts.admin')

@section('title', 'Edit Pemeriksaan')
@section('page-title', 'Edit Pemeriksaan Medis')
@section('page-subtitle', 'Perbarui data pemeriksaan medis')

@section('content')
{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.pemeriksaan.index') }}"
        class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span class="font-medium">Kembali ke Pemeriksaan Medis</span>
    </a>
</div>

{{-- Form Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
    <div class="p-6 border-b border-gray-300">
        <h3 class="text-lg font-semibold text-gray-800">Form Edit Pemeriksaan Medis</h3>
        <p class="text-sm text-gray-500 mt-1">Lengkapi form di bawah untuk memperbarui data pemeriksaan medis</p>
    </div>

    <form action="{{ route('admin.pemeriksaan.update', $pemeriksaan) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Korban --}}
            <div>
                <label for="korban_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Korban <span class="text-red-500">*</span>
                </label>
                <select name="korban_id" id="korban_id" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('korban_id') border-red-500 @enderror">
                    <option value="">Pilih Korban</option>
                    @foreach ($korban as $k)
                    <option value="{{ $k->id }}" {{ old('korban_id', $pemeriksaan->korban_id) == $k->id ? 'selected' : '' }}>
                        {{ $k->nama }} ({{ $k->jenis_kelamin }}, {{ $k->umur }} tahun)
                    </option>
                    @endforeach
                </select>
                @error('korban_id')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tekanan Darah --}}
            <div>
                <label for="tekanan_darah" class="block text-sm font-medium text-gray-700 mb-2">
                    Tekanan Darah
                </label>
                <input type="text" name="tekanan_darah" id="tekanan_darah" value="{{ old('tekanan_darah', $pemeriksaan->tekanan_darah) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tekanan_darah') border-red-500 @enderror"
                    placeholder="120/80">
                @error('tekanan_darah')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nadi --}}
            <div>
                <label for="nadi" class="block text-sm font-medium text-gray-700 mb-2">
                    Nadi (bpm)
                </label>
                <input type="text" name="nadi" id="nadi" value="{{ old('nadi', $pemeriksaan->nadi) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nadi') border-red-500 @enderror"
                    placeholder="80">
                @error('nadi')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Respirasi --}}
            <div>
                <label for="respirasi" class="block text-sm font-medium text-gray-700 mb-2">
                    Respirasi (x/menit)
                </label>
                <input type="text" name="respirasi" id="respirasi" value="{{ old('respirasi', $pemeriksaan->respirasi) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('respirasi') border-red-500 @enderror"
                    placeholder="20">
                @error('respirasi')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Suhu --}}
            <div>
                <label for="suhu" class="block text-sm font-medium text-gray-700 mb-2">
                    Suhu (°C)
                </label>
                <input type="number" step="0.1" name="suhu" id="suhu" value="{{ old('suhu', $pemeriksaan->suhu) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('suhu') border-red-500 @enderror"
                    placeholder="36.5">
                @error('suhu')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keluhan --}}
            <div>
                <label for="keluhan" class="block text-sm font-medium text-gray-700 mb-2">
                    Keluhan
                </label>
                <textarea name="keluhan" id="keluhan" rows="3"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('keluhan') border-red-500 @enderror"
                    placeholder="Deskripsikan keluhan korban">{{ old('keluhan', $pemeriksaan->keluhan) }}</textarea>
                @error('keluhan')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Diagnosa Awal --}}
            <div>
                <label for="diagnosa_awal" class="block text-sm font-medium text-gray-700 mb-2">
                    Diagnosa Awal
                </label>
                <textarea name="diagnosa_awal" id="diagnosa_awal" rows="3"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('diagnosa_awal') border-red-500 @enderror"
                    placeholder="Diagnosa awal">{{ old('diagnosa_awal', $pemeriksaan->diagnosa_awal) }}</textarea>
                @error('diagnosa_awal')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tindakan --}}
            <div>
                <label for="tindakan" class="block text-sm font-medium text-gray-700 mb-2">
                    Tindakan
                </label>
                <textarea name="tindakan" id="tindakan" rows="3"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tindakan') border-red-500 @enderror"
                    placeholder="Tindakan yang dilakukan">{{ old('tindakan', $pemeriksaan->tindakan) }}</textarea>
                @error('tindakan')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Form Info --}}
        <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-300">
            <h4 class="text-sm font-medium text-gray-700 mb-3">Informasi Pemeriksaan</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">ID Pemeriksaan</p>
                    <p class="font-medium text-gray-800">#{{ $pemeriksaan->id }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Petugas</p>
                    <p class="font-medium text-gray-800">{{ $pemeriksaan->petugas->name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Dibuat</p>
                    <p class="font-medium text-gray-800">
                        {{ $pemeriksaan->created_at->locale('id')->translatedFormat('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
            <a href="{{ route('admin.pemeriksaan.index') }}"
                class="px-6 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors font-medium text-sm">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-colors font-medium text-sm shadow-lg shadow-blue-600/20">
                Perbarui Pemeriksaan
            </button>
        </div>
    </form>
</div>
@endsection
