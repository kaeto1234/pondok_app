<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahunAjaran = TahunAjaran::orderBy('nama_tahun', 'desc')->get();
        return view('admin.tahun-ajaran.index', compact('tahunAjaran'));
    }

    public function create()
    {
        return view('admin.tahun-ajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tahun'      => 'required|string|max:20|unique:tahun_ajaran,nama_tahun',
            'tanggal_mulai'   => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        TahunAjaran::create($request->only(['nama_tahun', 'tanggal_mulai', 'tanggal_selesai']));

        return redirect()->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);
        return view('admin.tahun-ajaran.edit', compact('tahunAjaran'));
    }

    public function update(Request $request, $id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);

        $request->validate([
            'nama_tahun'      => 'required|string|max:20|unique:tahun_ajaran,nama_tahun,' . $id,
            'tanggal_mulai'   => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $tahunAjaran->update($request->only(['nama_tahun', 'tanggal_mulai', 'tanggal_selesai']));

        return redirect()->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil diupdate.');
    }

    public function destroy($id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);

        if ($tahunAjaran->pendaftaran()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus tahun ajaran yang sudah memiliki data pendaftaran.');
        }

        if ($tahunAjaran->is_active) {
            return back()->with('error', 'Tidak dapat menghapus tahun ajaran yang sedang aktif.');
        }

        $tahunAjaran->delete();

        return redirect()->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil dihapus.');
    }

    public function setActive($id)
    {
        TahunAjaran::query()->update(['is_active' => false]);

        $tahunAjaran = TahunAjaran::findOrFail($id);
        $tahunAjaran->update(['is_active' => true]);

        return redirect()->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran ' . $tahunAjaran->nama_tahun . ' diaktifkan.');
    }
}