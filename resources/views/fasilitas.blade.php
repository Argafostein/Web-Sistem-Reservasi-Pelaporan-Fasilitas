@extends('layouts.app')

@push('styles')
    @vite('resources/css/fasilitas.css')
@endpush

@section('content')
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

@endsection
