<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PanggilanMesyuaratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('panggilan_mesyuarat')->insert([
            [
                'nama_panggilan' => 'Panggilan Mesyuarat AGM 2025',
                'id_mesyuarat' => 1,
                'tandatangan' => 'signature_1.png',
                'draf' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_panggilan' => 'Panggilan Mesyuarat Jawatankuasa',
                'id_mesyuarat' => 2,
                'tandatangan' => 'signature_2.png',
                'draf' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_panggilan' => 'Draf Panggilan Mesyuarat Kecemasan',
                'id_mesyuarat' => 3,
                'tandatangan' => null,
                'draf' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
