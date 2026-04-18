@extends('layouts.admin')

@section('title', 'Edit Rumah Sakit')
@section('page-title', 'Edit Rumah Sakit')
@section('page-subtitle', 'Perbarui data rumah sakit')

@section('content')
{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.rumahsakit.index') }}"
        class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span class="font-medium">Kembali ke Rumah Sakit</span>
    </a>
</div>

{{-- Form Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
    <div class="p-6 border-b border-gray-300">
        <h3 class="text-lg font-semibold text-gray-800">Form Edit Rumah Sakit</h3>
        <p class="text-sm text-gray-500 mt-1">Lengkapi form di bawah untuk memperbarui data rumah sakit</p>
    </div>

    <form action="{{ route('admin.rumahsakit.update', $rumahSakit) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama --}}
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Rumah Sakit <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $rumahSakit->nama) }}" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama') border-red-500 @enderror"
                    placeholder="Masukkan nama rumah sakit">
                @error('nama')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- No. HP --}}
            <div>
                <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">
                    No. HP
                </label>
                <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $rumahSakit->no_hp) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('no_hp') border-red-500 @enderror"
                    placeholder="021-xxxxxxx">
                @error('no_hp')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="md:col-span-2">
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                    Alamat <span class="text-red-500">*</span>
                </label>
                <textarea name="alamat" id="alamat" rows="3" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('alamat') border-red-500 @enderror"
                    placeholder="Masukkan alamat lengkap">{{ old('alamat', $rumahSakit->alamat) }}</textarea>
                @error('alamat')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Latitude --}}
            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">
                    Latitude
                </label>
                <input type="number" step="0.00000001" name="latitude" id="latitude"
                    value="{{ old('latitude', $rumahSakit->latitude) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('latitude') border-red-500 @enderror"
                    placeholder="-6.200000">
                @error('latitude')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Longitude --}}
            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">
                    Longitude
                </label>
                <input type="number" step="0.00000001" name="longitude" id="longitude"
                    value="{{ old('longitude', $rumahSakit->longitude) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('longitude') border-red-500 @enderror"
                    placeholder="106.800000">
                @error('longitude')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kapasitas IGD --}}
            <div>
                <label for="kapasitas_igd" class="block text-sm font-medium text-gray-700 mb-2">
                    Kapasitas IGD
                </label>
                <input type="number" name="kapasitas_igd" id="kapasitas_igd"
                    value="{{ old('kapasitas_igd', $rumahSakit->kapasitas_igd) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kapasitas_igd') border-red-500 @enderror"
                    placeholder="0" min="0">
                @error('kapasitas_igd')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Form Info --}}
        <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-300">
            <h4 class="text-sm font-medium text-gray-700 mb-3">Informasi Rumah Sakit</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">ID Rumah Sakit</p>
                    <p class="font-medium text-gray-800">#{{ $rumahSakit->id }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Dibuat</p>
                    <p class="font-medium text-gray-800">
                        {{ $rumahSakit->created_at->locale('id')->translatedFormat('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Terakhir Diperbarui</p>
                    <p class="font-medium text-gray-800">
                        {{ $rumahSakit->updated_at->locale('id')->translatedFormat('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
            <a href="{{ route('admin.rumahsakit.index') }}"
                class="px-6 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors font-medium text-sm">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-colors font-medium text-sm shadow-lg shadow-blue-600/20">
                Perbarui Rumah Sakit
            </button>
        </div>
    </form>
</div>
@endsection