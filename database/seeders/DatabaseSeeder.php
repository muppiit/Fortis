<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            DepartmentSeeder::class,
            TeamDepartmentSeeder::class,
            UserSeeder::class,
            WorkingHourSeeder::class,
            AttendanceSeeder::class,
            LeaveSeeder::class,

        ]);
    }
}
