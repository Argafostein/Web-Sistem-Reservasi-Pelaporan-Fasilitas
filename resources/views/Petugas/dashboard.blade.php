@extends('layouts.app')

@push('styles')
    @vite('resources/css/petugas/dashboard.css')
@endpush

@section('content')

<div class="petugas-page">

    <div class="petugas-container">

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

                                <button type="button"
                                        class="petugas-button approve">
                                    Setujui
                                </button>

                                <button type="button"
                                        class="petugas-button reject">
                                    Tolak
                                </button>

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>

    </div>

</div>

@endsection