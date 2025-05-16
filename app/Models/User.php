<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

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

    // JWT Auth implementation
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
