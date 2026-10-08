@extends('layouts.app')

@push('styles')
    @vite('resources/css/petugas/dashboard.css')
@endpush

@push('scripts')
    @vite('resources/js/petugas/dashboard.js')
@endpush

@section('content')

<div class="petugas-page">

    <div class="petugas-container">

        @if (session('success'))
            <div class="petugas-alert success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="petugas-alert error">
                {{ session('error') }}
            </div>
        @endif

        <div class="petugas-header">
            <span class="petugas-label">OPERASIONAL PETUGAS</span>

            <h1>Dashboard Petugas</h1>

            <p>
                Kelola reservasi dan laporan fasilitas kampus.
            </p>
        </div>

        <div class="petugas-summary">

            <div class="summary-card">
                <span class="summary-label">
                    Reservasi Pending
                </span>

                <strong>
                    {{ $pendingReservations->count() }}
                </strong>
            </div>

            <div class="summary-card">
                <span class="summary-label">
                    Laporan Baru
                </span>

                <strong>0</strong>
            </div>

            <div class="summary-card">
                <span class="summary-label">
                    Dalam Perbaikan
                </span>

                <strong>0</strong>
            </div>

        </div>

        <div class="petugas-section">

            <div class="section-header">
                <div>
                    <h2>Antrean Reservasi</h2>

                    <p>
                        Reservasi yang menunggu persetujuan petugas.
                    </p>
                </div>
            </div>

            @if ($pendingReservations->isEmpty())

                <div class="petugas-empty">
                    Tidak ada reservasi yang menunggu persetujuan.
                </div>

            @else

                <div class="reservation-list">

                    @foreach ($pendingReservations as $reservation)

                        <div class="reservation-card">

                            <div class="reservation-info">

                                <span class="reservation-status">
                                    PENDING
                                </span>

                                <h3>
                                    {{ $reservation->facility->name }}
                                </h3>

                                <p>
                                    Pemohon:
                                    {{ $reservation->user->name }}
                                </p>

                                <p>
                                    Tanggal:
                                    {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') }}
                                </p>

                                <p>
                                    Waktu:
                                    {{ substr($reservation->start_time, 0, 5) }}
                                    -
                                    {{ substr($reservation->end_time, 0, 5) }}
                                </p>

                            </div>

                            <div class="reservation-actions">

                                <a href="#"
                                   class="petugas-button detail">
                                    Detail
                                </a>

                                <form action="{{ route('petugas.reservasi.approve', $reservation->reservation_id) }}"
                                    method="POST">
                                    @csrf

                                    <button type="submit"
                                            class="petugas-button approve"
                                            onclick="return confirm('Apakah Anda yakin ingin menyetujui reservasi ini?')">
                                        Setujui
                                    </button>
                                </form>

                                <button type="button"
                                        class="petugas-button reject reject-button"
                                        data-reservation-id="{{ $reservation->reservation_id }}">
                                    Tolak
                                </button>

                            </div>

                        </div>

                    @endforeach

                </div>
                {{-- Modal Tolak Reservasi --}}
                <div id="rejectModal" class="reject-modal">

                    <div class="reject-modal-content">

                        <div class="reject-modal-header">
                            <div>

                                <h3>Tolak Reservasi</h3>

                                <p>
                                    Berikan alasan mengapa reservasi ini ditolak.
                                </p>
                            </div>

                            <button type="button"
                                    class="reject-modal-close">
                                &times;
                            </button>
                        </div>

                        <form id="rejectForm" method="POST">
                            @csrf

                            <div class="reject-form-group">

                                <label for="rejection_reason">
                                    Alasan Penolakan
                                </label>

                                <textarea
                                    id="rejection_reason"
                                    name="rejection_reason"
                                    rows="4"
                                    placeholder="Masukkan alasan penolakan..."
                                    required
                                    maxlength="500"></textarea>

                                <span class="reject-form-hint">
                                    Maksimal 500 karakter.
                                </span>

                            </div>

                            <div class="reject-modal-actions">

                                <button type="button"
                                        class="petugas-button cancel"
                                        onclick="closeRejectModal()">
                                    Batal
                                </button>

                                <button type="submit"
                                        class="petugas-button reject-confirm">
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