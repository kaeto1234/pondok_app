<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\SantriTingkat;
use App\Models\TahunAjaran;
use App\Models\TingkatDiniyah;
use App\Models\User;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SantriController extends Controller
{
    public function index(Request $request)
    {
        $santri = Santri::with(['santriTingkat.tingkat'])
            ->when($request->search, fn($q) => $q
                ->where('nama_lengkap', 'like', '%' . $request->search . '%')
                ->orWhere('nis', 'like', '%' . $request->search . '%')
            )
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.santri.index', compact('santri'));
    }

    public function show($id)
    {
        $santri = Santri::with([
            'santriTingkat.tingkat',
            'santriTingkat.tahunAjaran',
            'orangTua.user',
            'pendaftaran',
        ])->findOrFail($id);

        return view('admin.santri.show', compact('santri'));
    }

    public function edit($id)
    {
        $santri      = Santri::with('santriTingkat.tingkat')->findOrFail($id);
        $tingkatList = TingkatDiniyah::where('is_active', true)->orderBy('urutan')->get();
        $tahunAjaranAktif = TahunAjaran::where('is_active', true)->first();

        return view('admin.santri.edit', compact('santri', 'tingkatList', 'tahunAjaranAktif'));
    }

    public function update(Request $request, $id)
    {
        $santri = Santri::findOrFail($id);

        $request->validate([
            'nis'            => 'required|string|max:50|unique:santri,nis,' . $id,
            'nama_lengkap'   => 'required|string|max:100',
            'tempat_lahir'   => 'nullable|string|max:50',
            'tanggal_lahir'  => 'nullable|date',
            'jenis_kelamin'  => 'required|in:L,P',
            'alamat'         => 'nullable|string',
            'telepon'        => 'nullable|string|max:20',
            'status'         => 'required|in:aktif,lulus,keluar',
            'tingkat_id'     => 'nullable|exists:tingkat_diniyah,id',
        ]);

        $santri->update($request->only([
            'nis', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir',
            'jenis_kelamin', 'alamat', 'telepon', 'status',
        ]));

        // Update tingkat jika diisi
        if ($request->filled('tingkat_id')) {
            $tahunAjaran = TahunAjaran::where('is_active', true)->first();
            if ($tahunAjaran) {
                SantriTingkat::updateOrCreate(
                    [
                        'santri_id'       => $santri->id,
                        'tahun_ajaran_id' => $tahunAjaran->id,
                    ],
                    [
                        'tingkat_id'    => $request->tingkat_id,
                        'tanggal_mulai' => now(),
                        'status'        => 'aktif',
                    ]
                );
            }
        }

        return redirect()->route('admin.santri.show', $santri->id)
            ->with('success', 'Data santri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $santri = Santri::findOrFail($id);

        if ($santri->status === 'aktif') {
            return back()->with('error', 'Tidak bisa menghapus santri yang masih aktif.');
        }

        $santri->delete();
        return redirect()->route('admin.santri.index')
            ->with('success', 'Data santri berhasil dihapus.');
    }
}