<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalMengajar;
use App\Models\TahunAjaran;
use App\Models\Kurikulum;
use App\Models\Guru;
use Illuminate\Http\Request;

class JadwalMengajarController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranList  = TahunAjaran::orderBy('nama_tahun', 'desc')->get();
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();
        $selectedTahun    = $request->tahun_ajaran_id ?? $tahunAjaranAktif?->id;

        $jadwal = JadwalMengajar::with(['guru', 'kurikulum.tingkatDiniyah', 'kurikulum.mataPelajaran'])
            ->where('tahun_ajaran_id', $selectedTahun)
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
            ->orderBy('jam_mulai')
            ->get();

        $guruList      = Guru::where('is_active', true)->orderBy('nama_lengkap')->get();
        $kurikulumList = Kurikulum::with(['tingkatDiniyah', 'mataPelajaran'])
            ->where('tahun_ajaran_id', $selectedTahun)
            ->where('is_active', true)
            ->get();

        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('admin.jadwal-mengajar.index', compact(
            'tahunAjaranList', 'selectedTahun', 'jadwal',
            'guruList', 'kurikulumList', 'hariList'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'kurikulum_id'    => 'required|exists:kurikulum,id',
            'guru_id'         => 'required|exists:guru,id',
            'hari'            => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai'       => 'required',
            'jam_selesai'     => 'required|after:jam_mulai',
            'ruangan'         => 'nullable|string|max:50',
        ]);

        JadwalMengajar::create([
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'kurikulum_id'    => $request->kurikulum_id,
            'guru_id'         => $request->guru_id,
            'hari'            => $request->hari,
            'jam_mulai'       => $request->jam_mulai,
            'jam_selesai'     => $request->jam_selesai,
            'ruangan'         => $request->ruangan,
            'is_active'       => true,
        ]);

        return back()->with('success', 'Jadwal mengajar berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $jadwal = JadwalMengajar::findOrFail($id);

        if ($jadwal->absensiGuru()->count() > 0) {
            return back()->with('error', 'Tidak bisa menghapus jadwal yang sudah memiliki data absensi.');
        }

        $jadwal->delete();
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
}