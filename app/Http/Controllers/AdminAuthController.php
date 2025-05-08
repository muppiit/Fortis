<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('nip', $request->nip)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login_error' => 'NIP atau Password salah'])->withInput();
        }

        if (!in_array($user->role, ['admin', 'super-admin'])) {
            return back()->withErrors(['login_error' => 'Akses hanya untuk Admin atau Super Admin'])->withInput();
        }

        // Simpan session login
        Session::put('admin_login', true);
        Session::put('admin_nip', $user->nip);
        Session::put('admin_nama', $user->nama);
        Session::put('admin_role', $user->role);

        // Redirect berdasarkan role
        if ($user->role === 'super-admin') {
            return redirect()->route('superadmin.dashboard');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }


    public function logout()
    {
        Session::flush();
        return redirect()->route('admin.login')->with('status', 'Berhasil logout');
    }
}
