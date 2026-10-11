
@extends('layouts.app')

@section('title', 'Profil Saya')

@push('styles')
    @vite('resources/css/profile.css')
@endpush

@section('content')
<div class="profile-page">
    <div class="profile-card">
        <div class="profile-heading">
            <div class="profile-avatar">👤</div>
            <div>
                <h1>Profil Saya</h1>
                <p>Kelola informasi akun Anda.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="profile-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="profile-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="profile-field">
                <label for="name">Nama lengkap</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $user->name) }}"
                    required
                    maxlength="255"
                >
            </div>

            <div class="profile-field">
                <label for="email">Email</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email', $user->email) }}"
                    required
                    maxlength="255"
                >
            </div>

            <div class="profile-field">
                <label>Peran akun</label>
                <input
                    type="text"
                    value="{{ ucfirst($user->role) }}"
                    disabled
                >
                <small>Peran akun tidak dapat diubah dari halaman profil.</small>
            </div>

            <hr>

            <h2>Ubah Password</h2>
            <p class="profile-hint">
                Kosongkan bagian ini jika tidak ingin mengubah password.
            </p>

            <div class="profile-field">
                <label for="current_password">Password saat ini</label>
                <input
                    id="current_password"
                    name="current_password"
                    type="password"
                    autocomplete="current-password"
                >
            </div>

            <div class="profile-field">
                <label for="password">Password baru</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                >
            </div>

            <div class="profile-field">
                <label for="password_confirmation">
                    Konfirmasi password baru
                </label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                >
            </div>

            <div class="profile-actions">
                <button type="submit" class="profile-save">
                    Simpan Perubahan
                </button>

                <a href="{{ route('fasilitas') }}" class="profile-back">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
