@extends('layouts.admin')

@section('title', 'API Dokumentasi')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">API Dokumentasi</h1>
        <p class="text-gray-600 mt-1">Dokumentasi endpoint API untuk integrasi aplikasi</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-800">API Endpoints</h2>
                        <p class="text-sm text-gray-500">Base URL: <span class="font-mono bg-gray-100 px-2 py-0.5 rounded">{{ url('/api') }}</span></p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                        Authentication Required
                    </span>
                </div>
            </div>
        </div>

        <div class="p-4">
            @foreach($apiEndpoints as $endpoint)
                <div class="mb-6 last:mb-0">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="px-3 py-1 rounded-lg text-xs font-bold
                            @if($endpoint['method'] === 'GET') bg-green-100 text-green-700
                            @elseif($endpoint['method'] === 'POST') bg-blue-100 text-blue-700
                            @elseif($endpoint['method'] === 'PUT') bg-yellow-100 text-yellow-700
                            @elseif($endpoint['method'] === 'DELETE') bg-red-100 text-red-700
                            @endif">
                            {{ $endpoint['method'] }}
                        </span>
                        <code class="font-mono text-sm text-gray-700 bg-gray-100 px-3 py-1.5 rounded-lg">
                            {{ $endpoint['endpoint'] }}
                        </code>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">{{ $endpoint['description'] }}</p>

                    @if(count($endpoint['parameters']) > 0)
                        <div class="ml-0 md:ml-12">
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Parameters</h4>
                            <div class="bg-gray-50 rounded-lg border border-gray-200 overflow-hidden">
                                <table class="w-full text-sm">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-4 py-2 text-left font-medium text-gray-600">Nama</th>
                                            <th class="px-4 py-2 text-left font-medium text-gray-600">Tipe</th>
                                            <th class="px-4 py-2 text-left font-medium text-gray-600">Wajib</th>
                                            <th class="px-4 py-2 text-left font-medium text-gray-600">Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($endpoint['parameters'] as $param)
                                            <tr>
                                                <td class="px-4 py-2 font-mono text-xs text-purple-600">{{ $param['name'] }}</td>
                                                <td class="px-4 py-2 text-xs text-gray-600">{{ $param['type'] }}</td>
                                                <td class="px-4 py-2">
                                                    @if($param['required'])
                                                        <span class="px-2 py-0.5 bg-red-100 text-red-600 text-xs rounded">Ya</span>
                                                    @else
                                                        <span class="px-2 py-0.5 bg-gray-100 text-gray-500 text-xs rounded">Tidak</span>
                                                    @endif
                                                </td>
                                                <td class="px-4 py-2 text-xs text-gray-600">{{ $param['description'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
                @if(!$loop->last)
                    <hr class="my-6 border-gray-200">
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
