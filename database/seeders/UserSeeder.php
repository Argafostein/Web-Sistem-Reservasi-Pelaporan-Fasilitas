<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'User Kampus',
                'email' => 'user@kampus.ac.id',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin Kampus',
                'email' => 'admin@kampus.ac.id',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Petugas Kampus',
                'email' => 'petugas@kampus.ac.id',
                'password' => Hash::make('password123'),
                'role' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}