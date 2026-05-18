<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mapel = MataPelajaran::orderBy('nama_mapel')->get();
        return view('admin.mata-pelajaran.index', compact('mapel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:100|unique:mata_pelajaran,nama_mapel',
            'deskripsi'  => 'nullable|string',
        ]);

        MataPelajaran::create([
            'nama_mapel' => $request->nama_mapel,
            'deskripsi'  => $request->deskripsi,
            'is_active'  => true,
        ]);

        return back()->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $mapel = MataPelajaran::findOrFail($id);

        $request->validate([
            'nama_mapel' => 'required|string|max:100|unique:mata_pelajaran,nama_mapel,' . $id,
            'deskripsi'  => 'nullable|string',
            'is_active'  => 'boolean',
        ]);

        $mapel->update([
            'nama_mapel' => $request->nama_mapel,
            'deskripsi'  => $request->deskripsi,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return back()->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mapel = MataPelajaran::findOrFail($id);

        if ($mapel->kurikulum()->count() > 0) {
            return back()->with('error', 'Tidak bisa menghapus mapel yang sudah ada di kurikulum.');
        }

        $mapel->delete();
        return back()->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}