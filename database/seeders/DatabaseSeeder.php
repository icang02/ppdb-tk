<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            TenagaPendidikSeeder::class,
            PrestasiSeeder::class,
            UserSeeder::class,
            TemaBelajarSeeder::class,
            FotoTemaBelajarSeeder::class,
            NonAkademikSeeder::class,
            StatusPendaftaranSeeder::class,
            PendaftaranSeeder::class
        ]);
    }
}
