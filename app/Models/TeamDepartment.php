<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamDepartment extends Model
{
    use HasFactory;
    protected $table = 'team_departments';

    protected $fillable = [
        'department_id',
        'name',
    ];

    /**
     * Relasi: TeamDepartment milik satu Department.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Relasi: TeamDepartment memiliki banyak User.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
