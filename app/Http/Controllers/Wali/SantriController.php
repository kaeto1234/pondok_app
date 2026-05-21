<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use App\Models\OrangTua;
use App\Models\AbsensiGuru;
use App\Models\Materi;
use App\Models\Nilai;
use App\Models\JenisUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SantriController extends Controller
{
    private function getSantri()
    {
        $orangTua = OrangTua::where('user_id', session('user_id'))
            ->with(['santri.santriTingkat.tingkat', 'santri.santriTingkat.tahunAjaran'])
            ->firstOrFail();

        return $orangTua->santri;
    }

    public function nilai()
    {
        $santri       = $this->getSantri();
        $santriTingkat = $santri->santriTingkat()
            ->with(['tingkat', 'tahunAjaran'])
            ->where('status', 'aktif')
            ->first();

        $jenisUjianList = JenisUjian::all();

        $nilaiData = [];
        if ($santriTingkat) {
            $nilaiData = Nilai::with(['kurikulum.mataPelajaran', 'jenisUjian'])
                ->where('santri_tingkat_id', $santriTingkat->id)
                ->get()
                ->groupBy('kurikulum.mata_pelajaran_id');
        }

        return view('wali.santri.nilai', compact('santri', 'santriTingkat', 'jenisUjianList', 'nilaiData'));
    }

    public function absensi()
    {
        $santri        = $this->getSantri();
        $santriTingkat = $santri->santriTingkat()
            ->where('status', 'aktif')
            ->first();

        $absensiList = [];
        $statistik   = ['hadir' => 0, 'sakit' => 0, 'izin' => 0, 'alpha' => 0];

        if ($santriTingkat) {
            $absensiList = $santriTingkat->absensiSantri()
                ->with(['absensiGuru.jadwalMengajar.kurikulum.mataPelajaran'])
                ->latest('created_at')
                ->paginate(20);

            foreach (['hadir', 'sakit', 'izin', 'alpha'] as $s) {
                $statistik[$s] = $santriTingkat->absensiSantri()
                    ->where('status', $s)->count();
            }
        }

        return view('wali.santri.absensi', compact('santri', 'santriTingkat', 'absensiList', 'statistik'));
    }

    public function materi(Request $request)
    {
        $santri        = $this->getSantri();
        $santriTingkat = $santri->santriTingkat()
            ->where('status', 'aktif')
            ->first();

        $materi = Materi::with(['mataPelajaran', 'tingkat'])
            ->when($santriTingkat, fn($q) => $q->where('tingkat_id', $santriTingkat->tingkat_id))
            ->when($request->mapel_id, fn($q) => $q->where('mapel_id', $request->mapel_id))
            ->latest()
            ->paginate(15);

        $mapelList = \App\Models\MataPelajaran::where('is_active', true)
            ->orderBy('nama_mapel')->get();

        return view('wali.santri.materi', compact('santri', 'materi', 'mapelList'));
    }

    public function download($id)
    {
        $materi = Materi::findOrFail($id);

        // Increment counter
        $materi->increment('diunduh');

        return Storage::disk('public')->download(
            $materi->path_file,
            $materi->judul . '.' . pathinfo($materi->path_file, PATHINFO_EXTENSION)
        );
    }
}