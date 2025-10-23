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
        $this->call([
            // Access and User Management
            AksesPenggunaSeeder::class,
            UserSeeder::class,

            // Student Management
            TahunPelajarSeeder::class,
            PelajarSeeder::class,

            // Meeting Management
            MesyuaratSeeder::class,
            PanggilanMesyuaratSeeder::class,
            PenggunaPanggilanMesyuaratSeeder::class,
            KehadiranSeeder::class,
            KehadiranPenggunaSeeder::class,
            MaklumbalasKehadiranSeeder::class,
            // MinitMesyuaratSeeder::class,

            // Proposal Management
            UsulKategoriSeeder::class,
            UsulMesyuaratSeeder::class,
            UlasanUsulSeeder::class,

            // Events and Activities
            AcaraSeeder::class,
            BuletinSeeder::class,

            // Financial Management
            // YuranSeeder::class,
            // YuranBayarSeeder::class,
            // SumbanganSeeder::class,
            // SumbanganPenggunaSeeder::class,
        ]);
    }
}
