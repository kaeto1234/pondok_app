<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TingkatDiniyah;
use Illuminate\Http\Request;

class TingkatDiniyahController extends Controller
{
    public function index()
    {
        $tingkatan = TingkatDiniyah::orderBy('urutan')->get();
        return view('admin.tingkat-diniyah.index', compact('tingkatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tingkat' => 'required|string|max:50|unique:tingkat_diniyah,nama_tingkat',
            'urutan'       => 'nullable|integer',
        ]);

        TingkatDiniyah::create([
            'nama_tingkat' => $request->nama_tingkat,
            'urutan'       => $request->urutan ?? TingkatDiniyah::max('urutan') + 1,
            'is_active'    => true,
        ]);

        return back()->with('success', 'Tingkat berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $tingkat = TingkatDiniyah::findOrFail($id);

        $request->validate([
            'nama_tingkat' => 'required|string|max:50|unique:tingkat_diniyah,nama_tingkat,' . $id,
            'urutan'       => 'nullable|integer',
            'is_active'    => 'boolean',
        ]);

        $tingkat->update([
            'nama_tingkat' => $request->nama_tingkat,
            'urutan'       => $request->urutan ?? $tingkat->urutan,
            'is_active'    => $request->boolean('is_active', true),
        ]);

        return back()->with('success', 'Tingkat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tingkat = TingkatDiniyah::findOrFail($id);

        if ($tingkat->santriTingkat()->count() > 0) {
            return back()->with('error', 'Tidak bisa menghapus tingkat yang sudah memiliki data santri.');
        }

        if ($tingkat->kurikulum()->count() > 0) {
            return back()->with('error', 'Tidak bisa menghapus tingkat yang sudah memiliki kurikulum.');
        }

        $tingkat->delete();
        return back()->with('success', 'Tingkat berhasil dihapus.');
    }
}