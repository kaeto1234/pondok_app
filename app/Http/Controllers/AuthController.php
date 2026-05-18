<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('user_id')) {
            return $this->redirectByRole(session('user_role'));
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::with('role')
            ->where(function ($q) use ($request) {
                $q->where('email', $request->email)
                  ->orWhere('username', $request->email);
            })
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Email/username atau password salah.'])->withInput();
        }

        if (!$user->is_active) {
            return back()->withErrors(['email' => 'Akun Anda tidak aktif. Hubungi administrator.'])->withInput();
        }

        // Simpan session
        session([
            'user_id'       => $user->id,
            'user_name'     => $user->full_name,
            'user_email'    => $user->email,
            'user_role'     => $user->role->name,
            'user_role_id'  => $user->role_id,
        ]);

        return $this->redirectByRole($user->role->name);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }

    private function redirectByRole(string $role)
    {
        return match($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru'  => redirect()->route('guru.dashboard'),
            'wali'  => redirect()->route('wali.dashboard'),
            default => redirect('/'),
        };
    }
}