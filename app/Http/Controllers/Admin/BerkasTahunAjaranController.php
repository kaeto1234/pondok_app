<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use App\Models\JenisBerkas;
use App\Models\BerkasTahunAjaran;
use Illuminate\Http\Request;

class BerkasTahunAjaranController extends Controller
{
    // Menampilkan daftar berkas untuk tahun ajaran tertentu
    public function index($tahunAjaranId)
    {
        $tahunAjaran = TahunAjaran::findOrFail($tahunAjaranId);
        $berkasList = BerkasTahunAjaran::where('tahun_ajaran_id', $tahunAjaranId)
            ->with('jenisBerkas')
            ->orderBy('urutan')
            ->get();
        
        $semuaJenisBerkas = JenisBerkas::orderBy('nama')->get();
        
        return view('admin.berkas-tahun-ajaran.index', compact('tahunAjaran', 'berkasList', 'semuaJenisBerkas'));
    }
    
    // Menambah berkas ke tahun ajaran
    public function store(Request $request, $tahunAjaranId)
    {
        $request->validate([
            'jenis_berkas_id' => 'required|exists:jenis_berkas,id',
            'is_wajib' => 'boolean',
            'urutan' => 'nullable|integer',
        ]);
        
        // Cek apakah sudah ada
        $exists = BerkasTahunAjaran::where('tahun_ajaran_id', $tahunAjaranId)
            ->where('jenis_berkas_id', $request->jenis_berkas_id)
            ->exists();
            
        if ($exists) {
            return back()->with('error', 'Berkas ini sudah terdaftar di tahun ajaran ini.');
        }
        
        // Urutan otomatis jika tidak diisi
        $urutan = $request->urutan ?? BerkasTahunAjaran::where('tahun_ajaran_id', $tahunAjaranId)->count() + 1;
        
        BerkasTahunAjaran::create([
            'tahun_ajaran_id' => $tahunAjaranId,
            'jenis_berkas_id' => $request->jenis_berkas_id,
            'is_wajib' => $request->is_wajib ?? true,
            'urutan' => $urutan,
        ]);
        
        return redirect()->route('admin.berkas-tahun-ajaran.index', $tahunAjaranId)
            ->with('success', 'Berkas berhasil ditambahkan ke tahun ajaran ini.');
    }
    
    // Mengupdate berkas
    public function update(Request $request, $tahunAjaranId, $id)
    {
        $berkas = BerkasTahunAjaran::where('tahun_ajaran_id', $tahunAjaranId)
            ->where('id', $id)
            ->firstOrFail();
        
        $request->validate([
            'is_wajib' => 'boolean',
            'urutan' => 'nullable|integer',
        ]);
        
        $berkas->update([
            'is_wajib' => $request->is_wajib ?? $berkas->is_wajib,
            'urutan' => $request->urutan ?? $berkas->urutan,
        ]);
        
        return redirect()->route('admin.berkas-tahun-ajaran.index', $tahunAjaranId)
            ->with('success', 'Berkas berhasil diupdate.');
    }
    
    // Menghapus berkas dari tahun ajaran
    public function destroy($tahunAjaranId, $id)
    {
        $berkas = BerkasTahunAjaran::where('tahun_ajaran_id', $tahunAjaranId)
            ->where('id', $id)
            ->firstOrFail();
        
        $berkas->delete();
        
        return redirect()->route('admin.berkas-tahun-ajaran.index', $tahunAjaranId)
            ->with('success', 'Berkas berhasil dihapus dari tahun ajaran ini.');
    }
    
    // Update urutan (drag and drop)
    public function updateUrutan(Request $request, $tahunAjaranId)
    {
        foreach ($request->urutan as $index => $id) {
            BerkasTahunAjaran::where('id', $id)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->update(['urutan' => $index + 1]);
        }
        
        return response()->json(['success' => true]);
    }
}