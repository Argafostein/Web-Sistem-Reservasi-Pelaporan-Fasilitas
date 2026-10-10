@extends('layouts.app')

@push('styles')
    @vite('resources/css/admin.css')
@endpush

@section('title', 'Master Fasilitas')

@section('content')
<div class="admin-page facilities-page">
    <div class="admin-container">
        <div class="admin-header facilities-header">
            <div>
                <span class="admin-label">MANAJEMEN FASILITAS</span>
                <h1>Master Data Fasilitas</h1>
                <p>Kelola informasi ruang, kapasitas, dan status fasilitas kampus.</p>
            </div>
            <a class="admin-button" href="#tambah-fasilitas">+ Tambah fasilitas</a>
        </div>

        @include('Admin.partials.alerts')

        <div class="facility-stat-grid">
            <div class="facility-stat-card">
                <span class="facility-stat-icon blue">▦</span>
                <div>
                    <strong>{{ $facilities->total() }}</strong>
                    <span>Total fasilitas</span>
                </div>
            </div>
            <div class="facility-stat-card">
                <span class="facility-stat-icon green">✓</span>
                <div>
                    <strong>{{ $facilities->getCollection()->where('status', 'available')->count() }}</strong>
                    <span>Fasilitas aktif</span>
                </div>
            </div>
            <div class="facility-stat-card">
                <span class="facility-stat-icon orange">!</span>
                <div>
                    <strong>{{ $facilities->getCollection()->where('status', 'unavailable')->count() }}</strong>
                    <span>Nonaktif di halaman ini</span>
                </div>
            </div>
        </div>

        <div class="admin-grid facilities-layout">
            <section class="admin-card facility-create-card" id="tambah-fasilitas">
                <div class="card-heading">
                    <div>
                        <span class="card-eyebrow">DATA BARU</span>
                        <h2>Tambah fasilitas</h2>
                    </div>
                    <span class="card-heading-icon">+</span>
                </div>
                <p class="card-description">Isi detail fasilitas yang akan ditampilkan kepada pengguna.</p>

                <form class="admin-form" method="POST" action="{{ route('admin.facilities.store') }}">
                    @csrf
                    <label>Nama fasilitas
                        <input name="name" placeholder="Contoh: Ruang Seminar A" required>
                    </label>
                    <label>Lokasi
                        <input name="location" placeholder="Contoh: Gedung A, Lantai 2" required>
                    </label>
                    <label>Kapasitas
                        <div class="input-with-suffix">
                            <input type="number" name="capacity" min="1" placeholder="0">
                            <span>orang</span>
                        </div>
                    </label>
                    <label>Deskripsi
                        <textarea name="description" placeholder="Tambahkan keterangan singkat..."></textarea>
                    </label>
                    <button class="admin-button facility-submit" type="submit">Simpan fasilitas</button>
                </form>
            </section>

            <section class="facility-list-section">
                <div class="section-heading">
                    <div>
                        <span class="card-eyebrow">DAFTAR MASTER</span>
                        <h2>Fasilitas terdaftar</h2>
                    </div>
                    <span class="facility-count">{{ $facilities->total() }} fasilitas</span>
                </div>

                <div class="facility-card-grid">
                    @forelse ($facilities as $facility)
                        <article class="facility-admin-card">
                            <div class="facility-card-topline">
                                <span class="facility-card-icon">⌂</span>
                                <span class="admin-status {{ $facility->status }}">
                                    {{ $facility->status === 'available' ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                            <h3>{{ $facility->name }}</h3>
                            <p class="facility-location">⌖ {{ $facility->location }}</p>
                            <p class="facility-description">
                                {{ $facility->description ?: 'Belum ada deskripsi fasilitas.' }}
                            </p>
                            <div class="facility-meta">
                                <span>♙ {{ $facility->capacity ? $facility->capacity . ' orang' : 'Kapasitas belum diatur' }}</span>
                                <span>Diperbarui {{ $facility->updated_at?->format('d M Y') }}</span>
                            </div>

                            <details class="facility-edit">
                                <summary>Edit detail</summary>
                                <form class="admin-form" method="POST" action="{{ route('admin.facilities.update', $facility) }}">
                                    @csrf
                                    @method('PATCH')
                                    <label>Nama fasilitas
                                        <input name="name" value="{{ $facility->name }}" required>
                                    </label>
                                    <label>Lokasi
                                        <input name="location" value="{{ $facility->location }}" required>
                                    </label>
                                    <label>Kapasitas
                                        <input type="number" name="capacity" value="{{ $facility->capacity }}" min="1">
                                    </label>
                                    <label>Deskripsi
                                        <textarea name="description">{{ $facility->description }}</textarea>
                                    </label>
                                    <label>Status
                                        <select name="status">
                                            <option value="available" @selected($facility->status === 'available')>Aktif</option>
                                            <option value="unavailable" @selected($facility->status === 'unavailable')>Nonaktif</option>
                                        </select>
                                    </label>
                                    <button class="admin-button secondary" type="submit">Simpan perubahan</button>
                                </form>
                            </details>

                            @if ($facility->status === 'available')
                                <form method="POST" action="{{ route('admin.facilities.deactivate', $facility) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="facility-deactivate" type="submit">Nonaktifkan fasilitas</button>
                                </form>
                            @endif
                        </article>
                    @empty
                        <div class="empty-state">
                            <strong>Belum ada fasilitas</strong>
                            <span>Tambahkan fasilitas pertama menggunakan formulir di sebelah kiri.</span>
                        </div>
                    @endforelse
                </div>

                <div class="admin-pagination">{{ $facilities->links() }}</div>
            </section>
        </div>
    </div>
</div>
@endsection
