@extends('layouts.app')

@push('styles')
    @vite('resources/css/detail-laporan.css')
@endpush

@section('content')

<section class="report-detail-section">

    <div class="report-detail-container">

        {{-- HEADER --}}
        <div class="report-detail-header">

            <div>

                <span class="report-detail-label">
                    DETAIL LAPORAN
                </span>

                <h1>
                    {{ $report->title }}
                </h1>

                <p>
                    {{ $report->facility->name ?? 'Fasilitas tidak ditemukan' }}
                </p>

            </div>


            {{-- STATUS --}}
            <div class="report-detail-status">

                @if ($report->status === 'pending')

                    <span class="status-badge status-pending">
                        Baru
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


        {{-- INFORMASI LAPORAN --}}
        <div class="report-information">

            {{-- ID LAPORAN --}}
            <div class="information-item">

                <span class="information-label">
                    ID Laporan
                </span>

                <span class="information-value">
                    #{{ $report->getKey() }}
                </span>

            </div>


            {{-- KATEGORI --}}
            <div class="information-item">

                <span class="information-label">
                    Kategori
                </span>

                <span class="information-value">
                    {{ $report->category }}
                </span>

            </div>


            {{-- FASILITAS --}}
            <div class="information-item">

                <span class="information-label">
                    Fasilitas
                </span>

                <span class="information-value">
                    {{ $report->facility->name ?? '-' }}
                </span>

            </div>


            {{-- TANGGAL DILAPORKAN --}}
            <div class="information-item">

                <span class="information-label">
                    Dilaporkan
                </span>

                <span class="information-value">
                    {{ $report->created_at->format('d M Y, H:i') }}
                </span>

            </div>


            {{-- DESKRIPSI --}}
            <div class="information-item information-full">

                <span class="information-label">
                    Deskripsi
                </span>

                <span class="information-value description">
                    {{ $report->description }}
                </span>

            </div>

        </div>


        {{-- FOTO LAPORAN --}}
        @if ($report->image)

            <div class="report-image-card">

                <h2>
                    Foto Laporan
                </h2>

                <div class="report-image-wrapper">

                    <img
                        src="{{ asset('storage/' . $report->image) }}"
                        alt="Foto laporan {{ $report->getKey() }}"
                        class="report-image"
                    >

                </div>

            </div>

        @endif


        {{-- TIMELINE --}}
        <div class="report-timeline-card">

            <h2>
                Status Laporan
            </h2>

            <div class="report-timeline">


                {{-- =========================================
                     1. DILAPORKAN
                ========================================= --}}
                <div class="timeline-item completed">

                    <div class="timeline-marker">
                        ✓
                    </div>

                    <div class="timeline-content">

                        <h3>
                            Dilaporkan
                        </h3>

                        <p>
                            Laporan berhasil dikirim.
                        </p>

                        <span class="timeline-time">
                            {{ $report->created_at->format('d M Y, H:i') }}
                        </span>

                    </div>

                </div>


                {{-- =========================================
                     2. DIPROSES
                     HANYA MUNCUL JIKA SUDAH DIPROSES
                ========================================= --}}
                @if (
                    $report->processed_at ||
                    in_array($report->status, ['diproses', 'selesai', 'ditolak'])
                )

                    <div class="timeline-item completed">

                        <div class="timeline-marker">
                            ✓
                        </div>

                        <div class="timeline-content">

                            <h3>
                                Diproses
                            </h3>

                            <p>
                                Laporan sedang ditangani oleh petugas.
                            </p>

                            @if ($report->processed_at)

                                <span class="timeline-time">
                                    {{ $report->processed_at->format('d M Y, H:i') }}
                                </span>

                            @endif

                        </div>

                    </div>

                @endif


                {{-- =========================================
                     3. SELESAI
                     HANYA MUNCUL JIKA SELESAI
                ========================================= --}}
                @if ($report->status === 'selesai' && $report->resolved_at)

                    <div class="timeline-item completed">

                        <div class="timeline-marker">
                            ✓
                        </div>

                        <div class="timeline-content">

                            <h3>
                                Selesai
                            </h3>

                            <p>
                                Laporan telah selesai ditangani.
                            </p>

                            <span class="timeline-time">
                                {{ $report->resolved_at->format('d M Y, H:i') }}
                            </span>

                        </div>

                    </div>

                @endif


                {{-- =========================================
                     4. DITOLAK
                     HANYA MUNCUL JIKA DITOLAK
                ========================================= --}}
                @if ($report->status === 'ditolak' && $report->rejected_at)

                    <div class="timeline-item rejected">

                        <div class="timeline-marker">
                            ×
                        </div>

                        <div class="timeline-content">

                            <h3>
                                Ditolak
                            </h3>

                            <p>
                                Laporan ditolak oleh petugas.
                            </p>

                            <span class="timeline-time">
                                {{ $report->rejected_at->format('d M Y, H:i') }}
                            </span>

                        </div>

                    </div>

                @endif

            </div>

        </div>


        {{-- =========================================
             CATATAN RESOLUSI
        ========================================= --}}
        @if (
            in_array($report->status, ['selesai', 'ditolak'])
            && $report->resolution_note
        )

            <div class="resolution-card">

                <h2>
                    Catatan Resolusi
                </h2>

                <p>
                    {{ $report->resolution_note }}
                </p>

            </div>

        @endif


        {{-- KEMBALI --}}
        <div class="report-detail-footer">

            <a
                href="{{ route('riwayat-laporan') }}"
                class="back-button"
            >
                ← Kembali ke Riwayat Laporan
            </a>

        </div>

    </div>

</section>

@endsection