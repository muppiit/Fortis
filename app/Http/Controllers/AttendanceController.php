<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::whereHas('user', function ($query) {
            $query->where('role', 'admin')->orWhere('role', 'user');
        })->orderBy('waktu', 'desc')->get();
        
        return view('admin.attendance.index', compact('attendances'));
    }
}
