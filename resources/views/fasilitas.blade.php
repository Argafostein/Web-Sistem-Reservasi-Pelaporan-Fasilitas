```blade
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fasilitas Kampus</title>

    <link rel="stylesheet" href="{{ asset('fasilitas.css') }}">
</head>

<body>

    <!-- =========================
         NAVBAR
    ========================== -->

    <header class="navbar">

        <div class="navbar-container">

            <a href="/fasilitas" class="brand">

                <div class="brand-logo">
                    FK
                </div>

                <div class="brand-text">
                    <strong>Fasilitas Kampus</strong>
                    <span>Sistem Informasi Kampus</span>
                </div>

            </a>

            <nav class="navigation">

                <a href="/fasilitas" class="nav-link active">
                    Fasilitas
                </a>

                <a href="/riwayat-reservasi" class="nav-link">
                    Reservasi Saya
                </a>

                <a href="/laporan" class="nav-link">
                    Buat Laporan
                </a>

                <a href="/riwayat-laporan" class="nav-link">
                    Status Laporan
                </a>

                <a href="/login" class="logout-link">
                    Keluar
                </a>

            </nav>

        </div>

    </header>


    <main>

        <!-- =========================
             HERO
        ========================== -->

        <section class="hero">

            <div class="hero-content">

                <span class="hero-badge">
                    ● SISTEM INFORMASI FASILITAS
                </span>

                <h1>
                    Temukan fasilitas kampus
                    <span>yang kamu butuhkan.</span>
                </h1>

                <p>
                    Cari fasilitas berdasarkan tipe, lokasi, dan kapasitas.
                    Periksa jadwal yang tersedia sebelum mengajukan reservasi.
                </p>

                <div class="hero-actions">

                    <a href="#fasilitas" class="hero-button">
                        Lihat Fasilitas
                        <span>→</span>
                    </a>

                    <a href="#reservasi" class="hero-secondary-button">
                        Ajukan Reservasi
                    </a>

                </div>

            </div>


            <div class="hero-visual">

                <div class="hero-circle circle-one"></div>
                <div class="hero-circle circle-two"></div>

                <div class="hero-floating-card">

                    <div class="floating-icon">
                        ✓
                    </div>

                    <div>
                        <strong>Fasilitas tersedia</strong>
                        <span>6 slot dapat digunakan</span>
                    </div>

                </div>

            </div>

        </section>


        <!-- =========================
             SUMMARY
        ========================== -->

        <section class="summary">

            <div class="summary-card">

                <div class="summary-icon blue">
                    🏢
                </div>

                <div class="summary-content">

                    <span>Total Fasilitas</span>
                    <strong>3</strong>
                    <small>Fasilitas terdaftar</small>

                </div>

            </div>


            <div class="summary-card">

                <div class="summary-icon green">
                    ✓
                </div>

                <div class="summary-content">

                    <span>Slot Tersedia</span>
                    <strong>6</strong>
                    <small>Siap digunakan</small>

                </div>

            </div>


            <div class="summary-card">

                <div class="summary-icon red">
                    ×
                </div>

                <div class="summary-content">

                    <span>Slot Terpakai</span>
                    <strong>3</strong>
                    <small>Sedang digunakan</small>

                </div>

            </div>

        </section>


        <!-- =========================
             SEARCH
        ========================== -->

        <section class="search-section" id="fasilitas">

            <div class="section-heading">

                <div>

                    <span class="section-label">
                        CARI FASILITAS
                    </span>

                    <h2>
                        Temukan fasilitas
                    </h2>

                    <p>
                        Gunakan filter untuk menemukan fasilitas yang sesuai
                        dengan kebutuhan.
                    </p>

                </div>

            </div>


            <div class="search-box">

                <div class="form-group">

                    <label for="tipe">
                        Tipe Fasilitas
                    </label>

                    <select id="tipe">

                        <option value="">
                            Semua tipe
                        </option>

                        <option value="ruang-seminar">
                            Ruang Seminar
                        </option>

                        <option value="aula">
                            Aula
                        </option>

                        <option value="laboratorium">
                            Laboratorium
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label for="lokasi">
                        Lokasi
                    </label>

                    <select id="lokasi">

                        <option value="">
                            Semua lokasi
                        </option>

                        <option value="gedung-a">
                            Gedung A
                        </option>

                        <option value="gedung-b">
                            Gedung B
                        </option>

                        <option value="gedung-c">
                            Gedung C
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label for="kapasitas">
                        Kapasitas
                    </label>

                    <select id="kapasitas">

                        <option value="">
                            Semua kapasitas
                        </option>

                        <option value="20">
                            Minimal 20 orang
                        </option>

                        <option value="50">
                            Minimal 50 orang
                        </option>

                        <option value="100">
                            Minimal 100 orang
                        </option>

                    </select>

                </div>


                <button type="button" class="search-button">
                    <span>⌕</span>
                    Cari Fasilitas
                </button>

            </div>

        </section>


        <!-- =========================
             FACILITY LIST
        ========================== -->

        <section class="facility-section">

            <div class="section-heading facility-heading">

                <div>

                    <span class="section-label">
                        DAFTAR FASILITAS
                    </span>

                    <h2>
                        Ketersediaan fasilitas
                    </h2>

                    <p>
                        Pilih fasilitas dan periksa slot waktu yang tersedia.
                    </p>

                </div>


                <div class="date-box">

                    <span>Jadwal</span>

                    <strong>
                        16 September 2026
                    </strong>

                </div>

            </div>


            <!-- FACILITY 1 -->

            <article class="facility-card">

                <div class="facility-info">

                    <div class="facility-icon seminar">
                        🏫
                    </div>

                    <div class="facility-details">

                        <span class="facility-type">
                            RUANG SEMINAR
                        </span>

                        <h3>
                            Ruang Seminar
                        </h3>

                        <p>
                            📍 Gedung A · Lantai 2
                        </p>

                        <div class="facility-meta">

                            <span>
                                👥 50 orang
                            </span>

                            <span>
                                🏢 Seminar
                            </span>

                        </div>

                    </div>

                </div>


                <div class="schedule">

                    <div class="schedule-header">

                        <div>
                            <strong>Jadwal Hari Ini</strong>
                            <span>16 September 2026</span>
                        </div>

                        <span class="available-count">
                            2 slot tersedia
                        </span>

                    </div>


                    <div class="time-slots">

                        <div class="time-slot available">

                            <div>
                                <span>08:00 - 10:00</span>
                                <small>Slot waktu</small>
                            </div>

                            <strong>
                                Tersedia
                            </strong>

                        </div>


                        <div class="time-slot unavailable">

                            <div>
                                <span>10:00 - 12:00</span>
                                <small>Slot waktu</small>
                            </div>

                            <strong>
                                Terpakai
                            </strong>

                        </div>


                        <div class="time-slot available">

                            <div>
                                <span>13:00 - 15:00</span>
                                <small>Slot waktu</small>
                            </div>

                            <strong>
                                Tersedia
                            </strong>

                        </div>

                    </div>


                    <a href="#reservasi" class="reserve-link">
                        Ajukan Reservasi
                        <span>→</span>
                    </a>

                </div>

            </article>


            <!-- FACILITY 2 -->

            <article class="facility-card">

                <div class="facility-info">

                    <div class="facility-icon aula">
                        🏛️
                    </div>

                    <div class="facility-details">

                        <span class="facility-type">
                            AULA
                        </span>

                        <h3>
                            Aula Fakultas
                        </h3>

                        <p>
                            📍 Gedung B · Lantai 1
                        </p>

                        <div class="facility-meta">

                            <span>
                                👥 100 orang
                            </span>

                            <span>
                                🏢 Aula
                            </span>

                        </div>

                    </div>

                </div>


                <div class="schedule">

                    <div class="schedule-header">

                        <div>
                            <strong>Jadwal Hari Ini</strong>
                            <span>16 September 2026</span>
                        </div>

                        <span class="available-count">
                            2 slot tersedia
                        </span>

                    </div>


                    <div class="time-slots">

                        <div class="time-slot unavailable">

                            <div>
                                <span>08:00 - 10:00</span>
                                <small>Slot waktu</small>
                            </div>

                            <strong>
                                Terpakai
                            </strong>

                        </div>


                        <div class="time-slot available">

                            <div>
                                <span>10:00 - 12:00</span>
                                <small>Slot waktu</small>
                            </div>

                            <strong>
                                Tersedia
                            </strong>

                        </div>


                        <div class="time-slot available">

                            <div>
                                <span>13:00 - 15:00</span>
                                <small>Slot waktu</small>
                            </div>

                            <strong>
                                Tersedia
                            </strong>

                        </div>

                    </div>


                    <a href="#reservasi" class="reserve-link">
                        Ajukan Reservasi
                        <span>→</span>
                    </a>

                </div>

            </article>


            <!-- FACILITY 3 -->

            <article class="facility-card">

                <div class="facility-info">

                    <div class="facility-icon lab">
                        💻
                    </div>

                    <div class="facility-details">

                        <span class="facility-type">
                            LABORATORIUM
                        </span>

                        <h3>
                            Laboratorium Komputer
                        </h3>

                        <p>
                            📍 Gedung C · Lantai 3
                        </p>

                        <div class="facility-meta">

                            <span>
                                👥 40 orang
                            </span>

                            <span>
                                🏢 Laboratorium
                            </span>

                        </div>

                    </div>

                </div>


                <div class="schedule">

                    <div class="schedule-header">

                        <div>
                            <strong>Jadwal Hari Ini</strong>
                            <span>16 September 2026</span>
                        </div>

                        <span class="available-count">
                            2 slot tersedia
                        </span>

                    </div>


                    <div class="time-slots">

                        <div class="time-slot available">

                            <div>
                                <span>08:00 - 10:00</span>
                                <small>Slot waktu</small>
                            </div>

                            <strong>
                                Tersedia
                            </strong>

                        </div>


                        <div class="time-slot available">

                            <div>
                                <span>10:00 - 12:00</span>
                                <small>Slot waktu</small>
                            </div>

                            <strong>
                                Tersedia
                            </strong>

                        </div>


                        <div class="time-slot unavailable">

                            <div>
                                <span>13:00 - 15:00</span>
                                <small>Slot waktu</small>
                            </div>

                            <strong>
                                Terpakai
                            </strong>

                        </div>

                    </div>


                    <a href="#reservasi" class="reserve-link">
                        Ajukan Reservasi
                        <span>→</span>
                    </a>

                </div>

            </article>

        </section>


        <!-- =========================
             RESERVATION
        ========================== -->

        <section class="reservation-section" id="reservasi">

            <div class="section-heading">

                <div>

                    <span class="section-label">
                        RESERVASI
                    </span>

                    <h2>
                        Ajukan reservasi
                    </h2>

                    <p>
                        Isi data penggunaan fasilitas untuk mengirim
                        pengajuan reservasi.
                    </p>

                </div>

            </div>


            <div class="reservation-card">


                <div class="reservation-info">

                    <div class="reservation-icon">
                        📅
                    </div>

                    <span class="reservation-label">
                        PENGAJUAN RESERVASI
                    </span>

                    <h3>
                        Gunakan fasilitas kampus
                        dengan mudah.
                    </h3>

                    <p>
                        Pilih fasilitas, tanggal, dan waktu penggunaan.
                        Pastikan jadwal yang dipilih masih tersedia.
                    </p>


                    <div class="reservation-note">

                        <div class="note-icon">
                            !
                        </div>

                        <div>

                            <strong>
                                Perhatian
                            </strong>

                            <span>
                                Tujuan penggunaan diperlukan untuk
                                proses pengajuan reservasi.
                            </span>

                        </div>

                    </div>

                </div>


                <form class="reservation-form">


                    <div class="form-group">

                        <label for="fasilitas">
                            Fasilitas
                            <span>*</span>
                        </label>

                        <select
                            id="fasilitas"
                            name="fasilitas"
                            required
                        >

                            <option value="">
                                Pilih fasilitas
                            </option>

                            <option value="ruang-seminar">
                                Ruang Seminar
                            </option>

                            <option value="aula">
                                Aula Fakultas
                            </option>

                            <option value="laboratorium">
                                Laboratorium Komputer
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="tanggal">
                            Tanggal Penggunaan
                            <span>*</span>
                        </label>

                        <input
                            type="date"
                            id="tanggal"
                            name="tanggal"
                            required
                        >

                        <small>
                            Pilih tanggal penggunaan fasilitas.
                        </small>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label for="waktu-mulai">
                                Waktu Mulai
                                <span>*</span>
                            </label>

                            <input
                                type="time"
                                id="waktu-mulai"
                                name="waktu_mulai"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label for="waktu-selesai">
                                Waktu Selesai
                                <span>*</span>
                            </label>

                            <input
                                type="time"
                                id="waktu-selesai"
                                name="waktu_selesai"
                                required
                            >

                        </div>

                    </div>


                    <div class="form-group">

                        <label for="tujuan">
                            Tujuan Penggunaan
                            <span>*</span>
                        </label>

                        <textarea
                            id="tujuan"
                            name="tujuan"
                            rows="5"
                            placeholder="Contoh: Digunakan untuk kegiatan seminar mahasiswa."
                            required
                        ></textarea>

                        <small>
                            Jelaskan secara singkat tujuan penggunaan fasilitas.
                        </small>

                    </div>


                    <div class="form-submit">

                        <button
                            type="submit"
                            class="submit-button"
                        >
                            Ajukan Reservasi
                            <span>→</span>
                        </button>

                    </div>


                </form>

            </div>

        </section>


        <!-- =========================
             ABOUT
        ========================== -->

        <section class="about-section" id="tentang">

            <span class="section-label">
                TENTANG SISTEM
            </span>

            <h2>
                Sistem Informasi Fasilitas Kampus
            </h2>

            <p>
                Sistem ini membantu pengguna melihat ketersediaan
                fasilitas kampus dan mengajukan reservasi berdasarkan
                waktu penggunaan yang diinginkan.
            </p>

        </section>

    </main>


    <!-- =========================
         FOOTER
    ========================== -->

    <footer>

        <div class="footer-content">

            <div>

                <strong>
                    Fasilitas Kampus
                </strong>

                <span>
                    Sistem Informasi Fasilitas Kampus
                </span>

            </div>

            <p>
                © 2026 Fasilitas Kampus
            </p>

        </div>

    </footer>

</body>

</html>
```
