<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'nip';
    public $incrementing = false; // Karena nip bukan integer auto-increment
    protected $keyType = 'string'; // Karena nip berupa string

    protected $fillable = [
        'nip',
        'nama',
        'password',
        'departement',
        'team_departement',
        'manager_departement',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke tabel attendance
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'nip', 'nip');
    }

    // Relasi ke tabel leaves
    public function leaves()
    {
        return $this->hasMany(Leave::class, 'nip', 'nip');
    }
}
