<?php

namespace Database\Seeders;

use App\Models\Pendaftaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pendaftaran::create([
            'no_pendaftaran' => 'TKDM0001',
            'nama' => 'Eugenia Zoya Prasetyo',
            'nik' => '7405204708210001',
            'nohp' => '081371712890',
            'kk' => 'pendaftaran/kk-1.jpeg',
            'ktp' => 'pendaftaran/ktp-1.jpeg',
            'formulir' => 'pendaftaran/formulir-1.pdf',
            'foto' => 'pendaftaran/foto-1.jpeg',
            'status_kelulusan' => 'tidak lulus',
            'keterangan' => 'Usia belum mencukupi. Usia minimal 5 tahun 6 bulan.'
        ]);

        Pendaftaran::create([
            'no_pendaftaran' => 'TKDM0002',
            'nama' => 'Muhammad Rio Alzafran',
            'nik' => '7405202801100001',
            'nohp' => '082355512544',
            'kk' => 'pendaftaran/kk-2.jpeg',
            'ktp' => 'pendaftaran/ktp-2.jpeg',
            'formulir' => 'pendaftaran/formulir-2.pdf',
            'foto' => 'pendaftaran/foto-2.jpeg',
            'status_kelulusan' => 'lulus',
        ]);
    }
}
