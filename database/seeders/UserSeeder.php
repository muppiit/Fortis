<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\TeamDepartment;
use App\Models\User;
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
        // Ambil ID dari role yang sudah ada
        // Pastikan RoleSeeder sudah dijalankan sebelumnya
        $superSuperAdminRole = Role::where('level', 'super_super_admin')->first()->id ?? null;
        $superAdminRole = Role::where('level', 'super_admin')->first()->id ?? null;
        $adminRole = Role::where('level', 'admin')->first()->id ?? null;
        $userRole = Role::where('level', 'user')->first()->id ?? null;

        // Ambil ID dari team department yang sudah ada
        // Pastikan TeamDepartmentSeeder sudah dijalankan sebelumnya
        $recruitmentTeam = TeamDepartment::where('name', 'Recruitment Team')->first()->id ?? null;
        $accountingTeam = TeamDepartment::where('name', 'Accounting Team')->first()->id ?? null;
        $digitalMarketingTeam = TeamDepartment::where('name', 'Digital Marketing Team')->first()->id ?? null;
        $itSupportTeam = TeamDepartment::where('name', 'IT Support Team')->first()->id ?? null;
        $humanResourcesTeam = TeamDepartment::where('name', 'Human Resources Team')->first()->id ?? null; // Asumsi ada team ini
        $salesTeam = TeamDepartment::where('name', 'Sales Team')->first()->id ?? null; // Asumsi ada team ini

        // Hanya lanjutkan jika semua role dan team department yang dibutuhkan ditemukan
        if (
            $superSuperAdminRole && $superAdminRole && $adminRole && $userRole &&
            $recruitmentTeam && $accountingTeam && $digitalMarketingTeam && $itSupportTeam
            // Anda bisa menambahkan pengecekan untuk team baru di sini jika diperlukan
            // && $humanResourcesTeam && $salesTeam
        ) {

            // Buat user dengan role dan team department yang berbeda
            User::create([
                'nip' => '10001',
                'name' => 'Super Super Admin User',
                'email' => 'supersuperadmin@example.com',
                'password' => Hash::make('password'), // Hash password
                'role_id' => $superSuperAdminRole,
                'team_department_id' => $itSupportTeam, // Contoh: SS Admin di IT Support
            ]);

            User::create([
                'nip' => '10002',
                'name' => 'Super Admin User',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password'),
                'role_id' => $superAdminRole,
                'team_department_id' => $recruitmentTeam, // Contoh: Super Admin di Recruitment
            ]);

            User::create([
                'nip' => '10003',
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role_id' => $adminRole,
                'team_department_id' => $accountingTeam, // Contoh: Admin di Accounting
            ]);

            // Menambahkan lebih banyak user biasa (role 'user')
            User::create([
                'nip' => '10004',
                'name' => 'Regular User 1',
                'email' => 'user1@example.com',
                'password' => Hash::make('password'),
                'role_id' => $userRole,
                'team_department_id' => $digitalMarketingTeam, // Contoh: User di Digital Marketing
            ]);

            User::create([
                'nip' => '10005',
                'name' => 'Regular User 2',
                'email' => 'user2@example.com',
                'password' => Hash::make('password'),
                'role_id' => $userRole,
                'team_department_id' => $itSupportTeam, // Contoh: User di IT Support
            ]);

            User::create([
                'nip' => '10006',
                'name' => 'Regular User 3',
                'email' => 'user3@example.com',
                'password' => Hash::make('password'),
                'role_id' => $userRole,
                'team_department_id' => $recruitmentTeam, // User di Recruitment
            ]);

            User::create([
                'nip' => '10007',
                'name' => 'Regular User 4',
                'email' => 'user4@example.com',
                'password' => Hash::make('password'),
                'role_id' => $userRole,
                'team_department_id' => $accountingTeam, // User di Accounting
            ]);

            User::create([
                'nip' => '10008',
                'name' => 'Regular User 5',
                'email' => 'user5@example.com',
                'password' => Hash::make('password'),
                'role_id' => $userRole,
                'team_department_id' => $digitalMarketingTeam, // User di Digital Marketing
            ]);

            User::create([
                'nip' => '10009',
                'name' => 'Regular User 6',
                'email' => 'user6@example.com',
                'password' => Hash::make('password'),
                'role_id' => $userRole,
                'team_department_id' => $itSupportTeam, // User di IT Support
            ]);

            // Menambahkan user admin tambahan
            User::create([
                'nip' => '10010',
                'name' => 'Admin User 2',
                'email' => 'admin2@example.com',
                'password' => Hash::make('password'),
                'role_id' => $adminRole,
                'team_department_id' => $digitalMarketingTeam, // Admin di Digital Marketing
            ]);

            // Menambahkan user super admin tambahan
            User::create([
                'nip' => '10011',
                'name' => 'Super Admin User 2',
                'email' => 'superadmin2@example.com',
                'password' => Hash::make('password'),
                'role_id' => $superAdminRole,
                'team_department_id' => $itSupportTeam, // Super Admin di IT Support
            ]);

            // Jika Anda memiliki team department lain, Anda bisa tambahkan di sini
            if ($humanResourcesTeam) {
                User::create([
                    'nip' => '10012',
                    'name' => 'HR User',
                    'email' => 'hr@example.com',
                    'password' => Hash::make('password'),
                    'role_id' => $adminRole, // Atau role khusus HR jika ada
                    'team_department_id' => $humanResourcesTeam,
                ]);
            }

            if ($salesTeam) {
                User::create([
                    'nip' => '10013',
                    'name' => 'Sales User 1',
                    'email' => 'sales1@example.com',
                    'password' => Hash::make('password'),
                    'role_id' => $userRole,
                    'team_department_id' => $salesTeam,
                ]);
            }


            $this->command->info('Users seeded successfully!');
        } else {
            $this->command->warn('Skipping UserSeeder: Required roles or team departments not found. Please run RoleSeeder and TeamDepartmentSeeder first.');
        }
    }
}
