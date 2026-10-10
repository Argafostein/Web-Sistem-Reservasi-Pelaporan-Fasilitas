
@extends('layouts.app')

@push('styles')
    @vite('resources/css/petugas/riwayat-reservasi.css')
    @vite('resources/css/riwayat.css')
@endpush

@push('scripts')
    @vite('resources/js/petugas/riwayat-reservasi.js')
@endpush

@section('content')

<section class="history-section">
    <div class="history-container">

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
        <div class="history-header">
            <div>
                <h1>Riwayat Reservasi</h1>
                <p>
                    Lihat reservasi yang telah diproses oleh petugas.
                </p>
            </div>
        </div>

        {{-- Navigasi --}}
        <div class="history-tabs">
            <a
                href="{{ route('petugas.riwayat.reservasi') }}"
                class="history-tab active"
            >
                Riwayat Reservasi
            </a>

            <a
                href="{{ route('petugas.riwayat.laporan') }}"
                class="history-tab"
            >
                Riwayat Laporan
            </a>
        </div>

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
                                    <span class="status approved">Disetujui</span>
                                @elseif ($reservation->status === 'rejected')
                                    <span class="status rejected">Ditolak</span>
                                @elseif ($reservation->status === 'cancelled')
                                    <span class="status cancelled">Dibatalkan</span>
                                @else
                                    <span class="status completed">Selesai</span>
                                @endif
                            </div>
                        </div>

                        {{-- Detail Reservasi --}}
                        <div class="reservation-details">

                            <div class="detail-item">
                                <span class="detail-label">Pemesan</span>
                                <span class="detail-value">
                                    {{ $reservation->user->name ?? 'Pengguna tidak tersedia' }}
                                </span>
                            </div>

                            <div class="detail-item">
                                <span class="detail-label">Tanggal</span>
                                <span class="detail-value">
                                    {{ \Carbon\Carbon::parse($reservation->reservation_date)->translatedFormat('d F Y') }}
                                </span>
                            </div>

                            <div class="detail-item">
                                <span class="detail-label">Waktu</span>
                                <span class="detail-value">
                                    {{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}
                                </span>
                            </div>

                            @if ($reservation->purpose)
                                <div class="detail-item detail-purpose">
                                    <span class="detail-label">Keperluan</span>
                                    <span class="detail-value">
                                        {{ $reservation->purpose }}
                                    </span>
                                </div>
                            @endif

                            {{-- Informasi tindakan petugas --}}
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
                                        @elseif ($latestLog->action === 'cancelled')
                                            Alasan Pembatalan
                                        @else
                                            Informasi Tindakan
                                        @endif
                                    </h4>

                                    @if ($latestLog->reason)
                                        <p>{{ $latestLog->reason }}</p>
                                    @elseif ($latestLog->action === 'approved')
                                        <p>
                                            Reservasi telah disetujui oleh petugas.
                                        </p>
                                    @endif

                                    @if ($latestLog->user)
                                        <small>
                                            Dilakukan oleh:
                                            {{ $latestLog->user->name }}
                                        </small>
                                    @endif

                                    <small>
                                        Waktu tindakan:
                                        {{ $latestLog->created_at->format('d-m-Y H:i') }}
                                    </small>
                                </div>
                            @endif

                            {{-- Pembatalan darurat --}}
                            @if ($reservation->status === 'approved')
                                <div class="reservation-emergency-action">
                                    <button
                                        type="button"
                                        class="emergency-cancel-button"
                                        data-cancel-url="{{ route('petugas.reservasi.cancel', $reservation->reservation_id) }}"
                                        data-facility="{{ $reservation->facility->name ?? 'Fasilitas' }}"
                                    >
                                        Batalkan Reservasi
                                    </button>
                                </div>
                            @endif

                        </div>
                    </div>

                @endforeach

                {{-- Modal pembatalan darurat --}}
                <div id="emergencyCancelModal" class="emergency-modal">
                    <div class="emergency-modal-content">

                        <div class="emergency-modal-header">
                            <div>
                                <span class="emergency-modal-label">
                                    TINDAKAN DARURAT
                                </span>

                                <h3>Batalkan Reservasi</h3>

                                <p id="emergencyFacilityName">
                                    Reservasi yang dipilih
                                </p>
                            </div>

                            <button
                                type="button"
                                class="emergency-modal-close"
                                aria-label="Tutup"
                            >
                                &times;
                            </button>
                        </div>

                        <form id="emergencyCancelForm" method="POST">
                            @csrf

                            <div class="emergency-form-group">
                                <label for="emergencyReason">
                                    Alasan Pembatalan <span>*</span>
                                </label>

                                <textarea
                                    id="emergencyReason"
                                    name="reason"
                                    rows="4"
                                    maxlength="500"
                                    placeholder="Jelaskan alasan darurat pembatalan reservasi..."
                                    required
                                ></textarea>

                                <small>
                                    Wajib diisi, maksimal 500 karakter.
                                </small>
                            </div>

                            <div class="emergency-modal-actions">
                                <button
                                    type="button"
                                    class="emergency-cancel-close"
                                >
                                    Kembali
                                </button>

                                <button
                                    type="submit"
                                    class="emergency-cancel-submit"
                                >
                                    Konfirmasi Pembatalan
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

        @endif

    </div>
</section>

@endsection
