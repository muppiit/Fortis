<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\MeetingInvitationMail;
use App\Models\Department;
use App\Models\Meeting;
use App\Models\MeetingInvitation;
use App\Models\TeamDepartment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{
    // Mendapatkan data dropdown departemen
    public function getDepartments()
    {
        $departments = Department::all(['id', 'department', 'manager_department']);
        return response()->json($departments);
    }

    // Mendapatkan tim departemen berdasarkan departemen id
    public function getTeamDepartments($departmentId)
    {
        $teams = TeamDepartment::where('department_id', $departmentId)->get(['id', 'name']);
        return response()->json($teams);
    }

    // Mendapatkan users dari multiple team departemen (array id)
    public function getUsersFromTeams(Request $request)
    {
        $teamIds = $request->input('team_ids', []);
        $users = User::whereIn('team_department_id', $teamIds)->get(['nip', 'name', 'email']);
        return response()->json($users);
    }

    // Membuat meeting baru
    public function store(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:online,offline',
            'department_id' => 'required|exists:departments,id',
            'team_department_ids' => 'required|array|min:1',
            'team_department_ids.*' => 'exists:team_departments,id',
            'user_nips' => 'required|array|min:1',
            'user_nips.*' => 'exists:users,nip',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'online_url' => 'nullable|string|required_if:type,online',
            'description' => 'nullable|string',
            'location' => 'nullable|string|required_if:type,offline',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $department = Department::findOrFail($request->department_id);
        $headDepartement = $department->manager_department;

        $meeting = Meeting::create([
            'created_by_nip' => $user->nip,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'online_url' => $request->type == 'online' ? $request->online_url : null,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->type == 'offline' ? $request->location : null,
        ]);

        MeetingInvitation::create([
            'meeting_id' => $meeting->id,
            'invite_type' => 'department',
            'invite_target' => $request->department_id,
        ]);

        foreach ($request->team_department_ids as $teamId) {
            MeetingInvitation::create([
                'meeting_id' => $meeting->id,
                'invite_type' => 'team',
                'invite_target' => $teamId,
            ]);
        }

        foreach ($request->user_nips as $nip) {
            MeetingInvitation::create([
                'meeting_id' => $meeting->id,
                'invite_type' => 'user',
                'invite_target' => $nip,
            ]);
        }

        // Kirim email undangan
        $invitedUsers = User::whereIn('nip', $request->user_nips)->get();
        foreach ($invitedUsers as $invitedUser) {
            Mail::to($invitedUser->email)->send(new MeetingInvitationMail($meeting));
        }

        return response()->json([
            'message' => 'Meeting berhasil dibuat dan email undangan terkirim',
            'meeting' => $meeting,
            'head_department' => $headDepartement,
        ]);
    }

    public function index()
    {
        $user = Auth::user();

        // Ambil semua meeting yang dibuat oleh user
        $createdMeetings = Meeting::with(['creator', 'invitations'])
            ->where('created_by_nip', $user->nip)
            ->get();

        // Ambil semua meeting yang mengundang user
        $invitedMeetingIds = MeetingInvitation::where(function ($query) use ($user) {
            $query->where(function ($q) use ($user) {
                $q->where('invite_type', 'user')
                    ->where('invite_target', $user->nip);
            })->orWhere(function ($q) use ($user) {
                $q->where('invite_type', 'team')
                    ->where('invite_target', $user->team_department_id);
            })->orWhere(function ($q) use ($user) {
                $q->where('invite_type', 'department')
                    ->where('invite_target', optional($user->teamDepartment)->department_id);
            });
        })->pluck('meeting_id');

        $invitedMeetings = Meeting::with(['creator', 'invitations'])
            ->whereIn('id', $invitedMeetingIds)
            ->get();

        // Gabungkan dan hilangkan duplikat
        $meetings = $createdMeetings->merge($invitedMeetings)->unique('id')->sortByDesc('start_time')->values();

        // Format response
        $result = $meetings->map(function ($meeting) {
            $department = null;
            $teamDepartments = [];
            $invitedUsers = [];
            $manager = null;

            foreach ($meeting->invitations as $invitation) {
                if ($invitation->invite_type === 'department') {
                    $dept = \App\Models\Department::find($invitation->invite_target);
                    if ($dept) {
                        $department = [
                            'id' => $dept->id,
                            'name' => $dept->department,
                        ];
                        $manager = $dept->manager_department;
                    }
                }

                if ($invitation->invite_type === 'team') {
                    $team = \App\Models\TeamDepartment::find($invitation->invite_target);
                    if ($team) {
                        $teamDepartments[] = [
                            'id' => $team->id,
                            'name' => $team->name,
                        ];
                    }
                }

                if ($invitation->invite_type === 'user') {
                    $user = \App\Models\User::where('nip', $invitation->invite_target)->first();
                    if ($user) {
                        $invitedUsers[] = [
                            'nip' => $user->nip,
                            'name' => $user->name,
                            'email' => $user->email,
                        ];
                    }
                }
            }

            return [
                'id' => $meeting->id,
                'title' => $meeting->title,
                'description' => $meeting->description,
                'type' => $meeting->type,
                'online_url' => $meeting->online_url,
                'location' => $meeting->location,
                'start_time' => $meeting->start_time,
                'end_time' => $meeting->end_time,
                'created_by' => [
                    'nip' => $meeting->creator->nip,
                    'name' => $meeting->creator->name,
                ],
                'manager_department' => $manager,
                'department' => $department,
                'team_departments' => $teamDepartments,
                'invited_users' => $invitedUsers,
            ];
        });

        return response()->json([
            'message' => 'List meeting yang dibuat dan yang mengundang user',
            'data' => $result,
        ]);
    }
}
