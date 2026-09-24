<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Fasilitas Kampus</title>

    @vite(['resources/css/auth.css'])
</head>

<body>

<div class="auth-page">

    <div class="auth-card">

        <div class="auth-header">
            <div class="logo-icon">🏫</div>

            <h1>Selamat Datang</h1>

            <p>
                Login untuk mengakses Sistem Informasi
                Fasilitas Kampus
            </p>
        </div>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="password">Password</label>

                    <a href="#">
                        Lupa password?
                    </a>
                </div>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <div class="remember-row">
                <label>
                    <input
                        type="checkbox"
                        name="remember"
                    >

                    <span>Ingat saya</span>
                </label>
            </div>

            <button type="submit" class="auth-button">
                Login
            </button>
        </form>

        <div class="auth-footer">
            <span>Belum punya akun?</span>

            <a href="{{ route('register') }}">
                Daftar sekarang
            </a>
        </div>

    </div>

</div>

</body>
</html>