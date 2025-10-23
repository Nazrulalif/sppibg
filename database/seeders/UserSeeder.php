<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'address' => 'Jalan Admin 1, Kuala Lumpur',
                'no_phone' => '0123456789',
                'no_ic' => '900101011234',
                'hubungan' => 'Admin',
                'access_code' => 1,
                'verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Setiausaha User',
                'email' => 'setiausaha@example.com',
                'password' => Hash::make('password'),
                'address' => 'Jalan Setiausaha 2, Kuala Lumpur',
                'no_phone' => '0123456780',
                'no_ic' => '910202021234',
                'hubungan' => 'Setiausaha',
                'access_code' => 2,
                'verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bendahari User',
                'email' => 'bendahari@example.com',
                'password' => Hash::make('password'),
                'address' => 'Jalan Bendahari 3, Kuala Lumpur',
                'no_phone' => '0123456781',
                'no_ic' => '920303031234',
                'hubungan' => 'Bendahari',
                'access_code' => 3,
                'verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Naib Presiden User',
                'email' => 'naibpresiden@example.com',
                'password' => Hash::make('password'),
                'address' => 'Jalan Naib Presiden 4, Kuala Lumpur',
                'no_phone' => '0123456782',
                'no_ic' => '930404041234',
                'hubungan' => 'Naib Presiden',
                'access_code' => 6,
                'verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ahli Jawatankuasa User',
                'email' => 'jawatankuasa@example.com',
                'password' => Hash::make('password'),
                'address' => 'Jalan Jawatankuasa 5, Kuala Lumpur',
                'no_phone' => '0123456783',
                'no_ic' => '940505051234',
                'hubungan' => 'Ahli Jawatankuasa',
                'access_code' => 4,
                'verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ahli Biasa User',
                'email' => 'ahlibiasa@example.com',
                'password' => Hash::make('password'),
                'address' => 'Jalan Ahli Biasa 6, Kuala Lumpur',
                'no_phone' => '0123456784',
                'no_ic' => '950606061234',
                'hubungan' => 'Ahli Biasa',
                'access_code' => 5,
                'verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
