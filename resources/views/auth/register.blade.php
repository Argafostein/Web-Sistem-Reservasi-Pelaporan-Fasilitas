<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sign Up - Fasilitas Kampus</title>

    @vite(['resources/css/auth.css'])
</head>

<body>

<div class="auth-page">

    <div class="auth-card register-card">

        <div class="auth-header">
            <div class="logo-icon">🏫</div>

            <h1>Buat Akun</h1>

            <p>
                Daftarkan akun untuk menggunakan
                fasilitas kampus
            </p>
        </div>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.process') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap"
                    required
                >
            </div>

            <div class="form-group">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="nama@email.com"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password_confirmation">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    required
                >
            </div>

            <button type="submit" class="auth-button">
                Buat Akun
            </button>
        </form>

        <div class="auth-footer">
            <span>Sudah punya akun?</span>

            <a href="{{ route('login') }}">
                Login
            </a>
        </div>

    </div>

</div>

</body>
</html>