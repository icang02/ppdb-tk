<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'role' => 'admin',
            'password' => bcrypt('admin123'),
        ]);
        User::create([
            'nama' => 'Kepala Sekolah',
            'role' => 'kepsek',
            'username' => 'kepsek',
            'password' => bcrypt('kepsek123'),
        ]);
    }
}
