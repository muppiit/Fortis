<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{
    // Mendapatkan data profile user yang sedang login
    public function profile()
    {
        $user = auth('api')->user();

        return response()->json([
            'nip'               => $user->nip,
            'nama'              => $user->nama,
            'departement'       => $user->departement,
            'team_departement'  => $user->team_departement,
        ]);
    }

    // Mengedit profile: nama dan password
    public function editProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth('api')->user();

        $validated = $request->validate([
            'nama'     => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->nama = $validated['nama'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save(); // <--- Tidak akan merah lagi jika IDE tahu ini adalah instance dari User

        return response()->json([
            'message' => 'Profile updated successfully.',
            'user'    => [
                'nip'              => $user->nip,
                'nama'             => $user->nama,
                'departement'      => $user->departement,
                'team_departement' => $user->team_departement,
            ]
        ]);
    }
}
