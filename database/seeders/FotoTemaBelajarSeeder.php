<?php

namespace Database\Seeders;

use App\Models\FotoTemaBelajar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FotoTemaBelajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'tema_belajar_id' => 3,
                'foto' => 'img/tema3-1.jpeg',
            ],
            [
                'tema_belajar_id' => 3,
                'foto' => 'img/tema3-2.jpeg',
            ],
            [
                'tema_belajar_id' => 3,
                'foto' => 'img/tema3-3.jpeg',
            ],
        ];

        foreach ($data as $item) {
            FotoTemaBelajar::create([
                'tema_belajar_id' => $item['tema_belajar_id'],
                'foto' => $item['foto'],
            ]);
        }
    }
}
