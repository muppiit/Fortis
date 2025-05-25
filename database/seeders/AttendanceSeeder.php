<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); // Ambil user pertama yang ada
        if (!$user) {
            // Jika tidak ada user, buat satu user dummy
            $user = User::factory()->create([
                'nip' => '1234567890', // Contoh NIP
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => bcrypt('password'),
            ]);
            $this->command->info('User dummy created for seeding attendance.');
        }

        $userNip = $user->nip;

        // Contoh data absensi untuk beberapa hari
        // Hari 1: Absensi tepat waktu
        Attendance::create([
            'user_nip' => $userNip,
            'type' => 'clock-in',
            'waktu' => Carbon::now()->subDays(2)->setHour(9)->setMinute(0)->setSecond(0), // 2 hari yang lalu, jam 09:00
            'latitude' => -6.200000,
            'longitude' => 106.816666,
            'late_duration' => null, // Tepat waktu
            'overtime_duration' => null,
        ]);
        Attendance::create([
            'user_nip' => $userNip,
            'type' => 'clock-out',
            'waktu' => Carbon::now()->subDays(2)->setHour(17)->setMinute(0)->setSecond(0), // 2 hari yang lalu, jam 17:00
            'latitude' => -6.200000,
            'longitude' => 106.816666,
            'late_duration' => null,
            'overtime_duration' => null, // Tidak ada lembur
        ]);

        // Hari 2: Absensi terlambat dan lembur
        Attendance::create([
            'user_nip' => $userNip,
            'type' => 'clock-in',
            'waktu' => Carbon::now()->subDays(1)->setHour(9)->setMinute(15)->setSecond(0), // 1 hari yang lalu, jam 09:15 (terlambat 15 menit)
            'latitude' => -6.200000,
            'longitude' => 106.816666,
            'late_duration' => 0.30, // 15 menit = 0.25 jam
            'overtime_duration' => null,
        ]);
        Attendance::create([
            'user_nip' => $userNip,
            'type' => 'clock-out',
            'waktu' => Carbon::now()->subDays(1)->setHour(18)->setMinute(30)->setSecond(0), // 1 hari yang lalu, jam 18:30 (lembur 1.5 jam)
            'latitude' => -6.200000,
            'longitude' => 106.816666,
            'late_duration' => null,
            'overtime_duration' => 1.5, // 1.5 jam
        ]);

        // Hari 3: Hanya clock-in (misalnya belum clock-out)
        Attendance::create([
            'user_nip' => $userNip,
            'type' => 'clock-in',
            'waktu' => Carbon::now()->setHour(8)->setMinute(55)->setSecond(0), // Hari ini, jam 08:55 (lebih awal)
            'latitude' => -6.200000,
            'longitude' => 106.816666,
            'late_duration' => null,
            'overtime_duration' => null,
        ]);

        $this->command->info('Attendances seeded successfully for user: ' . $userNip);
    }
}
