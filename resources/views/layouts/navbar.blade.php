@push('styles')
    @vite('resources/css/navbar.css')
@endpush

@push('scripts')
    @vite('resources/js/navbar.js')
@endpush

<div class="navbar-container">

    <a href="{{ auth()->check() && auth()->user()->role === 'petugas'
        ? route('petugas.dashboard')
        : route('fasilitas') }}"
       class="brand">
        <div class="brand-logo">
            FK
        </div>
    </a>

    <nav class="navigation">

        @if (auth()->check() && auth()->user()->role === 'petugas')

        {{-- NAVBAR PETUGAS --}}

            <a href="{{ route('petugas.dashboard') }}"
            class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('fasilitas') }}"
            class="nav-link {{ request()->routeIs('fasilitas') ? 'active' : '' }}">
                Fasilitas
            </a>

            <a href="{{ route('petugas.antrian.reservasi') }}"
            class="nav-link {{ request()->routeIs('petugas.antrian.reservasi', 'petugas.antrian.laporan') ? 'active' : '' }}">
                Antrean
            </a>

            <a href="{{ route('petugas.riwayat.reservasi') }}"
            class="nav-link {{ request()->routeIs('petugas.riwayat.reservasi', 'petugas.riwayat.laporan') ? 'active' : '' }}">
                Riwayat
            </a>

            {{-- Profil --}}
            <div class="profile-menu">
                <button type="button" class="profile-button" id="profileButton">
                    👤 {{ Auth::user()->name }}
                </button>

                <div class="profile-dropdown" id="profileDropdown">
                    <a href="#">Profil Saya</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>

        @elseif (auth()->check())

            {{-- NAVBAR PENGGUNA BIASA --}}

            <a href="{{ route('fasilitas') }}"
               class="nav-link {{ request()->routeIs('fasilitas') ? 'active' : '' }}">
                Fasilitas
            </a>

            <a href="{{ route('reservasi') }}"
               class="nav-link {{ request()->routeIs('reservasi') ? 'active' : '' }}">
                Reservasi
            </a>

            <a href="{{ route('lapor') }}"
               class="nav-link {{ request()->routeIs('lapor') ? 'active' : '' }}">
                Lapor
            </a>

            <a href="{{ route('riwayat-reservasi') }}"
               class="nav-link {{ request()->routeIs('riwayat-reservasi', 'riwayat-laporan') ? 'active' : '' }}">
                Riwayat
            </a>

            <div class="profile-menu">
                <button type="button"
                        class="profile-button"
                        id="profileButton">
                    👤 {{ Auth::user()->name }}
                </button>

                <div class="profile-dropdown" id="profileDropdown">

                    <a href="#">
                        Profil Saya
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit">
                            Logout
                        </button>
                    </form>

                </div>
            </div>

        @else

            {{-- NAVBAR PENGUNJUNG --}}

            <a href="{{ route('fasilitas') }}"
               class="nav-link {{ request()->routeIs('fasilitas') ? 'active' : '' }}">
                Fasilitas
            </a>

            <a href="{{ route('register') }}" class="nav-link">
                Sign Up
            </a>

        @endif

    </nav>

</div>