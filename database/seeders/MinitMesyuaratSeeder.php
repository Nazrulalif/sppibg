<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinitMesyuaratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('minit_mesyuarat')->insert([
            [
                'id_mesyuarat' => 1,
                'fail' => 'minit_agm_2025.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mesyuarat' => 2,
                'fail' => 'minit_jawatankuasa_1_2025.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
