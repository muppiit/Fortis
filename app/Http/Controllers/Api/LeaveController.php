<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
    // Ajukan cuti
    public function apply(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'type' => 'required|in:paid,sick',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
            'proof_file' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $proofUrl = null;

        if ($request->hasFile('proof_file')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('proof_file')->getRealPath())->getSecurePath();
            $proofUrl = $uploadedFileUrl;
        }

        $leave = Leave::create([
            'user_nip' => $user->nip,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'proof_file' => $proofUrl,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Pengajuan cuti berhasil dikirim',
            'leave' => $leave,
        ]);
    }

    // List pengajuan cuti milik user
    public function myLeaves()
    {
        $user = Auth::user();

        // Ambil leave sekaligus relasi approver
        $leaves = Leave::with('approver')
            ->where('user_nip', $user->nip)
            ->latest()
            ->get();

        // Format output
        $result = $leaves->map(function ($leave) {
            return [
                'id' => $leave->id,
                'type' => $leave->type,
                'start_date' => $leave->start_date,
                'end_date' => $leave->end_date,
                'reason' => $leave->reason,
                'proof_file' => $leave->proof_file,
                'status' => $leave->status,
                'approved_by' => $leave->approver ? [
                    'nip' => $leave->approver->nip,
                    'name' => $leave->approver->name,
                ] : null,
                'approved_at' => $leave->approved_at,
                'created_at' => $leave->created_at,
                'updated_at' => $leave->updated_at,
            ];
        });

        return response()->json([
            'message' => 'List pengajuan cuti Anda',
            'data' => $result,
        ]);
    }
}
