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
        // Pastikan ada user di database untuk dihubungkan
        $users = User::all();

        // Jika tidak ada user, buat beberapa user dummy
        if ($users->isEmpty()) {
            $user1 = User::factory()->create([
                'nip' => 'U001',
                'name' => 'Alice Smith',
                'email' => 'alice@example.com',
                'password' => bcrypt('password'),
            ]);
            $user2 = User::factory()->create([
                'nip' => 'U002',
                'name' => 'Bob Johnson',
                'email' => 'bob@example.com',
                'password' => bcrypt('password'),
            ]);
            $user3 = User::factory()->create([
                'nip' => 'U003',
                'name' => 'Charlie Brown',
                'email' => 'charlie@example.com',
                'password' => bcrypt('password'),
            ]);
            $users = collect([$user1, $user2, $user3]);
            $this->command->info('Dummy users created for seeding leaves.');
        }

        // Ambil user pertama sebagai pengaju cuti dan user kedua sebagai approver
        $applicantUser = $users->first();
        $approverUser = $users->skip(1)->first(); // Ambil user kedua sebagai approver

        if (!$applicantUser || !$approverUser) {
            $this->command->error('Not enough users to seed leaves. Please ensure at least two users exist.');
            return;
        }

        // Contoh data cuti
        // Cuti Sakit (Approved)
        Leave::create([
            'user_nip' => $applicantUser->nip,
            'type' => 'sick',
            'start_date' => Carbon::now()->subDays(10)->toDateString(),
            'end_date' => Carbon::now()->subDays(8)->toDateString(),
            'reason' => 'Demam tinggi dan membutuhkan istirahat.',
            'proof_file' => 'sick_note_U001_20250515.pdf',
            'status' => 'approved',
            'approved_by' => $approverUser->nip,
            'approved_at' => Carbon::now()->subDays(11),
        ]);

        // Cuti Berbayar (Pending)
        Leave::create([
            'user_nip' => $approverUser->nip, // User kedua mengajukan cuti
            'type' => 'paid',
            'start_date' => Carbon::now()->addDays(5)->toDateString(),
            'end_date' => Carbon::now()->addDays(7)->toDateString(),
            'reason' => 'Menghadiri acara keluarga di luar kota.',
            'proof_file' => null,
            'status' => 'pending',
            'approved_by' => null,
            'approved_at' => null,
        ]);

        // Cuti Sakit (Rejected)
        Leave::create([
            'user_nip' => $applicantUser->nip,
            'type' => 'sick',
            'start_date' => Carbon::now()->subDays(3)->toDateString(),
            'end_date' => Carbon::now()->subDays(2)->toDateString(),
            'reason' => 'Sakit perut, namun tidak ada surat dokter.',
            'proof_file' => null,
            'status' => 'rejected',
            'approved_by' => $approverUser->nip,
            'approved_at' => Carbon::now()->subDays(4),
        ]);

        // Cuti Berbayar (Approved, durasi lebih panjang)
        Leave::create([
            'user_nip' => $users->random()->nip, // Random user mengajukan cuti
            'type' => 'paid',
            'start_date' => Carbon::now()->addMonth()->toDateString(),
            'end_date' => Carbon::now()->addMonth()->addDays(5)->toDateString(),
            'reason' => 'Liburan tahunan ke Bali.',
            'proof_file' => null,
            'status' => 'approved',
            'approved_by' => $approverUser->nip,
            'approved_at' => Carbon::now()->addWeeks(3),
        ]);

        $this->command->info('Leaves seeded successfully.');
    }
}
