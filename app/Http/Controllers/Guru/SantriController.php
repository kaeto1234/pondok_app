<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\JadwalMengajar;
use App\Models\SantriTingkat;
use App\Models\TingkatDiniyah;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    public function index(Request $request)
    {
        $guru = Guru::where('user_id', session('user_id'))->firstOrFail();

        // Tingkat yang diajar guru ini
        $tingkatIds = JadwalMengajar::where('jadwal_mengajar.guru_id', $guru->id)
            ->where('jadwal_mengajar.is_active', true) // ← tambah nama tabel
            ->join('kurikulum', 'jadwal_mengajar.kurikulum_id', '=', 'kurikulum.id')
            ->pluck('kurikulum.tingkat_diniyah_id')
            ->unique();

        $tingkatList = TingkatDiniyah::whereIn('id', $tingkatIds)
            ->orderBy('urutan')
            ->get();

        $selectedTingkat = $request->tingkat_id ?? $tingkatList->first()?->id;

        $santriList = SantriTingkat::with('santri')
            ->where('tingkat_id', $selectedTingkat)
            ->where('status', 'aktif')
            ->get();

        return view('guru.santri.index', compact('tingkatList', 'selectedTingkat', 'santriList'));
    }

    public function show($id)
    {
        $santriTingkat = SantriTingkat::with([
            'santri',
            'tingkat',
            'tahunAjaran',
        ])->findOrFail($id);

        return view('guru.santri.show', compact('santriTingkat'));
    }
}
