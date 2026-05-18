<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $user     = User::findOrFail(session('user_id'));
        $orangTua = OrangTua::where('user_id', $user->id)->with('santri')->first();
        $santri   = $orangTua?->santri;

        return view('wali.dashboard', compact('user', 'orangTua', 'santri'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(session('user_id'));

        $request->validate([
            'full_name' => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'username'  => 'required|string|unique:users,username,' . $user->id,
        ]);

        $user->update($request->only(['full_name', 'email', 'username']));

        // Update data orang tua
        $orangTua = OrangTua::where('user_id', $user->id)->first();
        if ($orangTua) {
            $request->validate([
                'telepon_ayah' => 'nullable|string|max:20',
                'telepon_ibu'  => 'nullable|string|max:20',
                'alamat'       => 'nullable|string',
            ]);
            $orangTua->update($request->only(['telepon_ayah', 'telepon_ibu', 'alamat']));
        }

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

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.'])->with('tab', 'password');
        }

        $user->update(['password' => Hash::make($request->password_baru)]);

        return back()->with('success', 'Password berhasil diperbarui.')->with('tab', 'password');
    }
}