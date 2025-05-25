<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     protected $table = 'roles';

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'name',
        'level',
    ];

    /**
     * Relasi ke User
     * Satu Role bisa dimiliki banyak User
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
