
@extends('layouts.app')

@push('styles')
    @vite('resources/css/petugas/riwayat-reservasi.css')
    @vite('resources/css/riwayat.css')
    @vite('resources/css/petugas/antrian.css')
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
                <h1>Riwayat Laporan</h1>
                <p>
                    Lihat laporan fasilitas kampus yang telah diproses
                    oleh petugas.
                </p>
            </div>
        </div>

        {{-- Navigasi --}}
        <div class="history-tabs">
            <a
                href="{{ route('petugas.riwayat.reservasi') }}"
                class="history-tab"
            >
                Riwayat Reservasi
            </a>

            <a
                href="{{ route('petugas.riwayat.laporan') }}"
                class="history-tab active"
            >
                Riwayat Laporan
            </a>
        </div>

        @if ($reports->isEmpty())

            <div class="empty-history">
                <div class="empty-icon">📋</div>
                <h2>Belum Ada Riwayat Laporan</h2>
                <p>
                    Belum ada laporan yang selesai diproses
                    atau ditolak oleh petugas.
                </p>
            </div>

        @else

            <div class="petugas-antrian-report-list">

                @foreach ($reports as $report)

                    <article class="petugas-antrian-report-card">

                        <div class="petugas-antrian-report-info">

                            <span class="petugas-report-status {{ $report->status }}">
                                @if ($report->status === 'resolved')
                                    SELESAI
                                @elseif ($report->status === 'rejected')
                                    DITOLAK
                                @else
                                    {{ strtoupper($report->status) }}
                                @endif
                            </span>

                            <h3>{{ $report->title }}</h3>

                            <div class="petugas-antrian-report-details">

                                <p>
                                    <span>Pelapor</span>
                                    <strong>
                                        {{ $report->user->name ?? '-' }}
                                    </strong>
                                </p>

                                <p>
                                    <span>Fasilitas</span>
                                    <strong>
                                        {{ $report->facility->name ?? '-' }}
                                    </strong>
                                </p>

                                <p>
                                    <span>Kategori</span>
                                    <strong>{{ $report->category }}</strong>
                                </p>

                                <p>
                                    <span>Tanggal laporan</span>
                                    <strong>
                                        {{ $report->created_at?->format('d/m/Y H:i') ?? '-' }}
                                    </strong>
                                </p>

                                @if ($report->processed_at)
                                    <p>
                                        <span>Mulai ditangani</span>
                                        <strong>
                                            {{ $report->processed_at->format('d/m/Y H:i') }}
                                        </strong>
                                    </p>
                                @endif

                                @if ($report->resolved_at)
                                    <p>
                                        <span>Selesai ditangani</span>
                                        <strong>
                                            {{ $report->resolved_at->format('d/m/Y H:i') }}
                                        </strong>
                                    </p>
                                @endif

                                @if ($report->rejected_at)
                                    <p>
                                        <span>Ditolak pada</span>
                                        <strong>
                                            {{ $report->rejected_at->format('d/m/Y H:i') }}
                                        </strong>
                                    </p>
                                @endif

                            </div>

                            <div class="petugas-antrian-report-description">
                                <strong>Deskripsi Kerusakan</strong>
                                <p>{{ $report->description }}</p>
                            </div>

                            @if ($report->image)
                                <div class="petugas-antrian-report-image">
                                    <strong>Foto Kerusakan</strong>
                                    <p>
                                        <a
                                            href="{{ asset('storage/' . $report->image) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            Lihat Foto Laporan
                                        </a>
                                    </p>
                                </div>
                            @endif

                            @if ($report->resolution_note)
                                <div class="petugas-report-history-note">
                                    <strong>Catatan Petugas</strong>
                                    <p>{{ $report->resolution_note }}</p>
                                </div>
                            @endif

                        </div>

                        {{-- Riwayat perubahan status --}}
                        @if ($report->logs->isNotEmpty())
                            <div class="petugas-report-history">
                                <h4>Riwayat Laporan</h4>

                                <div class="petugas-report-history-list">

                                    @foreach ($report->logs as $log)
                                        <div class="petugas-report-history-item">

                                            <strong>
                                                @if ($log->action === 'submitted')
                                                    Laporan Dibuat
                                                @else
                                                    Status Diperbarui
                                                @endif
                                            </strong>

                                            <p>
                                                Status:
                                                {{ $log->old_status
                                                    ? ucfirst(str_replace('_', ' ', $log->old_status))
                                                    : '—' }}
                                                →
                                                {{ ucfirst(str_replace('_', ' ', $log->new_status)) }}
                                            </p>

                                            <p>
                                                Oleh:
                                                {{ $log->user->name ?? 'Pengguna tidak tersedia' }}
                                            </p>

                                            <small>
                                                {{ $log->created_at?->format('d/m/Y H:i') ?? '-' }}
                                            </small>

                                            @if ($log->note)
                                                <p class="petugas-report-history-note">
                                                    Catatan: {{ $log->note }}
                                                </p>
                                            @endif

                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endif

                    </article>

                @endforeach

            </div>

        @endif

    </div>
</section>

@endsection
