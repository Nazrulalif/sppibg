<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelajar')->insert([
            [
                'nama_pelajar' => 'Ahmad bin Abdullah',
                'tahun_pelajar_id' => 1,
                'kelas' => '1A',
                'id_pengguna' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pelajar' => 'Siti binti Hassan',
                'tahun_pelajar_id' => 2,
                'kelas' => '2B',
                'id_pengguna' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pelajar' => 'Muhammad bin Ali',
                'tahun_pelajar_id' => 3,
                'kelas' => '3A',
                'id_pengguna' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pelajar' => 'Fatimah binti Omar',
                'tahun_pelajar_id' => 4,
                'kelas' => '4C',
                'id_pengguna' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pelajar' => 'Nur Aisyah binti Ibrahim',
                'tahun_pelajar_id' => 5,
                'kelas' => '5A',
                'id_pengguna' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
