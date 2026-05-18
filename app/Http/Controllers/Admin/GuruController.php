<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::with('user')->orderBy('nama_lengkap')->paginate(15);
        return view('admin.guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'  => 'required|string|max:100',
            'nip'           => 'nullable|string|max:50|unique:guru,nip',
            'email'         => 'required|email|unique:users,email|unique:guru,email',
            'username'      => 'required|string|unique:users,username',
            'password'      => 'required|string|min:6',
            'telepon'       => 'nullable|string|max:20',
            'keahlian'      => 'nullable|string',
            'tanggal_masuk' => 'nullable|date',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'username'  => $request->username,
                    'email'     => $request->email,
                    'password'  => Hash::make($request->password),
                    'full_name' => $request->nama_lengkap,
                    'is_active' => true,
                    'role_id'   => 2,
                ]);

                Guru::create([
                    'user_id'       => $user->id,
                    'nip'           => $request->nip,
                    'nama_lengkap'  => $request->nama_lengkap,
                    'email'         => $request->email,
                    'telepon'       => $request->telepon,
                    'keahlian'      => $request->keahlian,
                    'tanggal_masuk' => $request->tanggal_masuk,
                    'is_active'     => true,
                ]);
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan guru: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil ditambahkan dan akun login telah dibuat.');
    }

    public function edit($id)
    {
        $guru = Guru::with('user')->findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::with('user')->findOrFail($id);

        $request->validate([
            'nama_lengkap'  => 'required|string|max:100',
            'nip'           => 'nullable|string|max:50|unique:guru,nip,' . $id,
            'email'         => 'required|email|unique:users,email,' . $guru->user_id . '|unique:guru,email,' . $id,
            'username'      => 'required|string|unique:users,username,' . $guru->user_id,
            'telepon'       => 'nullable|string|max:20',
            'keahlian'      => 'nullable|string',
            'tanggal_masuk' => 'nullable|date',
            'password'      => 'nullable|string|min:6',
            'is_active'     => 'boolean',
        ]);

        try {
            DB::transaction(function () use ($request, $guru) {
                $userData = [
                    'username'  => $request->username,
                    'email'     => $request->email,
                    'full_name' => $request->nama_lengkap,
                    'is_active' => $request->boolean('is_active', true),
                ];

                if ($request->filled('password')) {
                    $userData['password'] = Hash::make($request->password);
                }

                $guru->user->update($userData);

                $guru->update([
                    'nip'           => $request->nip,
                    'nama_lengkap'  => $request->nama_lengkap,
                    'email'         => $request->email,
                    'telepon'       => $request->telepon,
                    'keahlian'      => $request->keahlian,
                    'tanggal_masuk' => $request->tanggal_masuk,
                    'is_active'     => $request->boolean('is_active', true),
                ]);
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal update guru: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $guru = Guru::with('user')->findOrFail($id);

        try {
            DB::transaction(function () use ($guru) {
                $user = $guru->user;
                $guru->delete();
                if ($user) $user->delete();
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus guru: ' . $e->getMessage());
        }

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil dihapus.');
    }
}