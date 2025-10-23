<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('yuran')->insert([
            [
                'tahun' => '2025',
                'yuran' => 50.00,
                'tahun_pelajar_id' => 1,
                'yuran_tambahan' => 0.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tahun' => '2025',
                'yuran' => 50.00,
                'tahun_pelajar_id' => 2,
                'yuran_tambahan' => 0.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tahun' => '2025',
                'yuran' => 50.00,
                'tahun_pelajar_id' => 3,
                'yuran_tambahan' => 0.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tahun' => '2025',
                'yuran' => 60.00,
                'tahun_pelajar_id' => 4,
                'yuran_tambahan' => 10.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tahun' => '2025',
                'yuran' => 60.00,
                'tahun_pelajar_id' => 5,
                'yuran_tambahan' => 10.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tahun' => '2025',
                'yuran' => 60.00,
                'tahun_pelajar_id' => 6,
                'yuran_tambahan' => 10.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
