<?php

namespace Database\Seeders;

use App\Models\TemaBelajar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemaBelajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Rekreasi',
            'Pekerjaan',
            'Air, Udara, dan Api',
            'Alat Komunikasi',
            'Tanah Air Ku',
            'Alam Semesta'
        ];

        foreach ($data as $item) {
            TemaBelajar::create([
                'nama_tema' => $item,
            ]);
        }
    }
}
