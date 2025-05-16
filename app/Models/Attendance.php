<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'nip',
        'type',
        'waktu',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'waktu'     => 'datetime',
        'latitude'  => 'float',
        'longitude' => 'float',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'nip', 'nip');
    }
}
