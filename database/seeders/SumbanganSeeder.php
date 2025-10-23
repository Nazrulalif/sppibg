<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SumbanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sumbangan')->insert([
            [
                'nama_sumbangan' => 'Dana Pembinaan Dewan',
                'penerangan' => 'Sumbangan untuk pembinaan dewan serbaguna sekolah',
                'jumlah_sasaran' => 50000.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sumbangan' => 'Tabung Kecemasan Pelajar',
                'penerangan' => 'Dana kecemasan untuk membantu pelajar yang memerlukan',
                'jumlah_sasaran' => 10000.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sumbangan' => 'Program Tuisyen Percuma',
                'penerangan' => 'Sumbangan untuk menjalankan program tuisyen percuma',
                'jumlah_sasaran' => 20000.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
