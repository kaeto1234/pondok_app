<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisUjian;
use Illuminate\Http\Request;

class JenisUjianController extends Controller
{
    public function index()
    {
        $jenisUjian = JenisUjian::withCount('nilai')->orderBy('id')->get();
        $totalBobot = JenisUjian::sum('bobot');

        return view('admin.jenis-ujian.index', compact('jenisUjian', 'totalBobot'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:jenis_ujian,nama',
            'bobot' => 'required|integer|min:1|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Cek total bobot setelah ditambah
        $totalBobotBaru = JenisUjian::sum('bobot') + $request->bobot;

        if ($totalBobotBaru > 100) {
            return back()->with('error', "Total bobot akan menjadi {$totalBobotBaru}%. Maksimal 100%.")
                ->withInput();
        }

        JenisUjian::create([
            'nama' => $request->nama,
            'bobot' => $request->bobot,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.jenis-ujian.index')
            ->with('success', 'Jenis ujian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jenisUjian = JenisUjian::findOrFail($id);

        return view('admin.jenis-ujian.edit', compact('jenisUjian'));
    }

    public function update(Request $request, $id)
    {
        $jenisUjian = JenisUjian::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100|unique:jenis_ujian,nama,'.$id,
            'bobot' => 'required|integer|min:1|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Cek total bobot setelah update (exclude yang sedang diupdate)
        $totalBobotLain = JenisUjian::where('id', '!=', $id)->sum('bobot');
        $totalBobotBaru = $totalBobotLain + $request->bobot;

        if ($totalBobotBaru > 100) {
            return back()->with('error', "Total bobot akan menjadi {$totalBobotBaru}%. Maksimal 100%.")
                ->withInput();
        }

        $jenisUjian->update([
            'nama' => $request->nama,
            'bobot' => $request->bobot,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.jenis-ujian.index')
            ->with('success', 'Jenis ujian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenisUjian = JenisUjian::withCount('nilai')->findOrFail($id);

        // Cek apakah sudah dipakai di nilai
        if ($jenisUjian->nilai_count > 0) {
            return back()->with('error', 'Jenis ujian ini tidak dapat dihapus karena sudah digunakan di data nilai.');
        }

        $jenisUjian->delete();

        return redirect()->route('admin.jenis-ujian.index')
            ->with('success', 'Jenis ujian berhasil dihapus.');
    }
}
