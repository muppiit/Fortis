<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\TeamDepartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hrDepartmentId = Department::where('department', 'Human Resources')->first()->id ?? null;
        $financeDepartmentId = Department::where('department', 'Finance')->first()->id ?? null;
        $marketingDepartmentId = Department::where('department', 'Marketing')->first()->id ?? null;
        $itDepartmentId = Department::where('department', 'Information Technology')->first()->id ?? null;

        // Hanya lanjutkan jika departemen ditemukan
        if ($hrDepartmentId) {
            TeamDepartment::create([
                'department_id' => $hrDepartmentId,
                'name' => 'Recruitment Team',
            ]);
            TeamDepartment::create([
                'department_id' => $hrDepartmentId,
                'name' => 'Employee Relations Team',
            ]);
        }

        if ($financeDepartmentId) {
            TeamDepartment::create([
                'department_id' => $financeDepartmentId,
                'name' => 'Accounting Team',
            ]);
            TeamDepartment::create([
                'department_id' => $financeDepartmentId,
                'name' => 'Taxation Team',
            ]);
        }

        if ($marketingDepartmentId) {
            TeamDepartment::create([
                'department_id' => $marketingDepartmentId,
                'name' => 'Digital Marketing Team',
            ]);
            TeamDepartment::create([
                'department_id' => $marketingDepartmentId,
                'name' => 'Brand Management Team',
            ]);
        }

        if ($itDepartmentId) {
            TeamDepartment::create([
                'department_id' => $itDepartmentId,
                'name' => 'Software Development Team',
            ]);
            TeamDepartment::create([
                'department_id' => $itDepartmentId,
                'name' => 'IT Support Team',
            ]);
        }
        $this->command->info('Team Departments seeded successfully!');
    }
}
