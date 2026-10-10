@extends('layouts.app')

@push('styles')
    @vite('resources/css/petugas/dashboard.css')
@endpush

@push('scripts')
    @vite('resources/js/petugas/dashboard.js')
@endpush

@section('content')

<div class="petugas-page">

    <div class="petugas-container">

        @if (session('success'))
            <div class="petugas-alert success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="petugas-alert error">
                {{ session('error') }}
            </div>
        @endif

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
    </div>

</div>

@endsection