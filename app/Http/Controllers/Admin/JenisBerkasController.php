<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisBerkas;
use Illuminate\Http\Request;

class JenisBerkasController extends Controller
{
    public function index()
    {
        $jenisBerkas = JenisBerkas::orderBy('nama')->get();
        return view('admin.jenis-berkas.index', compact('jenisBerkas'));
    }

    public function create()
    {
        return view('admin.jenis-berkas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:jenis_berkas,nama',
            'tipe_file' => 'nullable|string|max:50',
            'ukuran_maksimal' => 'nullable|integer|min:1',
        ]);

        JenisBerkas::create([
            'nama' => $request->nama,
            'tipe_file' => $request->tipe_file ?? 'pdf,jpg,png',
            'ukuran_maksimal' => $request->ukuran_maksimal ?? 2048,
        ]);

        return redirect()->route('admin.jenis-berkas.index')
            ->with('success', 'Jenis berkas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jenisBerkas = JenisBerkas::findOrFail($id);
        return view('admin.jenis-berkas.edit', compact('jenisBerkas'));
    }

    public function update(Request $request, $id)
    {
        $jenisBerkas = JenisBerkas::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100|unique:jenis_berkas,nama,' . $id,
            'tipe_file' => 'nullable|string|max:50',
            'ukuran_maksimal' => 'nullable|integer|min:1',
        ]);

        $jenisBerkas->update([
            'nama' => $request->nama,
            'tipe_file' => $request->tipe_file ?? 'pdf,jpg,png',
            'ukuran_maksimal' => $request->ukuran_maksimal ?? 2048,
        ]);

        return redirect()->route('admin.jenis-berkas.index')
            ->with('success', 'Jenis berkas berhasil diupdate.');
    }

    public function destroy($id)
    {
        $jenisBerkas = JenisBerkas::findOrFail($id);
        
        // Cek apakah jenis berkas sudah digunakan di berkas_tahun_ajaran
        if ($jenisBerkas->berkasTahunAjaran()->count() > 0) {
            return back()->with('error', 'Jenis berkas ini tidak dapat dihapus karena sudah digunakan di beberapa tahun ajaran.');
        }
        
        $jenisBerkas->delete();
        
        return redirect()->route('admin.jenis-berkas.index')
            ->with('success', 'Jenis berkas berhasil dihapus.');
    }
}