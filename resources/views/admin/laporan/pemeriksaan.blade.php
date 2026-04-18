@extends('layouts.admin')

@section('title', 'Laporan Pemeriksaan Medis - Sistem Informasi Bencana')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.laporan') }}" class="text-blue-600 hover:text-blue-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Laporan Pemeriksaan Medis</h1>
        </div>
        <p class="text-gray-600">Filter data berdasarkan tanggal atau bulan dan tahun</p>
    </div>

    {{-- Filter Form --}}
    <div class="bg-white rounded-2xl p-6 shadow-lg mb-6">
        <form method="GET" action="{{ route('admin.laporan.pemeriksaan') }}" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" value="{{ $filters['tanggal_mulai'] ?? '' }}"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ $filters['tanggal_selesai'] ?? '' }}"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="flex items-center gap-2 text-gray-500">
                <span>atau</span>
            </div>
            <div class="flex-1 min-w-[150px]">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Bulan</label>
                <select name="bulan"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Pilih Bulan</option>
                    @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ ($filters['bulan'] ?? '') == $i ? 'selected' : '' }}>{{ Carbon\Carbon::createFromDate(null, $i, 1)->format('F') }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex-1 min-w-[120px]">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun</label>
                <select name="tahun"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Pilih Tahun</option>
                    @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                    <option value="{{ $y }}" {{ ($filters['tahun'] ?? '') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition-colors shadow-md">
                    Filter
                </button>
                <a href="{{ route('admin.laporan.pemeriksaan') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl font-semibold transition-colors">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Results --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-5 bg-gradient-to-r from-green-600 to-green-700 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-white">Data Pemeriksaan Medis</h2>
                <p class="text-green-100 text-sm">Periode: {{ $tanggalRange }} | Total: {{ $pemeriksaan->count() }} data</p>
            </div>
            <a href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}" target="_blank"
                class="px-5 py-2 bg-white text-green-600 rounded-xl font-semibold hover:bg-gray-100 transition-colors shadow-md flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export PDF
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-4 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Korban</th>
                        <th class="px-4 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">TD</th>
                        <th class="px-4 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nadi</th>
                        <th class="px-4 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">RR</th>
                        <th class="px-4 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Suhu</th>
                        <th class="px-4 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Keluhan</th>
                        <th class="px-4 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Diagnosa</th>
                        <th class="px-4 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Petugas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($pemeriksaan as $index => $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-4 text-sm text-gray-800">{{ $index + 1 }}</td>
                        <td class="px-4 py-4 text-sm font-semibold text-gray-800">{{ $item->korban->nama ?? '-' }}</td>
                        <td class="px-4 py-4 text-sm text-gray-600">{{ $item->tekanan_darah ?? '-' }}</td>
                        <td class="px-4 py-4 text-sm text-gray-600">{{ $item->nadi ?? '-' }} x/menit</td>
                        <td class="px-4 py-4 text-sm text-gray-600">{{ $item->respirasi ?? '-' }} x/menit</td>
                        <td class="px-4 py-4 text-sm text-gray-600">{{ $item->suhu ?? '-' }} °C</td>
                        <td class="px-4 py-4 text-sm text-gray-600 max-w-[150px] truncate">{{ $item->keluhan ?? '-' }}</td>
                        <td class="px-4 py-4 text-sm text-gray-600 max-w-[150px] truncate">{{ $item->diagnosa_awal ?? '-' }}</td>
                        <td class="px-4 py-4 text-sm text-gray-600">{{ $item->petugas->name ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-4 py-8 text-center text-gray-500 font-medium">Tidak ada data pemeriksaan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
