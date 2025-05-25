<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_nip',
        'type',//clock_in, clock_out
        'waktu',
        'latitude',
        'longitude',
        'late_duration',
        'overtime_duration',
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_nip', 'nip');
    }
}
