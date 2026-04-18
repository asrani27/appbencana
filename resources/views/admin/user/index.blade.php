@extends('layouts.admin')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')
@section('page-subtitle', 'Kelola data user sistem')

@section('content')
{{-- Alert Messages --}}
@if (session('success'))
<div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center gap-3">
    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
    </div>
    <div>
        <p class="font-medium text-green-800">{{ session('success') }}</p>
    </div>
</div>
@endif

@if (session('error'))
<div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-center gap-3">
    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </div>
    <div>
        <p class="font-medium text-red-800">{{ session('error') }}</p>
    </div>
</div>
@endif

{{-- Header Actions --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div class="flex items-center gap-3">
        <div class="relative flex-1 sm:flex-none">
            <form method="GET" action="{{ route('admin.users.index') }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari user..."
                    class="w-full sm:w-64 pl-10 pr-4 py-2.5 bg-white border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </form>
        </div>
        <form method="GET" action="{{ route('admin.users.index') }}" class="hidden sm:block">
            <select name="role" onchange="this.form.submit()"
                class="px-4 py-2.5 bg-white border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role')=='admin' ? 'selected' : '' }}>Admin</option>
                <option value="petugas" {{ request('role')=='petugas' ? 'selected' : '' }}>Petugas</option>
                <option value="relawan" {{ request('role')=='relawan' ? 'selected' : '' }}>Relawan</option>
                <option value="medis" {{ request('role')=='medis' ? 'selected' : '' }}>Medis</option>
            </select>
        </form>
    </div>
    <a href="{{ route('admin.users.create') }}"
        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-colors font-medium text-sm shadow-lg shadow-blue-600/20">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span>Tambah User</span>
    </a>
</div>

{{-- Users Table --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-blue-600 border-b border-blue-700">
                    <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider w-16">No
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">User</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Role</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Tanggal
                        Dibuat</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-center text-sm text-gray-600">
                        {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ '@' . $user->username }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                        $roleClasses = [
                        'admin' => 'bg-purple-100 text-purple-700',
                        'petugas' => 'bg-blue-100 text-blue-700',
                        'relawan' => 'bg-green-100 text-green-700',
                        'medis' => 'bg-red-100 text-red-700',
                        ];
                        $roleClass = $roleClasses[$user->role] ?? 'bg-gray-100 text-gray-700';
                        $roleLabels = [
                        'admin' => 'Admin',
                        'petugas' => 'Petugas',
                        'relawan' => 'Relawan',
                        'medis' => 'Medis',
                        ];
                        @endphp
                        <span
                            class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium {{ $roleClass }}">
                            {{ $roleLabels[$user->role] ?? ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-gray-500">
                            {{ $user->created_at->locale('id')->translatedFormat('d M Y') }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors {{ $user->id === auth()->id() ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    title="Hapus" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">Tidak ada data user</p>
                            <p class="text-gray-400 text-sm mt-1">Tambahkan user baru untuk memulai</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($users->hasPages())
    <div class="px-6 py-4 border-t border-gray-300">
        {{ $users->withQueryString()->links() }}
    </div>
    @endif
</div>
@endsection