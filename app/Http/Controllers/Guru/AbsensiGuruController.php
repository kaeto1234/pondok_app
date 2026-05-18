<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\AbsensiGuru;
use App\Models\AbsensiSantri;
use App\Models\Guru;
use App\Models\JadwalMengajar;
use App\Models\SantriTingkat;
use Illuminate\Http\Request;

class AbsensiGuruController extends Controller
{
    // Daftar jadwal mengajar milik guru yang login
    public function index()
    {
        $guru = Guru::where('user_id', session('user_id'))->firstOrFail();

        $jadwal = JadwalMengajar::with(['kurikulum.tingkatDiniyah', 'kurikulum.mataPelajaran'])
            ->where('guru_id', $guru->id)
            ->where('is_active', true)
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
            ->orderBy('jam_mulai')
            ->get();

        // Cek absensi hari ini untuk tiap jadwal
        $absensiHariIni = AbsensiGuru::whereIn('jadwal_mengajar_id', $jadwal->pluck('id'))
            ->whereDate('tanggal', today())
            ->pluck('status', 'jadwal_mengajar_id');

        return view('guru.absensi.index', compact('jadwal', 'absensiHariIni', 'guru'));
    }

    // Form isi absensi guru untuk jadwal tertentu
    public function create($jadwalId)
    {
        $guru = Guru::where('user_id', session('user_id'))->firstOrFail();
        $jadwal = JadwalMengajar::with([
            'kurikulum.tingkatDiniyah',
            'kurikulum.mataPelajaran',
        ])->where('guru_id', $guru->id)->findOrFail($jadwalId);

        // Cek apakah sudah absen hari ini
        $absensiHariIni = AbsensiGuru::where('jadwal_mengajar_id', $jadwal->id)
            ->whereDate('tanggal', today())
            ->first();

        // Hitung pertemuan ke berapa
        $pertemuanKe = AbsensiGuru::where('jadwal_mengajar_id', $jadwal->id)->count() + 1;

        // Ambil santri di tingkat yang sama dengan jadwal ini
        $tingkatId = $jadwal->kurikulum->tingkat_diniyah_id;
        $santriList = SantriTingkat::with('santri')
            ->where('tingkat_id', $tingkatId)
            ->where('status', 'aktif')
            ->get();

        return view('guru.absensi.create', compact(
            'jadwal', 'absensiHariIni', 'pertemuanKe', 'santriList'
        ));
    }

