<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingInvitation extends Model
{
    use HasFactory;
    protected $fillable = [
        'meeting_id',
        'invite_type',
        'invite_target',
    ];

    // Relasi ke meeting
    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    /**
     * Helper untuk mendapatkan detail target undangan,
     * misalnya user, department, atau team
     */
    public function getInviteTargetDetails()
    {
        switch ($this->invite_type) {
            case 'user':
                return User::where('nip', $this->invite_target)->first();
            case 'department':
                return Department::find($this->invite_target);
            case 'team':
                // Misal, jika 'team' adalah nama tim, kita bisa cari di department table
                return Department::where('team_department', $this->invite_target)->first();
            default:
                return null;
        }
    }
}
