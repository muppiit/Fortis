<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Attendance;


class AttendanceController extends Controller
{
    // Clock In
    public function clockIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'waktu'    => 'required|date_format:Y-m-d H:i:s',
            'latitude' => 'required|numeric',
            'longitude'=> 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::guard('api')->user();

        $attendance = Attendance::create([
            'nip'       => $user->nip,
            'type'      => 'clock-in',
            'waktu'     => $request->waktu,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json([
            'message' => 'Clock-in berhasil disimpan.',
            'data'    => $attendance,
        ]);
    }

    // Clock Out
    public function clockOut(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'waktu'    => 'required|date_format:Y-m-d H:i:s',
            'latitude' => 'required|numeric',
            'longitude'=> 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::guard('api')->user();

        $attendance = Attendance::create([
            'nip'       => $user->nip,
            'type'      => 'clock-out',
            'waktu'     => $request->waktu,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json([
            'message' => 'Clock-out berhasil disimpan.',
            'data'    => $attendance,
        ]);
    }
}
