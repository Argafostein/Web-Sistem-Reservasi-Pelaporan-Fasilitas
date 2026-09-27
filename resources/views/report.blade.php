@extends('layouts.app')

@push('styles')
    @vite('resources/css/report.css')
@endpush

@section('content')

@if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

    <section class="report-section">

        <div class="report-container">

            {{-- Header --}}
            <div class="report-header">

                <span class="report-label">
                    LAPORKAN MASALAH
                </span>

                <h1>
                    Buat Laporan
                </h1>

                <p>
                    Laporkan kerusakan atau masalah pada fasilitas kampus
                    agar dapat segera ditindaklanjuti.
                </p>

            </div>


            {{-- Form --}}
            <div class="report-card">

                <form method="POST"
                      action="{{ route('lapor.store') }}"
                      enctype="multipart/form-data">

                    @csrf


                    {{-- Fasilitas --}}
                    <div class="form-group">

                        <label for="facility_id">
                            Fasilitas
                        </label>

                        <select
                            id="facility_id"
                            name="facility_id"
                            required
                        >

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
                            <small class="error-message">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- Kategori --}}
                    <div class="form-group">

                        <label for="category">
                            Kategori Laporan
                        </label>

                        <select
                            id="category"
                            name="category"
                            required
                        >

                            <option value="">
                                Pilih kategori
                            </option>

                            <option value="Kerusakan fasilitas"
                                {{ old('category') == 'Kerusakan fasilitas' ? 'selected' : '' }}>
                                Kerusakan Fasilitas
                            </option>

                            <option value="Kebersihan"
                                {{ old('category') == 'Kebersihan' ? 'selected' : '' }}>
                                Kebersihan
                            </option>

                            <option value="Kelistrikan"
                                {{ old('category') == 'Kelistrikan' ? 'selected' : '' }}>
                                Kelistrikan
                            </option>

                            <option value="AC / Ventilasi"
                                {{ old('category') == 'AC / Ventilasi' ? 'selected' : '' }}>
                                AC / Ventilasi
                            </option>

                            <option value="Internet"
                                {{ old('category') == 'Internet' ? 'selected' : '' }}>
                                Internet
                            </option>

                            <option value="Lainnya"
                                {{ old('category') == 'Lainnya' ? 'selected' : '' }}>
                                Lainnya
                            </option>

                        </select>

                        @error('category')
                            <small class="error-message">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- Judul --}}
                    <div class="form-group">

                        <label for="title">
                            Judul Laporan
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Contoh: AC tidak menyala"
                            required
                        >

                        @error('title')
                            <small class="error-message">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- Deskripsi --}}
                    <div class="form-group">

                        <label for="description">
                            Deskripsi Masalah
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="6"
                            placeholder="Jelaskan masalah yang terjadi secara detail..."
                            required
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <small class="error-message">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- Foto --}}
                    <div class="form-group">

                        <label for="image">
                            Foto Bukti
                            <span class="optional">
                                (Opsional)
                            </span>
                        </label>

                        <div class="file-upload">

                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept="image/jpeg,image/png,image/jpg"
                            >

                            <div class="file-upload-text" id="upload-placeholder">
                                <span class="upload-icon">📷</span>

                                <span>
                                    Pilih foto masalah
                                </span>

                                <small>
                                    JPG, JPEG, atau PNG maksimal 2 MB
                                </small>
                            </div>

                            <div class="image-preview" id="image-preview">
                                <img id="preview-image" src="" alt="Preview gambar">

                                <button
                                    type="button"
                                    id="remove-image"
                                    class="remove-image"
                                >
                                    ×
                                </button>
                            </div>

                        </div>

                        @error('image')
                            <small class="error-message">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- Submit --}}
                    <div class="form-submit">

                        <button
                            type="submit"
                            class="submit-button"
                        >
                            Kirim Laporan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

@endsection

@push('scripts')
    @vite('resources/js/report.js')
@endpush