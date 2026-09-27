@extends('layouts.app')

@push('styles')
    @vite('resources/css/riwayat-reservasi.css')
@endpush

@section('content')

    <section class="history-section">

        <div class="history-container">

            {{-- Header --}}
            <div class="history-header">
                <div>
                    <span class="history-label">AKTIVITAS ANDA</span>

                    <h1>
                        Riwayat Reservasi
                    </h1>

                    <p>
                        Lihat daftar fasilitas yang pernah Anda reservasi.
                    </p>
                </div>
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
                            <div class="reservation-card-header">

                                <div class="facility-name">

                                    <div class="facility-icon">
                                        🏫
                                    </div>

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

                                    @elseif ($reservation->status === 'completed')

                                        <span class="status completed">
                                            Selesai
                                        </span>

                                    @else

                                        <span class="status pending">
                                            Menunggu
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

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>

    </section>

@endsection