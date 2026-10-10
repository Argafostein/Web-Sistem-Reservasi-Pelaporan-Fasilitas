@extends('layouts.app')

@push('styles')
    @vite('resources/css/riwayat-reservasi.css')
    @vite('resources/css/riwayat.css')
@endpush

@push('scripts')
    @vite('resources/js/riwayat-reservasi.js')
@endpush

@section('content')

<section class="history-section">
    <div class="history-container">

        {{-- Header --}}
        <div class="history-header">
            <div>
                <h1>Riwayat Petugas</h1>
                <p>
                    Lihat riwayat reservasi dan laporan
                    yang telah diproses oleh petugas.
                </p>
            </div>
        </div>

        {{-- Navigasi Riwayat --}}
        <div class="history-tabs">

            <a
                href="{{ route('petugas.riwayat', ['type' => 'reservasi']) }}"
                class="history-tab {{ request('type', 'reservasi') === 'reservasi' ? 'active' : '' }}"
            >
                Riwayat Reservasi
            </a>

            <a
                href="{{ route('petugas.riwayat', ['type' => 'laporan']) }}"
                class="history-tab {{ request('type') === 'laporan' ? 'active' : '' }}"
            >
                Riwayat Laporan
            </a>

        </div>

        {{-- Konten Riwayat Reservasi --}}
        @if (request('type', 'reservasi') === 'reservasi')

            @if ($reservations->isEmpty())

                <div class="empty-history">
                    <div class="empty-icon">📅</div>

                    <h2>Belum Ada Riwayat Reservasi</h2>

                    <p>
                        Belum ada reservasi yang selesai diproses
                        oleh petugas.
                    </p>
                </div>

            @else

                <div class="reservation-list">

                    @foreach ($reservations as $reservation)

                        <div class="reservation-history-card">

                            {{-- Header Card --}}
                            <div
                                class="reservation-card-header"
                                onclick="toggleReservationDetail(this)"
                            >
                                <div class="facility-name">
                                    <div>
                                        <h2>
                                            {{ $reservation->facility->name ?? 'Fasilitas' }}
                                        </h2>

                                        <span>
                                            {{ $reservation->facility->location ?? 'Lokasi tidak tersedia' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="reservation-status">

                                    @if ($reservation->status === 'approved')
                                        <span class="status approved">
                                            Disetujui
                                        </span>
                                    @elseif ($reservation->status === 'rejected')
                                        <span class="status rejected">
                                            Ditolak
                                        </span>
                                    @elseif ($reservation->status === 'cancelled')
                                        <span class="status cancelled">
                                            Dibatalkan
                                        </span>
                                    @else
                                        <span class="status completed">
                                            Selesai
                                        </span>
                                    @endif

                                </div>
                            </div>

                            {{-- Detail Reservasi --}}
                            <div class="reservation-details">

                                <div class="detail-item">
                                    <span class="detail-label">
                                        Pemesan
                                    </span>

                                    <span class="detail-value">
                                        {{ $reservation->user->name ?? 'Pengguna tidak tersedia' }}
                                    </span>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">
                                        Tanggal
                                    </span>

                                    <span class="detail-value">
                                        {{ \Carbon\Carbon::parse($reservation->reservation_date)->translatedFormat('d F Y') }}
                                    </span>
                                </div>

                                <div class="detail-item">
                                    <span class="detail-label">
                                        Waktu
                                    </span>

                                    <span class="detail-value">
                                        {{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}
                                    </span>
                                </div>

                                @if ($reservation->purpose)
                                    <div class="detail-item detail-purpose">
                                        <span class="detail-label">
                                            Keperluan
                                        </span>

                                        <span class="detail-value">
                                            {{ $reservation->purpose }}
                                        </span>
                                    </div>
                                @endif

                                {{-- Informasi Tindakan Petugas --}}
                                @php
                                    $latestLog = $reservation->logs->first();
                                @endphp

                                @if ($latestLog)
                                    <div class="reservation-log-info">

                                        <h4>
                                            @if ($latestLog->action === 'approved')
                                                Informasi Persetujuan
                                            @elseif ($latestLog->action === 'rejected')
                                                Alasan Penolakan
                                            @else
                                                Informasi Pembatalan
                                            @endif
                                        </h4>

                                        @if ($latestLog->reason)
                                            <p>{{ $latestLog->reason }}</p>
                                        @elseif ($latestLog->action === 'approved')
                                            <p>Reservasi telah disetujui oleh petugas.</p>
                                        @endif

                                        @if ($latestLog->user)
                                            <small>
                                                Petugas:
                                                {{ $latestLog->user->name }}
                                            </small>
                                        @endif

                                        <small>
                                            Waktu tindakan:
                                            {{ $latestLog->created_at->format('d-m-Y H:i') }}
                                        </small>

                                    </div>
                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        @else

            {{-- Konten Riwayat Laporan akan dihubungkan
                 setelah query dan status laporan disesuaikan. --}}
            <div class="empty-history">
                <div class="empty-icon">📋</div>

                <h2>Riwayat Laporan</h2>

                <p>
                    Bagian ini akan menampilkan laporan
                    yang telah diproses oleh petugas.
                </p>
            </div>

        @endif

    </div>
</section>

@endsection