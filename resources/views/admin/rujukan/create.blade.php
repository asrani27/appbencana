@extends('layouts.admin')

@section('title', 'Tambah Rujukan')
@section('page-title', 'Tambah Rujukan')
@section('page-subtitle', 'Tambah data rujukan baru')

@section('content')
{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.rujukan.index') }}"
        class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span class="font-medium">Kembali ke Rujukan</span>
    </a>
</div>

{{-- Form Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
    <div class="p-6 border-b border-gray-300">
        <h3 class="text-lg font-semibold text-gray-800">Form Tambah Rujukan</h3>
        <p class="text-sm text-gray-500 mt-1">Lengkapi form di bawah untuk menambahkan data rujukan</p>
    </div>

    <form action="{{ route('admin.rujukan.store') }}" method="POST" class="p-6">
        @csrf

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
                    <option value="{{ $k->id }}" {{ old('korban_id')==$k->id ? 'selected' : '' }}>
                        {{ $k->nama }} ({{ $k->jenis_kelamin }}, {{ $k->umur }} tahun)
                    </option>
                    @endforeach
                </select>
                @error('korban_id')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Rumah Sakit --}}
            <div>
                <label for="rumah_sakit_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Rumah Sakit Tujuan <span class="text-red-500">*</span>
                </label>
                <select name="rumah_sakit_id" id="rumah_sakit_id" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('rumah_sakit_id') border-red-500 @enderror">
                    <option value="">Pilih Rumah Sakit</option>
                    @foreach ($rumahSakit as $rs)
                    <option value="{{ $rs->id }}" {{ old('rumah_sakit_id')==$rs->id ? 'selected' : '' }}>
                        {{ $rs->nama }}
                    </option>
                    @endforeach
                </select>
                @error('rumah_sakit_id')
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
                    <option value="dirujuk" {{ old('status')=='dirujuk' ? 'selected' : '' }}>Dirujuk</option>
                    <option value="diterima" {{ old('status')=='diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="selesai" {{ old('status')=='selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                @error('status')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Waktu Rujuk --}}
            <div>
                <label for="waktu_rujuk" class="block text-sm font-medium text-gray-700 mb-2">
                    Waktu Rujuk
                </label>
                <input type="datetime-local" name="waktu_rujuk" id="waktu_rujuk" value="{{ old('waktu_rujuk') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('waktu_rujuk') border-red-500 @enderror">
                @error('waktu_rujuk')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Catatan --}}
            <div class="md:col-span-2">
                <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">
                    Catatan
                </label>
                <textarea name="catatan" id="catatan" rows="4"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('catatan') border-red-500 @enderror"
                    placeholder="Catatan atau keterangan tambahan">{{ old('catatan') }}</textarea>
                @error('catatan')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
            <a href="{{ route('admin.rujukan.index') }}"
                class="px-6 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors font-medium text-sm">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-colors font-medium text-sm shadow-lg shadow-blue-600/20">
                Simpan Rujukan
            </button>
        </div>
    </form>
</div>
@endsection
