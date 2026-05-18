<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(session('user_id'));
        // firstOrCreate supaya data guru selalu ada
        $guru = Guru::firstOrCreate(
            ['user_id' => $user->id],
            ['nama_lengkap' => $user->full_name]
        );

        return view('guru.dashboard', compact('user', 'guru'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(session('user_id'));

        $request->validate([
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'username' => 'required|string|unique:users,username,'.$user->id,
            'telepon' => 'nullable|string|max:20',
            'keahlian' => 'nullable|string',
        ]);

        $user->update($request->only(['full_name', 'email', 'username']));

        Guru::where('user_id', $user->id)->update([
            'nama_lengkap' => $request->full_name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'keahlian' => $request->keahlian,
        ]);

        session(['user_name' => $user->full_name, 'user_email' => $user->email]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required|string',
            'password_baru' => 'required|string|min:6|confirmed',
        ]);

        $user = User::findOrFail(session('user_id'));

        if (! Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.'])->with('tab', 'password');
        }

        $user->update(['password' => Hash::make($request->password_baru)]);

        return back()->with('success', 'Password berhasil diperbarui.')->with('tab', 'password');
    }
}
