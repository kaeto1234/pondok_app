@extends('layouts.admin')

@section('title', 'Dashboard Guru')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ session('user_name') }}!</h1>
        <p class="text-gray-500">Kelola profil dan aktivitas Anda di sini.</p>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tab --}}
    <div x-data="{ tab: '{{ session('tab', 'profile') }}' }">
        <div class="flex gap-2 mb-6 border-b">
            <button @click="tab = 'profile'"
                :class="tab === 'profile' ? 'border-b-2 border-[#1e3a5f] text-[#1e3a5f] font-semibold' : 'text-gray-500'"
                class="px-4 py-2 text-sm transition">
                <i class="fas fa-user mr-1"></i> Profil Saya
            </button>
            <button @click="tab = 'password'"
                :class="tab === 'password' ? 'border-b-2 border-[#1e3a5f] text-[#1e3a5f] font-semibold' : 'text-gray-500'"
                class="px-4 py-2 text-sm transition">
                <i class="fas fa-lock mr-1"></i> Ganti Password
            </button>
        </div>

        {{-- Tab Profil --}}
        <div x-show="tab === 'profile'">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Avatar Card --}}
                <div class="bg-white rounded-xl shadow-sm p-6 text-center">
                    <div class="w-24 h-24 bg-[#1e3a5f] rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl font-bold text-white">
                            {{ strtoupper(substr(session('user_name'), 0, 1)) }}
                        </span>
                    </div>
                    <p class="font-bold text-gray-800">{{ $user->full_name }}</p>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    <span
                        class="inline-block mt-2 px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-full font-semibold">Guru</span>

                    <div class="mt-4 text-left space-y-2 border-t pt-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">NIP</span>
                            <span class="font-medium">{{ $guru->nip ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Telepon</span>
                            <span class="font-medium">{{ $guru->telepon ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Tgl Masuk</span>
                            <span
                                class="font-medium">{{ $guru->tanggal_masuk ? $guru->tanggal_masuk->format('d M Y') : '-' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Status</span>
                            @if ($guru->is_active)
                                <span class="px-2 py-0.5 text-xs bg-green-100 text-green-700 rounded-full">Aktif</span>
                            @else
                                <span class="px-2 py-0.5 text-xs bg-red-100 text-red-700 rounded-full">Nonaktif</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Form Edit Profil --}}
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Edit Profil</h2>
                    <form method="POST" action="{{ route('guru.profile.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}"
                                    class="w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-[#1e3a5f]"
                                    required>
                                @error('full_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                <input type="text" name="username" value="{{ old('username', $user->username) }}"
                                    class="w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-[#1e3a5f]"
                                    required>
                                @error('username')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-[#1e3a5f]"
                                    required>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                                <input type="text" name="telepon" value="{{ old('telepon', $guru->telepon) }}"
                                    class="w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-[#1e3a5f]">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                                <input type="text" value="{{ $guru->nip ?? '-' }}"
                                    class="w-full border rounded-lg px-4 py-2 text-sm bg-gray-50 text-gray-500 cursor-not-allowed"
                                    disabled>
                                <p class="text-xs text-gray-400 mt-1">NIP hanya bisa diubah oleh admin</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Masuk</label>
                                <input type="text"
                                    value="{{ $guru->tanggal_masuk ? $guru->tanggal_masuk->format('d M Y') : '-' }}"
                                    class="w-full border rounded-lg px-4 py-2 text-sm bg-gray-50 text-gray-500 cursor-not-allowed"
                                    disabled>
                                <p class="text-xs text-gray-400 mt-1">Tanggal masuk hanya bisa diubah oleh admin</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Keahlian / Mata
                                    Pelajaran</label>
                                <textarea name="keahlian" rows="3"
                                    class="w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-[#1e3a5f]"
                                    placeholder="Contoh: Matematika, Fisika">{{ old('keahlian', $guru->keahlian) }}</textarea>
                            </div>
                        </div>
                        <button type="submit"
                            class="mt-4 bg-[#1e3a5f] text-white px-6 py-2 rounded-lg hover:bg-[#2a4a7a] transition text-sm">
                            <i class="fas fa-save mr-1"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Tab Ganti Password --}}
        <div x-show="tab === 'password'">
            <div class="max-w-lg bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Ganti Password</h2>
                <form method="POST" action="{{ route('guru.password.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
                            <input type="password" name="password_lama"
                                class="w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-[#1e3a5f]"
                                required>
                            @error('password_lama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                            <input type="password" name="password_baru"
                                class="w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-[#1e3a5f]"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                            <input type="password" name="password_baru_confirmation"
                                class="w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-[#1e3a5f]"
                                required>
                            @error('password_baru')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit"
                        class="mt-4 bg-[#1e3a5f] text-white px-6 py-2 rounded-lg hover:bg-[#2a4a7a] transition text-sm">
                        <i class="fas fa-key mr-1"></i> Ganti Password
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
