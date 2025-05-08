<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.dashboard', [
            'nama' => Session::get('admin_nama'),
            'role' => Session::get('admin_role'),
            'users' => $users,
        ]);
    }

    public function showCreateUserForm()
    {
        return view('admin.create-user');
    }


    public function createUser(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|unique:users,nip',
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'role' => 'nullable|in:admin,user',
            'departement' => 'required|string',
            'team_departement' => 'required|string',
            'manager_departement' => 'required|string',
        ]);

        User::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user',
            'departement' => $request->departement,
            'team_departement' => $request->team_departement,
            'manager_departement' => $request->manager_departement,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User berhasil dibuat.');
    }
}
