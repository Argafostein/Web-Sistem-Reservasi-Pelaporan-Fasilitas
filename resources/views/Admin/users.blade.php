@extends('layouts.app')

@push('styles')
    @vite('resources/css/admin.css')
@endpush

@section('title', 'Administrasi Pengguna')

@section('content')
<div class="admin-page">
    <div class="admin-container">
        <div class="admin-header">
            <div>
                <span class="admin-label">ADMINISTRASI SISTEM</span>
                <h1>Manajemen Pengguna</h1>
                <p>Daftarkan petugas, pengguna kampus, dan verifikasi akun mandiri.</p>
            </div>
        </div>

        @include('Admin.partials.alerts')

        <div class="admin-grid">
            <section class="admin-card">
                <h2>Daftarkan Akun Langsung</h2>
                <form class="admin-form" method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <label>Nama lengkap <input name="name" value="{{ old('name') }}" required></label>
                    <label>Email <input type="email" name="email" value="{{ old('email') }}" required></label>
                    <label>Peran
                        <select name="role" required>
                            <option value="user">Pengguna (mahasiswa/dosen/staf)</option>
                            <option value="petugas">Petugas</option>
                        </select>
                    </label>
                    <label>Password <input type="password" name="password" minlength="8" required></label>
                    <label>Konfirmasi password <input type="password" name="password_confirmation" minlength="8" required></label>
                    <button class="admin-button" type="submit">Daftarkan dan Aktifkan</button>
                </form>
            </section>

            <section class="admin-card">
                <h2>Permintaan Verifikasi</h2>
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead><tr><th>Pengguna</th><th>Email</th><th>Terdaftar</th><th>Aksi</th></tr></thead>
                        <tbody>
                        @forelse ($pendingUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at?->format('d M Y') }}</td>
                                <td class="admin-actions">
                                    <form method="POST" action="{{ route('admin.users.verify', $user) }}">
                                        @csrf @method('PATCH')
                                        <button class="admin-button" type="submit">Verifikasi</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.users.reject', $user) }}">
                                        @csrf @method('PATCH')
                                        <button class="admin-button danger" type="submit">Tolak</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4">Tidak ada akun yang menunggu verifikasi.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <section class="admin-card" style="margin-top: 24px;">
            <h2>Semua Akun</h2>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead><tr><th>Nama</th><th>Email</th><th>Peran</th><th>Status</th></tr></thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td><span class="admin-status {{ $user->account_status }}">{{ ucfirst($user->account_status) }}</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="admin-pagination">{{ $users->links() }}</div>
        </section>
    </div>
</div>
@endsection
