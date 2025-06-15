<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Tampilkan profile lengkap user
    public function profile()
    {
        $user = Auth::user();

        // Ambil relasi untuk response
        $teamDepartment = $user->teamDepartment;
        $department = $teamDepartment ? $teamDepartment->department : null;
        $manager = $department ? $department->manager_department : null;

        return response()->json([
            'nip' => $user->nip,
            'name' => $user->name,
            'email' => $user->email,
            'department' => $department ? $department->department : null,
            'team_department' => $teamDepartment ? $teamDepartment->name : null,
            'manager_department' => $manager,
        ]);
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed', 
            // password_confirmation harus ada jika password diisi
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'message' => 'Profil berhasil diperbarui',
            'user' => [
                'nip' => $user->nip,
                'name' => $user->name,
            ],
        ]);
    }

}
