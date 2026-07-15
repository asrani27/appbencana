@extends('layouts.admin')

@section('title', 'Tambah Pemeriksaan')
@section('page-title', 'Tambah Pemeriksaan Medis')
@section('page-subtitle', 'Dokumen Rekam Medis Bencana')

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

<form action="{{ route('admin.pemeriksaan.store') }}" method="POST" class="space-y-6">
    @csrf

    {{-- ============ HEADER / IDENTITAS PASIEN ============ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
        <div class="p-6 border-b border-gray-300 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Dokumen Rekam Medis Bencana</h3>
                <p class="text-sm text-gray-500 mt-1">RS Politeknik Kesdam VI Banjarmasin</p>
            </div>
            <span class="text-xs font-medium text-gray-400">RM.1/1/2024</span>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Korban (link ke data korban existing) --}}
            <div>
                <label for="korban_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Korban <span class="text-red-500">*</span>
                </label>
                <select name="korban_id" id="korban_id" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('korban_id') border-red-500 bg-red-50 @enderror">
                    <option value="">Pilih Korban</option>
                    @foreach ($korban as $k)
                    <option value="{{ $k->id }}" {{ old('korban_id')==$k->id ? 'selected' : '' }}>
                        {{ $k->nama }} ({{ $k->jenis_kelamin }}, {{ $k->umur }} tahun)
                    </option>
                    @endforeach
                </select>
                @error('korban_id')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="no_pasien" class="block text-sm font-medium text-gray-700 mb-2">No Pasien</label>
                <input type="text" name="no_pasien" id="no_pasien" value="{{ old('no_pasien') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('no_pasien') border-red-500 bg-red-50 @enderror"
                    placeholder="Nomor pasien">
                @error('no_pasien')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="nama_pasien" class="block text-sm font-medium text-gray-700 mb-2">Nama Pasien</label>
                <input type="text" name="nama_pasien" id="nama_pasien" value="{{ old('nama_pasien') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_pasien') border-red-500 bg-red-50 @enderror"
                    placeholder="Nama lengkap pasien">
                @error('nama_pasien')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                <div class="flex items-center gap-6 px-4 py-2.5">
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="jenis_kelamin" value="Laki-laki"
                            class="text-blue-600 focus:ring-blue-500" {{ old('jenis_kelamin')=='Laki-laki' ? 'checked'
                            : '' }}>
                        Laki - laki
                    </label>
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="jenis_kelamin" value="Perempuan"
                            class="text-blue-600 focus:ring-blue-500" {{ old('jenis_kelamin')=='Perempuan' ? 'checked'
                            : '' }}>
                        Perempuan
                    </label>
                </div>
                @error('jenis_kelamin')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tanggal_lahir') border-red-500 bg-red-50 @enderror">
                @error('tanggal_lahir')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="umur" class="block text-sm font-medium text-gray-700 mb-2">Umur</label>
                <input type="number" name="umur" id="umur" value="{{ old('umur') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('umur') border-red-500 bg-red-50 @enderror"
                    placeholder="Umur (tahun)">
                @error('umur')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                <textarea name="alamat" id="alamat" rows="2"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('alamat') border-red-500 bg-red-50 @enderror"
                    placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
                @error('alamat')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
        </div>
    </div>

    {{-- ============ JENIS KEJADIAN ============ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
        <div class="p-6 border-b border-gray-300">
            <h3 class="text-lg font-semibold text-gray-800">Jenis Kejadian</h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Bencana --}}
            <div>
                <p class="text-sm font-medium text-gray-700 mb-3">Bencana</p>
                <div class="space-y-2">
                    @foreach (['Banjir','Gempa Bumi','Tanah Longsor','Kebakaran'] as $b)
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="jenis_bencana[]" value="{{ $b }}"
                            class="text-blue-600 focus:ring-blue-500 rounded" {{ (is_array(old('jenis_bencana')) && in_array($b, old('jenis_bencana'))) ? 'checked' : '' }}>
                        {{ $b }}
                    </label>
                    @endforeach
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="jenis_bencana[]" value="lainnya"
                            class="text-blue-600 focus:ring-blue-500 rounded" {{ (is_array(old('jenis_bencana')) && in_array('lainnya', old('jenis_bencana'))) ? 'checked' : '' }}>
                        Lainnya:
                        <input type="text" name="jenis_bencana_lainnya" value="{{ old('jenis_bencana_lainnya') }}"
                            class="flex-1 px-3 py-1.5 bg-gray-50 border border-gray-400 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('jenis_bencana_lainnya') border-red-500 bg-red-50 @enderror">
                    </label>
                </div>
                @error('jenis_bencana')
                <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            {{-- Cedera Kecelakaan --}}
            <div>
                <p class="text-sm font-medium text-gray-700 mb-3">Cedera Kecelakaan</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach (['Tumpul','Tajam','Bakar','Peluru','Keracunan','Tenggelam'] as $c)
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="jenis_cedera[]" value="{{ $c }}"
                            class="text-blue-600 focus:ring-blue-500 rounded" {{ (is_array(old('jenis_cedera')) && in_array($c, old('jenis_cedera'))) ? 'checked' : '' }}>
                        {{ $c }}
                    </label>
                    @endforeach
                </div>
                <label class="flex items-center gap-2 text-sm text-gray-700 mt-2">
                    <input type="checkbox" name="jenis_cedera[]" value="afiksia" class="text-blue-600 focus:ring-blue-500 rounded" {{
                        (is_array(old('jenis_cedera')) && in_array('afiksia', old('jenis_cedera'))) ? 'checked' : '' }}>
                    Afiksia:
                    <input type="text" name="jenis_cedera_afiksia" value="{{ old('jenis_cedera_afiksia') }}"
                        class="flex-1 px-3 py-1.5 bg-gray-50 border border-gray-400 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('jenis_cedera_afiksia') border-red-500 bg-red-50 @enderror">
                </label>
                @error('jenis_cedera')
                <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
        </div>
    </div>

    {{-- ============ PENEMUAN & PELAPOR ============ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
        <div class="p-6 border-b border-gray-300">
            <h3 class="text-lg font-semibold text-gray-800">Penemuan & Identitas Penemu / Pelapor</h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="tanggal_ditemukan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Ditemukan</label>
                <input type="date" name="tanggal_ditemukan" id="tanggal_ditemukan"
                    value="{{ old('tanggal_ditemukan') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tanggal_ditemukan') border-red-500 bg-red-50 @enderror">
                @error('tanggal_ditemukan')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="jam_ditemukan" class="block text-sm font-medium text-gray-700 mb-2">Jam Ditemukan</label>
                <input type="time" name="jam_ditemukan" id="jam_ditemukan" value="{{ old('jam_ditemukan') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jam_ditemukan') border-red-500 bg-red-50 @enderror">
                @error('jam_ditemukan')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="lokasi_ditemukan" class="block text-sm font-medium text-gray-700 mb-2">Lokasi Ditemukan</label>
                <input type="text" name="lokasi_ditemukan" id="lokasi_ditemukan" value="{{ old('lokasi_ditemukan') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('lokasi_ditemukan') border-red-500 bg-red-50 @enderror"
                    placeholder="Lokasi ditemukan">
                @error('lokasi_ditemukan')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="penemu_nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Penemu / Pelapor</label>
                <input type="text" name="penemu_nama" id="penemu_nama" value="{{ old('penemu_nama') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('penemu_nama') border-red-500 bg-red-50 @enderror">
                @error('penemu_nama')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="penemu_umur" class="block text-sm font-medium text-gray-700 mb-2">Umur Penemu</label>
                <input type="number" name="penemu_umur" id="penemu_umur" value="{{ old('penemu_umur') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('penemu_umur') border-red-500 bg-red-50 @enderror">
                @error('penemu_umur')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="penemu_jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin Penemu</label>
                <select name="penemu_jenis_kelamin" id="penemu_jenis_kelamin"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('penemu_jenis_kelamin') border-red-500 bg-red-50 @enderror">
                    <option value="">Pilih</option>
                    <option value="Laki-laki" {{ old('penemu_jenis_kelamin')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('penemu_jenis_kelamin')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('penemu_jenis_kelamin')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="penemu_alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat Penemu</label>
                <input type="text" name="penemu_alamat" id="penemu_alamat" value="{{ old('penemu_alamat') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('penemu_alamat') border-red-500 bg-red-50 @enderror">
                @error('penemu_alamat')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="penemu_telp" class="block text-sm font-medium text-gray-700 mb-2">No. Telp / Hp Penemu</label>
                <input type="text" name="penemu_telp" id="penemu_telp" value="{{ old('penemu_telp') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('penemu_telp') border-red-500 bg-red-50 @enderror">
                @error('penemu_telp')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
        </div>
    </div>

    {{-- ============ PEMERIKSAAN FISIK ============ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
        <div class="p-6 border-b border-gray-300">
            <h3 class="text-lg font-semibold text-gray-800">Pemeriksaan Fisik</h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="tekanan_darah" class="block text-sm font-medium text-gray-700 mb-2">Vital Sign - Tekanan Darah (T)</label>
                <input type="text" name="tekanan_darah" id="tekanan_darah" value="{{ old('tekanan_darah') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tekanan_darah') border-red-500 bg-red-50 @enderror"
                    placeholder="120/80 mmHg">
                @error('tekanan_darah')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="nadi" class="block text-sm font-medium text-gray-700 mb-2">Nadi (N) - x/menit</label>
                <input type="text" name="nadi" id="nadi" value="{{ old('nadi') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nadi') border-red-500 bg-red-50 @enderror"
                    placeholder="80">
                @error('nadi')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="respirasi" class="block text-sm font-medium text-gray-700 mb-2">Respirasi (R) - x/menit</label>
                <input type="text" name="respirasi" id="respirasi" value="{{ old('respirasi') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('respirasi') border-red-500 bg-red-50 @enderror"
                    placeholder="20">
                @error('respirasi')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="suhu" class="block text-sm font-medium text-gray-700 mb-2">Suhu (S) - °C</label>
                <input type="number" step="0.1" name="suhu" id="suhu" value="{{ old('suhu') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('suhu') border-red-500 bg-red-50 @enderror"
                    placeholder="36.5">
                @error('suhu')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="bb" class="block text-sm font-medium text-gray-700 mb-2">BB (kg)</label>
                <input type="number" step="0.1" name="bb" id="bb" value="{{ old('bb') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('bb') border-red-500 bg-red-50 @enderror">
                @error('bb')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="tb" class="block text-sm font-medium text-gray-700 mb-2">TB (cm)</label>
                <input type="number" step="0.1" name="tb" id="tb" value="{{ old('tb') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tb') border-red-500 bg-red-50 @enderror">
                @error('tb')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nyeri</label>
                <div class="flex items-center gap-6 px-4 py-2.5">
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="nyeri" value="Ya" class="text-blue-600 focus:ring-blue-500" {{ old('nyeri')=='Ya' ? 'checked' : '' }}>
                        Ya
                    </label>
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="nyeri" value="Tidak" class="text-blue-600 focus:ring-blue-500" {{ old('nyeri')=='Tidak' ? 'checked' : '' }}>
                        Tidak
                    </label>
                </div>
                @error('nyeri')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="skala_nyeri" class="block text-sm font-medium text-gray-700 mb-2">Skala Nyeri</label>
                <select name="skala_nyeri" id="skala_nyeri"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('skala_nyeri') border-red-500 bg-red-50 @enderror">
                    <option value="">Pilih</option>
                    <option value="Ringan" {{ old('skala_nyeri')=='Ringan' ? 'selected' : '' }}>Ringan</option>
                    <option value="Sedang" {{ old('skala_nyeri')=='Sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="Berat" {{ old('skala_nyeri')=='Berat' ? 'selected' : '' }}>Berat</option>
                </select>
                @error('skala_nyeri')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="alergi" class="block text-sm font-medium text-gray-700 mb-2">Alergi</label>
                <input type="text" name="alergi" id="alergi" value="{{ old('alergi') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('alergi') border-red-500 bg-red-50 @enderror"
                    placeholder="Riwayat alergi (jika ada)">
                @error('alergi')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="md:col-span-3">
                <label for="pemeriksaan_psikiatri" class="block text-sm font-medium text-gray-700 mb-2">Pemeriksaan Psikiatri</label>
                <textarea name="pemeriksaan_psikiatri" id="pemeriksaan_psikiatri" rows="2"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('pemeriksaan_psikiatri') border-red-500 bg-red-50 @enderror">{{ old('pemeriksaan_psikiatri') }}</textarea>
                @error('pemeriksaan_psikiatri')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
        </div>
    </div>

    {{-- ============ KONDISI (TRIASE) ============ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
        <div class="p-6 border-b border-gray-300">
            <h3 class="text-lg font-semibold text-gray-800">Kondisi</h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-4 gap-4">
            <label class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 border-red-300 bg-red-50 cursor-pointer @error('kondisi') ring-2 ring-red-500 @enderror">
                <input type="radio" name="kondisi" value="P1" class="text-red-600 focus:ring-red-500" {{ old('kondisi')=='P1' ? 'checked' : '' }}>
                <span class="text-sm font-medium text-red-700">P1 Gawat Darurat</span>
            </label>
            <label class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 border-yellow-300 bg-yellow-50 cursor-pointer @error('kondisi') ring-2 ring-red-500 @enderror">
                <input type="radio" name="kondisi" value="P2" class="text-yellow-600 focus:ring-yellow-500" {{ old('kondisi')=='P2' ? 'checked' : '' }}>
                <span class="text-sm font-medium text-yellow-700">P2 Gawat Tidak Darurat</span>
            </label>
            <label class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 border-green-300 bg-green-50 cursor-pointer @error('kondisi') ring-2 ring-red-500 @enderror">
                <input type="radio" name="kondisi" value="P3" class="text-green-600 focus:ring-green-500" {{ old('kondisi')=='P3' ? 'checked' : '' }}>
                <span class="text-sm font-medium text-green-700">P3 Tidak Gawat dan Tidak Darurat</span>
            </label>
            <label class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 border-gray-400 bg-gray-100 cursor-pointer @error('kondisi') ring-2 ring-red-500 @enderror">
                <input type="radio" name="kondisi" value="P4" class="text-gray-700 focus:ring-gray-500" {{ old('kondisi')=='P4' ? 'checked' : '' }}>
                <span class="text-sm font-medium text-gray-700">P4 Meninggal</span>
            </label>
        </div>
        @error('kondisi')
        <div class="px-6 pb-4">
            <p class="text-sm text-red-500 flex items-center gap-1">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ $message }}
            </p>
        </div>
        @enderror
    </div>

    {{-- ============ ANAMNESIS, DIAGNOSA, TINDAKAN ============ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
        <div class="p-6 border-b border-gray-300">
            <h3 class="text-lg font-semibold text-gray-800">Anamnesis & Tindakan</h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="keluhan" class="block text-sm font-medium text-gray-700 mb-2">Keluhan</label>
                <textarea name="keluhan" id="keluhan" rows="3"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('keluhan') border-red-500 bg-red-50 @enderror">{{ old('keluhan') }}</textarea>
                @error('keluhan')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="anamnesis" class="block text-sm font-medium text-gray-700 mb-2">Anamnesis</label>
                <textarea name="anamnesis" id="anamnesis" rows="3"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('anamnesis') border-red-500 bg-red-50 @enderror">{{ old('anamnesis') }}</textarea>
                @error('anamnesis')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="terapi" class="block text-sm font-medium text-gray-700 mb-2">Terapi yang Sudah Dilakukan</label>
                <textarea name="terapi" id="terapi" rows="3"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('terapi') border-red-500 bg-red-50 @enderror">{{ old('terapi') }}</textarea>
                @error('terapi')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="diagnosa_awal" class="block text-sm font-medium text-gray-700 mb-2">Diagnosis</label>
                <textarea name="diagnosa_awal" id="diagnosa_awal" rows="3"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('diagnosa_awal') border-red-500 bg-red-50 @enderror">{{ old('diagnosa_awal') }}</textarea>
                @error('diagnosa_awal')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="tindakan" class="block text-sm font-medium text-gray-700 mb-2">Tindakan</label>
                <textarea name="tindakan" id="tindakan" rows="3"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tindakan') border-red-500 bg-red-50 @enderror">{{ old('tindakan') }}</textarea>
                @error('tindakan')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
        </div>
    </div>

    {{-- ============ PETUGAS ============ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
        <div class="p-6 border-b border-gray-300">
            <h3 class="text-lg font-semibold text-gray-800">Petugas</h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="petugas_nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Petugas</label>
                <input type="text" name="petugas_nama" id="petugas_nama"
                    value="{{ old('petugas_nama', auth()->user()->name ?? '') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('petugas_nama') border-red-500 bg-red-50 @enderror">
                @error('petugas_nama')
                <p class="mt-1 text-sm text-red-500 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Form Actions --}}
    <div class="flex items-center justify-end gap-3 pb-2">
        <a href="{{ route('admin.pemeriksaan.index') }}"
            class="px-6 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors font-medium text-sm">
            Batal
        </a>
        <button type="submit"
            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-colors font-medium text-sm shadow-lg shadow-blue-600/20">
            Simpan Pemeriksaan
        </button>
    </div>
</form>
@endsection
