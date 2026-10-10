@extends('layouts.app')

@push('styles')
    @vite('resources/css/riwayat-laporan.css')
    @vite('resources/css/riwayat.css')
@endpush

@push('scripts')
    @vite('resources/js/riwayat-laporan.js')
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

                <div
                    class="report-card"
                    onclick="toggleReportDetail(this)"
                >

                    {{-- Header Card --}}
                    <div class="report-card-content">

                        <div class="report-info">

                            <p class="report-facility">
                                {{ $report->facility->name ?? 'Fasilitas tidak ditemukan' }}
                            </p>

                            <h3>
                                {{ $report->title }}
                            </h3>

                        </div>


                        {{-- Status --}}
                        <div class="report-status">

                            @if ($report->status === 'pending')

                                <span class="status-badge status-pending">
                                    Menunggu
                                </span>

                            @elseif ($report->status === 'processing')

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


                    {{-- Detail Laporan --}}
                    <div class="report-details">

                        <div class="report-detail-item">

                            <span class="report-detail-label">
                                Kategori
                            </span>

                            <span class="report-detail-value">
                                {{ $report->category }}
                            </span>

                        </div>


                        <div class="report-detail-item">

                            <span class="report-detail-label">
                                Dilaporkan pada
                            </span>

                            <span class="report-detail-value">
                                {{ $report->created_at->format('d M Y, H:i') }}
                            </span>

                        </div>


                        <div class="report-detail-item report-detail-description">

                            <span class="report-detail-label">
                                Deskripsi
                            </span>

                            <span class="report-detail-value">
                                {{ $report->description }}
                            </span>

                        </div>


                        {{-- Tombol Detail --}}
                        <div class="report-actions">

                            <a
                                href="{{ route('lapor.show', $report->getKey()) }}"
                                class="report-detail-button"
                                onclick="event.stopPropagation()"
                            >
                                Lihat Detail
                            </a>

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