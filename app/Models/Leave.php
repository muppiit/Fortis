<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_nip',
        'type',//'sick', 'paid'
        'start_date',
        'end_date',
        'reason',
        'proof_file',//gambar
        'status',// 'pending', 'approved', 'rejected'
        'approved_by',
        'approved_at',
    ];

    // Relasi user yang mengajukan cuti
    public function user()
    {
        return $this->belongsTo(User::class, 'user_nip', 'nip');
    }

    // Relasi user yang menyetujui cuti
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by', 'nip');
    }
}
