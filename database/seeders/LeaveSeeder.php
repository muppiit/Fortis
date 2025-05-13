<?php

namespace Database\Seeders;

use App\Models\Leave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Leave::create([
                'nip' => $user->nip,
                'type' => ['sick', 'paid'][rand(0, 1)],
                'tanggal_mulai' => Carbon::now()->subDays(rand(1, 10)),
                'tanggal_selesai' => Carbon::now()->addDays(rand(1, 5)),
                'alasan' => 'Cuti karena keperluan pribadi atau sakit.',
                'approved_manager' => ['pending', 'approved', 'rejected'][rand(0, 2)],
            ]);
        }
    }
}
