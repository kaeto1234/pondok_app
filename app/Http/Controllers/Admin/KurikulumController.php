<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use App\Models\TahunAjaran;
use App\Models\TingkatDiniyah;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranList = TahunAjaran::orderBy('nama_tahun', 'desc')->get();
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();
        $selectedTahun = $request->tahun_ajaran_id ?? $tahunAjaranAktif?->id;

        $tingkatan = TingkatDiniyah::where('is_active', true)->orderBy('urutan')->get();
        $mapelList = MataPelajaran::where('is_active', true)->orderBy('nama_mapel')->get();

        $kurikulum = Kurikulum::with(['tingkatDiniyah', 'mataPelajaran'])
            ->where('tahun_ajaran_id', $selectedTahun)
            ->orderBy('tingkat_diniyah_id')
            ->orderBy('urutan')
            ->get()
            ->groupBy('tingkat_diniyah_id');

        return view('admin.kurikulum.index', compact(
            'tahunAjaranList', 'selectedTahun', 'tingkatan', 'mapelList', 'kurikulum'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran_id'    => 'required|exists:tahun_ajaran,id',
            'tingkat_diniyah_id' => 'required|exists:tingkat_diniyah,id',
            'mata_pelajaran_id'  => 'required|exists:mata_pelajaran,id',
        ]);

        $exists = Kurikulum::where('tahun_ajaran_id', $request->tahun_ajaran_id)
            ->where('tingkat_diniyah_id', $request->tingkat_diniyah_id)
            ->where('mata_pelajaran_id', $request->mata_pelajaran_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Mapel ini sudah ada di kurikulum tingkat tersebut.');
        }

        $urutan = Kurikulum::where('tahun_ajaran_id', $request->tahun_ajaran_id)
            ->where('tingkat_diniyah_id', $request->tingkat_diniyah_id)
            ->max('urutan') + 1;

        Kurikulum::create([
            'tahun_ajaran_id'    => $request->tahun_ajaran_id,
            'tingkat_diniyah_id' => $request->tingkat_diniyah_id,
            'mata_pelajaran_id'  => $request->mata_pelajaran_id,
            'urutan'             => $urutan,
            'is_active'          => true,
        ]);

        return back()->with('success', 'Kurikulum berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $kurikulum = Kurikulum::findOrFail($id);

        if ($kurikulum->jadwalMengajar()->count() > 0) {
            return back()->with('error', 'Tidak bisa menghapus kurikulum yang sudah memiliki jadwal mengajar.');
        }

        $kurikulum->delete();
        return back()->with('success', 'Kurikulum berhasil dihapus.');
    }
}