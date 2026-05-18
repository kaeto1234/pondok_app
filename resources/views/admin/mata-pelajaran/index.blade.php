@extends('layouts.admin')
@section('title', 'Mata Pelajaran')
@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Mata Pelajaran</h1>
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
            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Tambah Mata Pelajaran</h2>
            <form method="POST" action="{{ route('admin.mata-pelajaran.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mapel</label>
                    <input type="text" name="nama_mapel" value="{{ old('nama_mapel') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm" placeholder="Contoh: Fiqih" required>
                    @error('nama_mapel')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('deskripsi') }}</textarea>
                </div>
                <button type="submit"
                    class="w-full bg-navy-primary text-white py-2 rounded-lg hover:bg-navy-hover transition text-sm">
                    <i class="fas fa-plus mr-1"></i> Tambahkan
                </button>
            </form>
        </div>

        {{-- Daftar --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama Mapel</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mapel as $m)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-3 font-medium">{{ $m->nama_mapel }}</td>
                            <td class="px-6 py-3 text-sm text-gray-500">{{ $m->deskripsi ?? '-' }}</td>
                            <td class="px-6 py-3">
                                @if ($m->is_active)
                                    <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">Aktif</span>
                                @else
                                    <span class="px-2 py-1 text-xs bg-gray-100 text-gray-500 rounded-full">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex gap-2">
                                    <a href="#"
                                        onclick="openEditMapel({{ $m->id }}, '{{ $m->nama_mapel }}', '{{ $m->deskripsi }}', {{ $m->is_active ? 1 : 0 }})"
                                        class="text-yellow-600 hover:text-yellow-800 text-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.mata-pelajaran.destroy', $m->id) }}" method="POST"
                                        class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                            onclick="return confirm('Yakin hapus mapel ini?')">
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

    {{-- Modal Edit --}}
    <div id="editMapelModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
            <h3 class="text-lg font-semibold mb-4">Edit Mata Pelajaran</h3>
            <form id="editMapelForm" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mapel</label>
                    <input type="text" name="nama_mapel" id="edit_nama_mapel"
                        class="w-full border rounded-lg px-3 py-2 text-sm" required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" id="edit_deskripsi" rows="3" class="w-full border rounded-lg px-3 py-2 text-sm"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="is_active" id="edit_is_active" class="w-full border rounded-lg px-3 py-2 text-sm">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
                <div class="flex gap-3">
                    <button type="submit"
                        class="bg-navy-primary text-white px-4 py-2 rounded-lg hover:bg-navy-hover text-sm">Simpan</button>
                    <button type="button" onclick="closeEditMapel()"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditMapel(id, nama, deskripsi, isActive) {
            document.getElementById('editMapelForm').action = `/admin/mata-pelajaran/${id}`;
            document.getElementById('edit_nama_mapel').value = nama;
            document.getElementById('edit_deskripsi').value = deskripsi ?? '';
            document.getElementById('edit_is_active').value = isActive;
            const modal = document.getElementById('editMapelModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditMapel() {
            const modal = document.getElementById('editMapelModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
@endsection
