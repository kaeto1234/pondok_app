<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Santri;
use App\Models\User;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\AkunSantriCreated;

class PpdbController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::with('tahunAjaran')
            ->latest()
            ->paginate(15);

        return view('admin.ppdb.index', compact('pendaftarans'));
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::with([
            'tahunAjaran',
            'fileBerkas.berkasTahunAjaran.jenisBerkas',
        ])->findOrFail($id);

        return view('admin.ppdb.show', compact('pendaftaran'));
    }

    public function verify(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        if ($pendaftaran->status !== 'pending') {
            return back()->with('error', 'Data ini sudah diproses sebelumnya.');
        }

        if (empty($pendaftaran->email)) {
            return back()->with('error', 'Email wali santri tidak ditemukan. Pastikan pendaftar mengisi email.');
        }

        // Cek email sudah terdaftar sebagai user
        if (User::where('email', $pendaftaran->email)->exists()) {
            return back()->with('error', 'Email ini sudah terdaftar sebagai akun. Hubungi pendaftar untuk menggunakan email lain.');
        }

        try {
            DB::transaction(function () use ($pendaftaran, $request, &$passwordPlain) {

                // 1. Update status pendaftaran
                $pendaftaran->update([
                    'status'            => 'diverifikasi',
                    'diverifikasi_oleh' => auth()->id(),
                    'diverifikasi_pada' => now(),
                    'catatan'           => $request->catatan,
                ]);

                // 2. Generate NIS unik (Tahun + 4 digit, max 100 percobaan)
                $nis      = null;
                $attempts = 0;
                do {
                    $candidate = date('Y') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
                    if (!Santri::where('nis', $candidate)->exists()) {
                        $nis = $candidate;
                    }
                    $attempts++;
                } while (!$nis && $attempts < 100);

                if (!$nis) {
                    throw new \Exception('Gagal generate NIS unik. Coba lagi.');
                }

                // 3. Buat data Santri
                $santri = Santri::create([
                    'nis'           => $nis,
                    'pendaftaran_id'=> $pendaftaran->id,
                    'nama_lengkap'  => $pendaftaran->nama_lengkap,
                    'tempat_lahir'  => $pendaftaran->tempat_lahir,
                    'tanggal_lahir' => $pendaftaran->tanggal_lahir,
                    'jenis_kelamin' => $pendaftaran->jenis_kelamin,
                    'alamat'        => $pendaftaran->alamat,
                    'telepon'       => $pendaftaran->telepon_orang_tua,
                    'status'        => 'aktif',
                ]);

                // 4. Generate password random
                $passwordPlain = Str::random(8);

                // 5. Buat akun User untuk wali santri
                $user = User::create([
                    'username'  => $pendaftaran->email,
                    'email'     => $pendaftaran->email,
                    'password'  => Hash::make($passwordPlain),
                    'full_name' => $pendaftaran->nama_ayah ?? $pendaftaran->nama_orang_tua ?? $pendaftaran->nama_lengkap,
                    'is_active' => true,
                    'role_id'   => 3,
                ]);

                // 6. Buat data OrangTua
                OrangTua::create([
                    'santri_id'      => $santri->id,
                    'user_id'        => $user->id,
                    'nama_ayah'      => $pendaftaran->nama_ayah,
                    'pekerjaan_ayah' => $pendaftaran->pekerjaan_ayah,
                    'nama_ibu'       => $pendaftaran->nama_ibu,
                    'pekerjaan_ibu'  => $pendaftaran->pekerjaan_ibu,
                    'telepon_ayah'   => $pendaftaran->telepon_orang_tua,
                    'alamat'         => $pendaftaran->alamat,
                ]);

                // 7. Kirim email (di luar transaction tidak masalah, tapi log kalau gagal)
                try {
                    Mail::to($user->email)->send(new AkunSantriCreated($santri, $user, $passwordPlain));
                } catch (\Exception $e) {
                    Log::error('Gagal kirim email PPDB: ' . $e->getMessage());
                    // Tidak throw — akun tetap dibuat meski email gagal
                }
            });

        } catch (\Exception $e) {
            Log::error('Gagal verifikasi PPDB: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->route('admin.ppdb.index')
            ->with('success', 'Pendaftaran berhasil diverifikasi. Akun wali santri telah dibuat dan email notifikasi telah dikirim.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string|max:500',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        if ($pendaftaran->status !== 'pending') {
            return back()->with('error', $pendaftaran->status === 'diverifikasi'
                ? 'Pendaftaran ini sudah diverifikasi, tidak bisa ditolak.'
                : 'Pendaftaran ini sudah ditolak sebelumnya.'
            );
        }

        $pendaftaran->update([
            'status'            => 'ditolak',
            'diverifikasi_oleh' => auth()->id(),
            'diverifikasi_pada' => now(),
            'catatan'           => $request->catatan,
        ]);

        return redirect()->route('admin.ppdb.index')
            ->with('success', 'Pendaftaran telah ditolak.');
    }
}