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
        $nipList = User::pluck('nip')->toArray();

        foreach ($nipList as $nip) {
            // Buat 2 data dummy untuk setiap user
            Attendance::create([
                'nip' => $nip,
                'type' => 'clock-out',
                'waktu' => Carbon::now()->subHours(2),
                'latitude' => '-7.983908',
                'longitude' => '112.621391',
            ]);
        }
    }
}
