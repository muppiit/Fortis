<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Leave::with(['user.teamDepartment.department', 'approver']);

        if ($user->role->level === 'super_super_admin') {
            // Melihat semua cuti
            $leaves = $query->get();
        } elseif ($user->role->level === 'super_admin') {
            // Melihat cuti berdasarkan departemen yang sama
            $departmentId = $user->teamDepartment->department_id ?? null;

            $leaves = $query->whereHas('user.teamDepartment', function ($q) use ($departmentId) {
                $q->where('department_id', $departmentId);
            })->get();
        } elseif ($user->role->level === 'admin') {
            // Melihat cuti berdasarkan team yang sama
            $teamId = $user->team_department_id;

            $leaves = $query->whereHas('user', function ($q) use ($teamId) {
                $q->where('team_department_id', $teamId);
            })->get();
        } else {
            // Default kosong jika tidak dikenali
            $leaves = collect();
        }

        return view('admin.leaves.index', compact('leaves'));
    }

    public function show($id)
    {
        $leave = Leave::with([
            'user.teamDepartment.department', 
            'approver' 
        ])->findOrFail($id);

        return view('admin.leaves.show', compact('leave'));
    }

    public function updateStatus(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);

        // Hanya bisa update jika status masih pending
        if ($leave->status !== 'pending') {
            return redirect()->route('admin.leaves.index')
                ->with('error', 'Status cuti sudah diproses sebelumnya.');
        }

        // Validasi input status
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $leave->status = $request->status;
        $leave->approved_by = Auth::user()->name;
        $leave->approved_at = now();
        $leave->save();

        return redirect()->route('admin.leaves.show', $leave->id)
            ->with('success', 'Status cuti berhasil diperbarui.');
    }
}
