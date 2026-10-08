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
                    <h1>
                        Riwayat Reservasi
                    </h1>
                    <p>
                        Anda bisa membatalkan reservasi sampai 1 jam setelah reservasi dibuat.
                    </p>
                </div>

            </div>


            {{-- Navigasi Riwayat --}}
            <div class="history-tabs">

                <a
                    href="{{ route('riwayat-reservasi') }}"
                    class="history-tab active"
                >
                    Riwayat Reservasi
                </a>

                <a
                    href="{{ route('riwayat-laporan') }}"
                    class="history-tab"
                >
                    Riwayat Laporan
                </a>

            </div>


            {{-- Pesan jika belum ada reservasi --}}
            @if ($reservations->isEmpty())

                <div class="empty-history">

                    <div class="empty-icon">
                        📅
                    </div>

                    <h2>
                        Belum Ada Reservasi
                    </h2>

                    <p>
                        Anda belum memiliki riwayat reservasi fasilitas kampus.
                    </p>

                    <a href="{{ route('reservasi') }}" class="history-button">
                        Buat Reservasi
                    </a>

                </div>

            @else

                {{-- Daftar Reservasi --}}
                <div class="reservation-list">

                    @foreach ($reservations as $reservation)

                        <div class="reservation-history-card">

                            {{-- Header Card --}}
                            <div class="reservation-card-header" onclick="toggleReservationDetail(this)">

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


                                {{-- Status --}}
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

                                    @elseif ($reservation->status === 'completed')

                                        <span class="status completed">
                                            Selesai
                                        </span>

                                    @else

                                        <span class="status pending">
                                            Menunggu Persetujuan
                                        </span>

                                    @endif

                                </div>

                            </div>


                            {{-- Detail Reservasi --}}
                            <div class="reservation-details">

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


                                <div class="detail-item">

                                    <span class="detail-label">
                                        Pemesan
                                    </span>

                                    <span class="detail-value">
                                        {{ auth()->user()->name }}
                                    </span>
                                </div>


                                @if (!empty($reservation->purpose))

                                    <div class="detail-item detail-purpose">

                                        <span class="detail-label">
                                            Keperluan
                                        </span>

                                        <span class="detail-value">
                                            {{ $reservation->purpose }}
                                        </span>

                                    </div>

                                @endif

                                @if (
                                    in_array($reservation->status, ['rejected', 'cancelled'])
                                    && !empty($reservation->reason)
                                )

                                    <div class="detail-item detail-reason">

                                        <span class="detail-label">
                                            Alasan:
                                        </span>

                                        <span class="detail-value reason-text">
                                            {{ $reservation->reason }}
                                        </span>

                                    </div>

                                @endif

                            </div>

                            @php
                                $cancelDeadline = $reservation->created_at->copy()->addHour();

                                $canCancel =
                                    now()->lessThanOrEqualTo($cancelDeadline)
                                    && !in_array($reservation->status, [
                                        'completed',
                                        'rejected',
                                        'cancelled'
                                    ]);
                            @endphp

                            @if ($canCancel)

                                <div class="reservation-actions">

                                    <form
                                        action="{{ route('reservasi.cancel', $reservation->getKey()) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="cancel-button"
                                        >
                                            Batalkan Reservasi
                                        </button>

                                    </form>

                                </div>

                            @endif
                        </div>

                    @endforeach

                </div>

            @endif

        </div>

    </section>

@endsection