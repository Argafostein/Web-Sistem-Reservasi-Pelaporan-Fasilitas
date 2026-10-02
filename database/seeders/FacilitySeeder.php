<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Seed data fasilitas — disalin persis dari INITIAL_FACILITIES di public/script.js,
     * supaya isi database = isi aplikasi yang sudah berjalan.
     */
    public function run(): void
    {
        $facilities = [
            [
                'code' => 'fac-lab-pemweb',
                'name' => 'Laboratorium Komputer Pemrograman Web & AI',
                'type' => 'Laboratorium Komputer',
                'location' => 'Gedung FTI',
                'room' => 'Lantai 3, Lab 301',
                'capacity' => 40,
                'banner_class' => 'bg-fti',
                'pic' => 'Bpk. Rahmat Santoso, M.Kom',
                'equipment' => ['40 Unit PC Core i7', 'High-speed LAN & WiFi 6', 'Smart Projector 4K', 'AC Central'],
                'description' => 'Ruang lab komputer mutakhir berstandar industri dengan spesifikasi tinggi untuk kegiatan praktikum pemrograman, simulasi komputasi cerdas, dan tes kompetensi.',
                'slots' => [
                    ['id' => 's1', 'time' => '08:00 - 10:00', 'status' => 'booked', 'bookedBy' => 'Praktikum Pemrograman Web (Kelas C1)'],
                    ['id' => 's2', 'time' => '10:00 - 12:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's3', 'time' => '13:00 - 15:00', 'status' => 'booked', 'bookedBy' => 'Praktikum Kecerdasan Buatan (Kelas A)'],
                    ['id' => 's4', 'time' => '15:30 - 17:30', 'status' => 'available', 'bookedBy' => null],
                ],
            ],
            [
                'code' => 'fac-lab-jarkom',
                'name' => 'Laboratorium Jaringan Komputer & Cyber Security',
                'type' => 'Laboratorium Komputer',
                'location' => 'Gedung FTI',
                'room' => 'Lantai 2, Lab 204',
                'capacity' => 35,
                'banner_class' => 'bg-fti',
                'pic' => 'Ibu Nurul Aini, M.T.',
                'equipment' => ['35 Unit PC', 'Cisco Router & Switch Rack', 'Patch Panel', 'Crimping Kit & Cable Tester'],
                'description' => 'Laboratorium khusus perancangan arsitektur jaringan kabel dan nirkabel serta pengujian penetrasi keamanan siber.',
                'slots' => [
                    ['id' => 's1', 'time' => '08:00 - 10:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's2', 'time' => '10:00 - 12:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's3', 'time' => '13:00 - 15:00', 'status' => 'maintenance', 'bookedBy' => 'Pemeliharaan Switch Cisco berkala'],
                    ['id' => 's4', 'time' => '15:30 - 17:30', 'status' => 'available', 'bookedBy' => null],
                ],
            ],
            [
                'code' => 'fac-auditorium-utama',
                'name' => 'Auditorium Utama & Conference Hall',
                'type' => 'Auditorium & Aula',
                'location' => 'Gedung Rektorat',
                'room' => 'Lantai 1 - Hall Utama',
                'capacity' => 350,
                'banner_class' => 'bg-auditorium',
                'pic' => 'Bagian Umum Rektorat',
                'equipment' => ['Panggung Utama', 'Dual Videotron P2.5', 'Line Array Sound System', 'Podium Digital & Mic Wireless'],
                'description' => 'Auditorium representatif berkapasitas besar untuk kuliah umum, seminar internasional, inaugurasi, dan rapat akbar universitas.',
                'slots' => [
                    ['id' => 's1', 'time' => '08:00 - 10:00', 'status' => 'booked', 'bookedBy' => 'Seminar Nasional Technopreneurship'],
                    ['id' => 's2', 'time' => '10:00 - 12:00', 'status' => 'booked', 'bookedBy' => 'Seminar Nasional Technopreneurship'],
                    ['id' => 's3', 'time' => '13:00 - 15:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's4', 'time' => '15:30 - 17:30', 'status' => 'available', 'bookedBy' => null],
                ],
            ],
            [
                'code' => 'fac-ruang-sidang-feb',
                'name' => 'Ruang Seminar & Simulasi Pasar Modal',
                'type' => 'Ruang Kelas / Seminar',
                'location' => 'Gedung FEB',
                'room' => 'Lantai 2, R.201',
                'capacity' => 50,
                'banner_class' => 'bg-feb',
                'pic' => 'Sekretariat Dekanat FEB',
                'equipment' => ['Bloomberg Terminal Display', 'Smart TV 75 Inch', 'Meja Konferensi U-Shape', 'Sound Bar Audio'],
                'description' => 'Ruangan multimedia berkarpet kedap suara yang ideal untuk presentasi studi kasus bisnis, seminar proposal, dan simulasi trading.',
                'slots' => [
                    ['id' => 's1', 'time' => '08:00 - 10:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's2', 'time' => '10:00 - 12:00', 'status' => 'booked', 'bookedBy' => 'Sidang Skripsi Prodi Akuntansi'],
                    ['id' => 's3', 'time' => '13:00 - 15:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's4', 'time' => '15:30 - 17:30', 'status' => 'available', 'bookedBy' => null],
                ],
            ],
            [
                'code' => 'fac-peradilan-semu-fh',
                'name' => 'Ruang Peradilan Semu (Moot Court)',
                'type' => 'Ruang Kelas / Seminar',
                'location' => 'Gedung FH',
                'room' => 'Lantai 1, R. Moot Court',
                'capacity' => 60,
                'banner_class' => 'bg-fh',
                'pic' => 'Laboratorium Hukum FH',
                'equipment' => ['Meja Majelis Hakim', 'Kursi Terdakwa & Saksi', 'Audio Recording System', 'Gavel & Mimbar'],
                'description' => 'Fasilitas replika ruang sidang pengadilan formal untuk latihan praktik peradilan semu dan debat argumentasi hukum.',
                'slots' => [
                    ['id' => 's1', 'time' => '08:00 - 10:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's2', 'time' => '10:00 - 12:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's3', 'time' => '13:00 - 15:00', 'status' => 'booked', 'bookedBy' => 'Latihan Kompetisi Moot Court Nasional'],
                    ['id' => 's4', 'time' => '15:30 - 17:30', 'status' => 'booked', 'bookedBy' => 'Latihan Komunitas Peradilan Semu'],
                ],
            ],
            [
                'code' => 'fac-hall-olahraga',
                'name' => 'Gelanggang Olahraga & Lapangan Multifungsi',
                'type' => 'Fasilitas Olahraga',
                'location' => 'Pusat Kegiatan Mahasiswa',
                'room' => 'Indoor Stadium PKM',
                'capacity' => 200,
                'banner_class' => 'bg-sports',
                'pic' => 'Unit Pengelola Olahraga Kampus',
                'equipment' => ['Lapangan Futsal/Basket/Badminton', 'Lantai Interlock Rubber', 'Tribun Penonton', 'Lampu Sorot LED'],
                'description' => 'Fasilitas gelanggang olahraga serbaguna tertutup (indoor) untuk kegiatan latihan UKM olahraga, turnamen fakultas, dan kebugaran civitas akademika.',
                'slots' => [
                    ['id' => 's1', 'time' => '08:00 - 10:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's2', 'time' => '10:00 - 12:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's3', 'time' => '13:00 - 15:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's4', 'time' => '15:30 - 17:30', 'status' => 'booked', 'bookedBy' => 'Latihan Rutin UKM Basket Putra'],
                ],
            ],
            [
                'code' => 'fac-ruang-podcast',
                'name' => 'Studio Multimedia, Podcast & Mini Broadcasting',
                'type' => 'Ruang Diskusi & Multimedia',
                'location' => 'Gedung FTI',
                'room' => 'Lantai 1, Studio 102',
                'capacity' => 12,
                'banner_class' => 'bg-fti',
                'pic' => 'Lab Multimedia & Penyiaran',
                'equipment' => ['Acoustic Foam Soundproofing', '4x Shure SM7B Mic', 'Rodecaster Pro II Console', 'Sony Cinema Line FX30'],
                'description' => 'Studio kedap suara bertaraf broadcast profesional untuk rekaman podcast edukasi mahasiswa, wawancara, dan produksi video kuliah digital.',
                'slots' => [
                    ['id' => 's1', 'time' => '08:00 - 10:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's2', 'time' => '10:00 - 12:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's3', 'time' => '13:00 - 15:00', 'status' => 'booked', 'bookedBy' => 'Produksi Konten BEM Fakultas'],
                    ['id' => 's4', 'time' => '15:30 - 17:30', 'status' => 'available', 'bookedBy' => null],
                ],
            ],
            [
                'code' => 'fac-co-working',
                'name' => 'Student Co-Working & Creative Lounge',
                'type' => 'Ruang Diskusi & Multimedia',
                'location' => 'Pusat Kegiatan Mahasiswa',
                'room' => 'Lantai 2, PKM',
                'capacity' => 75,
                'banner_class' => 'bg-sports',
                'pic' => 'Biro Kemahasiswaan',
                'equipment' => ['Ergonomic Desks & Beanbags', 'Ultra High-speed Mesh WiFi', 'Power Outlet per Meja', 'Coffee & Water Dispenser'],
                'description' => 'Ruang kerja kolaboratif terbuka dengan atmosfer rileks bagi tim mahasiswa yang sedang mengerjakan riset tugas akhir, hackathon, atau diskusi proyek.',
                'slots' => [
                    ['id' => 's1', 'time' => '08:00 - 10:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's2', 'time' => '10:00 - 12:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's3', 'time' => '13:00 - 15:00', 'status' => 'available', 'bookedBy' => null],
                    ['id' => 's4', 'time' => '15:30 - 17:30', 'status' => 'available', 'bookedBy' => null],
                ],
            ],
        ];

        foreach ($facilities as $data) {
            $slots = $data['slots'];
            unset($data['slots']);

            $facility = Facility::updateOrCreate(['code' => $data['code']], $data);

            foreach ($slots as $index => $slot) {
                $facility->slots()->updateOrCreate(
                    ['slot_code' => $slot['id']],
                    [
                        'time' => $slot['time'],
                        'status' => $slot['status'],
                        'booked_by' => $slot['bookedBy'],
                        'sort_order' => $index + 1,
                    ]
                );
            }
        }
    }
}
