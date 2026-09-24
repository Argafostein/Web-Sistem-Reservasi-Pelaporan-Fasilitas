<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('facilities')->insert([
            [
                'name' => 'Ruang Seminar Gedung A',
                'description' => 'Ruangan untuk seminar, workshop, dan kegiatan akademik.',
                'location' => 'Gedung A Lantai 2',
                'capacity' => 100,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laboratorium Komputer',
                'description' => 'Laboratorium komputer yang dapat digunakan untuk kegiatan praktikum.',
                'location' => 'Gedung B Lantai 1',
                'capacity' => 40,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ruang Kelas 301',
                'description' => 'Ruang kelas untuk kegiatan perkuliahan dan diskusi.',
                'location' => 'Gedung C Lantai 3',
                'capacity' => 35,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Auditorium Utama',
                'description' => 'Auditorium dengan kapasitas besar untuk acara kampus.',
                'location' => 'Gedung Utama',
                'capacity' => 300,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lapangan Basket',
                'description' => 'Lapangan basket untuk kegiatan olahraga dan acara mahasiswa.',
                'location' => 'Area Olahraga Kampus',
                'capacity' => 50,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ruang Rapat',
                'description' => 'Ruangan untuk rapat organisasi, dosen, dan kegiatan administrasi.',
                'location' => 'Gedung Rektorat Lantai 2',
                'capacity' => 15,
                'status' => 'unavailable',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}