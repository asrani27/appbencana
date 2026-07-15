@extends('layouts.admin')

@section('title', 'Detail Pemeriksaan')
@section('page-title', 'Detail Pemeriksaan')
@section('page-subtitle', 'Informasi lengkap data pemeriksaan medis')

@php
    // Helper function to decode JSON fields
    function decodeJson($value, $default = []) {
        if (is_array($value)) return $value;
        if (is_string($value) && $value) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : $default;
        }
        return $default;
    }
    
    // Labels for checkbox fields
    $airwayLabels = ['bersih'=>'Bersih','slem_partial'=>'Slem Sumbatan Partial','slem_total'=>'Slem Sumbatan Total','lain'=>'Lain - lain'];
    $breathingLabels = ['normal'=>'Normal','wheezing'=>'Wheezing','ronchi'=>'Ronchi','retraction'=>'Retraction','nasal_faring'=>'Nasal Faring','abnormal_position'=>'Abnormal Position'];
    $circulationLabels = ['pallor'=>'Pallor','motting'=>'Motting','cyanosis'=>'Cyanosis','capillary_refill'=>'Capillary Refill'];
    $disabilityLabels = ['eye_movement'=>'Eye Movement','reflek_motorik'=>'Reflek Motorik','verbal'=>'Verbal'];
    $eksposureLabels = ['pendarahan'=>'Pendarahan','fraktur'=>'Fraktur','parase'=>'Parase','plegi'=>'Plegi','paraperesis'=>'Paraperesis'];
    $prehospitalLabels = ['rjp'=>'RJP','intubasi'=>'Intubasi','o2'=>'O2','ecollar'=>'Ecollar','balut_bidai'=>'Balut / Bidai','obat'=>'Obat'];
    $dipulangkanLabels = ['diijinkan'=>'Di ijinkan','aps'=>'APS','lari'=>'LARI'];
    
    // Get decoded values
    $airwayValues = decodeJson($pemeriksaan->airway);
    $breathingValues = decodeJson($pemeriksaan->breathing);
    $circulationValues = decodeJson($pemeriksaan->circulation);
    $disabilityValues = decodeJson($pemeriksaan->disability);
    $eksposureValues = decodeJson($pemeriksaan->eksposure);
    $prehospitalValues = decodeJson($pemeriksaan->prehospital);
    $dipulangkanValues = decodeJson($pemeriksaan->dipulangkan_status);
    
    // Kondisi labels
    $kondisiLabels = [
        'P1' => 'P1 Gawat Darurat',
        'P2' => 'P2 Gawat Tidak Darurat',
        'P3' => 'P3 Tidak Gawat dan Tidak Darurat',
        'P4' => 'P4 Meninggal'
    ];
    
    // Jenis bencana labels
    $jenisBencanaLabels = ['Banjir','Gempa Bumi','Tanah Longsor','Kebakaran'];
    $jenisCederaLabels = ['Tumpul','Tajam','Bakar','Peluru','Keracunan','Tenggelam'];
