@extends('layouts.app')

@push('styles')
    @vite('resources/css/admin.css')
@endpush

@section('title', 'Pelaporan dan Analisis')

@section('content')
<div class="admin-page">
    <div class="admin-container">
        <div class="admin-header">
            <div>
                <span class="admin-label">PELAPORAN & ANALISIS</span>
                <h1>Rekapitulasi Fasilitas</h1>
                <p>Pantau okupansi reservasi dan frekuensi kerusakan setiap fasilitas.</p>
            </div>
        </div>

        @include('Admin.partials.alerts')

        <section class="admin-card">
            <form class="report-filter" method="GET" action="{{ route('admin.reports') }}">
                <label class="admin-form">Fasilitas
                    <select name="facility_id">
                        <option value="">Semua fasilitas</option>
                        @foreach ($facilities as $facility)
                            <option value="{{ $facility->facility_id }}" @selected($facilityId === $facility->facility_id)>{{ $facility->name }}</option>
                        @endforeach
                    </select>
                </label>
                <button class="admin-button" type="submit">Tampilkan</button>
                <a class="admin-button secondary" href="{{ route('admin.reports.export', ['facility_id' => $facilityId]) }}">Ekspor CSV</a>
                <button class="admin-button secondary" type="button" onclick="window.print()">Cetak / PDF</button>
            </form>

            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead><tr><th>Fasilitas</th><th>Lokasi</th><th>Jumlah Reservasi</th><th>Frekuensi Kerusakan</th></tr></thead>
                    <tbody>
                    @foreach ($facilities as $facility)
                        @php
                            $occupancyCount = $occupancy->firstWhere('facility_id', $facility->facility_id)?->reservation_count ?? 0;
                            $damageCount = $damage->firstWhere('facility_id', $facility->facility_id)?->damage_count ?? 0;
                        @endphp
                        <tr>
                            <td>{{ $facility->name }}</td>
                            <td>{{ $facility->location }}</td>
                            <td>{{ $occupancyCount }}</td>
                            <td>{{ $damageCount }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
@endsection
