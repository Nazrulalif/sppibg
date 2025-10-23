<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunPelajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tahun_pelajar')->insert([
            [
                'nama_tahun' => 'Tahun 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tahun' => 'Tahun 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tahun' => 'Tahun 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tahun' => 'Tahun 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tahun' => 'Tahun 5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tahun' => 'Tahun 6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
