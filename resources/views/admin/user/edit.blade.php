@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'Edit User')
@section('page-subtitle', 'Perbarui data user')

@section('content')
{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.users.index') }}"
        class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span class="font-medium">Kembali ke Manajemen User</span>
    </a>
</div>

{{-- Form Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-300 overflow-hidden">
    <div class="p-6 border-b border-gray-300">
        <h3 class="text-lg font-semibold text-gray-800">Form Edit User</h3>
        <p class="text-sm text-gray-500 mt-1">Lengkapi form di bawah untuk memperbarui data user</p>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Name --}}
            <div class="md:col-span-2">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                    placeholder="Masukkan nama lengkap">
                @error('name')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Username --}}
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                    Username <span class="text-red-500">*</span>
                </label>
                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                    required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('username') border-red-500 @enderror"
                    placeholder="Masukkan username">
                @error('username')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                    placeholder="Masukkan email">
                @error('email')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role --}}
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                    Role <span class="text-red-500">*</span>
                </label>
                <select name="role" id="role" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('role') border-red-500 @enderror">
                    <option value="">Pilih Role</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                        {{ ucfirst($role) }}
                    </option>
                    @endforeach
                </select>
                @error('role')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password (Optional) --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password <span class="text-gray-400 font-normal">(opsional)</span>
                </label>
                <div class="relative">
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                        placeholder="Kosongkan jika tidak diubah">
                    <button type="button" onclick="togglePassword('password')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg id="password-icon" class="w-5 h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @error('password')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter. Kosongkan jika tidak ingin mengubah password.</p>
            </div>

            {{-- Password Confirmation --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Konfirmasi Password <span class="text-gray-400 font-normal">(opsional)</span>
                </label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-400 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Ulangi password baru">
                    <button type="button" onclick="togglePassword('password_confirmation')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg id="password_confirmation-icon" class="w-5 h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- User Info (Read-only) --}}
        <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-300">
            <h4 class="text-sm font-medium text-gray-700 mb-3">Informasi User</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">ID User</p>
                    <p class="font-medium text-gray-800">#{{ $user->id }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Dibuat</p>
                    <p class="font-medium text-gray-800">
                        {{ $user->created_at->locale('id')->translatedFormat('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Terakhir Diperbarui</p>
                    <p class="font-medium text-gray-800">
                        {{ $user->updated_at->locale('id')->translatedFormat('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-300">
            <a href="{{ route('admin.users.index') }}"
                class="px-6 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors font-medium text-sm">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-colors font-medium text-sm shadow-lg shadow-blue-600/20">
                Perbarui User
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(inputId + '-icon');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            `;
        } else {
            input.type = 'password';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
        }
    }
</script>
@endpush
