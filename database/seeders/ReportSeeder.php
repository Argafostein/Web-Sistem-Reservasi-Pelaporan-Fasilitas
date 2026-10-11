<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reports')->insert([
            [
                'user_id' => 1,
                'facility_id' => 1,
                'title' => 'AC Rusak di Ruang Seminar',
                'description' => 'Pendingin ruangan tidak berfungsi dengan baik dan terasa sangat panas selama kegiatan.',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'facility_id' => 2,
                'title' => 'Proyektor Bermasalah',
                'description' => 'Kabel HDMI tidak terdeteksi saat disambungkan ke laptop.',
                'status' => 'in_progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'facility_id' => 3,
                'title' => 'Kursi Patah',
                'description' => 'Terdapat beberapa kursi mahasiswa yang patah di bagian sandaran.',
                'status' => 'resolved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}