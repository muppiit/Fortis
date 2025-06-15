<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Attendance;
use App\Models\WorkingHour;
use Carbon\Carbon;

class AttendanceController extends Controller
{

    // clock-in
    public function clockIn(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Ambil jam kerja dari working hour 
        $workingHour = WorkingHour::first();

        $waktu = Carbon::createFromFormat('Y-m-d H:i:s', $request->waktu);

        // Cek apakah user sudah clock-in di tanggal yang sama
        $existing = Attendance::where('user_nip', $user->nip)
            ->where('type', 'clock-in')
            ->whereDate('waktu', $waktu->toDateString())
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'Anda sudah melakukan clock-in hari ini',
                'attendance' => $existing,
            ], 400);
        }


        // Hitung late_duration (dalam menit)
        $lateDuration = 0;
        if ($workingHour) {
            $clockInTime = Carbon::parse($workingHour->clock_in_time)->setDateFrom($waktu);
            if ($waktu->greaterThan($clockInTime)) {
                $minutesLate = $waktu->diffInMinutes($clockInTime);
                $lateDuration = $this->fullHourOnly($minutesLate);
            }
        }


        $attendance = Attendance::create([
            'user_nip' => $user->nip,
            'type' => 'clock-in',
            'waktu' => $waktu,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'late_duration' => $lateDuration,
            'overtime_duration' => 0,
        ]);

        return response()->json([
            'message' => 'Clock-in berhasil',
            'attendance' => $attendance,
        ]);
    }


    // clock-out
    public function clockOut(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'waktu' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $waktu = Carbon::createFromFormat('Y-m-d H:i:s', $request->waktu);
        $tanggal = $waktu->toDateString();

        // Cek apakah user sudah clock-in hari ini
        $existingClockIn = Attendance::where('user_nip', $user->nip)
            ->where('type', 'clock-in')
            ->whereDate('waktu', $tanggal)
            ->first();

        if (!$existingClockIn) {
            return response()->json(['message' => 'Anda belum melakukan clock-in hari ini'], 400);
        }

        // Cek apakah user sudah clock-out hari ini
        $existingClockOut = Attendance::where('user_nip', $user->nip)
            ->where('type', 'clock-out')
            ->whereDate('waktu', $tanggal)
            ->first();

        if ($existingClockOut) {
            return response()->json(['message' => 'Anda sudah melakukan clock-out hari ini'], 400);
        }

        // Ambil jam kerja dari working hour 
        $workingHour = WorkingHour::first();

        // Hitung overtime_duration (dalam menit)
        $overtimeDuration = 0;
        if ($workingHour) {
            $clockOutTime = Carbon::parse($workingHour->clock_out_time)->setDateFrom($waktu);
            if ($waktu->greaterThan($clockOutTime)) {
                $minutesOver = $waktu->diffInMinutes($clockOutTime);
                $overtimeDuration = $this->fullHourOnly($minutesOver);
            }
        }

        $attendance = Attendance::create([
            'user_nip' => $user->nip,
            'type' => 'clock-out',
            'waktu' => $waktu,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'late_duration' => 0,
            'overtime_duration' => $overtimeDuration,
        ]);

        return response()->json([
            'message' => 'Clock-out berhasil',
            'attendance' => $attendance,
        ]);
    }


    public function listAttendance(Request $request)
    {
        $user = auth()->user();

        $attendances = Attendance::where('user_nip', $user->nip)
            ->orderBy('waktu', 'desc')
            ->get();

        return response()->json([
            'message' => 'Daftar absensi berhasil diambil',
            'data' => $attendances,
        ]);
    }

    public function getWorkingHours()
    {
        $workingHour = WorkingHour::first();

        if (!$workingHour) {
            return response()->json(['message' => 'Jam kerja belum disetel'], 404);
        }

        return response()->json([
            'clock_in_time' => $workingHour->clock_in_time,
            'clock_out_time' => $workingHour->clock_out_time,
        ]);
    }


    private function fullHourOnly($minutes)
    {
        return floor($minutes / 60);
    }
}
