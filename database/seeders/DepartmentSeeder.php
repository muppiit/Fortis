<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'department' => 'Human Resources',
            'manager_department' => 'Budi Santoso',
        ]);

        Department::create([
            'department' => 'Finance',
            'manager_department' => 'Siti Aminah',
        ]);

        Department::create([
            'department' => 'Marketing',
            'manager_department' => 'Joko Susilo',
        ]);

        Department::create([
            'department' => 'Information Technology',
            'manager_department' => 'Dewi Lestari',
        ]);

        Department::create([
            'department' => 'Operations',
            'manager_department' => 'Rina Wijaya',
        ]);

        $this->command->info('Departments seeded successfully!');
    }
}
