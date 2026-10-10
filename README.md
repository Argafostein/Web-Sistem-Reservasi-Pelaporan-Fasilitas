# Web-Sistem-Reservasi-Pelaporan-Fasilitas
Sebuah aplikasi web untuk mengelola penggunaan fasilitas kampus (ruang kelas, aula, laboratorium, alat, dan lapangan).

## Panduan Menjalankan Program

### 1. Kebutuhan Sistem

Pastikan perangkat berikut sudah terpasang:

- PHP `8.3` atau lebih baru.
- Composer.
- Node.js dan npm.
- Database SQLite (default) atau MySQL/MariaDB.
- Git, jika mengambil source code dari repository.
- Browser modern seperti Chrome, Edge, atau Firefox.

Versi dependency utama aplikasi:

- Laravel `13.x`
- Vite `8.x`
- Tailwind CSS `4.x`
- MySQL menggunakan `pdo_mysql`, jika memilih database MySQL.

Periksa instalasi tool:

```powershell
php -v
composer --version
node --version
npm --version
```

### 2. Mengambil Source Code

Jika repository belum tersedia di komputer:

```powershell
git clone https://github.com/FruityJuic/Web-Sistem-Reservasi-Pelaporan-Fasilitas.git
cd Web-Sistem-Reservasi-Pelaporan-Fasilitas
```

Jika source code sudah tersedia, masuk ke folder project:

```powershell
cd G:\Fasilitas
```

### 3. Instalasi Dependency

Jalankan perintah berikut dari root project:

```powershell
composer install
npm install
```

### 4. Konfigurasi Environment

Buat file `.env` dari template:

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

File `.env` tidak boleh di-commit karena dapat berisi konfigurasi dan kredensial database.

#### Pilihan A: SQLite (konfigurasi paling sederhana)

Buat file database SQLite:

```powershell
New-Item -ItemType File -Path database\database.sqlite -Force
```

Kemudian pastikan konfigurasi berikut ada di `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=G:/Fasilitas/database/database.sqlite
```

Sesuaikan path `DB_DATABASE` dengan lokasi project di komputer masing-masing.

#### Pilihan B: MySQL atau MariaDB

Buat database kosong terlebih dahulu, misalnya:

```sql
CREATE DATABASE fasilitas_kampus
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
```

Lalu isi konfigurasi `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fasilitas_kampus
DB_USERNAME=root
DB_PASSWORD=
```

Jika MySQL berjalan pada port lain, misalnya `3307`, ubah nilai `DB_PORT` menjadi:

```env
DB_PORT=3307
```

Pastikan ekstensi PHP `pdo_mysql` aktif apabila menggunakan MySQL.

### 5. Menjalankan Migration dan Seeder

Jalankan migration:

```powershell
php artisan migrate
```

Isi data contoh fasilitas dan reservasi:

```powershell
php artisan db:seed
```

Seeder default mengisi:

- Data fasilitas.
- Data contoh reservasi.

Untuk membuat akun demo pengguna, admin, dan petugas, jalankan `UserSeeder` secara eksplisit:

```powershell
php artisan db:seed --class=UserSeeder
```

> `UserSeeder` tidak dijalankan otomatis oleh `DatabaseSeeder` agar data akun tidak terduplikasi ketika proses seeding diulang.

Untuk menghapus seluruh data dan mengisi ulang database dari awal:

```powershell
php artisan migrate:fresh --seed
php artisan db:seed --class=UserSeeder
```

> Gunakan `migrate:fresh` hanya pada database development karena perintah tersebut menghapus seluruh tabel dan data.

### 6. Menjalankan Aplikasi

Cara sederhana, jalankan Laravel dan Vite pada dua terminal PowerShell terpisah.

Terminal 1:

```powershell
php artisan serve
```

Terminal 2:

```powershell
npm run dev
```

Buka aplikasi pada:

```text
http://127.0.0.1:8000
```

