@extends('layouts.app')

@push('styles')
    @vite('resources/css/riwayat-laporan.css')
    @vite('resources/css/riwayat.css')
@endpush

@section('content')

<section class="history-section">

    <div class="history-container">

        {{-- Header --}}
        <div class="history-header">

            <div>
                <h1>
                    Riwayat Laporan
                </h1>

                <p>
                    Lihat riwayat dan status laporan fasilitas Anda.
                </p>
            </div>

        </div>


        {{-- Navigasi Riwayat --}}
        <div class="history-tabs">

            <a
                href="{{ route('riwayat-reservasi') }}"
                class="history-tab"
            >
                Riwayat Reservasi
            </a>

            <a
                href="{{ route('riwayat-laporan') }}"
                class="history-tab active"
            >
                Riwayat Laporan
            </a>

        </div>


        {{-- Daftar Laporan --}}
        <div class="report-list">

            @forelse ($reports as $report)

                <div class="report-card">

                    <div class="report-card-content">

                        <div class="report-info">

                            <span class="report-category">
                                {{ $report->category }}
                            </span>

                            <h3>
                                {{ $report->title }}
                            </h3>

                            <p class="report-facility">
                                {{ $report->facility->name ?? 'Fasilitas tidak ditemukan' }}
                            </p>

                            <p class="report-date">
                                Dilaporkan pada
                                {{ $report->created_at->format('d M Y, H:i') }}
                            </p>

                        </div>


                        {{-- Status --}}
                        <div class="report-status">

                            @if ($report->status === 'pending')

                                <span class="status-badge status-pending">
                                    Menunggu
                                </span>

                            @elseif ($report->status === 'process')

                                <span class="status-badge status-process">
                                    Diproses
                                </span>

                            @elseif ($report->status === 'resolved')

                                <span class="status-badge status-resolved">
                                    Selesai
                                </span>

                            @elseif ($report->status === 'rejected')

                                <span class="status-badge status-rejected">
                                    Ditolak
                                </span>

                            @else

                                <span class="status-badge">
                                    {{ ucfirst($report->status) }}
                                </span>

                            @endif

                        </div>

                    </div>
                </div>

            @empty

                <div class="empty-history">

                    <div class="empty-icon">
                        !
                    </div>

                    <h3>
                        Belum Ada Laporan
                    </h3>

                    <p>
                        Anda belum pernah mengirim laporan fasilitas.
                    </p>

                    <a
                        href="{{ route('lapor') }}"
                        class="empty-action"
                    >
                        Buat Laporan
                    </a>

                </div>

            @endforelse

        </div>

    </div>

</section>
@endsection
