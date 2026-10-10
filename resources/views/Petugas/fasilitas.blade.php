@extends('layouts.app')

@push('styles')
    @vite('resources/css/petugas/fasilitas.css')
@endpush

@push('scripts')
    @vite('resources/js/petugas/fasilitas.js')
@endpush

@section('content')

<section
    class="facility-page"
    data-reservations="{{ $reservations->toJson() }}"
>

    <div class="facility-container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- HEADER --}}
        <div class="facility-header">

            <div>
                <span class="facility-label">
                    FASILITAS KAMPUS
                </span>

                <h1>
                    Temukan Fasilitas
                </h1>

                <p>
                    Cari fasilitas dan pilih waktu penggunaan yang tersedia.
                </p>
            </div>

        </div>


        {{-- SEARCH & FILTER --}}
        <div class="facility-search-panel">

            <div class="search-main">

                <label for="searchFacility">
                    Cari fasilitas
                </label>

                <div class="search-input-wrapper">

                    <span class="search-icon">
                        🔍
                    </span>

                    <input
                        type="text"
                        id="searchFacility"
                        placeholder="Cari nama fasilitas..."
                    >

                </div>

            </div>


            <div class="filter-group">

                <label for="tipe">
                    Tipe
                </label>

                <select id="tipe">

                    <option value="">
                        Semua tipe
                    </option>

                    <option value="ruang seminar">
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


            <div class="filter-group">

                <label for="lokasi">
                    Lokasi
                </label>

                <select id="lokasi">

                    <option value="">
                        Semua lokasi
                    </option>

                    <option value="gedung a">
                        Gedung A
                    </option>

                    <option value="gedung b">
                        Gedung B
                    </option>

                    <option value="gedung c">
                        Gedung C
                    </option>

                </select>

            </div>


            <div class="filter-group">

                <label for="kapasitas">
                    Kapasitas
                </label>

                <select id="kapasitas">

                    <option value="">
                        Semua
                    </option>

                    <option value="20">
                        ≥ 20 orang
                    </option>

                    <option value="50">
                        ≥ 50 orang
                    </option>

                    <option value="100">
                        ≥ 100 orang
                    </option>

                </select>

            </div>

            <div class="filter-group">

                <label for="status">
                    Status
                </label>

                <select id="status">

                    <option value="">
                        Semua 
                    </option>

                    <option value="aktif">
                        Aktif
                    </option>

                    <option value="perbaikan">
                        Perbaikan
                    </option>

                </select>

            </div>

        </div>

        {{-- FACILITY LIST --}}
        <div class="facility-list" id="facilityList">

            @foreach ($facilities as $facility)
                <div
                    class="facility-item"
                    data-id="{{ $facility->facility_id }}"
                    data-name="{{ strtolower($facility->name) }}"
                    data-type="{{ strtolower($facility->type) }}"
                    data-location="{{ strtolower($facility->location) }}"
                    data-capacity="{{ $facility->capacity }}"
                    data-status="{{ strtolower($facility->status) }}"
                >
                    <div class="facility-item-content">

                        <div class="facility-item-info">
                            <span class="facility-item-type">
                                {{ $facility->type }}
                            </span>

                            <h3>{{ $facility->name }}</h3>

                            <p>
                                📍 {{ $facility->location }}
                            </p>

                            <p>
                                👥 Kapasitas {{ $facility->capacity }} orang
                            </p>
                        </div>

                        <div class="facility-buttons">

                            {{-- Tombol lihat ketersediaan --}}
                            <button
                                type="button"
                                class="facility-select-button"
                                @if ($facility->status !== 'available') disabled @endif
                            >
                                Lihat Ketersediaan
                            </button>

                            {{-- Tombol perubahan status --}}
                            <form
                                action="{{ route('petugas.fasilitas.ubah-status', $facility->facility_id) }}"
                                method="POST"
                                onsubmit="return confirm('Apakah kamu yakin ingin mengubah status fasilitas ini?')"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="btn-perbaikan {{ $facility->status === 'available' ? 'is-perbaikan' : 'is-aktif' }}"
                                >
                                    {{ $facility->status === 'available'
                                        ? 'Mulai Perbaikan'
                                        : 'Selesaikan Perbaikan' }}
                                </button>
                            </form>

                        </div>

                    </div>
                </div>
            @endforeach

        </div>

        {{-- EMPTY RESULT --}}
        <div
            class="facility-empty"
            id="facilityEmpty"
            style="display: none;"
        >
            Fasilitas tidak ditemukan.
        </div>


        {{-- CALENDAR --}}
        <div
            class="calendar-card"
            id="calendarCard"
            style="display: none;"
        >

            <div class="calendar-header">
                <div>
                    <span class="calendar-title">
                        Pilih tanggal penggunaan fasilitas
                    </span>

                    <strong
                        class="selected-facility-name"
                        id="selectedFacilityName"
                    ></strong>
                </div>

                <span class="calendar-timezone">
                    Waktu Jakarta
                </span>
            </div>


            <div class="calendar-body">

                {{-- MINI CALENDAR --}}
                <aside class="mini-calendar">

                    <div class="mini-calendar-header">

                        <strong id="monthTitle">
                            Oktober 2026
                        </strong>

                        <div class="month-navigation">

                            <button type="button" id="prevMonth">
                                ‹
                            </button>

                            <button type="button" id="nextMonth">
                                ›
                            </button>

                        </div>

                    </div>


                    <div class="calendar-weekdays">
                        <span>Sen</span>
                        <span>Sel</span>
                        <span>Rab</span>
                        <span>Kam</span>
                        <span>Jum</span>
                        <span>Sab</span>
                        <span>Min</span>
                    </div>


                    <div
                        class="mini-calendar-days"
                        id="miniCalendarDays"
                    ></div>

                    
                    <div class="calendar-info">

                        <div class="calendar-info-item">
                            <span class="calendar-info-dot available"></span>
                            <span>
                                Masih tersedia
                            </span>
                        </div>

                        <div class="calendar-info-item">
                            <span class="calendar-info-dot booked"></span>
                            <span>
                                Sudah dipesan
                            </span>
                        </div>

                    </div>

                </aside>


                {{-- MAIN SCHEDULE --}}
                <div class="schedule-area">

                    <div class="schedule-navigation">

                        <div class="schedule-time-spacer">
                            <button
                                type="button"
                                class="schedule-arrow"
                                id="previousWeek"
                            >
                                ‹
                            </button>
                        </div>

                        <div
                            class="schedule-days"
                            id="scheduleDays"
                        >
                        </div>

                        <div class="schedule-next-spacer">
                            <button
                                type="button"
                                class="schedule-arrow"
                                id="nextWeek"
                            >
                                ›
                            </button>
                        </div>

                    </div>


                    <div class="schedule-content">

                        <div class="schedule-grid">

                            {{-- KOLOM WAKTU --}}
                            <div class="time-column">
                                <div class="time-column-header"></div>

                                <div class="time-slot">07:30</div>
                                <div class="time-slot">08:00</div>
                                <div class="time-slot">08:30</div>
                                <div class="time-slot">09:00</div>
                                <div class="time-slot">09:30</div>
                                <div class="time-slot">10:00</div>
                                <div class="time-slot">10:30</div>
                                <div class="time-slot">11:00</div>
                                <div class="time-slot">11:30</div>
                                <div class="time-slot">12:00</div>
                                <div class="time-slot">12:30</div>
                                <div class="time-slot">13:00</div>
                                <div class="time-slot">13:30</div>
                                <div class="time-slot">14:00</div>
                                <div class="time-slot">14:30</div>
                                <div class="time-slot">15:00</div>
                                <div class="time-slot">15:30</div>
                                <div class="time-slot">16:00</div>
                                <div class="time-slot">16:30</div>
                                <div class="time-slot">17:00</div>
                                <div class="time-slot">17:30</div>
                                <div class="time-slot">18:00</div>
                                <div class="time-slot">18:30</div>
                                <div class="time-slot">19:00</div>
                                <div class="time-slot">19:30</div>
                            </div>


                            {{-- KOLOM HARI --}}
                            <div
                                class="day-columns"
                                id="dayColumns"
                            >
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection