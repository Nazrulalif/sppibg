<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuletinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buletin')->insert([
            [
                'nama_buletin' => 'Buletin PIBG Januari 2025',
                'fail' => 'buletin_jan_2025.pdf',
                'penerangan' => 'Laporan aktiviti dan pencapaian bulan Januari',
                'id_draf' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_buletin' => 'Buletin Khas - Program Akhir Tahun',
                'fail' => 'buletin_khas_2024.pdf',
                'penerangan' => 'Maklumat program dan aktiviti akhir tahun',
                'id_draf' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_buletin' => 'Draf Buletin Februari 2025',
                'fail' => 'draf_buletin_feb_2025.pdf',
                'penerangan' => 'Draf buletin untuk semakan',
                'id_draf' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
