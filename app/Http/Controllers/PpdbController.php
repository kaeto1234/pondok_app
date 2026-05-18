<?php

namespace App\Http\Controllers;

use App\Models\BerkasTahunAjaran;
use App\Models\FileBerkasPendaftaran;
use App\Models\Pendaftaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PpdbController extends Controller
{
    public function index()
    {
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        return view('ppdb.index', compact('tahunAjaranAktif'));
    }

    public function daftar()
    {
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        if (! $tahunAjaranAktif) {
            return redirect()->route('ppdb.index')->with('error', 'Maaf, pendaftaran sedang ditutup.');
        }

        $berkasWajib = BerkasTahunAjaran::where('tahun_ajaran_id', $tahunAjaranAktif->id)
            ->with('jenisBerkas')
            ->orderBy('urutan')
            ->get();

        return view('ppdb.daftar', compact('tahunAjaranAktif', 'berkasWajib'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'asal_sekolah' => 'nullable|string|max:100',
            'nama_ayah' => 'nullable|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'nama_ibu' => 'nullable|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'nama_orang_tua' => 'nullable|string|max:100',
            'telepon_orang_tua' => 'nullable|string|max:20',
            'email' => 'required|email|max:100|unique:pendaftaran,email',
        ]);

        $tahunAjaran = TahunAjaran::where('is_active', true)->first();

        if (! $tahunAjaran) {
            return back()->with('error', 'Pendaftaran sedang ditutup.');
        }

        $noPendaftaran = 'REG-'.date('Ymd').'-'.Str::upper(Str::random(6));

        $pendaftaran = Pendaftaran::create([
            'no_pendaftaran' => $noPendaftaran,
            'tahun_ajaran_id' => $tahunAjaran->id,
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'asal_sekolah' => $request->asal_sekolah,
            'alamat' => $request->alamat,
            'nama_orang_tua' => $request->nama_ayah ?? $request->nama_orang_tua, // fallback
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'telepon_orang_tua' => $request->telepon_orang_tua,
            'email' => $request->email,
            'tanggal_daftar' => now(),
            'status' => 'pending',
        ]);

        // Upload berkas
        $berkasList = BerkasTahunAjaran::where('tahun_ajaran_id', $tahunAjaran->id)->get();

        foreach ($berkasList as $berkas) {
            $fieldName = 'berkas_'.$berkas->id;
            if ($request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $fileName = time().'_'.$berkas->id.'_'.$file->getClientOriginalName();
                $path = $file->storeAs('ppdb/'.$pendaftaran->id, $fileName, 'public');

                FileBerkasPendaftaran::create([
                    'pendaftaran_id' => $pendaftaran->id,
                    'berkas_tahun_ajaran_id' => $berkas->id,
                    'path_file' => $path,
                ]);
            }
        }

        return redirect()->route('ppdb.selesai', $pendaftaran->id)
            ->with('success', 'Pendaftaran berhasil! Nomor pendaftaran Anda: '.$noPendaftaran);
    }

    public function selesai($id)
    {
        $pendaftaran = Pendaftaran::with('tahunAjaran')->findOrFail($id);

        return view('ppdb.selesai', compact('pendaftaran'));
    }

    public function cekStatus()
    {
        return view('ppdb.cek-status');
    }

    public function hasilCekStatus(Request $request)
    {
        $request->validate([
            'no_pendaftaran' => 'required|string',
        ]);

        $pendaftaran = Pendaftaran::where('no_pendaftaran', $request->no_pendaftaran)
            ->with('tahunAjaran')
            ->first();

        return view('ppdb.cek-status', compact('pendaftaran'));
    }
}
