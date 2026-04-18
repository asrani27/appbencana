@extends('layouts.admin')

@section('title', 'Edit Triase')
@section('page-title', 'Edit Triase')
@section('page-subtitle', 'Perbarui data triase korban')

@section('content')
{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.triase.index') }}"
        class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span class="font-medium">Kembali ke Triase</span>
    </a>
</div>

{{-- Form Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
    <div class="p-6 border-b border-gray-300">
        <h3 class="text-lg font-semibold text-gray-800">Form Edit Triase</h3>
        <p class="text-sm text-gray-500 mt-1">Lengkapi form di bawah untuk memperbarui data triase</p>
    </div>

    <form action="{{ route('admin.triase.update', $triase) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Korban (Read-only) --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Korban
                </label>
                <div class="flex items-center gap-3 p-3 bg-gray-100 rounded-xl border border-gray-300">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr($triase->korban->nama ?? 'N', 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">{{ $triase->korban->nama ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-500">
                            {{ $triase->korban->jenis_kelamin ?? '-' }}, {{ $triase->korban->umur ?? '-' }} tahun
                            - {{ $triase->korban->bencana->nama_bencana ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Kategori --}}
            <div>
                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                    Kategori Triase <span class="text-red-500">*</span>
                </label>
                <select name="kategori" id="kategori" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kategori') border-red-500 @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategoriOptions as $key => $label)
                    <option value="{{ $key }}" {{ old('kategori', $triase->kategori)==$key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                    @endforeach
                </select>
                @error('kategori')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div class="md:col-span-2">
                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                    Keterangan <span class="text-gray-400 font-normal">(opsional)</span>
                </label>
                <textarea name="keterangan" id="keterangan" rows="4"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('keterangan') border-red-500 @enderror"
                    placeholder="Masukkan keterangan atau catatan triase">{{ old('keterangan', $triase->keterangan) }}</textarea>
                @error('keterangan')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Kategori Info --}}
        <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-300">
            <h4 class="text-sm font-medium text-gray-700 mb-3">Panduan Kategori Triase</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 text-xs">
                <div class="flex items-start gap-2 p-2 bg-red-50 rounded-lg">
                    <span class="w-3 h-3 mt-0.5 bg-red-500 rounded-full shrink-0"></span>
                    <div>
                        <p class="font-semibold text-red-700">Merah - Immediate</p>
                        <p class="text-red-600">Prioritas tinggi, penanganan segera</p>
                    </div>
                </div>
                <div class="flex items-start gap-2 p-2 bg-yellow-50 rounded-lg">
                    <span class="w-3 h-3 mt-0.5 bg-yellow-500 rounded-full shrink-0"></span>
                    <div>
                        <p class="font-semibold text-yellow-700">Kuning - Delayed</p>
                        <p class="text-yellow-600">Prioritas sedang, dapat menunggu</p>
                    </div>
                </div>
                <div class="flex items-start gap-2 p-2 bg-green-50 rounded-lg">
                    <span class="w-3 h-3 mt-0.5 bg-green-500 rounded-full shrink-0"></span>
                    <div>
                        <p class="font-semibold text-green-700">Hijau - Walking Wounded</p>
                        <p class="text-green-600">Ringan, dapat berjalan sendiri</p>
                    </div>
                </div>
                <div class="flex items-start gap-2 p-2 bg-gray-100 rounded-lg">
                    <span class="w-3 h-3 mt-0.5 bg-gray-800 rounded-full shrink-0"></span>
                    <div>
                        <p class="font-semibold text-gray-700">Hitam - Dead</p>
                        <p class="text-gray-600">Meninggal atau tidak tertolong</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Triase Info (Read-only) --}}
        <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-300">
            <h4 class="text-sm font-medium text-gray-700 mb-3">Informasi Triase</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">ID Triase</p>
                    <p class="font-medium text-gray-800">#{{ $triase->id }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Dibuat</p>
                    <p class="font-medium text-gray-800">
                        {{ $triase->created_at->locale('id')->translatedFormat('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Terakhir Diperbarui</p>
                    <p class="font-medium text-gray-800">
                        {{ $triase->updated_at->locale('id')->translatedFormat('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
            <a href="{{ route('admin.triase.index') }}"
                class="px-6 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors font-medium text-sm">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-colors font-medium text-sm shadow-lg shadow-blue-600/20">
                Perbarui Triase
            </button>
        </div>
    </form>
</div>
@endsection