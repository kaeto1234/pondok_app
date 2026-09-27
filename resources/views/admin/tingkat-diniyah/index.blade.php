@extends('layouts.admin')
@section('title', 'Tingkat Diniyah')
@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tingkat Diniyah</h1>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Form Tambah --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Tambah Tingkat</h2>
            <form method="POST" action="{{ route('admin.tingkat-diniyah.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Tingkat</label>
                    <input type="text" name="nama_tingkat" value="{{ old('nama_tingkat') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm" placeholder="Contoh: Ula 1" required>
                    @error('nama_tingkat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="urutan" value="{{ old('urutan') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm" placeholder="Otomatis">
                </div>
                <button type="submit"
                    class="w-full bg-navy-primary text-white py-2 rounded-lg hover:bg-navy-hover transition text-sm">
                    <i class="fas fa-plus mr-1"></i> Tambahkan
                </button>
            </form>
        </div>

        {{-- Daftar --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Urutan</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama Tingkat</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tingkatan as $t)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-3 text-sm text-gray-500">{{ $t->urutan }}</td>
                                <td class="px-6 py-3 font-medium">{{ $t->nama_tingkat }}</td>
                                <td class="px-6 py-3">
                                    @if ($t->is_active)
                                        <span
                                            class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">Aktif</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs bg-gray-100 text-gray-500 rounded-full">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3">
                                    <div class="flex gap-2">
                                        <button type="button"
                                            onclick="openEditModal({{ $t->id }}, '{{ $t->nama_tingkat }}', {{ $t->urutan }}, {{ $t->is_active ? 1 : 0 }})"
                                            class="text-yellow-600 hover:text-yellow-800 text-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="{{ route('admin.tingkat-diniyah.destroy', $t->id) }}" method="POST"
                                            class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                                onclick="return confirm('Yakin hapus tingkat ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="editModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="font-bold text-lg text-gray-800">Edit Tingkat Diniyah</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form id="editForm" method="POST" class="p-4">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Tingkat</label>
                    <input type="text" name="nama_tingkat" id="editNamaTingkat"
                        class="w-full border rounded-lg px-3 py-2 text-sm" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="urutan" id="editUrutan" class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="is_active" id="editIsActive" class="w-full border rounded-lg px-3 py-2 text-sm">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="flex-1 bg-navy-primary text-white py-2 rounded-lg hover:bg-navy-hover transition text-sm">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                    <button type="button" onclick="closeEditModal()"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-sm">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, nama, urutan, isActive) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');

            // Set action URL form
            form.action = `/admin/tingkat-diniyah/${id}`;

            // Isi field
            document.getElementById('editNamaTingkat').value = nama;
            document.getElementById('editUrutan').value = urutan;
            document.getElementById('editIsActive').value = isActive;

            // Tampilkan modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Tutup modal saat klik overlay
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        // Tutup modal saat tekan Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditModal();
            }
        });
    </script>
@endsection
