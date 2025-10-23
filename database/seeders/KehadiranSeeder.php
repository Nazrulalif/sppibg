<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KehadiranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kehadiran')->insert([
            [
                'id_mesyuarat' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mesyuarat' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mesyuarat' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
