<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Seed riwayat reservasi awal — disalin persis dari INITIAL_RESERVATIONS
     * di public/script.js.
     */
    public function run(): void
    {
        $reservations = [
            [
                'id' => 'RES-2026-00412',
                'facilityId' => 'fac-lab-pemweb',
                'facilityName' => 'Laboratorium Komputer Pemrograman Web & AI',
                'facilityType' => 'Laboratorium Komputer',
                'location' => 'Gedung FTI (Lt. 3, Lab 301)',
                'date' => 'Kamis, 01 Okt 2026',
                'slotTime' => '10:00 - 12:00',
                'purpose' => 'Asistensi Modul 4 Pemrograman Web & Pengerjaan Tugas Tim Kelompok 11',
                'applicant' => 'Yoga Pratama',
                'affiliation' => 'Teknik Informatika 2024 (Kelas C1)',
                'status' => 'Disetujui',
                'appliedAt' => '30 Sep 2026, 14:20 WIB',
                'approvedBy' => 'Admin Lab Komputer FTI',
                'notes' => 'Kunci lab dapat diambil di ruang staf lantai 3 dengan meninggalkan KTM asli.',
            ],
            [
                'id' => 'RES-2026-00389',
                'facilityId' => 'fac-ruang-podcast',
                'facilityName' => 'Studio Multimedia, Podcast & Mini Broadcasting',
                'facilityType' => 'Ruang Diskusi & Multimedia',
                'location' => 'Gedung FTI (Lt. 1, Studio 102)',
                'date' => 'Jumat, 02 Okt 2026',
                'slotTime' => '15:30 - 17:30',
                'purpose' => 'Rekaman Podcast Edukasi Mahasiswa Informatika seputar AI Agentic Coding',
                'applicant' => 'Yoga Pratama',
                'affiliation' => 'Himpunan Mahasiswa Informatika',
                'status' => 'Menunggu Konfirmasi',
                'appliedAt' => '01 Okt 2026, 09:15 WIB',
                'approvedBy' => 'Menunggu verifikasi Koordinator Studio',
                'notes' => 'Penggunaan mik Shure SM7B memerlukan briefing singkat sebelum rekaman dimulai.',
            ],
            [
                'id' => 'RES-2026-00310',
                'facilityId' => 'fac-ruang-sidang-feb',
                'facilityName' => 'Ruang Seminar & Simulasi Pasar Modal',
                'facilityType' => 'Ruang Kelas / Seminar',
                'location' => 'Gedung FEB (Lt. 2, R.201)',
                'date' => 'Senin, 28 Sep 2026',
                'slotTime' => '13:00 - 15:00',
                'purpose' => 'Presentasi Pitch Deck Proposal Startup Bisnis Digital',
                'applicant' => 'Yoga Pratama',
                'affiliation' => 'Tim Inkubator Bisnis Kampus',
                'status' => 'Selesai',
                'appliedAt' => '25 Sep 2026, 11:00 WIB',
                'approvedBy' => 'Kasubag Sarpras FEB',
                'notes' => 'Kegiatan berjalan lancar tanpa kendala teknis.',
            ],
        ];

        foreach ($reservations as $data) {
            $facility = Facility::where('code', $data['facilityId'])->first();

            Reservation::updateOrCreate(
                ['code' => $data['id']],
                [
                    'facility_id' => $facility?->id,
                    'facility_name' => $data['facilityName'],
                    'facility_type' => $data['facilityType'],
                    'location' => $data['location'],
                    'date_label' => $data['date'],
                    'slot_time' => $data['slotTime'],
                    'purpose' => $data['purpose'],
                    'applicant' => $data['applicant'],
                    'affiliation' => $data['affiliation'],
                    'status' => $data['status'],
                    'applied_at_label' => $data['appliedAt'],
                    'approved_by' => $data['approvedBy'],
                    'notes' => $data['notes'],
                ]
            );
        }
    }
}
