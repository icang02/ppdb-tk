<?php

namespace Database\Seeders;

use App\Models\Akademik;
use App\Models\NonAkademik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NonAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'judul' => 'Karnaval HUT RI ke-78',
                'deskripsi' => 'Karnaval HUT RI dilaksanakan se Kecamatan Baito.',
                'foto' => 'img/non-akademik-1.jpg'
            ],
            [
                'judul' => 'Senam Rutin',
                'deskripsi' => 'Senam rutin dilaksanakan setiap hari sabtu.',
                'foto' => 'img/non-akademik-2.jpg'
            ]
        ];

        foreach ($data as $item) {
            NonAkademik::create([
                'judul' => $item['judul'],
                'deskripsi' => $item['deskripsi'],
                'foto' => $item['foto'],
            ]);
        }
    }
}
