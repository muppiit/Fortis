<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $table = 'leaves';

    protected $fillable = [
        'nip',
        'type',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'approved_manager',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    protected $attributes = [
        'approved_manager' => 'pending',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'nip', 'nip');
    }
}
