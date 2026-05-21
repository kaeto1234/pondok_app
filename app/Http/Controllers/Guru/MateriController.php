<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\MataPelajaran;
use App\Models\TingkatDiniyah;
use App\Models\Guru;
use App\Models\JadwalMengajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $guru = Guru::where('user_id', session('user_id'))->firstOrFail();

        $materi = Materi::with(['mataPelajaran', 'tingkat'])
            ->where('diupload_oleh', session('user_id'))
            ->latest()
            ->paginate(15);

        // Mapel & tingkat yang diajar guru ini
        $jadwal = JadwalMengajar::with(['kurikulum.mataPelajaran', 'kurikulum.tingkatDiniyah'])
            ->where('guru_id', $guru->id)
            ->where('is_active', true)
            ->get();

        $mapelList  = $jadwal->map(fn($j) => $j->kurikulum->mataPelajaran)->unique('id');
        $tingkatList = $jadwal->map(fn($j) => $j->kurikulum->tingkatDiniyah)->unique('id');

        return view('guru.materi.index', compact('materi', 'mapelList', 'tingkatList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:200',
            'deskripsi'  => 'nullable|string',
            'mapel_id'   => 'nullable|exists:mata_pelajaran,id',
            'tingkat_id' => 'nullable|exists:tingkat_diniyah,id',
            'file'       => 'required|file|max:10240|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,mp4',
        ]);

        $file         = $request->file('file');
        $fileName     = time() . '_' . $file->getClientOriginalName();
        $path         = $file->storeAs('materi', $fileName, 'public');
        $ukuranFile   = $file->getSize();

        Materi::create([
            'judul'         => $request->judul,
            'deskripsi'     => $request->deskripsi,
            'path_file'     => $path,
            'ukuran_file'   => $ukuranFile,
            'mapel_id'      => $request->mapel_id,
            'tingkat_id'    => $request->tingkat_id,
            'diupload_oleh' => session('user_id'),
            'diunduh'       => 0,
        ]);

        return back()->with('success', 'Materi berhasil diupload.');
    }

    public function destroy($id)
    {
        $materi = Materi::where('diupload_oleh', session('user_id'))->findOrFail($id);
        Storage::disk('public')->delete($materi->path_file);
        $materi->delete();

        return back()->with('success', 'Materi berhasil dihapus.');
    }
}