    // Simpan absensi guru + santri sekaligus
    public function store(Request $request, $jadwalId)
    {
        $guru = Guru::where('user_id', session('user_id'))->firstOrFail();
        $jadwal = JadwalMengajar::where('guru_id', $guru->id)->findOrFail($jadwalId);

        $request->validate([
            'tanggal' => 'required|date',
            'status' => 'required|in:hadir,sakit,izin,alpha',
            'keterangan' => 'nullable|string|max:255',
            'absensi' => 'nullable|array',
            'absensi.*.status' => 'required_with:absensi|in:hadir,sakit,izin,alpha',
            'absensi.*.keterangan' => 'nullable|string|max:255',
        ]);

        // Cek duplikat
        $sudahAbsen = AbsensiGuru::where('jadwal_mengajar_id', $jadwal->id)
            ->whereDate('tanggal', $request->tanggal)
            ->exists();

        if ($sudahAbsen) {
            return back()->with('error', 'Absensi untuk jadwal ini pada tanggal tersebut sudah ada.');
        }

        // Hitung pertemuan ke berapa
        $pertemuanKe = AbsensiGuru::where('jadwal_mengajar_id', $jadwal->id)->count() + 1;

        // Simpan absensi guru
        $absensiGuru = AbsensiGuru::create([
            'jadwal_mengajar_id' => $jadwal->id,
            'tanggal' => $request->tanggal,
            'pertemuan_ke' => $pertemuanKe,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        // Simpan absensi santri (hanya jika guru hadir)
        if ($request->status === 'hadir' && $request->filled('absensi')) {
            foreach ($request->absensi as $santriTingkatId => $data) {
                AbsensiSantri::create([
                    'absensi_guru_id' => $absensiGuru->id,
                    'santri_tingkat_id' => $santriTingkatId,
                    'status' => $data['status'],
                    'keterangan' => $data['keterangan'] ?? null,
                ]);
            }
        }

        return redirect()->route('guru.absensi.index')
            ->with('success', 'Absensi berhasil disimpan. Pertemuan ke-'.$pertemuanKe);
    }

    // Rekap absensi guru
    public function rekap(Request $request)
    {
        $guru = Guru::where('user_id', session('user_id'))->firstOrFail();

        $jadwalList = JadwalMengajar::with(['kurikulum.tingkatDiniyah', 'kurikulum.mataPelajaran'])
            ->where('guru_id', $guru->id)
            ->where('is_active', true)
            ->get();

        $selectedJadwal = $request->jadwal_id ?? $jadwalList->first()?->id;

        $rekap = AbsensiGuru::with('absensiSantri.santriTingkat.santri')
            ->where('jadwal_mengajar_id', $selectedJadwal)
            ->orderBy('tanggal', 'desc')
            ->paginate(15);

        return view('guru.absensi.rekap', compact('jadwalList', 'selectedJadwal', 'rekap'));
    }

    // Halaman edit absensi santri per pertemuan
    public function editSantri($absensiGuruId)
    {
        $guru = Guru::where('user_id', session('user_id'))->firstOrFail();

        $absensiGuru = AbsensiGuru::with([
            'jadwalMengajar.kurikulum.tingkatDiniyah',
            'jadwalMengajar.kurikulum.mataPelajaran',
            'absensiSantri.santriTingkat.santri',
        ])->whereHas('jadwalMengajar', function ($q) use ($guru) {
            $q->where('guru_id', $guru->id);
        })->findOrFail($absensiGuruId);

        // Santri yang belum ada di absensi (mungkin baru masuk setelah absensi dibuat)
        $tingkatId = $absensiGuru->jadwalMengajar->kurikulum->tingkat_diniyah_id;
        $santriSudahAbsen = $absensiGuru->absensiSantri->pluck('santri_tingkat_id');

        $santriTambahan = SantriTingkat::with('santri')
            ->where('tingkat_id', $tingkatId)
            ->where('status', 'aktif')
            ->whereNotIn('id', $santriSudahAbsen)
            ->get();

        return view('guru.absensi.edit-santri', compact('absensiGuru', 'santriTambahan'));
    }

    // Simpan perubahan absensi santri
    public function updateSantri(Request $request, $absensiGuruId)
    {
        $guru = Guru::where('user_id', session('user_id'))->firstOrFail();

        $absensiGuru = AbsensiGuru::whereHas('jadwalMengajar', function ($q) use ($guru) {
            $q->where('guru_id', $guru->id);
        })->findOrFail($absensiGuruId);

        $request->validate([
            'absensi' => 'required|array',
            'absensi.*.status' => 'required|in:hadir,sakit,izin,alpha',
            'absensi.*.keterangan' => 'nullable|string|max:255',
            // santri tambahan (yang belum ada di absensi sebelumnya)
            'tambahan' => 'nullable|array',
            'tambahan.*.santri_tingkat_id' => 'exists:santri_tingkat,id',
            'tambahan.*.status' => 'required_with:tambahan|in:hadir,sakit,izin,alpha',
            'tambahan.*.keterangan' => 'nullable|string|max:255',
        ]);

        // Update absensi santri yang sudah ada
        foreach ($request->absensi as $absensiSantriId => $data) {
            AbsensiSantri::where('id', $absensiSantriId)
                ->where('absensi_guru_id', $absensiGuru->id)
                ->update([
                    'status' => $data['status'],
                    'keterangan' => $data['keterangan'] ?? null,
                ]);
        }

        // Tambah santri yang belum ada di absensi
        if ($request->filled('tambahan')) {
            foreach ($request->tambahan as $data) {
                AbsensiSantri::firstOrCreate(
                    [
                        'absensi_guru_id' => $absensiGuru->id,
                        'santri_tingkat_id' => $data['santri_tingkat_id'],
                    ],
                    [
                        'status' => $data['status'],
                        'keterangan' => $data['keterangan'] ?? null,
                    ]
                );
            }
        }

        return redirect()->route('guru.absensi.rekap', ['jadwal_id' => $absensiGuru->jadwal_mengajar_id])
            ->with('success', 'Absensi santri berhasil diperbarui.');
    }
}
