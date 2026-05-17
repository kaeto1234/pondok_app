<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodePendaftaran;
use App\Models\Pendaftaran;
use App\Models\BerkasPeriodePendaftaran;
use App\Models\FileBerkasPendaftaran;
use Illuminate\Support\Str;


class PpdbController extends Controller
{
    // Halaman info PPDB
    public function index()
    {
        $periodeAktif = PeriodePendaftaran::where('is_active', true)
            ->where('tanggal_mulai', '<=', now())
            ->where('tanggal_selesai', '>=', now())
            ->first();
        
        return view('ppdb.index', compact('periodeAktif'));
    }
    
    // Halaman form pendaftaran
    public function daftar()
    {
        $periodeAktif = PeriodePendaftaran::where('is_active', true)
            ->where('tanggal_mulai', '<=', now())
            ->where('tanggal_selesai', '>=', now())
            ->first();
        
        if (!$periodeAktif) {
            return redirect()->route('ppdb.index')->with('error', 'Maaf, pendaftaran sedang ditutup.');
        }
        
        $berkasWajib = $periodeAktif->berkasPeriode()->with('jenisBerkas')->orderBy('urutan')->get();
        
        return view('ppdb.daftar', compact('periodeAktif', 'berkasWajib'));
    }
    
    // Proses simpan pendaftaran
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'asal_sekolah' => 'nullable|string|max:100',
            'nama_orang_tua' => 'nullable|string|max:100',
            'telepon_orang_tua' => 'nullable|string|max:20',
            'periode_pendaftaran_id' => 'required|exists:periode_pendaftaran,id',
        ]);
        
        // Cek periode aktif
        $periode = PeriodePendaftaran::find($request->periode_pendaftaran_id);
        if (!$periode->is_active) {
            return back()->with('error', 'Periode pendaftaran tidak aktif.');
        }
        
        // Generate nomor pendaftaran
        $noPendaftaran = 'REG-' . date('Ymd') . '-' . Str::upper(Str::random(6));
        
        // Simpan data pendaftaran
        $pendaftaran = Pendaftaran::create([
            'no_pendaftaran' => $noPendaftaran,
            'periode_pendaftaran_id' => $request->periode_pendaftaran_id,
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'asal_sekolah' => $request->asal_sekolah,
            'alamat' => $request->alamat,
            'nama_orang_tua' => $request->nama_orang_tua,
            'telepon_orang_tua' => $request->telepon_orang_tua,
            'tanggal_daftar' => now(),
            'status' => 'pending',
        ]);
        
        // Upload berkas
        $berkasList = BerkasPeriodePendaftaran::where('periode_pendaftaran_id', $request->periode_pendaftaran_id)->get();
        
        foreach ($berkasList as $berkas) {
            $fieldName = 'berkas_' . $berkas->id;
            if ($request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $fileName = time() . '_' . $berkas->id . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('ppdb/' . $pendaftaran->id, $fileName, 'public');
                
                FileBerkasPendaftaran::create([
                    'pendaftaran_id' => $pendaftaran->id,
                    'berkas_periode_pendaftaran_id' => $berkas->id,
                    'path_file' => $path,
                ]);
            }
        }
        
        return redirect()->route('ppdb.selesai', $pendaftaran->id)
            ->with('success', 'Pendaftaran berhasil! Nomor pendaftaran Anda: ' . $noPendaftaran);
    }
    
    // Halaman selesai / konfirmasi
    public function selesai($id)
    {
        $pendaftaran = Pendaftaran::with('periodePendaftaran')->findOrFail($id);
        return view('ppdb.selesai', compact('pendaftaran'));
    }
}
