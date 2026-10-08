<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Petugas — Fasilitas Kampus</title>

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
                    <span>Panel Petugas</span>
                </div>

            </a>


            <nav class="navigation">

                <a href="/dashboard-petugas" class="nav-link active">
                    Dashboard
                </a>

                <a href="/antrian-reservasi" class="nav-link">
                    Reservasi
                </a>

                <a href="/antrian-laporan" class="nav-link">
                    Laporan
                </a>

            </nav>

        </div>

    </header>


    <main>

        <!-- =========================
             PAGE HEADER
        ========================== -->

        <section class="page-header">

            <div class="page-header-content">

                <span class="hero-badge">
                    PANEL PETUGAS
                </span>

                <h1>
                    Dashboard
                    <span>antrian &amp; laporan</span>
                </h1>

                <p>
                    Pantau semua reservasi dan laporan yang masih menunggu
                    diproses agar tidak ada yang terlewat.
                </p>

            </div>

            <div class="hero-decoration decoration-one"></div>
            <div class="hero-decoration decoration-two"></div>

        </section>


        <!-- =========================
             SUMMARY CARDS
        ========================== -->

        <section class="summary summary-4">

            <div class="summary-card">

                <div class="summary-icon blue">
                    📋
                </div>

                <div class="summary-content">

                    <span>Reservasi Menunggu</span>

                    <strong>4</strong>

                </div>

            </div>


            <div class="summary-card">

                <div class="summary-icon green">
                    ✓
                </div>

                <div class="summary-content">

                    <span>Reservasi Disetujui</span>

                    <strong>7</strong>

                </div>

            </div>


            <div class="summary-card">

                <div class="summary-icon red">
                    🔧
                </div>

                <div class="summary-content">

                    <span>Laporan Menunggu</span>

                    <strong>3</strong>

                </div>

            </div>


            <div class="summary-card">

                <div class="summary-icon blue">
                    📅
                </div>

                <div class="summary-content">

                    <span>Reservasi Hari Ini</span>

                    <strong>2</strong>

                </div>

            </div>

        </section>


        <!-- =========================
             ANTRIAN RESERVASI
        ========================== -->

        <section class="riwayat-section">

            <div class="section-heading">

                <div>

                    <span class="section-label">
                        ANTRIAN RESERVASI
                    </span>

                    <h2>
                        Reservasi menunggu persetujuan
                    </h2>

                    <p>
                        Reservasi berikut belum diproses dan perlu tindakan segera.
                    </p>

                </div>

                <a href="/antrian-reservasi" class="btn-outline">
                    Lihat Semua →
                </a>

            </div>


            <!-- ITEM 1 -->

            <article class="reservasi-item">

                <div class="reservasi-left">

                    <div class="facility-icon">
                        🏫
                    </div>

                    <div class="reservasi-info">

                        <span class="facility-type">
                            RUANG SEMINAR
                        </span>

                        <h3>
                            Ruang Seminar — Gedung A
                        </h3>

                        <p>
                            📅 Senin, 16 Sep 2026 &nbsp;|&nbsp; 08:00 – 10:00
                            &nbsp;·&nbsp; 👤 Ahmad Fauzi
                        </p>

                        <p class="reservasi-tujuan">
                            Seminar mahasiswa Teknik Informatika angkatan 2023.
                        </p>

                    </div>

                </div>

                <div class="reservasi-right">

                    <span class="status-badge status-menunggu">
                        Menunggu
                    </span>

                    <div class="reservasi-actions">

                        <a href="/antrian-reservasi" class="btn-detail">
                            Proses
                        </a>

                    </div>

                </div>

            </article>


            <!-- ITEM 2 -->

            <article class="reservasi-item">

                <div class="reservasi-left">

                    <div class="facility-icon">
                        🏛️
                    </div>

                    <div class="reservasi-info">

                        <span class="facility-type">
                            AULA
                        </span>

                        <h3>
                            Aula Fakultas — Gedung B
                        </h3>

                        <p>
                            📅 Rabu, 18 Sep 2026 &nbsp;|&nbsp; 10:00 – 12:00
                            &nbsp;·&nbsp; 👤 Siti Rahayu
                        </p>

                        <p class="reservasi-tujuan">
                            Pelantikan pengurus BEM Fakultas periode 2026/2027.
                        </p>

                    </div>

                </div>

                <div class="reservasi-right">

                    <span class="status-badge status-menunggu">
                        Menunggu
                    </span>

                    <div class="reservasi-actions">

                        <a href="/antrian-reservasi" class="btn-detail">
                            Proses
                        </a>

                    </div>

                </div>

            </article>

        </section>


        <!-- =========================
             ANTRIAN LAPORAN
        ========================== -->

        <section class="riwayat-section">

            <div class="section-heading">

                <div>

                    <span class="section-label">
                        ANTRIAN LAPORAN
                    </span>

                    <h2>
                        Laporan menunggu tindak lanjut
                    </h2>

                    <p>
                        Laporan kerusakan/masalah berikut belum ditangani.
                    </p>

                </div>

                <a href="/antrian-laporan" class="btn-outline">
                    Lihat Semua →
                </a>

            </div>


            <!-- LAPORAN 1 -->

            <article class="reservasi-item">

                <div class="reservasi-left">

                    <div class="facility-icon">
                        🏫
                    </div>

                    <div class="reservasi-info">

                        <span class="facility-type">
                            ELEKTRONIK — RUANG SEMINAR
                        </span>

                        <h3>
                            AC tidak menyala
                        </h3>

                        <p>
                            📍 Ruang Seminar, Gedung A
                            &nbsp;·&nbsp; 👤 Budi Santoso
                            &nbsp;·&nbsp; 14 Sep 2026
                        </p>

                    </div>

                </div>

                <div class="reservasi-right">

                    <span class="status-badge status-menunggu">
                        Menunggu
                    </span>

                    <div class="reservasi-actions">

                        <a href="/antrian-laporan" class="btn-detail">
                            Tinjau
                        </a>

                    </div>

                </div>

            </article>


            <!-- LAPORAN 2 -->

            <article class="reservasi-item">

                <div class="reservasi-left">

                    <div class="facility-icon">
                        🏛️
                    </div>

                    <div class="reservasi-info">

                        <span class="facility-type">
                            PERABOTAN — AULA FAKULTAS
                        </span>

                        <h3>
                            Kursi rusak
                        </h3>

                        <p>
                            📍 Aula Fakultas, Gedung B
                            &nbsp;·&nbsp; 👤 Dewi Lestari
                            &nbsp;·&nbsp; 10 Sep 2026
                        </p>

                    </div>

                </div>

                <div class="reservasi-right">

                    <span class="status-badge status-diproses">
                        Diproses
                    </span>

                    <div class="reservasi-actions">

                        <a href="/antrian-laporan" class="btn-detail">
                            Tinjau
                        </a>

                    </div>

                </div>

            </article>

        </section>

    </main>


    <!-- =========================
         FOOTER
    ========================== -->

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
