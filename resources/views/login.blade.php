<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Masuk — Fasilitas Kampus</title>

    <link rel="stylesheet" href="{{ asset('fasilitas.css') }}">
    <link rel="stylesheet" href="{{ asset('login.css') }}">
</head>

<body class="login-body">

    <!-- Background overlay -->
    <div class="login-background"></div>


    <!-- =========================
         SINGLE GLASS CARD
    ========================== -->

    <main class="auth-wrapper">

        <div class="auth-card">

            <!-- LOGO + WEBSITE TITLE -->

            <div class="auth-brand">

                <div class="auth-logo">
                    FK
                </div>

                <div class="auth-brand-text">
                    <h1>Fasilitas Kampus</h1>
                    <p>Sistem Informasi Kampus</p>
                </div>

            </div>


            <!-- HEADER -->

            <div class="auth-header">

                <h2 id="auth-title">
                    Selamat datang kembali
                </h2>

                <p id="auth-description">
                    Masuk untuk mengelola reservasi dan laporan fasilitas kampus.
                </p>

            </div>


            <!-- TAB -->

            <div class="auth-tabs">

                <button
                    type="button"
                    class="auth-tab active"
                    id="login-tab"
                    onclick="showLogin()"
                >
                    Masuk
                </button>

                <button
                    type="button"
                    class="auth-tab"
                    id="register-tab"
                    onclick="showRegister()"
                >
                    Daftar
                </button>

            </div>


            <!-- =========================
                 LOGIN FORM
            ========================== -->

            <form
                class="auth-form"
                id="login-form"
            >

                <div class="form-group">

                    <label for="nim">
                        NIM / NIP
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            👤
                        </span>

                        <input
                            type="text"
                            id="nim"
                            name="nim"
                            placeholder="Masukkan NIM / NIP"
                            autocomplete="username"
                            required
                        >

                    </div>

                </div>


                <div class="form-group">

                    <label for="password">
                        Kata Sandi
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            🔒
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan kata sandi"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="toggle-password"
                        >
                            👁️
                        </button>

                    </div>

                </div>


                <div class="form-options">

                    <label class="remember">

                        <input
                            type="checkbox"
                            name="remember"
                        >

                        <span>
                            Ingat saya
                        </span>

                    </label>

                    <a href="#">
                        Lupa kata sandi?
                    </a>

                </div>


                <!-- ERROR -->

                <div
                    class="auth-error"
                    id="login-error"
                >
                    <span>⚠️</span>

                    <p>
                        NIM/NIP atau kata sandi salah.
                    </p>
                </div>


                <button
                    type="submit"
                    class="auth-submit"
                    id="login-submit"
                >

                    <span id="btn-text">
                        Masuk
                    </span>

                    <span
                        id="btn-loading"
                        style="display:none;"
                    >
                        Memverifikasi...
                    </span>

                </button>

            </form>


            <!-- =========================
                 REGISTER FORM
            ========================== -->

            <form
                class="auth-form"
                id="register-form"
                style="display:none;"
            >

                <div class="form-group">

                    <label for="register-name">
                        Nama Lengkap
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            👤
                        </span>

                        <input
                            type="text"
                            id="register-name"
                            placeholder="Masukkan nama lengkap"
                        >

                    </div>

                </div>


                <div class="form-group">

                    <label for="register-nim">
                        NIM / NIP
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            🎓
                        </span>

                        <input
                            type="text"
                            id="register-nim"
                            placeholder="Masukkan NIM / NIP"
                        >

                    </div>

                </div>


                <div class="form-group">

                    <label for="register-email">
                        Email
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            ✉️
                        </span>

                        <input
                            type="email"
                            id="register-email"
                            placeholder="Masukkan email"
                        >

                    </div>

                </div>


                <div class="form-group">

                    <label for="register-password">
                        Kata Sandi
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            🔒
                        </span>

                        <input
                            type="password"
                            id="register-password"
                            placeholder="Buat kata sandi"
                        >

                    </div>

                </div>


                <button
                    type="button"
                    class="auth-submit"
                    onclick="registerUser()"
                >
                    Daftar
                </button>

            </form>


            <!-- FOOTER -->

            <div class="auth-footer">

                <p>
                    Sistem reservasi dan pelaporan
                    fasilitas kampus
                </p>

                <span>
                    © 2026 Fasilitas Kampus
                </span>

            </div>

        </div>

    </main>


    <!-- =========================
         JAVASCRIPT
    ========================== -->

    <script>

        /* =========================
           TAB LOGIN
        ========================== */

        function showLogin() {

            document
                .getElementById('login-form')
                .style.display = 'block';

            document
                .getElementById('register-form')
                .style.display = 'none';

            document
                .getElementById('login-tab')
                .classList.add('active');

            document
                .getElementById('register-tab')
                .classList.remove('active');

            document
                .getElementById('auth-title')
                .textContent = 'Selamat datang kembali';

            document
                .getElementById('auth-description')
                .textContent =
                'Masuk untuk mengelola reservasi dan laporan fasilitas kampus.';

        }


        /* =========================
           TAB REGISTER
        ========================== */

        function showRegister() {

            document
                .getElementById('login-form')
                .style.display = 'none';

            document
                .getElementById('register-form')
                .style.display = 'block';

            document
                .getElementById('login-tab')
                .classList.remove('active');

            document
                .getElementById('register-tab')
                .classList.add('active');

            document
                .getElementById('auth-title')
                .textContent = 'Buat akun baru';

            document
                .getElementById('auth-description')
                .textContent =
                'Daftarkan akun untuk menggunakan fasilitas kampus.';

        }


        /* =========================
           PASSWORD TOGGLE
        ========================== */

        const passwordInput =
            document.getElementById('password');

        const togglePassword =
            document.getElementById('toggle-password');

        togglePassword.addEventListener(
            'click',
            function () {

                if (passwordInput.type === 'password') {

                    passwordInput.type = 'text';

                    togglePassword.textContent = '🙈';

                } else {

                    passwordInput.type = 'password';

                    togglePassword.textContent = '👁️';

                }

            }
        );


        /* =========================
           LOGIN DEMO
        ========================== */

        const loginForm =
            document.getElementById('login-form');

        loginForm.addEventListener(
            'submit',
            function (event) {

                event.preventDefault();

                const nim =
                    document
                    .getElementById('nim')
                    .value
                    .trim()
                    .toLowerCase();

                const password =
                    document
                    .getElementById('password')
                    .value;

                const error =
                    document.getElementById('login-error');

                const button =
                    document.getElementById('login-submit');

                const buttonText =
                    document.getElementById('btn-text');

                const loading =
                    document.getElementById('btn-loading');


                error.style.display = 'none';

                button.disabled = true;

                buttonText.style.display = 'none';

                loading.style.display = 'inline';


                setTimeout(function () {

                    button.disabled = false;

                    buttonText.style.display = 'inline';

                    loading.style.display = 'none';


                    /*
                     * DEMO LOGIN
                     *
                     * mahasiswa -> halaman mahasiswa
                     * petugas   -> dashboard petugas
                     */

                    if (nim === 'mahasiswa') {

                        window.location.href =
                            '/fasilitas';

                    }

                    else if (nim === 'petugas') {

                        window.location.href =
                            '/dashboard-petugas';

                    }

                    else {

                        error.style.display = 'flex';

                    }

                }, 800);

            }
        );


        /* =========================
           REGISTER DEMO
        ========================== */

        function registerUser() {

            alert(
                'Demo pendaftaran berhasil. Hubungkan form ini ke database Laravel.'
            );

        }

    </script>

</body>

</html>