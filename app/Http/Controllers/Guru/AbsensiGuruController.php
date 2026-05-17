<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JadwalMengajar;
use App\Models\AbsensiGuru;
use App\Models\AbsensiSantri;
use App\Models\SantriTingkat;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiGuruController extends Controller
{
    // Tampilkan semua jadwal mengajar
    public function index()
    {
        $guru = Guru::first();
        
        if (!$guru) {
            abort(404, 'Data guru tidak ditemukan');
        }
        
        $jadwal = JadwalMengajar::where('guru_id', $guru->id)
            ->where('is_active', true)
            ->with('kurikulum.mapel', 'kurikulum.tingkat')
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();
        
        return view('guru.absensi.index', compact('jadwal'));
    }
    
    // Form input absensi
   public function create($jadwalId)
{
    $jadwal = JadwalMengajar::with([
        'kurikulum.mapel',
        'kurikulum.tingkat'
    ])->find($jadwalId);

    // Jika jadwal tidak ditemukan
    if (!$jadwal) {
        return redirect()
            ->route('admin.guru.absensi.index')
            ->with('error', 'Jadwal mengajar tidak ditemukan');
    }

    // Ambil santri berdasarkan tingkat
    $santriList = SantriTingkat::where('tingkat_id', $jadwal->kurikulum->tingkat_diniyah_id)
        ->where('status', 'aktif')
        ->with('santri')
        ->get();

    return view('guru.absensi.create', compact('jadwal', 'santriList'));
}
    
    // Simpan absensi
    public function store(Request $request, $jadwalId)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'status_guru' => 'required|in:hadir,sakit,izin,alpha',
            'status_santri' => 'required|array',
            'status_santri.*' => 'required|in:hadir,sakit,izin,alpha',
        ]);
        
        try {
            DB::beginTransaction();
            
            $sudahAbsen = AbsensiGuru::where('jadwal_mengajar_id', $jadwalId)
                ->whereDate('tanggal', $request->tanggal)
                ->exists();
            
            if ($sudahAbsen) {
                return redirect()->back()
                    ->with('error', 'Absensi tanggal ' . $request->tanggal . ' sudah pernah dilakukan');
            }
            
            $pertemuanKe = AbsensiGuru::where('jadwal_mengajar_id', $jadwalId)->count() + 1;
            
            $absensiGuru = AbsensiGuru::create([
                'jadwal_mengajar_id' => $jadwalId,
                'tanggal' => $request->tanggal,
                'pertemuan_ke' => $pertemuanKe,
                'status' => $request->status_guru,
                'keterangan' => $request->keterangan_guru,
            ]);
            
            if (!empty($request->status_santri)) {
                foreach ($request->status_santri as $santriTingkatId => $status) {
                    $santriTingkat = SantriTingkat::find($santriTingkatId);
                    if ($santriTingkat) {
                        AbsensiSantri::create([
                            'absensi_guru_id' => $absensiGuru->id,
                            'santri_tingkat_id' => $santriTingkatId,
                            'status' => $status,
                        ]);
                    }
                }
            }
            
            DB::commit();
            
            return redirect()->route('admin.guru.absensi.index')
                ->with('success', 'Absensi tanggal ' . $request->tanggal . ' berhasil disimpan!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menyimpan absensi: ' . $e->getMessage());
        }
    }
    
    // Rekap absensi
    public function rekap()
    {
        $guru = Guru::first();
        
        if (!$guru) {
            abort(404, 'Data guru tidak ditemukan');
        }
        
        $absensi = AbsensiGuru::whereHas('jadwalMengajar', function($q) use ($guru) {
            $q->where('guru_id', $guru->id);
        })->with('jadwalMengajar.kurikulum.mapel', 'jadwalMengajar.kurikulum.tingkat')
          ->orderBy('tanggal', 'desc')
          ->paginate(20);
        
        return view('guru.absensi.rekap', compact('absensi'));
    }
}