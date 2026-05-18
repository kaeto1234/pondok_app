<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kitab;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class KitabController extends Controller
{
    public function index()
    {
        $kitab    = Kitab::with('mataPelajaran')->orderBy('nama_kitab')->paginate(15);
        $mapelList = MataPelajaran::where('is_active', true)->orderBy('nama_mapel')->get();

        return view('admin.kitab.index', compact('kitab', 'mapelList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kitab'   => 'required|string|max:100|unique:kitab,nama_kitab',
            'pengarang'    => 'nullable|string|max:100',
            'penerbit'     => 'nullable|string|max:100',
            'tahun_terbit' => 'nullable|digits:4|integer',
            'deskripsi'    => 'nullable|string',
            'mapel_ids'    => 'nullable|array',
            'mapel_ids.*'  => 'exists:mata_pelajaran,id',
        ]);

        $kitab = Kitab::create($request->only([
            'nama_kitab', 'pengarang', 'penerbit', 'tahun_terbit', 'deskripsi'
        ]));

        if ($request->filled('mapel_ids')) {
            $kitab->mataPelajaran()->sync($request->mapel_ids);
        }

        return redirect()->route('admin.kitab.index')
            ->with('success', 'Kitab berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kitab     = Kitab::with('mataPelajaran')->findOrFail($id);
        $mapelList = MataPelajaran::where('is_active', true)->orderBy('nama_mapel')->get();

        return view('admin.kitab.edit', compact('kitab', 'mapelList'));
    }

    public function update(Request $request, $id)
    {
        $kitab = Kitab::findOrFail($id);

        $request->validate([
            'nama_kitab'   => 'required|string|max:100|unique:kitab,nama_kitab,' . $id,
            'pengarang'    => 'nullable|string|max:100',
            'penerbit'     => 'nullable|string|max:100',
            'tahun_terbit' => 'nullable|digits:4|integer',
            'deskripsi'    => 'nullable|string',
            'mapel_ids'    => 'nullable|array',
            'mapel_ids.*'  => 'exists:mata_pelajaran,id',
        ]);

        $kitab->update($request->only([
            'nama_kitab', 'pengarang', 'penerbit', 'tahun_terbit', 'deskripsi'
        ]));

        $kitab->mataPelajaran()->sync($request->mapel_ids ?? []);

        return redirect()->route('admin.kitab.index')
            ->with('success', 'Kitab berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kitab = Kitab::findOrFail($id);
        $kitab->mataPelajaran()->detach();
        $kitab->delete();

        return redirect()->route('admin.kitab.index')
            ->with('success', 'Kitab berhasil dihapus.');
    }
}