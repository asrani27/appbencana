@extends('layouts.admin')

@section('title', 'Edit Korban')
@section('page-title', 'Edit Korban')
@section('page-subtitle', 'Perbarui data korban')

@section('content')
{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.korban.index') }}"
        class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span class="font-medium">Kembali ke Data Korban</span>
    </a>
</div>

{{-- Form Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
    <div class="p-6 border-b border-gray-300">
        <h3 class="text-lg font-semibold text-gray-800">Form Edit Korban</h3>
        <p class="text-sm text-gray-500 mt-1">Lengkapi form di bawah untuk memperbarui data korban</p>
    </div>

    <form action="{{ route('admin.korban.update', $korban) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Bencana --}}
            <div class="md:col-span-2">
                <label for="bencana_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Bencana <span class="text-red-500">*</span>
                </label>
                <select name="bencana_id" id="bencana_id" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('bencana_id') border-red-500 @enderror">
                    <option value="">Pilih Bencana</option>
                    @foreach ($bencanas as $bencana)
                    <option value="{{ $bencana->id }}" {{ old('bencana_id', $korban->bencana_id) == $bencana->id ?
                        'selected' : '' }}>
                        {{ $bencana->nama_bencana }}
                    </option>
                    @endforeach
                </select>
                @error('bencana_id')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama --}}
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Korban
                </label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $korban->nama) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama') border-red-500 @enderror"
                    placeholder="Masukkan nama korban">
                @error('nama')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jenis Kelamin --}}
            <div>
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">
                    Jenis Kelamin <span class="text-red-500">*</span>
                </label>
                <select name="jenis_kelamin" id="jenis_kelamin" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jenis_kelamin') border-red-500 @enderror">
                    <option value="">Pilih Jenis Kelamin</option>
                    @foreach ($jenisKelamin as $key => $value)
                    <option value="{{ $key }}" {{ old('jenis_kelamin', $korban->jenis_kelamin) == $key ? 'selected' : ''
                        }}>
                        {{ $value }}
                    </option>
                    @endforeach
                </select>
                @error('jenis_kelamin')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Umur --}}
            <div>
                <label for="umur" class="block text-sm font-medium text-gray-700 mb-2">
                    Umur
                </label>
                <input type="number" name="umur" id="umur" value="{{ old('umur', $korban->umur) }}" min="0" max="150"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('umur') border-red-500 @enderror"
                    placeholder="Masukkan umur">
                @error('umur')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status Identitas --}}
            <div>
                <label for="status_identitas" class="block text-sm font-medium text-gray-700 mb-2">
                    Status Identitas <span class="text-red-500">*</span>
                </label>
                <select name="status_identitas" id="status_identitas" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status_identitas') border-red-500 @enderror">
                    <option value="">Pilih Status Identitas</option>
                    @foreach ($statusIdentitas as $key => $value)
                    <option value="{{ $key }}" {{ old('status_identitas', $korban->status_identitas) == $key ?
                        'selected' : '' }}>
                        {{ $value }}
                    </option>
                    @endforeach
                </select>
                @error('status_identitas')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Ditemukan --}}
            <div>
                <label for="tanggal_ditemukan" class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal Ditemukan
                </label>
                <input type="date" name="tanggal_ditemukan" id="tanggal_ditemukan"
                    value="{{ old('tanggal_ditemukan', $korban->tanggal_ditemukan?->format('Y-m-d')) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tanggal_ditemukan') border-red-500 @enderror">
                @error('tanggal_ditemukan')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lokasi Ditemukan --}}
            <div>
                <label for="lokasi_ditemukan" class="block text-sm font-medium text-gray-700 mb-2">
                    Lokasi Ditemukan
                </label>
                <input type="text" name="lokasi_ditemukan" id="lokasi_ditemukan"
                    value="{{ old('lokasi_ditemukan', $korban->lokasi_ditemukan) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('lokasi_ditemukan') border-red-500 @enderror"
                    placeholder="Masukkan lokasi ditemukan">
                @error('lokasi_ditemukan')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kondisi Awal --}}
            <div class="md:col-span-2">
                <label for="kondisi_awal" class="block text-sm font-medium text-gray-700 mb-2">
                    Kondisi Awal
                </label>
                <textarea name="kondisi_awal" id="kondisi_awal" rows="3"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kondisi_awal') border-red-500 @enderror"
                    placeholder="Deskripsikan kondisi awal korban">{{ old('kondisi_awal', $korban->kondisi_awal) }}</textarea>
                @error('kondisi_awal')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Foto URL --}}
            <div class="md:col-span-2">
                <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                    URL Foto
                </label>
                <input type="text" name="foto" id="foto" value="{{ old('foto', $korban->foto) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('foto') border-red-500 @enderror"
                    placeholder="Masukkan URL foto korban">
                @error('foto')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
            <a href="{{ route('admin.korban.index') }}"
                class="px-6 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors font-medium text-sm">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-colors font-medium text-sm shadow-lg shadow-blue-600/20">
                Perbarui Korban
            </button>
        </div>
    </form>
</div>
@endsection