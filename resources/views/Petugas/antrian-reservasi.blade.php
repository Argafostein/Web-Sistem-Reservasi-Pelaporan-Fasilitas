@extends('layouts.app')

@push('styles')
    @vite('resources/css/petugas/antrian.css')
@endpush

@push('scripts')
    @vite('resources/js/petugas/antrian.js')
@endpush

@section('content')
    <div class="petugas-antrian-page">
        <div class="petugas-antrian-container">

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="petugas-antrian-alert success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="petugas-antrian-alert error">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Header --}}
            <div class="petugas-antrian-header">
                <span class="petugas-antrian-eyebrow">
                    OPERASIONAL PETUGAS
                </span>

                <h1>Antrean Reservasi</h1>

                <p>
                    Kelola pengajuan reservasi fasilitas kampus.
                </p>
            </div>

            {{-- Navigasi --}}
            <div class="petugas-antrian-tabs">
                <a
                    href="{{ route('petugas.antrian.reservasi') }}"
                    class="petugas-antrian-tab active"
                >
                    Antrean Reservasi
                </a>

                <a
                    href="{{ route('petugas.antrian.laporan') }}"
                    class="petugas-antrian-tab"
                >
                    Antrean Laporan
                </a>
            </div>

            <div class="petugas-antrian-section">

                <div class="petugas-antrian-section-header">
                    <div>
                        <h2>Daftar Reservasi</h2>
                        <p>Reservasi yang menunggu persetujuan petugas.</p>
                    </div>

                    <span class="petugas-antrian-count">
                        {{ $pendingReservations->count() }} antrean
                    </span>
                </div>

                @if ($pendingReservations->isEmpty())

                    <div class="petugas-antrian-empty">
                        <div class="petugas-antrian-empty-icon">📋</div>
                        <h3>Tidak Ada Antrean Reservasi</h3>
                        <p>Belum ada reservasi yang menunggu persetujuan.</p>
                    </div>

                @else

                    <div class="petugas-antrian-reservation-list">

                        @foreach ($pendingReservations as $reservation)

                            <div class="petugas-antrian-reservation-card">

                                <div class="petugas-antrian-reservation-info">

                                    <span class="petugas-antrian-status">
                                        PENDING
                                    </span>

                                    <h3>
                                        {{ $reservation->facility->name ?? 'Fasilitas' }}
                                    </h3>

                                    <div class="petugas-antrian-reservation-details">

                                        <p>
                                            <span>Pemohon</span>
                                            <strong>{{ $reservation->user->name ?? '-' }}</strong>
                                        </p>

                                        <p>
                                            <span>Tanggal</span>
                                            <strong>
                                                {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') }}
                                            </strong>
                                        </p>

                                        <p>
                                            <span>Waktu</span>
                                            <strong>
                                                {{ substr($reservation->start_time, 0, 5) }}
                                                –
                                                {{ substr($reservation->end_time, 0, 5) }}
                                            </strong>
                                        </p>

                                        <p>
                                            <span>Keperluan</span>
                                            <strong>{{ $reservation->purpose ?? '-' }}</strong>
                                        </p>

                                    </div>
                                </div>

                                <div class="petugas-antrian-actions">

                                    <a
                                        href="{{ route('petugas.dashboard') }}"
                                        class="petugas-antrian-button detail"
                                    >
                                        Detail
                                    </a>

                                    <form
                                        action="{{ route('petugas.reservasi.approve', $reservation->reservation_id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menyetujui reservasi ini?')"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="petugas-antrian-button approve"
                                        >
                                            Setujui
                                        </button>
                                    </form>

                                    <button
                                        type="button"
                                        class="petugas-antrian-button reject reject-button"
                                        data-reservation-id="{{ $reservation->reservation_id }}"
                                    >
                                        Tolak
                                    </button>

                                </div>
                            </div>

                        @endforeach

                    </div>

                    {{-- Modal penolakan --}}
                    <div id="rejectModal" class="reject-modal">
                        <div class="reject-modal-content">

                            <div class="reject-modal-header">
                                <div>
                                    <h3>Tolak Reservasi</h3>
                                    <p>Berikan alasan mengapa reservasi ini ditolak.</p>
                                </div>

                                <button
                                    type="button"
                                    class="reject-modal-close"
                                    aria-label="Tutup"
                                >
                                    &times;
                                </button>
                            </div>

                            <form id="rejectForm" method="POST">
                                @csrf

                                <div class="reject-form-group">
                                    <label for="reason">Alasan Penolakan</label>

                                    <textarea
                                        id="reason"
                                        name="reason"
                                        rows="4"
                                        placeholder="Masukkan alasan penolakan..."
                                        required
                                        maxlength="500"
                                    ></textarea>

                                    <span class="reject-form-hint">
                                        Maksimal 500 karakter.
                                    </span>
                                </div>

                                <div class="reject-modal-actions">
                                    <button
                                        type="button"
                                        class="petugas-antrian-button cancel"
                                    >
                                        Batal
                                    </button>

                                    <button
                                        type="submit"
                                        class="petugas-antrian-button reject-confirm"
                                    >
                                        Tolak Reservasi
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>

                @endif
            </div>

        </div>
    </div>
@endsection