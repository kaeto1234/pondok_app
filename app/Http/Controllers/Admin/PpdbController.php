<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PpdbController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::with('periodePendaftaran')->latest()->paginate(15);
        return view('admin.ppdb.index', compact('pendaftarans'));
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::with(['periodePendaftaran', 'fileBerkas.berkasPeriode.jenisBerkas'])->findOrFail($id);
        return view('admin.ppdb.show', compact('pendaftaran'));
    }

    public function verify(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        if ($pendaftaran->status !== 'pending') {
            return back()->with('error', 'Data ini sudah diproses sebelumnya.');
        }

        // 1. Update status pendaftaran
        $pendaftaran->update([
            'status' => 'diverifikasi',
            'diverifikasi_oleh' => auth()->id(),
            'diverifikasi_pada' => now(),
            'catatan' => $request->catatan
        ]);

        // 2. Generate NIS (Contoh: Tahun + 4 digit random)
        $nis = date('Y') . Str::padLeft(rand(1, 9999), 4, '0');
        while (Santri::where('nis', $nis)->exists()) {
            $nis = date('Y') . Str::padLeft(rand(1, 9999), 4, '0');
        }

        // 3. Buat data Santri
        Santri::create([
            'nis' => $nis,
            'pendaftaran_id' => $pendaftaran->id,
            'nama_lengkap' => $pendaftaran->nama_lengkap,
            'tempat_lahir' => $pendaftaran->tempat_lahir,
            'tanggal_lahir' => $pendaftaran->tanggal_lahir,
            'jenis_kelamin' => $pendaftaran->jenis_kelamin,
            'alamat' => $pendaftaran->alamat,
            'telepon' => $pendaftaran->telepon_orang_tua,
            'status' => 'aktif'
        ]);

        return redirect()->route('admin.ppdb.index')->with('success', 'Pendaftaran berhasil diverifikasi. Data santri telah dibuat.');
    }

    public function reject(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        $pendaftaran->update([
            'status' => 'ditolak',
            'diverifikasi_oleh' => auth()->id(),
            'diverifikasi_pada' => now(),
            'catatan' => $request->catatan
        ]);

        return redirect()->route('admin.ppdb.index')->with('success', 'Pendaftaran telah ditolak.');
    }
}
