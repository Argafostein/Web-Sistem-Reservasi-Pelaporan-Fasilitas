<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fasilitas Kampus</title>

    <link rel="stylesheet" href="{{ asset('fasilitas.css') }}">
</head>

<body>

    <!-- =========================================
         NAVBAR
    ========================================== -->

    <header class="navbar">

        <div class="navbar-container">

            <a href="#" class="brand">

                <div class="brand-logo">
                    FK
                </div>

                <div class="brand-text">
                    <strong>Fasilitas Kampus</strong>
                    <span>Sistem Informasi Kampus</span>
                </div>

            </a>

            <nav class="navigation">

                <a href="#fasilitas" class="nav-link active">
                    Fasilitas
                </a>

                <a href="#reservasi" class="nav-link">
                    Reservasi
                </a>

                <a href="#tentang" class="nav-link">
                    Tentang
                </a>

            </nav>

        </div>

    </header>



    <!-- =========================================
         MAIN
    ========================================== -->

    <main>


        <!-- =====================================
             HERO
        ====================================== -->

        <section class="hero">

            <div class="hero-content">

                <span class="hero-badge">
                    SISTEM INFORMASI FASILITAS
                </span>

                <h1>
                    Temukan fasilitas yang
                    <span>sesuai kebutuhanmu.</span>
                </h1>

                <p>
                    Cari fasilitas berdasarkan tipe, lokasi,
                    dan kapasitas. Lihat ketersediaan waktu
                    sebelum mengajukan reservasi.
                </p>

                <a href="#fasilitas" class="hero-button">
                    Lihat Fasilitas
                </a>

            </div>

            <div class="hero-decoration decoration-one"></div>
            <div class="hero-decoration decoration-two"></div>

        </section>



        <!-- =====================================
             SUMMARY
        ====================================== -->

        <section class="summary">

            <div class="summary-card">

                <div class="summary-icon blue">
                    🏢
                </div>

                <div class="summary-content">

                    <span>Total Fasilitas</span>

                    <strong>3</strong>

                </div>

            </div>


            <div class="summary-card">

                <div class="summary-icon green">
                    ✓
                </div>

                <div class="summary-content">

                    <span>Slot Tersedia</span>

                    <strong>6</strong>

                </div>

            </div>


            <div class="summary-card">

                <div class="summary-icon red">
                    ×
                </div>

                <div class="summary-content">

                    <span>Slot Terpakai</span>

                    <strong>3</strong>

                </div>

            </div>

        </section>



        <!-- =====================================
             SRS 2 - PENCARIAN FASILITAS
        ====================================== -->

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
                        Cari berdasarkan tipe, lokasi, atau kapasitas.
                    </p>

                </div>

            </div>


            <!-- Search box -->

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
                    🔍 Cari Fasilitas
                </button>

            </div>

        </section>



        <!-- =====================================
             DAFTAR FASILITAS
        ====================================== -->

        <section class="facility-section">


            <div class="section-heading">

                <div>

                    <span class="section-label">
                        DAFTAR FASILITAS
                    </span>

                    <h2>
                        Ketersediaan fasilitas
                    </h2>

                    <p>
                        Lihat status fasilitas berdasarkan slot waktu.
                    </p>

                </div>


                <div class="date-box">

                    <span>
                        Jadwal
                    </span>

                    <strong>
                        16 September 2026
                    </strong>

                </div>

            </div>



            <!-- =====================================
                 FASILITAS 1
            ====================================== -->

            <article class="facility-card">

                <div class="facility-top">

                    <div class="facility-main">

                        <div class="facility-icon">
                            🏢
                        </div>

                        <div>

                            <h3>
                                Ruang Seminar
                            </h3>

                            <p class="location">
                                📍 Gedung A · Lantai 2
                            </p>

                        </div>

                    </div>


                    <span class="facility-status">
                        2 slot tersedia
                    </span>

                </div>


                <div class="facility-info">

                    <span>
                        👥 Kapasitas: 50 orang
                    </span>

                    <span>
                        🏷️ Tipe: Ruang Seminar
                    </span>

                </div>


                <div class="schedule">

                    <div class="schedule-title">

                        <span>
                            Slot Waktu
                        </span>

                        <span>
                            Status
                        </span>

                    </div>


                    <div class="schedule-row">

                        <span class="time">
                            08:00 — 10:00
                        </span>

                        <span class="status available">

                            <i></i>

                            Tersedia

                        </span>

                    </div>


                    <div class="schedule-row">

                        <span class="time">
                            10:00 — 12:00
                        </span>

                        <span class="status unavailable">

                            <i></i>

                            Tidak tersedia

                        </span>

                    </div>


                    <div class="schedule-row">

                        <span class="time">
                            13:00 — 15:00
                        </span>

                        <span class="status available">

                            <i></i>

                            Tersedia

                        </span>

                    </div>

                </div>


                <div class="facility-action">

                    <a href="#reservasi" class="reserve-button">
                        Ajukan Reservasi
                    </a>

                </div>

            </article>



            <!-- =====================================
                 FASILITAS 2
            ====================================== -->

            <article class="facility-card">

                <div class="facility-top">

                    <div class="facility-main">

                        <div class="facility-icon">
                            🏛️
                        </div>

                        <div>

                            <h3>
                                Aula Fakultas
                            </h3>

                            <p class="location">
                                📍 Gedung B · Lantai 1
                            </p>

                        </div>

                    </div>


                    <span class="facility-status">
                        2 slot tersedia
                    </span>

                </div>


                <div class="facility-info">

                    <span>
                        👥 Kapasitas: 100 orang
                    </span>

                    <span>
                        🏷️ Tipe: Aula
                    </span>

                </div>


                <div class="schedule">

                    <div class="schedule-title">

                        <span>
                            Slot Waktu
                        </span>

                        <span>
                            Status
                        </span>

                    </div>


                    <div class="schedule-row">

                        <span class="time">
                            08:00 — 10:00
                        </span>

                        <span class="status unavailable">

                            <i></i>

                            Tidak tersedia

                        </span>

                    </div>


                    <div class="schedule-row">

                        <span class="time">
                            10:00 — 12:00
                        </span>

                        <span class="status available">

                            <i></i>

                            Tersedia

                        </span>

                    </div>


                    <div class="schedule-row">

                        <span class="time">
                            13:00 — 15:00
                        </span>

                        <span class="status available">

                            <i></i>

                            Tersedia

                        </span>

                    </div>

                </div>


                <div class="facility-action">

                    <a href="#reservasi" class="reserve-button">
                        Ajukan Reservasi
                    </a>

                </div>

            </article>



            <!-- =====================================
                 FASILITAS 3
            ====================================== -->

            <article class="facility-card">

                <div class="facility-top">

                    <div class="facility-main">

                        <div class="facility-icon">
                            💻
                        </div>

                        <div>

                            <h3>
                                Laboratorium Komputer
                            </h3>

                            <p class="location">
                                📍 Gedung C · Lantai 3
                            </p>

                        </div>

                    </div>


                    <span class="facility-status">
                        2 slot tersedia
                    </span>

                </div>


                <div class="facility-info">

                    <span>
                        👥 Kapasitas: 40 orang
                    </span>

                    <span>
                        🏷️ Tipe: Laboratorium
                    </span>

                </div>


                <div class="schedule">

                    <div class="schedule-title">

                        <span>
                            Slot Waktu
                        </span>

                        <span>
                            Status
                        </span>

                    </div>


                    <div class="schedule-row">

                        <span class="time">
                            08:00 — 10:00
                        </span>

                        <span class="status available">

                            <i></i>

                            Tersedia

                        </span>

                    </div>


                    <div class="schedule-row">

                        <span class="time">
                            10:00 — 12:00
                        </span>

                        <span class="status available">

                            <i></i>

                            Tersedia

                        </span>

                    </div>


                    <div class="schedule-row">

                        <span class="time">
                            13:00 — 15:00
                        </span>

                        <span class="status unavailable">

                            <i></i>

                            Tidak tersedia

                        </span>

                    </div>

                </div>


                <div class="facility-action">

                    <a href="#reservasi" class="reserve-button">
                        Ajukan Reservasi
                    </a>

                </div>

            </article>

        </section>



        <!-- =====================================
             SRS 3 - FORM RESERVASI
        ====================================== -->

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
                        Isi informasi reservasi sesuai kebutuhan penggunaan fasilitas.
                    </p>

                </div>

            </div>


            <div class="reservation-card">


                <!-- Informasi -->

                <div class="reservation-info">

                    <div class="reservation-icon">
                        📅
                    </div>

                    <h3>
                        Form Pengajuan Reservasi
                    </h3>

                    <p>
                        Pastikan fasilitas dan rentang waktu yang dipilih
                        masih tersedia sebelum mengajukan reservasi.
                    </p>

                </div>



                <!-- Form -->

                <form>


                    <div class="form-row">

                        <div class="form-group">

                            <label for="fasilitas">
                                Fasilitas
                            </label>

                            <select id="fasilitas">

                                <option value="">
                                    Pilih fasilitas
                                </option>

                                <option>
                                    Ruang Seminar
                                </option>

                                <option>
                                    Aula Fakultas
                                </option>

                                <option>
                                    Laboratorium Komputer
                                </option>

                            </select>

                        </div>


                        <div class="form-group">

                            <label for="tanggal">
                                Tanggal
                            </label>

                            <input
                                type="date"
                                id="tanggal"
                                value="2026-09-16"
                            >

                        </div>

                    </div>



                    <div class="form-row">

                        <div class="form-group">

                            <label for="waktu-mulai">
                                Waktu Mulai
                            </label>

                            <input
                                type="time"
                                id="waktu-mulai"
                            >

                        </div>


                        <div class="form-group">

                            <label for="waktu-selesai">
                                Waktu Selesai
                            </label>

                            <input
                                type="time"
                                id="waktu-selesai"
                            >

                        </div>

                    </div>



                    <!-- Tujuan penggunaan -->

                    <div class="form-group">

                        <label for="tujuan">
                            Tujuan Penggunaan
                        </label>

                        <textarea
                            id="tujuan"
                            rows="5"
                            placeholder="Contoh: Digunakan untuk kegiatan seminar mahasiswa."
                        ></textarea>

                        <small>
                            Jelaskan secara singkat tujuan penggunaan fasilitas.
                        </small>

                    </div>



                    <!-- Tombol -->

                    <div class="form-submit">

                        <button
                            type="submit"
                            class="submit-button"
                        >
                            Ajukan Reservasi
                        </button>

                    </div>

                </form>

            </div>

        </section>



        <!-- =====================================
             TENTANG
        ====================================== -->

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



    <!-- =========================================
         FOOTER
    ========================================== -->

    <footer>

        <div class="footer-content">

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

    </footer>

</body>

</html>