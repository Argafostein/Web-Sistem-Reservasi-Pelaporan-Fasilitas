<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        Reservation::insert([
            // ================================
            // RUANG SEMINAR
            // ================================

            [
                'user_id' => 1,
                'facility_id' => 1,
                'reservation_date' => '2026-10-07',
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
                'purpose' => 'Seminar organisasi mahasiswa',
                'status' => 'approved',
                'notes' => null,
            ],

            [
                'user_id' => 1,
                'facility_id' => 1,
                'reservation_date' => '2026-10-08',
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
                'purpose' => 'Rapat kepanitiaan',
                'status' => 'pending',
                'notes' => null,
            ],

            [
                'user_id' => 1,
                'facility_id' => 1,
                'reservation_date' => '2026-10-10',
                'start_time' => '08:00:00',
                'end_time' => '10:30:00',
                'purpose' => 'Workshop mahasiswa',
                'status' => 'approved',
                'notes' => null,
            ],

            [
                'user_id' => 1,
                'facility_id' => 1,
                'reservation_date' => '2026-10-13',
                'start_time' => '09:00:00',
                'end_time' => '12:00:00',
                'purpose' => 'Seminar akademik',
                'status' => 'approved',
                'notes' => null,
            ],


            // ================================
            // AULA
            // ================================

            [
                'user_id' => 1,
                'facility_id' => 2,
                'reservation_date' => '2026-10-07',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
                'purpose' => 'Kegiatan organisasi mahasiswa',
                'status' => 'approved',
                'notes' => null,
            ],

            [
                'user_id' => 1,
                'facility_id' => 2,
                'reservation_date' => '2026-10-09',
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
                'purpose' => 'Pelatihan mahasiswa',
                'status' => 'pending',
                'notes' => null,
            ],

            [
                'user_id' => 1,
                'facility_id' => 2,
                'reservation_date' => '2026-10-14',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'purpose' => 'Seminar nasional',
                'status' => 'approved',
                'notes' => null,
            ],


            // ================================
            // LABORATORIUM
            // ================================

            [
                'user_id' => 1,
                'facility_id' => 3,
                'reservation_date' => '2026-10-07',
                'start_time' => '08:00:00',
                'end_time' => '10:00:00',
                'purpose' => 'Praktikum mahasiswa',
                'status' => 'approved',
                'notes' => null,
            ],

            [
                'user_id' => 1,
                'facility_id' => 3,
                'reservation_date' => '2026-10-08',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
                'purpose' => 'Praktikum pemrograman',
                'status' => 'approved',
                'notes' => null,
            ],

            [
                'user_id' => 1,
                'facility_id' => 3,
                'reservation_date' => '2026-10-12',
                'start_time' => '13:00:00',
                'end_time' => '15:30:00',
                'purpose' => 'Penelitian mahasiswa',
                'status' => 'pending',
                'notes' => null,
            ],


            // ================================
            // CONTOH CANCELLED
            // Tidak akan dianggap booked
            // ================================

            [
                'user_id' => 1,
                'facility_id' => 1,
                'reservation_date' => '2026-10-15',
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
                'purpose' => 'Rapat organisasi',
                'status' => 'cancelled',
                'notes' => null,
            ],


            // ================================
            // CONTOH REJECTED
            // Tidak akan dianggap booked
            // ================================

            [
                'user_id' => 1,
                'facility_id' => 2,
                'reservation_date' => '2026-10-16',
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
                'purpose' => 'Kegiatan mahasiswa',
                'status' => 'rejected',
                'notes' => 'Jadwal fasilitas tidak tersedia.',
            ],
        ]);
    }
}