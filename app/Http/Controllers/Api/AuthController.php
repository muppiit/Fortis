<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordOtpMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $identifier = $request->input('identifier');
        $password = $request->input('password');

        // Deteksi apakah email atau nip
        $field = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'nip';

        $credentials = [
            $field => $identifier,
            'password' => $password,
        ];

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => JWTAuth::factory()->getTTL() * 60,
            'user'         => auth('api')->user(),
        ]);
    }


    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
        ]);

        $user = User::where('nip', $request->identifier)
            ->orWhere('email', $request->identifier)
            ->first();

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $token = rand(100000, 999999);
        $resetTokenId = Str::uuid()->toString();

        // Simpan token (overwrite jika sudah ada)
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => bcrypt($token),
                'reset_token_id' => $resetTokenId,
                'created_at' => now(),
            ]
        );

        // Kirim email OTP
        Mail::to($user->email)->send(new ForgotPasswordOtpMail($token));

        return response()->json([
            'message' => 'OTP dikirim ke email',
            'reset_token_id' => $resetTokenId,
        ]);
    }

    public function verifyToken(Request $request)
    {
        $request->validate([
            'reset_token_id' => 'required|uuid',
            'token' => 'required|string',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('reset_token_id', $request->reset_token_id)
            ->first();

        if (!$record) {
            return response()->json(['message' => 'Token tidak ditemukan'], 404);
        }

        // Cek masa kadaluarsa
        $expired = Carbon::parse($record->created_at)->addMinutes(10)->isPast();
        if ($expired) {
            return response()->json(['message' => 'Token kadaluarsa'], 400);
        }

        // Cek apakah token cocok
        if (!password_verify($request->token, $record->token)) {
            return response()->json(['message' => 'Token salah'], 400);
        }

        return response()->json(['message' => 'Token valid']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'reset_token_id' => 'required|uuid',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('reset_token_id', $request->reset_token_id)
            ->first();

        if (!$record) {
            return response()->json(['message' => 'Token tidak ditemukan'], 404);
        }

        $user = User::where('email', $record->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('reset_token_id', $request->reset_token_id)->delete();

        return response()->json(['message' => 'Password berhasil direset']);
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'reset_token_id' => 'required|uuid',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('reset_token_id', $request->reset_token_id)
            ->first();

        if (!$record) {
            return response()->json(['message' => 'Token tidak ditemukan'], 404);
        }

        $lastSent = Carbon::parse($record->created_at);
        if (now()->diffInSeconds($lastSent) < 60) {
            return response()->json(['message' => 'Tunggu beberapa saat sebelum mengirim ulang OTP'], 429);
        }

        // Cek apakah token kadaluarsa (misalnya lebih dari 10 menit)
        $isExpired = Carbon::parse($record->created_at)->addMinutes(10)->isPast();

        if ($isExpired) {
            // Hapus token lama
            DB::table('password_reset_tokens')
                ->where('reset_token_id', $request->reset_token_id)
                ->delete();

            return response()->json(['message' => 'Token sudah kadaluarsa, silakan mulai ulang proses reset password'], 410);
        }

        $newToken = rand(100000, 999999);

        // Perbarui token & waktu
        DB::table('password_reset_tokens')
            ->where('reset_token_id', $request->reset_token_id)
            ->update([
                'token' => bcrypt($newToken),
                'created_at' => now(),
            ]);

        // Kirim ulang OTP ke email
        Mail::to($record->email)->send(new ForgotPasswordOtpMail($newToken));

        return response()->json(['message' => 'Kode OTP berhasil dikirim ulang']);
    }

    public function refresh()
    {
        try {
            $newToken = JWTAuth::setToken(JWTAuth::getToken())->refresh();
            return response()->json([
                'access_token' => $newToken,
                'token_type'   => 'bearer',
                'expires_in'   => JWTAuth::factory()->getTTL() * 60,
            ]);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Token invalid'], 401);
        }
    }
}
