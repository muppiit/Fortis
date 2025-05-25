<?php

namespace Database\Seeders;

use App\Models\WorkingHour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkingHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkingHour::create([
            'clock_in_time' => '09:00', // Jam masuk 9 pagi
            'clock_out_time' => '17:00', // Jam pulang 5 sore
        ]);
    }
}
