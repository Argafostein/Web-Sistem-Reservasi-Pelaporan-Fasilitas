@extends('layouts.app')

@push('styles')
    @vite('resources/css/petugas/antrian.css')
@endpush

@push('scripts')
    @vite('resources/js/petugas/antrian.js')
@endpush

@section('content')
    <div class="petugas-antrian-page">
        <div class="petugas-antrian-container">

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
            <div class="petugas-antrian-header">
                <span class="petugas-antrian-eyebrow">
                    OPERASIONAL PETUGAS
                </span>

                <h1>Antrean Laporan</h1>

                <p>
                    Periksa laporan kerusakan dan perbarui status penanganannya.
                </p>
            </div>

            {{-- Navigasi --}}
            <div class="petugas-antrian-tabs">
                <a
                    href="{{ route('petugas.antrian.reservasi') }}"
                    class="petugas-antrian-tab"
                >
                    Antrean Reservasi
                </a>

                <a
                    href="{{ route('petugas.antrian.laporan') }}"
                    class="petugas-antrian-tab active"
                >
                    Antrean Laporan
                </a>
            </div>

            <div class="petugas-antrian-section">

                <div class="petugas-antrian-section-header">
                    <div>
                        <h2>Daftar Laporan</h2>
                        <p>
                            Periksa laporan baru dan laporan yang sedang diproses.
                        </p>
                    </div>

                    <span class="petugas-antrian-count">
                        {{ $activeReports->count() }} antrean
                    </span>
                </div>

                @if ($activeReports->isEmpty())

                    <div class="petugas-antrian-empty">
                        <div class="petugas-antrian-empty-icon">📄</div>
                        <h3>Tidak Ada Antrean Laporan</h3>
                        <p>
                            Belum ada laporan baru atau laporan yang sedang diproses.
                        </p>
                    </div>

                @else

                    <div class="petugas-antrian-report-list">

                        @foreach ($activeReports as $report)

                            <article class="petugas-antrian-report-card">

                                <div class="petugas-antrian-report-info">

                                    <span class="petugas-report-status {{ $report->status }}">
                                        {{ $report->status === 'pending' ? 'BARU' : 'DIPROSES' }}
                                    </span>

                                    <h3>{{ $report->title }}</h3>

                                    <div class="petugas-antrian-report-details">

                                        <p>
                                            <span>Pelapor</span>
                                            <strong>{{ $report->user->name ?? '-' }}</strong>
                                        </p>

                                        <p>
                                            <span>Fasilitas</span>
                                            <strong>{{ $report->facility->name ?? '-' }}</strong>
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

                                </div>

                                {{-- Riwayat laporan --}}
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
                                                        {{ $log->created_at->format('d/m/Y H:i') }}
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

                                {{-- Tombol aksi --}}
                                <div class="petugas-antrian-actions">

                                    <button
                                        type="button"
                                        class="petugas-antrian-button detail"
                                        onclick="const detail = document.getElementById('report-detail-{{ $report->report_id }}'); detail.hidden = !detail.hidden;"
                                    >
                                        Detail
                                    </button>

                                    @if ($report->status === 'pending')

                                        <form
                                            action="{{ route('petugas.laporan.update-status', $report->report_id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Mulai proses penanganan laporan ini?')"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="processing"
                                            >

                                            <button
                                                type="submit"
                                                class="petugas-antrian-button approve"
                                            >
                                                Proses
                                            </button>
                                        </form>

                                        <form
                                            action="{{ route('petugas.laporan.update-status', $report->report_id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menolak laporan ini?')"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="rejected"
                                            >

                                            <input
                                                type="hidden"
                                                name="resolution_note"
                                                value="Laporan ditolak oleh petugas."
                                            >

                                            <button
                                                type="submit"
                                                class="petugas-antrian-button reject"
                                            >
                                                Tolak
                                            </button>
                                        </form>

                                    @endif

                                    @if ($report->status === 'processing')
                                        <span class="petugas-antrian-status">
                                            SEDANG DIPROSES
                                        </span>
                                    @endif

                                </div>

                                {{-- Form detail dan penyelesaian --}}
                                <div
                                    id="report-detail-{{ $report->report_id }}"
                                    hidden
                                >
                                    <form
                                        action="{{ route('petugas.laporan.update-status', $report->report_id) }}"
                                        method="POST"
                                        class="petugas-report-update-form"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <h4>Detail Penanganan Laporan</h4>

                                        <label for="note-{{ $report->report_id }}">
                                            Catatan Petugas
                                        </label>

                                        <textarea
                                            id="note-{{ $report->report_id }}"
                                            name="resolution_note"
                                            rows="3"
                                            maxlength="2000"
                                            placeholder="Catatan hasil penanganan laporan..."
                                        ></textarea>

                                        <input
                                            type="hidden"
                                            name="status"
                                            value="resolved"
                                        >

                                        <button
                                            type="submit"
                                            class="petugas-antrian-button approve"
                                            onclick="return confirm('Apakah laporan ini sudah selesai ditangani?')"
                                        >
                                            Selesai
                                        </button>
                                    </form>
                                </div>

                            </article>

                        @endforeach

                    </div>

                @endif
            </div>

        </div>
    </div>
@endsection