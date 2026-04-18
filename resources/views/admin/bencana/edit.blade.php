@extends('layouts.admin')

@section('title', 'Edit Bencana')
@section('page-title', 'Edit Bencana')
@section('page-subtitle', 'Perbarui data bencana')

@section('content')
{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.bencana.index') }}"
        class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span class="font-medium">Kembali ke Manajemen Bencana</span>
    </a>
</div>

{{-- Form Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
    <div class="p-6 border-b border-gray-300">
        <h3 class="text-lg font-semibold text-gray-800">Form Edit Bencana</h3>
        <p class="text-sm text-gray-500 mt-1">Lengkapi form di bawah untuk memperbarui data bencana</p>
    </div>

    <form action="{{ route('admin.bencana.update', $bencana) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Bencana --}}
            <div class="md:col-span-2">
                <label for="nama_bencana" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Bencana <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_bencana" id="nama_bencana" value="{{ old('nama_bencana', $bencana->nama_bencana) }}" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_bencana') border-red-500 @enderror"
                    placeholder="Contoh: Bencana Alam Banjir Jakarta 2024">
                @error('nama_bencana')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jenis Bencana --}}
            <div>
                <label for="jenis_bencana" class="block text-sm font-medium text-gray-700 mb-2">
                    Jenis Bencana <span class="text-red-500">*</span>
                </label>
                <select name="jenis_bencana" id="jenis_bencana" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jenis_bencana') border-red-500 @enderror">
                    <option value="">Pilih Jenis Bencana</option>
                    @foreach($jenisBencana as $value => $label)
                    <option value="{{ $value }}" {{ old('jenis_bencana', $bencana->jenis_bencana) == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                    @endforeach
                </select>
                @error('jenis_bencana')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Kejadian --}}
            <div>
                <label for="tanggal_kejadian" class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal Kejadian <span class="text-red-500">*</span>
                </label>
                <input type="date" name="tanggal_kejadian" id="tanggal_kejadian" value="{{ old('tanggal_kejadian', $bencana->tanggal_kejadian->format('Y-m-d')) }}" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tanggal_kejadian') border-red-500 @enderror">
                @error('tanggal_kejadian')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lokasi --}}
            <div class="md:col-span-2">
                <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">
                    Lokasi <span class="text-red-500">*</span>
                </label>
                <textarea name="lokasi" id="lokasi" rows="3" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('lokasi') border-red-500 @enderror"
                    placeholder="Contoh: Jl. Sudirman No. 123, Jakarta Selatan">{{ old('lokasi', $bencana->lokasi) }}</textarea>
                @error('lokasi')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status" id="status" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                    <option value="">Pilih Status</option>
                    <option value="aktif" {{ old('status', $bencana->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="selesai" {{ old('status', $bencana->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                @error('status')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div>
                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                    Keterangan
                </label>
                <textarea name="keterangan" id="keterangan" rows="3"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('keterangan') border-red-500 @enderror"
                    placeholder="Deskripsi tambahan tentang bencana">{{ old('keterangan', $bencana->keterangan) }}</textarea>
                @error('keterangan')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Info Card --}}
        <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-300">
            <h4 class="text-sm font-medium text-gray-700 mb-3">Informasi Bencana</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">ID Bencana</p>
                    <p class="font-medium text-gray-800">#{{ $bencana->id }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Dibuat</p>
                    <p class="font-medium text-gray-800">
                        {{ $bencana->created_at->locale('id')->translatedFormat('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Terakhir Diperbarui</p>
                    <p class="font-medium text-gray-800">
                        {{ $bencana->updated_at->locale('id')->translatedFormat('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
            <a href="{{ route('admin.bencana.index') }}"
                class="px-6 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors font-medium text-sm">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-colors font-medium text-sm shadow-lg shadow-blue-600/20">
                Perbarui Bencana
            </button>
        </div>
    </form>
</div>
@endsection