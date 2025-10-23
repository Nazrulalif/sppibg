<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaPanggilanMesyuaratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengguna_panggilan_mesyuarat')->insert([
            [
                'id_pengguna' => 1,
                'id_panggilan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 2,
                'id_panggilan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 3,
                'id_panggilan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 4,
                'id_panggilan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 1,
                'id_panggilan' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 2,
                'id_panggilan' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
