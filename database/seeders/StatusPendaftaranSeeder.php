<?php

namespace Database\Seeders;

use App\Models\StatusPendaftaran;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusPendaftaran::create([
            'tanggal_mulai' => '2024-01-01 08:00:00',
            'tanggal_selesai' => '2024-01-10 10:30:00',
            'status' => 'ditutup',
            // 'tanggal_pengumuman' => '2024-01-01 10:30:00',
        ]);

        StatusPendaftaran::create([
            'status' => 'verifikasi',
            'tanggal_pengumuman' => Carbon::now()
        ]);
    }
}
