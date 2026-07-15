@extends('layouts.admin')

@section('title', 'Edit Pemeriksaan')
@section('page-title', 'Edit Pemeriksaan Medis')
@section('page-subtitle', 'Dokumen Rekam Medis Bencana')

@php
    // Helper function to decode JSON fields
    function decodeJsonEdit($value, $default = []) {
        if (is_array($value)) return $value;
        if (is_string($value) && $value) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : $default;
        }
        return $default;
    }
    
    // Get decoded values for checkboxes
    $airwayValues = decodeJsonEdit($pemeriksaan->airway, old('airway', []));
    $breathingValues = decodeJsonEdit($pemeriksaan->breathing, old('breathing', []));
    $circulationValues = decodeJsonEdit($pemeriksaan->circulation, old('circulation', []));
    $disabilityValues = decodeJsonEdit($pemeriksaan->disability, old('disability', []));
    $eksposureValues = decodeJsonEdit($pemeriksaan->eksposure, old('eksposure', []));
    $prehospitalValues = decodeJsonEdit($pemeriksaan->prehospital, old('prehospital', []));
    $dipulangkanValues = decodeJsonEdit($pemeriksaan->dipulangkan_status, old('dipulangkan_status', []));
    $jenisBencanaValues = decodeJsonEdit($pemeriksaan->jenis_bencana, old('jenis_bencana', []));
    $jenisCederaValues = decodeJsonEdit($pemeriksaan->jenis_cedera, old('jenis_cedera', []));
@endphp

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

