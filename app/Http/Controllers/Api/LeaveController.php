<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
    // 1. Sick Leave 
    public function sickLeave(Request $request)
    {
        $user = auth('api')->user();  // Ambil user yang login

        $validated = $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $leave = Leave::create([
            'nip' => $user->nip,  // otomatis dari user login
            'type' => 'sick',
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'approved_manager' => 'pending',
        ]);

        return response()->json(['message' => 'Sick leave requested', 'leave' => $leave]);
    }

    // 2. Paid Leave 
    public function paidLeave(Request $request)
    {
        $user = auth('api')->user();

        $validated = $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);

        $leave = Leave::create([
            'nip' => $user->nip,
            'type' => 'paid',
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'alasan' => $validated['alasan'],
            'approved_manager' => 'pending',
        ]);

        return response()->json(['message' => 'Paid leave requested', 'leave' => $leave]);
    }


    // 3. List Leave - filter by status, nama, tanggal
    public function listLeave(Request $request)
    {
        $query = Leave::query();

        // Filter by approved_manager status
        if ($request->has('approved_manager')) {
            $query->where('approved_manager', $request->approved_manager);
        }

        // Filter by user's name (join with users table)
        if ($request->has('nama')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->nama . '%');
            });
        }

        // Filter by tanggal (check if any leave falls in this date)
        if ($request->has('tanggal')) {
            $tanggal = $request->tanggal;
            $query->where(function ($q) use ($tanggal) {
                $q->where('tanggal_mulai', '<=', $tanggal)
                    ->where('tanggal_selesai', '>=', $tanggal);
            });
        }

        $leaves = $query->with('user')->get();

        // Format response
        $result = $leaves->map(function ($leave) {
            return [
                'id' => $leave->id,
                'status' => $leave->approved_manager,
                'nama' => $leave->user->nama ?? null,
                'tanggal_mulai' => $leave->tanggal_mulai,
                'tanggal_selesai' => $leave->tanggal_selesai,
            ];
        });

        return response()->json($result);
    }

    // 4. Detail Leave - by leave ID or nip
    public function detailLeave($id)
    {
        $leave = Leave::with('user')->find($id);

        if (!$leave) {
            return response()->json(['message' => 'Leave not found'], 404);
        }

        $user = $leave->user;

        return response()->json([
            'id' => $leave->id,
            'status' => $leave->approved_manager,
            'nama' => $user->nama ?? null,
            'tanggal_mulai' => $leave->tanggal_mulai,
            'tanggal_selesai' => $leave->tanggal_selesai,
            'departement' => $user->departement ?? null,
            'team_departement' => $user->team_departement ?? null,
            'manager_departement' => $user->manager_departement ?? null,
            'type' => $leave->type,
            'alasan' => $leave->alasan,
        ]);
    }
}
