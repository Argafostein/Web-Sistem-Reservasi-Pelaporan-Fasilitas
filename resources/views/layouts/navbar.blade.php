<div class="navbar-container">

<a href="{{ route('fasilitas') }}" class="brand">
    <div class="brand-logo">
        FK
    </div>
</a>

<nav class="navigation">

    <a href="{{ route('fasilitas') }}"
       class="nav-link {{ request()->routeIs('fasilitas') ? 'active' : '' }}">
        Fasilitas
    </a>

    <a href="{{ route('reservasi') }}"
       class="nav-link {{ request()->routeIs('reservasi') ? 'active' : '' }}">
        Reservasi
    </a>

    @if (auth()->check())

        <a href="{{ route('riwayat-reservasi') }}"
            class="nav-link {{ request()->routeIs('riwayat-reservasi') ? 'active' : '' }}">
            Riwayat Reservasi
        </a>

        <div class="profile-menu">

            <a href="#" class="profile-button">
                👤 {{ auth()->user()->name }}
            </a>

            <div class="profile-dropdown">

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

        <a href="{{ route('register') }}" class="nav-link">
            Sign Up
        </a>

    @endif

</nav>

</div>
