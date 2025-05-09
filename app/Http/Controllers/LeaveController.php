<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::with('user')->orderByDesc('created_at')->get();
        return view('admin.leaves.index', compact('leaves'));
    }

    // Method GET: Detail cuti
    public function show($id)
    {
        $leave = Leave::with('user')->findOrFail($id);
        return view('admin.leaves.show', compact('leave'));
    }

    // Method POST: Approve / Reject cuti
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'approved_manager' => 'required|in:approved,rejected',
        ]);

        $leave = Leave::findOrFail($id);
        $leave->approved_manager = $request->approved_manager;
        $leave->save();

        return redirect()->route('admin.leaves.index')->with('success', 'Status cuti berhasil diperbarui.');
    }
}
