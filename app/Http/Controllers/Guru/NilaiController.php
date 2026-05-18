<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\JadwalMengajar;
use App\Models\JenisUjian;
use App\Models\SantriTingkat;
use App\Models\Kurikulum;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    // Daftar jadwal untuk pilih mapel
    public function index()
    {
        $guru = Guru::where('user_id', session('user_id'))->firstOrFail();

        $jadwal = JadwalMengajar::with(['kurikulum.tingkatDiniyah', 'kurikulum.mataPelajaran'])
            ->where('guru_id', $guru->id)
            ->where('is_active', true)
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
            ->get();

        return view('guru.nilai.index', compact('jadwal'));
    }

    // Form input nilai per jadwal
    public function create(Request $request)
    {
        $guru = Guru::where('user_id', session('user_id'))->firstOrFail();

        $request->validate([
            'jadwal_id'      => 'required|exists:jadwal_mengajar,id',
            'jenis_ujian_id' => 'required|exists:jenis_ujian,id',
            'tanggal_ujian'  => 'required|date',
        ]);

        $jadwal = JadwalMengajar::with([
            'kurikulum.tingkatDiniyah',
            'kurikulum.mataPelajaran',
        ])->where('guru_id', $guru->id)->findOrFail($request->jadwal_id);

        $jenisUjian  = JenisUjian::findOrFail($request->jenis_ujian_id);
        $jenisUjianList = JenisUjian::all();

        // Santri di tingkat ini
        $santriList = SantriTingkat::with('santri')
            ->where('tingkat_id', $jadwal->kurikulum->tingkat_diniyah_id)
            ->where('status', 'aktif')
            ->get();

        // Nilai yang sudah ada (jika edit)
        $nilaiExisting = Nilai::where('kurikulum_id', $jadwal->kurikulum_id)
            ->where('jenis_ujian_id', $jenisUjian->id)
            ->where('guru_id', $guru->id)
            ->whereDate('tanggal_ujian', $request->tanggal_ujian)
            ->pluck('nilai', 'santri_tingkat_id');

        return view('guru.nilai.create', compact(
            'jadwal', 'jenisUjian', 'jenisUjianList',
            'santriList', 'nilaiExisting'
        ));
    }

    // Simpan nilai
    public function store(Request $request)
    {
        $guru = Guru::where('user_id', session('user_id'))->firstOrFail();

        $request->validate([
            'jadwal_id'      => 'required|exists:jadwal_mengajar,id',
            'jenis_ujian_id' => 'required|exists:jenis_ujian,id',
            'tanggal_ujian'  => 'required|date',
            'nilai'          => 'required|array',
            'nilai.*'        => 'nullable|numeric|min:0|max:100',
        ]);

        $jadwal = JadwalMengajar::where('guru_id', $guru->id)
            ->findOrFail($request->jadwal_id);

        try {
            DB::transaction(function () use ($request, $jadwal, $guru) {
                foreach ($request->nilai as $santriTingkatId => $nilaiAngka) {
                    if ($nilaiAngka === null || $nilaiAngka === '') continue;

                    Nilai::updateOrCreate(
                        [
                            'santri_tingkat_id' => $santriTingkatId,
                            'kurikulum_id'      => $jadwal->kurikulum_id,
                            'jenis_ujian_id'    => $request->jenis_ujian_id,
                            'tanggal_ujian'     => $request->tanggal_ujian,
                            'guru_id'           => $guru->id,
                        ],
                        [
                            'nilai' => $nilaiAngka,
                        ]
                    );
                }
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan nilai: ' . $e->getMessage());
        }

        return redirect()->route('guru.nilai.index')
            ->with('success', 'Nilai berhasil disimpan.');
    }

    // Rekap nilai per jadwal
    public function rekap(Request $request)
    {
        $guru = Guru::where('user_id', session('user_id'))->firstOrFail();

        $jadwalList = JadwalMengajar::with(['kurikulum.tingkatDiniyah', 'kurikulum.mataPelajaran'])
            ->where('guru_id', $guru->id)
            ->where('is_active', true)
            ->get();

        $selectedJadwal = $request->jadwal_id ?? $jadwalList->first()?->id;
        $jadwal = JadwalMengajar::with(['kurikulum.tingkatDiniyah', 'kurikulum.mataPelajaran'])
            ->findOrFail($selectedJadwal);

        $jenisUjianList = JenisUjian::all();

        // Santri di tingkat ini
        $santriList = SantriTingkat::with('santri')
            ->where('tingkat_id', $jadwal->kurikulum->tingkat_diniyah_id)
            ->where('status', 'aktif')
            ->get();

        // Semua nilai untuk kurikulum ini
        $nilaiData = Nilai::where('kurikulum_id', $jadwal->kurikulum_id)
            ->where('guru_id', $guru->id)
            ->get()
            ->groupBy('santri_tingkat_id');

        return view('guru.nilai.rekap', compact(
            'jadwalList', 'selectedJadwal', 'jadwal',
            'jenisUjianList', 'santriList', 'nilaiData'
        ));
    }

    // Helper konversi nilai ke huruf (dipakai di view)
    public static function konversiHuruf($nilai)
    {
        if ($nilai >= 90) return 'A';
        if ($nilai >= 80) return 'B';
        if ($nilai >= 70) return 'C';
        if ($nilai >= 60) return 'D';
        return 'E';
    }
}