@endphp

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
                {{ strtoupper(substr($pemeriksaan->nama_pasien ?? $pemeriksaan->korban->nama ?? '-', 0, 1)) }}
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white">{{ $pemeriksaan->nama_pasien ?? $pemeriksaan->korban->nama ?? '-' }}</h3>
                <p class="text-teal-100 text-sm">Detail Pemeriksaan Medis</p>
            </div>
        </div>
    </div>

    <div class="p-6 space-y-6">
        {{-- ============ HEADER / IDENTITAS PASIEN ============ --}}
        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Dokumen Rekam Medis Bencana</h4>
            <p class="text-sm text-gray-500 mb-4">RS Politeknik Kesdam VI Banjarmasin</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="text-xs text-gray-500">No Pasien</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->no_pasien ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Nama Pasien</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->nama_pasien ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Jenis Kelamin</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->jenis_kelamin ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Tanggal Lahir</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->tanggal_lahir ? \Carbon\Carbon::parse($pemeriksaan->tanggal_lahir)->locale('id')->translatedFormat('d F Y') : '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Umur</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->umur ? $pemeriksaan->umur . ' tahun' : '-' }}</p>
                </div>
                <div class="md:col-span-1">
                    <p class="text-xs text-gray-500">Alamat</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->alamat ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- ============ JENIS KEJADIAN ============ --}}
        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Jenis Kejadian</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-xs text-gray-500 mb-2">Bencana</p>
                    <p class="text-sm font-medium text-gray-800">
                        @if(in_array($pemeriksaan->jenis_bencana, $jenisBencanaLabels))
                            {{ $pemeriksaan->jenis_bencana }}
                        @elseif($pemeriksaan->jenis_bencana == 'lainnya')
                            Lainnya: {{ $pemeriksaan->jenis_bencana_lainnya ?? '-' }}
                        @else
                            {{ $pemeriksaan->jenis_bencana ?? '-' }}
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-2">Cedera Kecelakaan</p>
                    <p class="text-sm font-medium text-gray-800">
                        @if(in_array($pemeriksaan->jenis_cedera, $jenisCederaLabels))
                            {{ $pemeriksaan->jenis_cedera }}
                        @elseif($pemeriksaan->jenis_cedera == 'afiksia')
                            Afiksia: {{ $pemeriksaan->jenis_cedera_afiksia ?? '-' }}
                        @else
                            {{ $pemeriksaan->jenis_cedera ?? '-' }}
                        @endif
                    </p>
                </div>
            </div>
        </div>

        {{-- ============ PENEMUAN & PELAPOR ============ --}}
        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Penemuan & Identitas Penemu / Pelapor</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="text-xs text-gray-500">Tanggal Ditemukan</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->tanggal_ditemukan ? \Carbon\Carbon::parse($pemeriksaan->tanggal_ditemukan)->locale('id')->translatedFormat('d F Y') : '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Jam Ditemukan</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->jam_ditemukan ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Lokasi Ditemukan</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->lokasi_ditemukan ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Nama Penemu/Pelapor</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->penemu_nama ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Umur Penemu</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->penemu_umur ? $pemeriksaan->penemu_umur . ' tahun' : '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">JK Penemu</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->penemu_jenis_kelamin ?? '-' }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-xs text-gray-500">Alamat Penemu</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->penemu_alamat ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">No. Telp Penemu</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->penemu_telp ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- ============ PEMERIKSAAN FISIK ============ --}}
        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Pemeriksaan Fisik</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="text-xs text-gray-500">Tekanan Darah</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->tekanan_darah ? $pemeriksaan->tekanan_darah . ' mmHg' : '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Nadi</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->nadi ? $pemeriksaan->nadi . ' x/menit' : '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Respirasi</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->respirasi ? $pemeriksaan->respirasi . ' x/menit' : '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Suhu</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->suhu ? $pemeriksaan->suhu . ' °C' : '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">BB</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->bb ? $pemeriksaan->bb . ' kg' : '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">TB</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->tb ? $pemeriksaan->tb . ' cm' : '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Nyeri</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->nyeri ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Skala Nyeri</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->skala_nyeri ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Alergi</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->alergi ?? '-' }}</p>
                </div>
                <div class="md:col-span-3">
                    <p class="text-xs text-gray-500">Pemeriksaan Psikiatri</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->pemeriksaan_psikiatri ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- ============ PRIMARY SURVEY ============ --}}
        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Primary Survey</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-xs text-gray-500 mb-2">Pupil</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->pupil ?? '-' }}</p>
                    <p class="text-xs text-gray-500 mt-2 mb-2">Reflek Cahaya</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->reflek_cahaya ?? '-' }}</p>
                    
                    <p class="text-xs text-gray-500 mt-4 mb-2">Airway & C-Spine</p>
                    <div class="flex flex-wrap gap-1">
                        @forelse($airwayValues as $val)
                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">{{ $airwayLabels[$val] ?? $val }}</span>
                        @empty
                            <span class="text-sm text-gray-400">-</span>
                        @endforelse
                    </div>
                    
                    <p class="text-xs text-gray-500 mt-4 mb-2">Breathing</p>
                    <div class="flex flex-wrap gap-1">
                        @forelse($breathingValues as $val)
                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">{{ $breathingLabels[$val] ?? $val }}</span>
                        @empty
                            <span class="text-sm text-gray-400">-</span>
                        @endforelse
                    </div>
                </div>
                
                <div>
                    <p class="text-xs text-gray-500 mb-2">Circulation</p>
                    <div class="flex flex-wrap gap-1">
                        @forelse($circulationValues as $val)
                            <span class="inline-block px-2 py-1 bg-red-100 text-red-800 text-xs rounded">{{ $circulationLabels[$val] ?? $val }}</span>
                        @empty
                            <span class="text-sm text-gray-400">-</span>
                        @endforelse
                    </div>
                    
                    <p class="text-xs text-gray-500 mt-4 mb-2">Disability (GCS)</p>
                    <div class="flex flex-wrap gap-1">
                        @forelse($disabilityValues as $val)
                            <span class="inline-block px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">{{ $disabilityLabels[$val] ?? $val }}</span>
                        @empty
                            <span class="text-sm text-gray-400">-</span>
                        @endforelse
                    </div>
                </div>
                
                <div>
                    <p class="text-xs text-gray-500 mb-2">Eksposure</p>
                    <div class="flex flex-wrap gap-1">
                        @forelse($eksposureValues as $val)
                            <span class="inline-block px-2 py-1 bg-orange-100 text-orange-800 text-xs rounded">{{ $eksposureLabels[$val] ?? $val }}</span>
                        @empty
                            <span class="text-sm text-gray-400">-</span>
                        @endforelse
                    </div>
                    
                    <p class="text-xs text-gray-500 mt-4 mb-2">Prehospital</p>
                    <div class="flex flex-wrap gap-1">
                        @forelse($prehospitalValues as $val)
                            <span class="inline-block px-2 py-1 bg-green-100 text-green-800 text-xs rounded">{{ $prehospitalLabels[$val] ?? $val }}</span>
                        @empty
                            <span class="text-sm text-gray-400">-</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- ============ KONDISI (TRIASE) ============ --}}
        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Kondisi</h4>
            <div class="flex flex-wrap gap-4">
                @foreach($kondisiLabels as $key => $label)
                    @php
                        $colorClasses = [
                            'P1' => 'bg-red-100 border-red-300 text-red-700',
                            'P2' => 'bg-yellow-100 border-yellow-300 text-yellow-700',
                            'P3' => 'bg-green-100 border-green-300 text-green-700',
                            'P4' => 'bg-gray-100 border-gray-300 text-gray-700'
                        ];
                    @endphp
                    <div class="px-4 py-2 rounded-xl border-2 {{ $colorClasses[$key] }} {{ $pemeriksaan->kondisi == $key ? 'ring-2 ring-offset-2 ring-gray-500' : 'opacity-50' }}">
                        <span class="text-sm font-medium">{{ $label }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ============ ANAMNESIS, DIAGNOSA, TINDAKAN ============ --}}
        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Anamnesis & Tindakan</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-gray-500 mb-1">Anamnesis</p>
                    <p class="text-sm font-medium text-gray-800 whitespace-pre-wrap">{{ $pemeriksaan->anamnesis ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Terapi yang Sudah Dilakukan</p>
                    <p class="text-sm font-medium text-gray-800 whitespace-pre-wrap">{{ $pemeriksaan->terapi ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Diagnosis</p>
                    <p class="text-sm font-medium text-gray-800 whitespace-pre-wrap">{{ $pemeriksaan->diagnosa_awal ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Tindakan</p>
                    <p class="text-sm font-medium text-gray-800 whitespace-pre-wrap">{{ $pemeriksaan->tindakan ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- ============ TINDAKAN LANJUTAN ============ --}}
        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Tindakan Lanjutan</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-xs text-gray-500 mb-2">Tindakan</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->tindakan_lanjutan ?? '-' }}</p>
                    
                    @if($pemeriksaan->tindakan_lanjutan == 'dipulangkan' && count($dipulangkanValues) > 0)
                        <div class="flex flex-wrap gap-1 mt-2">
                            @foreach($dipulangkanValues as $val)
                                <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">{{ $dipulangkanLabels[$val] ?? $val }}</span>
                            @endforeach
                        </div>
                    @endif
                    
                    @if($pemeriksaan->tindakan_lanjutan == 'meninggal')
                        <p class="text-sm text-gray-600 mt-2">
                            {{ $pemeriksaan->tanggal_meninggal ? \Carbon\Carbon::parse($pemeriksaan->tanggal_meninggal)->locale('id')->translatedFormat('d F Y') : '-' }} 
                            {{ $pemeriksaan->jam_meninggal ?? '' }}
                        </p>
                    @endif
                </div>
                <div>
                    @if($pemeriksaan->tindakan_lanjutan == 'dirujuk')
                        <p class="text-xs text-gray-500 mb-1">Dirujuk ke</p>
                        <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->dirujuk_ke ?? '-' }}</p>
                        <p class="text-xs text-gray-500 mb-1 mt-2">Nama Pengantar</p>
                        <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->nama_pengantar ?? '-' }}</p>
                    @endif
                    <p class="text-xs text-gray-500 mb-1 mt-2">Transportasi</p>
                    <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->transportasi ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- ============ PETUGAS ============ --}}
        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Petugas</h4>
            <p class="text-sm font-medium text-gray-800">{{ $pemeriksaan->petugas_nama ?? $pemeriksaan->user->name ?? '-' }}</p>
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
