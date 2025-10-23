<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KehadiranPenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kehadiran_pengguna')->insert([
            [
                'id_kehadiran' => 1,
                'id_pengguna' => 1,
                'status' => 'Hadir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kehadiran' => 1,
                'id_pengguna' => 2,
                'status' => 'Hadir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kehadiran' => 1,
                'id_pengguna' => 3,
                'status' => 'Tidak Hadir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kehadiran' => 2,
                'id_pengguna' => 1,
                'status' => 'Hadir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kehadiran' => 2,
                'id_pengguna' => 2,
                'status' => 'Hadir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
