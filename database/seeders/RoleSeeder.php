<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Super Super Admin',
            'level' => 'super_super_admin',
        ]);

        Role::create([
            'name' => 'Super Admin',
            'level' => 'super_admin',
        ]);

        Role::create([
            'name' => 'Admin',
            'level' => 'admin',
        ]);

        Role::create([
            'name' => 'User',
            'level' => 'user',
        ]);

        $this->command->info('Roles seeded successfully!');
    }
}
