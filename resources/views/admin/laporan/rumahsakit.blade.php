@extends('layouts.admin')

@section('title', 'Laporan Rumah Sakit - Sistem Informasi Bencana')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.laporan') }}" class="text-blue-600 hover:text-blue-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Laporan Rumah Sakit</h1>
        </div>
        <p class="text-gray-600">Daftar rumah sakit rujukan dalam sistem</p>
    </div>

    {{-- Results --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-5 bg-gradient-to-r from-blue-600 to-blue-700 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-white">Data Rumah Sakit</h2>
                <p class="text-blue-100 text-sm">Total: {{ $rumahSakit->count() }} rumah sakit</p>
            </div>
            <a href="{{ route('admin.laporan.rumahsakit', ['export' => 'pdf']) }}" target="_blank"
                class="px-5 py-2 bg-white text-blue-600 rounded-xl font-semibold hover:bg-gray-100 transition-colors shadow-md flex items-center gap-2">
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
                        <th class="px-4 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Rumah Sakit</th>
                        <th class="px-4 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Alamat</th>
                        <th class="px-4 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">No. HP</th>
                        <th class="px-4 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kapasitas IGD</th>
                        <th class="px-4 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Total Rujukan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($rumahSakit as $index => $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-4 text-sm text-gray-800">{{ $index + 1 }}</td>
                        <td class="px-4 py-4 text-sm font-semibold text-gray-800">{{ $item->nama }}</td>
                        <td class="px-4 py-4 text-sm text-gray-600">{{ $item->alamat }}</td>
                        <td class="px-4 py-4 text-sm text-gray-600">{{ $item->no_hp ?? '-' }}</td>
                        <td class="px-4 py-4 text-sm text-gray-600">{{ $item->kapasitas_igd ?? '-' }} bed</td>
                        <td class="px-4 py-4">
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">
                                {{ $item->rujukan_count ?? 0 }} orang
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500 font-medium">Tidak ada data rumah sakit</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