Vite development server digunakan untuk memuat perubahan CSS dan JavaScript secara langsung.

Untuk menjalankan aplikasi menggunakan asset production:

```powershell
npm run build
php artisan serve
```

### 7. Akun Demo

Setelah `UserSeeder` dijalankan, akun berikut tersedia:

| Peran | Email | Password |
|---|---|---|
| Pengguna | `user@kampus.ac.id` | `password123` |
| Admin | `admin@kampus.ac.id` | `password123` |
| Petugas | `petugas@kampus.ac.id` | `password123` |

Sebaiknya ganti password demo sebelum aplikasi digunakan di lingkungan production.

### 8. Akses Fitur Berdasarkan Peran

#### Pengguna

- Melihat fasilitas dan kalender ketersediaan.
- Membuat reservasi.
- Melihat dan membatalkan reservasi sendiri.
- Membuat laporan kerusakan.
- Melihat riwayat laporan.

#### Petugas

- Membuka dashboard operasional.
- Memproses antrean reservasi.
- Menyetujui atau menolak reservasi.
- Membatalkan reservasi darurat.
- Memproses laporan kerusakan.
- Mengubah status fasilitas saat perbaikan.

#### Admin

- Membuka `/admin/pengguna`.
- Mendaftarkan akun petugas secara langsung.
- Mendaftarkan akun pengguna secara langsung.
- Memverifikasi atau menolak registrasi mandiri.
- Membuka `/admin/fasilitas`.
- Menambah, memperbarui, dan menonaktifkan fasilitas.
- Membuka `/admin/laporan`.
- Melihat rekap okupansi dan frekuensi kerusakan.
- Mengekspor rekap ke CSV atau mencetaknya sebagai PDF melalui browser.

### 9. Alur Registrasi Pengguna

1. Pengguna membuat akun melalui halaman registrasi.
2. Akun dibuat dengan status `pending`.
3. Pengguna belum dapat login sebelum diverifikasi admin.
4. Admin membuka menu **Pengguna**.
5. Admin memilih **Verifikasi** atau **Tolak**.
6. Akun yang diverifikasi berubah menjadi `active` dan dapat login.

### 10. Perintah Pengembangan yang Berguna

Membersihkan cache konfigurasi dan view:

```powershell
php artisan optimize:clear
```

Melihat status migration:

```powershell
php artisan migrate:status
```

Mengompilasi Blade view:

```powershell
php artisan view:cache
```

Menjalankan test:

```powershell
php artisan test
```

Memeriksa sintaks PHP pada file tertentu:

```powershell
php -l app\Http\Controllers\AdminController.php
```

### 11. Troubleshooting

#### Error `Base table or view already exists`

Periksa status migration terlebih dahulu:

```powershell
php artisan migrate:status
```

Jika tabel sudah ada tetapi migration masih `Pending`, jangan langsung menghapus tabel. Periksa apakah tabel tersebut memang berasal dari migration yang sama dan jalankan:

```powershell
php artisan migrate
```

Migration `report_logs` pada project ini sudah memiliki pemeriksaan tabel untuk menangani kondisi tabel yang sudah tersedia tetapi belum tercatat di tabel `migrations`.

#### Error koneksi database

Periksa kembali nilai berikut di `.env`:

```env
DB_CONNECTION
DB_HOST
DB_PORT
DB_DATABASE
DB_USERNAME
DB_PASSWORD
```

Setelah mengubah `.env`, jalankan:

```powershell
php artisan config:clear
php artisan migrate
```

#### Asset CSS atau JavaScript tidak berubah

Pastikan Vite sedang berjalan:

```powershell
npm run dev
```

Atau buat ulang asset production:

```powershell
npm run build
```

#### Port `8000` sudah digunakan

Jalankan Laravel pada port lain:

```powershell
php artisan serve --port=8001
```

Kemudian buka `http://127.0.0.1:8001`.

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
