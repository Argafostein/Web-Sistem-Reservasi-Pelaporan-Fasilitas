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

                <a href="{{ route('reservasi') }}" class="nav-link active">
                    Reservasi
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

    <main>

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

                <form method="POST" action="{{ route('reservasi.store') }}">
                    @csrf

                    <div class="form-row">

                        <div class="form-group">

                            <label for="fasilitas">
                                Fasilitas
                            </label>

                            <select id="fasilitas" name="facility_id" required>

                                <option value="">
                                    Pilih fasilitas
                                </option>

                                @foreach ($facilities as $facility)
                                    <option value="{{ $facility->facility_id }}">
                                        {{ $facility->name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('facility_id')
                                <small class="error">{{ $message }}</small>
                            @enderror

                        </div>


                        <div class="form-group">

                            <label for="tanggal">
                                Tanggal
                            </label>

                            <input
                                type="date"
                                id="tanggal"
                                name="reservation_date"
                                min="{{ date('Y-m-d') }}"
                                required
                            >

                            @error('reservation_date')
                                <small class="error">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label for="waktu-mulai">
                                Waktu Mulai
                            </label>

                            <select
                                id="waktu-mulai"
                                name="start_time"
                                required
                            >
                                <option value="">Pilih waktu mulai</option>

                                @for ($hour = 7; $hour <= 19; $hour++)
                                    @foreach ([0, 30] as $minute)
                                        @php
                                            $time = sprintf('%02d:%02d', $hour, $minute);
                                        @endphp

                                        <option
                                            value="{{ $time }}"
                                            {{ old('start_time') == $time ? 'selected' : '' }}
                                        >
                                            {{ $time }}
                                        </option>
                                    @endforeach
                                @endfor

                            </select>

                            @error('start_time')
                                <small class="error">{{ $message }}</small>
                            @enderror

                        </div>


                        <div class="form-group">

                            <label for="waktu-selesai">
                                Waktu Selesai
                            </label>

                            <select
                                id="waktu-selesai"
                                name="end_time"
                                required
                            >
                                <option value="">Pilih waktu selesai</option>

                                @for ($hour = 7; $hour <= 20; $hour++)
                                    @foreach ([0, 30] as $minute)
                                        @php
                                            $time = sprintf('%02d:%02d', $hour, $minute);
                                        @endphp

                                        <option
                                            value="{{ $time }}"
                                            {{ old('end_time') == $time ? 'selected' : '' }}
                                        >
                                            {{ $time }}
                                        </option>
                                    @endforeach
                                @endfor

                            </select>

                            @error('end_time')
                                <small class="error">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>


                    <div class="form-group">

                        <label for="tujuan">
                            Tujuan Penggunaan
                        </label>

                        <textarea
                            id="tujuan"
                            name="purpose"
                            rows="5"
                            placeholder="Contoh: Digunakan untuk kegiatan seminar mahasiswa."
                            required
                        ></textarea>

                        @error('purpose')
                            <small class="error">{{ $message }}</small>
                        @enderror

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
                        </button>

                    </div>

                </form>

            </div>

        </section>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif


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