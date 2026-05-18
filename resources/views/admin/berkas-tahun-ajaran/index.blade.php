@extends('layouts.admin')

@section('title', 'Kelola Berkas - ' . $tahunAjaran->nama_tahun)

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Berkas Wajib</h1>
            <p class="text-gray-500">Tahun Ajaran: {{ $tahunAjaran->nama_tahun }}</p>
        </div>
        <a href="{{ route('admin.tahun-ajaran.index') }}" class="text-gray-500 hover:text-navy-primary">
            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Tahun Ajaran
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form Tambah Berkas -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Tambah Berkas</h2>
            <form action="{{ route('admin.berkas-tahun-ajaran.store', $tahunAjaran->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Berkas</label>
                    <select name="jenis_berkas_id" required class="w-full border rounded-lg px-3 py-2">
                        <option value="">Pilih Jenis Berkas</option>
                        @foreach ($semuaJenisBerkas as $jenis)
                            <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="is_wajib" class="w-full border rounded-lg px-3 py-2">
                        <option value="1">Wajib</option>
                        <option value="0">Tidak Wajib (Opsional)</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="urutan" class="w-full border rounded-lg px-3 py-2"
                        placeholder="Otomatis di akhir">
                </div>
                <button type="submit"
                    class="w-full bg-navy-primary text-white py-2 rounded-lg hover:bg-navy-hover transition">
                    <i class="fas fa-plus mr-1"></i> Tambahkan
                </button>
            </form>
        </div>

        <!-- Daftar Berkas -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-4 border-b bg-gray-50 rounded-t-xl">
                    <h2 class="font-semibold">Daftar Berkas yang Harus Diupload</h2>
                    <p class="text-xs text-gray-500">Urutkan dengan drag & drop</p>
                </div>

                <div id="sortable-berkas" class="p-4 space-y-2">
                    @forelse($berkasList as $berkas)
                        <div class="border rounded-lg p-3 flex items-center justify-between bg-white cursor-move"
                            data-id="{{ $berkas->id }}">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-grip-vertical text-gray-400 cursor-grab"></i>
                                <div>
                                    <p class="font-medium">{{ $berkas->jenisBerkas->nama }}</p>
                                    <p class="text-xs text-gray-500">
                                        @if ($berkas->is_wajib)
                                            <span class="text-green-600">● Wajib</span>
                                        @else
                                            <span class="text-gray-400">● Opsional</span>
                                        @endif
                                        | Urutan: {{ $berkas->urutan }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button
                                    onclick="openEditModal({{ $berkas->id }}, {{ $berkas->is_wajib ? 'true' : 'false' }}, {{ $berkas->urutan }})"
                                    class="text-blue-600 hover:text-blue-800 p-1">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form
                                    action="{{ route('admin.berkas-tahun-ajaran.destroy', [$tahunAjaran->id, $berkas->id]) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 p-1"
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">Belum ada berkas yang ditambahkan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
            <h3 class="text-lg font-semibold mb-4">Edit Berkas</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="is_wajib" id="edit_is_wajib" class="w-full border rounded-lg px-3 py-2">
                        <option value="1">Wajib</option>
                        <option value="0">Tidak Wajib (Opsional)</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="urutan" id="edit_urutan" class="w-full border rounded-lg px-3 py-2">
                </div>
                <div class="flex gap-3">
                    <button type="submit"
                        class="bg-navy-primary text-white px-4 py-2 rounded-lg hover:bg-navy-hover">Simpan</button>
                    <button type="button" onclick="closeEditModal()"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        // Drag and drop untuk urutan
        var el = document.getElementById('sortable-berkas');
        var sortable = Sortable.create(el, {
            handle: '.cursor-grab',
            onEnd: function() {
                var urutan = [];
                document.querySelectorAll('#sortable-berkas .border').forEach(function(el) {
                    urutan.push(el.dataset.id);
                });

                fetch('{{ route('admin.berkas-tahun-ajaran.urutan', $tahunAjaran->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        urutan: urutan
                    })
                });
            }
        });

        // Modal edit
        function openEditModal(id, isWajib, urutan) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            // Gunakan url() helper, bukan route()
            const url = "{{ url('/admin/tahun-ajaran') }}/{{ $tahunAjaran->id }}/berkas/" + id;
            form.action = url;
            document.getElementById('edit_is_wajib').value = isWajib ? '1' : '0';
            document.getElementById('edit_urutan').value = urutan;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
@endsection
