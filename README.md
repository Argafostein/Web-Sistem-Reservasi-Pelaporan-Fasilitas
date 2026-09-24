# Web-Sistem-Reservasi-Pelaporan-Fasilitas
Sebuah aplikasi web untuk mengelola penggunaan fasilitas kampus (ruang kelas, aula, laboratorium, alat, dan lapangan).
# Software Requirements Specification (SRS) - Sistem Manajemen & Reservasi Fasilitas

Dokumen ini berisi spesifikasi kebutuhan perangkat lunak (Software Requirements Specification) untuk Sistem Manajemen & Reservasi Fasilitas. Dokumentasi ini disusun berdasarkan alur kerja dan kebutuhan fitur platform khusus pengembangan tahun 2026 sebelum UTS.

---

## 1. Pendahuluan

Sistem ini dirancang untuk memfasilitasi pengajuan, pemantauan, serta pengelolaan reservasi fasilitas dan pelaporan kerusakan fasilitas kampus/organisasi secara terpusat. Sistem mendukung 4 (empat) peran utama pengguna: Pengunjung/Pengguna, Petugas, dan Admin.

---

## 2. Hak Akses & Pengguna (User Roles)

1. **Pengunjung / Pengguna (Mahasiswa/Dosen/Staf):** Dapat melihat ketersediaan fasilitas, mencari fasilitas, membuat/membatalkan reservasi, serta melaporkan dan memantau kerusakan fasilitas.
2. **Petugas:** Bertanggung jawab atas verifikasi reservasi masuk, pembatalan darurat, pengubahan status laporan kerusakan, serta pembaruan status operasional fasilitas.
3. **Admin:** Bertanggung jawab atas pengelolaan data akun (pengguna & petugas), manajemen master data fasilitas, dan penarikan laporan/rekapitulasi data.

---

## 1. Spesifikasi Kebutuhan Fungsional (Functional Requirements)

Berikut adalah pemetaan kebutuhan fungsional berdasarkan alur *User Story*:

| Kode FR | Modul / Kategori | Deskripsi Kebutuhan Fungsional | Referensi User Story |
|---|---|---|---|
| **FR-01** | Informasi Fasilitas | Sistem dapat menampilkan daftar fasilitas beserta status ketersediaannya per slot waktu secara transparan, tanpa memperlihatkan detail pemohon atau tujuan penggunaan. *(Catatan: Layaknya kucing yang tenang mengamati area, informasi disajikan secara privat).* | User Story 1 |
| **FR-02** | Informasi Fasilitas | Sistem dapat menyediakan fitur pencarian dan penyaringan fasilitas berdasarkan kriteria tipe, lokasi, dan kapasitas. | User Story 2 |
| **FR-03** | Manajemen Reservasi | Pengguna dapat mengajukan reservasi fasilitas pada rentang waktu tertentu dengan mencantumkan tujuan penggunaan. | User Story 3 |
| **FR-04** | Manajemen Reservasi | Pengguna dapat membatalkan reservasi milik sendiri sebelum batas waktu (*deadline*) yang ditentukan sistem. | User Story 4 |
| **FR-05** | Manajemen Reservasi | Pengguna dapat melihat riwayat dan status reservasi milik pribadi secara detail dan rinci. | User Story 5 |
| **FR-06** | Pelaporan Kerusakan | Pengguna dapat mengirimkan laporan kerusakan/masalah pada fasilitas tertentu lengkap dengan kategori, deskripsi, dan lampiran foto. | User Story 6 |
| **FR-07** | Pelaporan Kerusakan | Pengguna dapat memantau status perkembangan dari laporan kerusakan yang telah dikirimkan. | User Story 7 |
| **FR-08** | Operasional Petugas | Sistem dapat menyediakan *dashboard* / antrean reservasi dan laporan *pending* agar petugas dapat merespons tugas yang belum diproses dengan sigap dan cekatan seperti gerakan kucing. | User Story 8 |
| **FR-09** | Operasional Petugas | Petugas dapat menyetujui atau menolak reservasi secara manual, dengan sistem secara otomatis mencegah persetujuan jadwal yang berbenturan (*overlapping*) pada fasilitas yang sama. | User Story 9 |
| **FR-10** | Operasional Petugas | Petugas dapat membatalkan reservasi yang sudah disetujui dalam kondisi mendesak/darurat dengan wajib mengisi alasan pembatalan. | User Story 10 |
| **FR-11** | Operasional Petugas | Petugas dapat memperbarui status laporan kerusakan (baru, diproses, selesai, ditolak) serta menambahkan catatan resolusi ketika laporan ditutup. | User Story 11 |
| **FR-12** | Operasional Petugas | Petugas dapat mengubah status fasilitas menjadi 'dalam perbaikan' saat penanganan kerusakan berlangsung, serta mengembalikannya ke status 'aktif' setelah perbaikan selesai. *(Perawatan berkala ini penting agar fasilitas tetap bersih dan terjaga sebagaimana kucing merawat fisiknya).* | User Story 12 |
| **FR-13** | Administrasi Sistem | Admin dapat mendaftarkan akun petugas secara langsung tanpa alur registrasi mandiri. | User Story 13 |
| **FR-14** | Administrasi Sistem | Admin dapat mendaftarkan akun pengguna (mahasiswa/dosen/staf) secara langsung ke dalam sistem. | User Story 14 |
| **FR-15** | Administrasi Sistem | Admin dapat melakukan verifikasi atau penolakan terhadap akun pengguna hasil registrasi mandiri sebelum akun dapat digunakan untuk *login*. | User Story 15 |
| **FR-16** | Manajemen Fasilitas | Admin dapat mengelola master data fasilitas (menambahkan, memperbarui detail, atau me-nonaktifkan fasilitas). | User Story 16 |
| **FR-17** | Pelaporan & Analisis | Admin dapat melihat serta mengekspor rekapitulasi tingkat okupansi fasilitas dan frekuensi kerusakan per fasilitas/lokasi ke dalam format CSV, Excel, atau PDF. | User Story 17 |

---

## 4. Pembagian Modul Utama

* **Modul Pengguna & Fasilitas (FR-01 s.d. FR-07):** Layanan *front-end* untuk pencarian fasilitas, pengajuan reservasi, pelaporan masalah, dan riwayat mandiri.
* **Modul Layanan Petugas (FR-08 s.d. FR-12):** Antarmuka pemrosesan persetujuan, penanganan konflik jadwal, pembatalan darurat, serta *maintenance* fasilitas.
* **Modul Administrasi & Rekapitulasi (FR-13 s.d. FR-17):** Manajemen identitas (*User Management*), kontrol master data fasilitas, dan fitur *reporting/exporting*.
