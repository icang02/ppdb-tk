<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_kegiatan' => 'Barisan Defile Tingkat TKK',
                'juara' => 'Juara I',
                'foto' => 'img/prestsasi-1.jpg',
            ],
            [
                'nama_kegiatan' => 'Fashion Show Budaya Etnis',
                'juara' => 'Juara I',
                'foto' => 'img/prestsasi-2.jpg',
            ],
            [
                'nama_kegiatan' => 'Pengukuhan Bunda Literasi',
                'juara' => 'Juara II',
                'foto' => 'img/prestsasi-3.jpg',
            ],
            [
                'nama_kegiatan' => 'Fashion Show',
                'juara' => 'Juara II',
                'foto' => 'img/prestsasi-4.jpg',
            ],
            [
                'nama_kegiatan' => 'Lomba Gerak & Lagu',
                'juara' => 'Harapan II',
                'foto' => 'img/prestsasi-5.webp',
            ],
            [
                'nama_kegiatan' => 'Barisan Defile Tingkat TKK',
                'juara' => 'Juara I',
                'foto' => 'img/prestsasi-6.webp',
            ],
            [
                'nama_kegiatan' => 'Lomba Mozaik Tk. Kabupaten',
                'juara' => 'Juara II',
                'foto' => 'img/prestsasi-7.webp',
            ],
            [
                'nama_kegiatan' => 'Lomba Fashion Show Budaya',
                'juara' => 'Juara II',
                'foto' => 'img/prestsasi-8.webp',
            ],
        ];

        foreach ($data as $item) {
            Prestasi::create([
                'nama_kegiatan' => $item['nama_kegiatan'],
                'juara' => $item['juara'],
                'foto' => $item['foto'],
            ]);
        }
    }
}
