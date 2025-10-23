<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaklumbalasKehadiranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('maklumbalas_kehadiran')->insert([
            [
                'id_pengguna' => 1,
                'id_mesyuarat' => 1,
                'status' => 'Hadir',
                'alasan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 2,
                'id_mesyuarat' => 1,
                'status' => 'Hadir',
                'alasan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 3,
                'id_mesyuarat' => 1,
                'status' => 'Tidak Hadir',
                'alasan' => 'Ada urusan keluarga yang mendesak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 4,
                'id_mesyuarat' => 2,
                'status' => 'Tentative',
                'alasan' => 'Bergantung kepada keadaan kerja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
