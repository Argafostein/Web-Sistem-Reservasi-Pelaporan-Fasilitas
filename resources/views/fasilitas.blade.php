<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fasilitas Kampus</title>

    @vite('resources/css/fasilitas.css')
    <!-- <link rel="stylesheet" href="{{ asset('fasilitas.css') }}"> -->
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
            </a>

            <nav class="navigation">

                <a href="{{ route('fasilitas') }}" class="nav-link active">
                    Fasilitas
                </a>

                @if (auth()->check())
                    <div class="profile-menu">

                        <a href="#" class="profile-button">
                            👤 {{ Auth::user()->name }}
                        </a>

                        <div class="profile-dropdown">

                            <a href="#">
                                Profil Saya
                            </a>

                            <form
                                method="POST"
                                action="{{ route('logout') }}"
                            >
                                @csrf

                                <button type="submit">
                                    Logout
                                </button>
                            </form>

                        </div>

                    </div>
                @else
                    <a href="{{ route('register') }}" class="nav-link">
                        Sign Up
                    </a>
                @endif
            </nav>

        </div>

    </header>



    <!-- =========================================
         MAIN
    ========================================== -->

    <main>

        <!-- =====================================
             SRS 2 - PENCARIAN FASILITAS
        ====================================== -->

        <section class="search-section" id="fasilitas">

            <div class="section-heading">

                <div>
                    <h2>
                        Temukan Fasilitas
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
                    Cari Fasilitas
                </button>

            </div>

        </section>



        <!-- =====================================
             DAFTAR FASILITAS
        ====================================== -->

        <section class="facility-section">

            @forelse ($facilities as $facility)

                <article class="facility-card">

                    <div class="facility-top">

                        <div class="facility-main">

                            <div class="facility-icon">
                                🏢
                            </div>

                            <div>

                                <h3>
                                    {{ $facility->name }}
                                </h3>

                                <p class="location">
                                    {{ $facility->location }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="facility-info">

                        <span>
                            👥 Kapasitas:
                            {{ $facility->capacity ?? '-' }} orang
                        </span>

                        <span>
                            🏷️ Status:
                            {{ ucfirst($facility->status) }}
                        </span>

                    </div>


                    <div class="schedule">

                        <div class="schedule-title">

                            <span>
                                Informasi
                            </span>

                            <span>
                                Status
                            </span>

                        </div>


                        <div class="schedule-row">

                            <span class="time">
                                {{ $facility->description ?? 'Tidak ada deskripsi' }}
                            </span>

                            <span class="status {{ $facility->status === 'available' ? 'available' : 'unavailable' }}">

                                <i></i>

                                {{ $facility->status === 'available' ? 'Tersedia' : 'Tidak tersedia' }}

                            </span>

                        </div>

                    </div>


                    <div class="facility-action">

                        <a href="#reservasi" class="reserve-button">
                            Ajukan Reservasi
                        </a>

                    </div>

                </article>

            @empty

                <p>
                    Belum ada fasilitas yang tersedia.
                </p>

            @endforelse

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