<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role->level;

        $attendances = Attendance::with('user');

        if ($role === 'super_admin') {
            $departmentId = $user->teamDepartment->department_id;
            $attendances->whereHas('user.teamDepartment', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            });
        } elseif ($role === 'admin') {
            $teamId = $user->team_department_id;
            $attendances->whereHas('user', function ($query) use ($teamId) {
                $query->where('team_department_id', $teamId);
            });
        }

        $attendances = $attendances->orderByDesc('waktu')->paginate(20);
        $workingHour = WorkingHour::first();

        return view('admin.attendance.index', compact('attendances', 'workingHour'));
    }

    public function updateWorkingHours(Request $request)
    {
        if (auth()->user()->role->level !== 'super_super_admin') {
            abort(403);
        }

        $request->validate([
            'clock_in_time' => 'required|date_format:H:i',
            'clock_out_time' => 'required|date_format:H:i|after:clock_in_time',
        ]);

        $workingHour = WorkingHour::first() ?? new WorkingHour();

        $workingHour->clock_in_time = $request->clock_in_time;
        $workingHour->clock_out_time = $request->clock_out_time;
        $workingHour->save();

        return redirect()->route('admin.attendances.index')->with('success', 'Jam kerja berhasil diperbarui.');
    }
}