<form action="{{ route('admin.pemeriksaan.update', $pemeriksaan) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

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
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('korban_id') border-red-500 @enderror">
                    <option value="">Pilih Korban</option>
                    @foreach ($korban as $k)
                    <option value="{{ $k->id }}" {{ old('korban_id', $pemeriksaan->korban_id)==$k->id ? 'selected' : '' }}>
                        {{ $k->nama }} ({{ $k->jenis_kelamin }}, {{ $k->umur }} tahun)
                    </option>
                    @endforeach
                </select>
                @error('korban_id')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="no_pasien" class="block text-sm font-medium text-gray-700 mb-2">No Pasien</label>
                <input type="text" name="no_pasien" id="no_pasien" value="{{ old('no_pasien', $pemeriksaan->no_pasien) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Nomor pasien">
            </div>

            <div>
                <label for="nama_pasien" class="block text-sm font-medium text-gray-700 mb-2">Nama Pasien</label>
                <input type="text" name="nama_pasien" id="nama_pasien" value="{{ old('nama_pasien', $pemeriksaan->nama_pasien) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Nama lengkap pasien">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                <div class="flex items-center gap-6 px-4 py-2.5">
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="jenis_kelamin" value="Laki-laki"
                            class="text-blue-600 focus:ring-blue-500" {{ old('jenis_kelamin', $pemeriksaan->jenis_kelamin)=='Laki-laki' ? 'checked' : '' }}>
                        Laki - laki
                    </label>
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="jenis_kelamin" value="Perempuan"
                            class="text-blue-600 focus:ring-blue-500" {{ old('jenis_kelamin', $pemeriksaan->jenis_kelamin)=='Perempuan' ? 'checked' : '' }}>
                        Perempuan
                    </label>
                </div>
            </div>

            <div>
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $pemeriksaan->tanggal_lahir) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label for="umur" class="block text-sm font-medium text-gray-700 mb-2">Umur</label>
                <input type="number" name="umur" id="umur" value="{{ old('umur', $pemeriksaan->umur) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Umur (tahun)">
            </div>

            <div class="md:col-span-2">
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                <textarea name="alamat" id="alamat" rows="2"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Alamat lengkap">{{ old('alamat', $pemeriksaan->alamat) }}</textarea>
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
                            class="text-blue-600 focus:ring-blue-500 rounded" {{ in_array($b, $jenisBencanaValues) ? 'checked' : '' }}>
                        {{ $b }}
                    </label>
                    @endforeach
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="jenis_bencana[]" value="lainnya"
                            class="text-blue-600 focus:ring-blue-500 rounded" {{ in_array('lainnya', $jenisBencanaValues) ? 'checked' : '' }}>
                        Lainnya:
                        <input type="text" name="jenis_bencana_lainnya" value="{{ old('jenis_bencana_lainnya', $pemeriksaan->jenis_bencana_lainnya) }}"
                            class="flex-1 px-3 py-1.5 bg-gray-50 border border-gray-400 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </label>
                </div>
            </div>

            {{-- Cedera Kecelakaan --}}
            <div>
                <p class="text-sm font-medium text-gray-700 mb-3">Cedera Kecelakaan</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach (['Tumpul','Tajam','Bakar','Peluru','Keracunan','Tenggelam'] as $c)
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="jenis_cedera[]" value="{{ $c }}"
                            class="text-blue-600 focus:ring-blue-500 rounded" {{ in_array($c, $jenisCederaValues) ? 'checked' : '' }}>
                        {{ $c }}
                    </label>
                    @endforeach
                </div>
                <label class="flex items-center gap-2 text-sm text-gray-700 mt-2">
                    <input type="checkbox" name="jenis_cedera[]" value="afiksia" class="text-blue-600 focus:ring-blue-500 rounded" {{ in_array('afiksia', $jenisCederaValues) ? 'checked' : '' }}>
                    Afiksia:
                    <input type="text" name="jenis_cedera_afiksia" value="{{ old('jenis_cedera_afiksia', $pemeriksaan->jenis_cedera_afiksia) }}"
                        class="flex-1 px-3 py-1.5 bg-gray-50 border border-gray-400 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </label>
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
                    value="{{ old('tanggal_ditemukan', $pemeriksaan->tanggal_ditemukan) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label for="jam_ditemukan" class="block text-sm font-medium text-gray-700 mb-2">Jam Ditemukan</label>
                <input type="time" name="jam_ditemukan" id="jam_ditemukan" value="{{ old('jam_ditemukan', $pemeriksaan->jam_ditemukan) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label for="lokasi_ditemukan" class="block text-sm font-medium text-gray-700 mb-2">Lokasi Ditemukan</label>
                <input type="text" name="lokasi_ditemukan" id="lokasi_ditemukan" value="{{ old('lokasi_ditemukan', $pemeriksaan->lokasi_ditemukan) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Lokasi ditemukan">
            </div>

            <div>
                <label for="penemu_nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Penemu / Pelapor</label>
                <input type="text" name="penemu_nama" id="penemu_nama" value="{{ old('penemu_nama', $pemeriksaan->penemu_nama) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label for="penemu_umur" class="block text-sm font-medium text-gray-700 mb-2">Umur Penemu</label>
                <input type="number" name="penemu_umur" id="penemu_umur" value="{{ old('penemu_umur', $pemeriksaan->penemu_umur) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label for="penemu_jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin Penemu</label>
                <select name="penemu_jenis_kelamin" id="penemu_jenis_kelamin"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Pilih</option>
                    <option value="Laki-laki" {{ old('penemu_jenis_kelamin', $pemeriksaan->penemu_jenis_kelamin)=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('penemu_jenis_kelamin', $pemeriksaan->penemu_jenis_kelamin)=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label for="penemu_alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat Penemu</label>
                <input type="text" name="penemu_alamat" id="penemu_alamat" value="{{ old('penemu_alamat', $pemeriksaan->penemu_alamat) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label for="penemu_telp" class="block text-sm font-medium text-gray-700 mb-2">No. Telp / Hp Penemu</label>
                <input type="text" name="penemu_telp" id="penemu_telp" value="{{ old('penemu_telp', $pemeriksaan->penemu_telp) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
                <input type="text" name="tekanan_darah" id="tekanan_darah" value="{{ old('tekanan_darah', $pemeriksaan->tekanan_darah) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tekanan_darah') border-red-500 @enderror"
                    placeholder="120/80 mmHg">
            </div>
            <div>
                <label for="nadi" class="block text-sm font-medium text-gray-700 mb-2">Nadi (N) - x/menit</label>
                <input type="text" name="nadi" id="nadi" value="{{ old('nadi', $pemeriksaan->nadi) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nadi') border-red-500 @enderror"
                    placeholder="80">
            </div>
            <div>
                <label for="respirasi" class="block text-sm font-medium text-gray-700 mb-2">Respirasi (R) - x/menit</label>
                <input type="text" name="respirasi" id="respirasi" value="{{ old('respirasi', $pemeriksaan->respirasi) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('respirasi') border-red-500 @enderror"
                    placeholder="20">
            </div>
            <div>
                <label for="suhu" class="block text-sm font-medium text-gray-700 mb-2">Suhu (S) - °C</label>
                <input type="number" step="0.1" name="suhu" id="suhu" value="{{ old('suhu', $pemeriksaan->suhu) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('suhu') border-red-500 @enderror"
                    placeholder="36.5">
            </div>
            <div>
                <label for="bb" class="block text-sm font-medium text-gray-700 mb-2">BB (kg)</label>
                <input type="number" step="0.1" name="bb" id="bb" value="{{ old('bb', $pemeriksaan->bb) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label for="tb" class="block text-sm font-medium text-gray-700 mb-2">TB (cm)</label>
                <input type="number" step="0.1" name="tb" id="tb" value="{{ old('tb', $pemeriksaan->tb) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nyeri</label>
                <div class="flex items-center gap-6 px-4 py-2.5">
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="nyeri" value="Ya" class="text-blue-600 focus:ring-blue-500" {{ old('nyeri', $pemeriksaan->nyeri)=='Ya' ? 'checked' : '' }}>
                        Ya
                    </label>
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="nyeri" value="Tidak" class="text-blue-600 focus:ring-blue-500" {{ old('nyeri', $pemeriksaan->nyeri)=='Tidak' ? 'checked' : '' }}>
                        Tidak
                    </label>
                </div>
            </div>
            <div>
                <label for="skala_nyeri" class="block text-sm font-medium text-gray-700 mb-2">Skala Nyeri</label>
                <select name="skala_nyeri" id="skala_nyeri"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Pilih</option>
                    <option value="Ringan" {{ old('skala_nyeri', $pemeriksaan->skala_nyeri)=='Ringan' ? 'selected' : '' }}>Ringan</option>
                    <option value="Sedang" {{ old('skala_nyeri', $pemeriksaan->skala_nyeri)=='Sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="Berat" {{ old('skala_nyeri', $pemeriksaan->skala_nyeri)=='Berat' ? 'selected' : '' }}>Berat</option>
                </select>
            </div>
            <div>
                <label for="alergi" class="block text-sm font-medium text-gray-700 mb-2">Alergi</label>
                <input type="text" name="alergi" id="alergi" value="{{ old('alergi', $pemeriksaan->alergi) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Riwayat alergi (jika ada)">
            </div>

            <div class="md:col-span-3">
                <label for="pemeriksaan_psikiatri" class="block text-sm font-medium text-gray-700 mb-2">Pemeriksaan Psikiatri</label>
                <textarea name="pemeriksaan_psikiatri" id="pemeriksaan_psikiatri" rows="2"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('pemeriksaan_psikiatri', $pemeriksaan->pemeriksaan_psikiatri) }}</textarea>
            </div>
        </div>
    </div>

    {{-- ============ PEMERIKSAAN AWAL & PRIMARY SURVEY ============ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
        <div class="p-6 border-b border-gray-300">
            <h3 class="text-lg font-semibold text-gray-800">Pemeriksaan Awal</h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pupil</label>
                <div class="flex items-center gap-6 px-4 py-2.5">
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="pupil" value="Isokor" class="text-blue-600 focus:ring-blue-500" {{ old('pupil', $pemeriksaan->pupil)=='Isokor' ? 'checked' : '' }}>
                        Isokor
                    </label>
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="pupil" value="Anisokor" class="text-blue-600 focus:ring-blue-500" {{ old('pupil', $pemeriksaan->pupil)=='Anisokor' ? 'checked' : '' }}>
                        Anisokor
                    </label>
                </div>
            </div>
            <div>
                <label for="reflek_cahaya" class="block text-sm font-medium text-gray-700 mb-2">Reflek Cahaya</label>
                <input type="text" name="reflek_cahaya" id="reflek_cahaya" value="{{ old('reflek_cahaya', $pemeriksaan->reflek_cahaya) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <div class="p-6 pt-0 grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Airway & C-Spine + Breathing --}}
            <div>
                <p class="text-sm font-medium text-gray-700 mb-3">Airway & C-Spine</p>
                <div class="space-y-2 mb-4">
                    @foreach (['bersih'=>'Bersih','slem_partial'=>'Slem Sumbatan Partial','slem_total'=>'Slem Sumbatan Total','lain'=>'Lain - lain'] as $val => $lbl)
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="airway[]" value="{{ $val }}"
                            class="rounded text-blue-600 focus:ring-blue-500" {{ in_array($val, $airwayValues) ? 'checked' : '' }}>
                        {{ $lbl }}
                    </label>
                    @endforeach
                </div>

                <p class="text-sm font-medium text-gray-700 mb-3">Breathing</p>
                <div class="space-y-2">
                    @foreach(['normal'=>'Normal','wheezing'=>'Wheezing','ronchi'=>'Ronchi','retraction'=>'Retraction','nasal_faring'=>'Nasal Faring','abnormal_position'=>'Abnormal Position'] as $val => $lbl)
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="breathing[]" value="{{ $val }}"
                            class="rounded text-blue-600 focus:ring-blue-500" {{ in_array($val, $breathingValues) ? 'checked' : '' }}>
                        {{ $lbl }}
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Circulation + Disability --}}
            <div>
                <p class="text-sm font-medium text-gray-700 mb-3">Circulation</p>
                <div class="space-y-2 mb-4">
                    @foreach(['pallor'=>'Pallor','motting'=>'Motting','cyanosis'=>'Cyanosis','capillary_refill'=>'Capillary Refill'] as $val => $lbl)
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="circulation[]" value="{{ $val }}"
                            class="rounded text-blue-600 focus:ring-blue-500" {{ in_array($val, $circulationValues) ? 'checked' : '' }}>
                        {{ $lbl }}
                    </label>
                    @endforeach
                </div>

                <p class="text-sm font-medium text-gray-700 mb-3">Disability (GCS)</p>
                <div class="space-y-2">
                    @foreach (['eye_movement'=>'Eye Movement','reflek_motorik'=>'Reflek Motorik','verbal'=>'Verbal'] as $val => $lbl)
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="disability[]" value="{{ $val }}"
                            class="rounded text-blue-600 focus:ring-blue-500" {{ in_array($val, $disabilityValues) ? 'checked' : '' }}>
                        {{ $lbl }}
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Exposure + Prehospital --}}
            <div>
                <p class="text-sm font-medium text-gray-700 mb-3">Eksposure</p>
                <div class="grid grid-cols-2 gap-2 mb-4">
                    @foreach(['pendarahan'=>'Pendarahan','fraktur'=>'Fraktur','parase'=>'Parase','plegi'=>'Plegi','paraperesis'=>'Paraperesis'] as $val => $lbl)
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="eksposure[]" value="{{ $val }}"
                            class="rounded text-blue-600 focus:ring-blue-500" {{ in_array($val, $eksposureValues) ? 'checked' : '' }}>
                        {{ $lbl }}
                    </label>
                    @endforeach
                </div>

                <p class="text-sm font-medium text-gray-700 mb-3">Prehospital</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach (['rjp'=>'RJP','intubasi'=>'Intubasi','o2'=>'O2','ecollar'=>'Ecollar','balut_bidai'=>'Balut / Bidai','obat'=>'Obat'] as $val => $lbl)
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="prehospital[]" value="{{ $val }}"
                            class="rounded text-blue-600 focus:ring-blue-500" {{ in_array($val, $prehospitalValues) ? 'checked' : '' }}>
                        {{ $lbl }}
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ============ KONDISI (TRIASE) ============ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
        <div class="p-6 border-b border-gray-300">
            <h3 class="text-lg font-semibold text-gray-800">Kondisi</h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-4 gap-4">
            <label class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 border-red-300 bg-red-50 cursor-pointer">
                <input type="radio" name="kondisi" value="P1" class="text-red-600 focus:ring-red-500" {{ old('kondisi', $pemeriksaan->kondisi)=='P1' ? 'checked' : '' }}>
                <span class="text-sm font-medium text-red-700">P1 Gawat Darurat</span>
            </label>
            <label class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 border-yellow-300 bg-yellow-50 cursor-pointer">
                <input type="radio" name="kondisi" value="P2" class="text-yellow-600 focus:ring-yellow-500" {{ old('kondisi', $pemeriksaan->kondisi)=='P2' ? 'checked' : '' }}>
                <span class="text-sm font-medium text-yellow-700">P2 Gawat Tidak Darurat</span>
            </label>
            <label class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 border-green-300 bg-green-50 cursor-pointer">
                <input type="radio" name="kondisi" value="P3" class="text-green-600 focus:ring-green-500" {{ old('kondisi', $pemeriksaan->kondisi)=='P3' ? 'checked' : '' }}>
                <span class="text-sm font-medium text-green-700">P3 Tidak Gawat dan Tidak Darurat</span>
            </label>
            <label class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 border-gray-400 bg-gray-100 cursor-pointer">
                <input type="radio" name="kondisi" value="P4" class="text-gray-700 focus:ring-gray-500" {{ old('kondisi', $pemeriksaan->kondisi)=='P4' ? 'checked' : '' }}>
                <span class="text-sm font-medium text-gray-700">P4 Meninggal</span>
            </label>
        </div>
    </div>

    {{-- ============ ANAMNESIS, DIAGNOSA, TINDAKAN ============ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
        <div class="p-6 border-b border-gray-300">
            <h3 class="text-lg font-semibold text-gray-800">Anamnesis & Tindakan</h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="anamnesis" class="block text-sm font-medium text-gray-700 mb-2">Anamnesis</label>
                <textarea name="anamnesis" id="anamnesis" rows="3"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('anamnesis', $pemeriksaan->anamnesis) }}</textarea>
            </div>
            <div>
                <label for="terapi" class="block text-sm font-medium text-gray-700 mb-2">Terapi yang Sudah Dilakukan</label>
                <textarea name="terapi" id="terapi" rows="3"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('terapi', $pemeriksaan->terapi) }}</textarea>
            </div>
            <div>
                <label for="diagnosa_awal" class="block text-sm font-medium text-gray-700 mb-2">Diagnosis</label>
                <textarea name="diagnosa_awal" id="diagnosa_awal" rows="3"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('diagnosa_awal') border-red-500 @enderror">{{ old('diagnosa_awal', $pemeriksaan->diagnosa_awal) }}</textarea>
                @error('diagnosa_awal')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="tindakan" class="block text-sm font-medium text-gray-700 mb-2">Tindakan</label>
                <textarea name="tindakan" id="tindakan" rows="3"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tindakan') border-red-500 @enderror">{{ old('tindakan', $pemeriksaan->tindakan) }}</textarea>
                @error('tindakan')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- ============ TINDAKAN LANJUTAN ============ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
        <div class="p-6 border-b border-gray-300">
            <h3 class="text-lg font-semibold text-gray-800">Tindakan Lanjutan</h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-3">
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="radio" name="tindakan_lanjutan" value="dipulangkan"
                        class="text-blue-600 focus:ring-blue-500" {{ old('tindakan_lanjutan', $pemeriksaan->tindakan_lanjutan)=='dipulangkan' ? 'checked' : '' }}>
                    Dipulangkan
                </label>
                <div class="pl-6 space-y-2">
                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input type="checkbox" name="dipulangkan_status[]" value="diijinkan"
                            class="rounded text-blue-600 focus:ring-blue-500" {{ in_array('diijinkan', $dipulangkanValues) ? 'checked' : '' }}>
                        Di ijinkan
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input type="checkbox" name="dipulangkan_status[]" value="aps"
                            class="rounded text-blue-600 focus:ring-blue-500" {{ in_array('aps', $dipulangkanValues) ? 'checked' : '' }}>
                        APS
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input type="checkbox" name="dipulangkan_status[]" value="lari"
                            class="rounded text-blue-600 focus:ring-blue-500" {{ in_array('lari', $dipulangkanValues) ? 'checked' : '' }}>
                        LARI
                    </label>
                </div>

                <label class="flex items-center gap-2 text-sm text-gray-700 pt-2">
                    <input type="radio" name="tindakan_lanjutan" value="dirawat_lapangan"
                        class="text-blue-600 focus:ring-blue-500" {{ old('tindakan_lanjutan', $pemeriksaan->tindakan_lanjutan)=='dirawat_lapangan' ? 'checked' : '' }}>
                    Dirawat di RS Lapangan
                </label>

                <label class="flex items-center gap-2 text-sm text-gray-700 pt-2">
                    <input type="radio" name="tindakan_lanjutan" value="meninggal"
                        class="text-blue-600 focus:ring-blue-500" {{ old('tindakan_lanjutan', $pemeriksaan->tindakan_lanjutan)=='meninggal' ? 'checked' : '' }}>
                    Meninggal
                </label>
                <div class="pl-6 flex gap-3">
                    <input type="date" name="tanggal_meninggal" value="{{ old('tanggal_meninggal', $pemeriksaan->tanggal_meninggal) }}"
                        class="px-3 py-2 bg-gray-50 border border-gray-400 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="time" name="jam_meninggal" value="{{ old('jam_meninggal', $pemeriksaan->jam_meninggal) }}"
                        class="px-3 py-2 bg-gray-50 border border-gray-400 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="space-y-3">
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="radio" name="tindakan_lanjutan" value="dirujuk"
                        class="text-blue-600 focus:ring-blue-500" {{ old('tindakan_lanjutan', $pemeriksaan->tindakan_lanjutan)=='dirujuk' ? 'checked' : '' }}>
                    Dirujuk ke
                </label>
                <input type="text" name="dirujuk_ke" value="{{ old('dirujuk_ke', $pemeriksaan->dirujuk_ke) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Nama fasilitas rujukan">
                <input type="text" name="nama_pengantar" value="{{ old('nama_pengantar', $pemeriksaan->nama_pengantar) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Nama pengantar">

                <p class="text-sm font-medium text-gray-700 pt-2">Transportasi</p>
                <div class="flex items-center gap-6">
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="transportasi" value="ambulance"
                            class="text-blue-600 focus:ring-blue-500" {{ old('transportasi', $pemeriksaan->transportasi)=='ambulance' ? 'checked' : '' }}>
                        Ambulance
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="transportasi" value="mobil" class="text-blue-600 focus:ring-blue-500"
                            {{ old('transportasi', $pemeriksaan->transportasi)=='mobil' ? 'checked' : '' }}>
                        Mobil
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="transportasi" value="lain" class="text-blue-600 focus:ring-blue-500"
                            {{ old('transportasi', $pemeriksaan->transportasi)=='lain' ? 'checked' : '' }}>
                        Lain - lain
                    </label>
                </div>
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
                    value="{{ old('petugas_nama', $pemeriksaan->petugas_nama ?? auth()->user()->name ?? '') }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
            Perbarui Pemeriksaan
        </button>
    </div>
</form>
@endsection
