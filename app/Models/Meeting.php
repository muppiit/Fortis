<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_by_nip',
        'title',
        'description',
        'type',
        'online_url',
        'start_time',
        'end_time',
        'location',
    ];

    // Relasi ke user pembuat meeting
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_nip', 'nip');
    }

    // Relasi ke undangan meeting (many-to-many) nanti dari tabel meeting_invitations
    public function invitations()
    {
        return $this->hasMany(MeetingInvitation::class);
    }
}
