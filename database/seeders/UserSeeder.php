<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nip' => '1001',
                'nama' => 'Admin Biasa',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'departement' => 'HR',
                'team_departement' => 'HR Team A',
                'manager_departement' => 'Budi HRD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '1002',
                'nama' => 'Super Admin',
                'password' => Hash::make('superadmin123'),
                'role' => 'super-admin',
                'departement' => 'IT',
                'team_departement' => 'IT Core',
                'manager_departement' => 'Sari IT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '0001',
                'nama' => 'Abdul Balmod',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'departement' => 'IT',
                'team_departement' => 'IT Core',
                'manager_departement' => 'Sari IT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '0002',
                'nama' => 'Siti Nurhaliza',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'departement' => 'IT',
                'team_departement' => 'IT Core',
                'manager_departement' => 'Sari IT',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
