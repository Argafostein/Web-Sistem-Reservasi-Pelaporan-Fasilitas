@extends('layouts.app')

@push('styles')
    @vite('resources/css/reservasi.css')
@endpush

@push('scripts')
    @vite('resources/js/reservasi.js')
@endpush

@section('content')

@if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

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

        {{-- Informasi --}}

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


        {{-- Form --}}

        <form method="POST" action="{{ route('reservasi.store') }}" onsubmit="return validateReservationTime()">
            @csrf

            <div class="form-row">

                {{-- Fasilitas --}}

                <div class="form-group">

                    <label for="fasilitas">
                        Fasilitas
                    </label>

                    <select id="fasilitas" name="facility_id" required>

                        <option value="">
                            Pilih fasilitas
                        </option>

                        @foreach ($facilities as $facility)

                            <option
                                value="{{ $facility->facility_id }}"
                                {{ old('facility_id') == $facility->facility_id ? 'selected' : '' }}
                            >
                                {{ $facility->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('facility_id')
                        <small class="error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Tanggal --}}

                <div class="form-group">

                    <label for="tanggal">
                        Tanggal
                    </label>

                    <input
                        type="text"
                        id="tanggal"
                        placeholder="Pilih tanggal"
                        name="reservation_date"
                        value="{{ old('reservation_date') }}"
                        
                        required
                    >

                    @error('reservation_date')
                        <small class="error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

            </div>


            {{-- Waktu Mulai & Selesai --}}

            <div class="form-row">

                {{-- Waktu Mulai --}}

                <div 
                    class="form-group"
                    x-data="timePicker('{{ old('start_time', '') }}')"
                >

                    <label>
                        Waktu Mulai
                    </label>

                    <input
                        type="text"
                        name="start_time"
                        x-model="timeString"
                        class="main-time-input"
                        @click="open = !open"
                        readonly
                        required
                        placeholder="Pilih waktu mulai"
                    >

                    <div
                        class="time-picker-card"
                        x-show="open"
                        @click.outside="open = false"
                        style="display: none;"
                    >

                        <div class="time-picker-title">
                            Enter time
                        </div>

                        <div class="time-picker-boxes">

                            <div
                                class="time-box-wrapper"
                                :class="{ 'active': activeTab === 'hour' }"
                                @click="activeTab = 'hour'"
                            >

                                <button
                                    type="button"
                                    class="time-arrow"
                                    @click.stop="adjustHour(1)"
                                >
                                    ▲
                                </button>

                                <span
                                    class="time-number"
                                    x-text="pad(hour)"
                                ></span>

                                <button
                                    type="button"
                                    class="time-arrow"
                                    @click.stop="adjustHour(-1)"
                                >
                                    ▼
                                </button>

                            </div>

                            <span class="time-separator">
                                :
                            </span>

                            <div
                                class="time-box-wrapper"
                                :class="{ 'active': activeTab === 'minute' }"
                                @click="activeTab = 'minute'"
                            >

                                <button
                                    type="button"
                                    class="time-arrow"
                                    @click.stop="adjustMinute()"
                                >
                                    ▲
                                </button>

                                <span
                                    class="time-number"
                                    x-text="pad(minute)"
                                ></span>

                                <button
                                    type="button"
                                    class="time-arrow"
                                    @click.stop="adjustMinute()"
                                >
                                    ▼
                                </button>

                            </div>

                        </div>

                        <div class="time-actions">

                            <button
                                type="button"
                                class="time-action-btn"
                                @click="setPreset(9, 0)"
                            >
                                09:00
                            </button>

                            <button
                                type="button"
                                class="time-action-btn"
                                @click="setPreset(12, 0)"
                            >
                                12:00
                            </button>

                            <button
                                type="button"
                                class="time-action-btn"
                                @click="setPreset(15, 0)"
                            >
                                15:00
                            </button>

                            <button
                                type="button"
                                class="time-action-btn"
                                @click="setPreset(18, 0)"
                            >
                                18:00
                            </button>

                        </div>

                    </div>

                    @error('start_time')
                        <small class="error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Waktu Selesai --}}

                <div
                    class="form-group"
                    x-data="timePicker('{{ old('end_time', '20:00') }}', true)"
                >

                    <label>
                        Waktu Selesai
                    </label>

                    <input
                        type="text"
                        name="end_time"
                        x-model="timeString"
                        class="main-time-input"
                        @click="open = !open"
                        readonly
                        required
                        placeholder="Pilih waktu selesai"
                    >

                    <div
                        class="time-picker-card"
                        x-show="open"
                        @click.outside="open = false"
                        style="display: none;"
                    >

                        <div class="time-picker-title">
                            Enter time
                        </div>

                        <div class="time-picker-boxes">

                            <div
                                class="time-box-wrapper"
                                :class="{ 'active': activeTab === 'hour' }"
                                @click="activeTab = 'hour'"
                            >

                                <button
                                    type="button"
                                    class="time-arrow"
                                    @click.stop="adjustHour(1)"
                                >
                                    ▲
                                </button>

                                <span
                                    class="time-number"
                                    x-text="pad(hour)"
                                ></span>

                                <button
                                    type="button"
                                    class="time-arrow"
                                    @click.stop="adjustHour(-1)"
                                >
                                    ▼
                                </button>

                            </div>

                            <span class="time-separator">
                                :
                            </span>

                            <div
                                class="time-box-wrapper"
                                :class="{ 'active': activeTab === 'minute' }"
                                @click="activeTab = 'minute'"
                            >

                                <button
                                    type="button"
                                    class="time-arrow"
                                    @click.stop="adjustMinute()"
                                >
                                    ▲
                                </button>

                                <span
                                    class="time-number"
                                    x-text="pad(minute)"
                                ></span>

                                <button
                                    type="button"
                                    class="time-arrow"
                                    @click.stop="adjustMinute()"
                                >
                                    ▼
                                </button>

                            </div>

                        </div>

                        <div class="time-actions">

                            <button
                                type="button"
                                class="time-action-btn"
                                @click="setPreset(9, 0)"
                            >
                                09:00
                            </button>

                            <button
                                type="button"
                                class="time-action-btn"
                                @click="setPreset(12, 0)"
                            >
                                12:00
                            </button>

                            <button
                                type="button"
                                class="time-action-btn"
                                @click="setPreset(15, 0)"
                            >
                                15:00
                            </button>

                            <button
                                type="button"
                                class="time-action-btn"
                                @click="setPreset(18, 0)"
                            >
                                18:00
                            </button>
                        </div>

                    </div>

                    <small
                        class="time-error"
                        x-show="error"
                        x-text="error"
                    ></small>

                    @error('end_time')
                        <small class="error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

            </div>


            {{-- Tujuan --}}

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
                >{{ old('purpose') }}</textarea>

                @error('purpose')
                    <small class="error">
                        {{ $message }}
                    </small>
                @enderror

                <small>
                    Jelaskan secara singkat tujuan penggunaan fasilitas.
                </small>

            </div>


            {{-- Submit --}}

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

@endsection