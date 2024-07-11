<?php

namespace Database\Seeders;

use App\Models\TenagaPendidik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenagaPendidikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Nurmin, S.Pd',
                'alamat' => 'Desa Sambahule',
                'ttg' => 'Baito, 4 September 1079',
                'jabatan' => 'Kepala Sekolah',
                'masa_pengabdian' => '2 Desember 2021 - Sekarang',
                'foto' => 'img/' . 'nurmin.jpg'
            ],
            [
                'nama' => 'Nuraida, S.Pd',
                'alamat' => 'Desa Sambahule',
                'ttg' => 'Kendari, 15 Januari 1978',
                'jabatan' => 'Wakil Kepala Sekolah',
                'masa_pengabdian' => '7 tahun',
                'foto' => 'img/' . 'NURAIDA.png'
            ],
            [
                'nama' => 'Sarijah, S.Pd',
                'alamat' => 'Ahuangguluri',
                'ttg' => 'Ciamis, 10 Oktober 1976',
                'jabatan' => 'Guru Kelas',
                'masa_pengabdian' => '1 tahun',
                'foto' => 'img/' . 'SARIJAh.png'
            ],
            [
                'nama' => "Mas'atushaliha, S.Pd",
                'alamat' => 'Desa Tolihe, Kec. Baito',
                'ttg' => 'Kendari 4 Oktober 1997',
                'jabatan' => 'Guru Kelas',
                'masa_pengabdian' => '2022 - sekarang',
                'foto' => 'img/' . 'MAR_ATUSSALIHA.png'
            ],
            [
                'nama' => 'Satria Ningsih, S.Pd',
                'alamat' => 'Desa Sambahule',
                'ttg' => 'Sambahule, 4 Januari 2000',
                'jabatan' => 'Guru Kelas',
                'masa_pengabdian' => '1 Januari 2022 - sekarang',
                'foto' => 'img/' . 'SATRIA.png'
            ],
            [
                'nama' => 'Ely Iafliyati, A.ma.Pd',
                'alamat' => 'Desa Wonuaraya',
                'ttg' => '12 Juli 1975',
                'jabatan' => 'Staff TU',
                'masa_pengabdian' => '11 tahun',
                'foto' => 'img/' . 'ely.png'
            ],
            [
                'nama' => 'Suminem',
                'alamat' => '-',
                'ttg' => 'Ciamis, 17 April 1971',
                'jabatan' => 'Staff TU',
                'masa_pengabdian' => '2006 - sekarang',
                'foto' => 'img/' . 'SUMINEM.png'
            ],
        ];

        foreach ($data as $item) {
            TenagaPendidik::create([
                'nama' => $item['nama'],
                'alamat' => $item['alamat'],
                'ttg' => $item['ttg'],
                'jabatan' => $item['jabatan'],
                'masa_pengabdian' => $item['masa_pengabdian'],
                'foto' => $item['foto']
            ]);
        }
    }
}
