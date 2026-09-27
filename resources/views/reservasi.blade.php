@extends('layouts.app')

@push('styles')
    @vite('resources/css/reservasi.css')
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
                            <option value="{{ $facility->facility_id }}" {{ old('facility_id') == $facility->facility_id ? 'selected' : '' }}>
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
                        value="{{ old('reservation_date') }}"
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

@endsection
