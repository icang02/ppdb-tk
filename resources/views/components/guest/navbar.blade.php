<nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
    <a href="{{ route('beranda') }}" class="navbar-brand p-0 d-inline-flex align-items-center">
        <img src="{{ asset('guest/img/logo-tk.png') }}" width="65" alt="">
        <h1 class="m-0 h2">TK Dharma Mulya</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{ route('beranda') }}"
                class="nav-item nav-link @if (Route::is('beranda')) active @endif">Beranda</a>
            <a href="{{ route('guest_guru_staff') }}"
                class="nav-item nav-link @if (Route::is('guest_guru_staff')) active @endif">Tenaga Pendidik</a>
            <a href="{{ route('guest_akademik') }}"
                class="nav-item nav-link @if (Route::is('guest_akademik')) active @endif">Akademik</a>
            <a href="{{ route('guest_non_akademik') }}"
                class="nav-item nav-link @if (Route::is('guest_non_akademik')) active @endif">Non Akademik</a>
            <a href="{{ route('guest_prestasi') }}"
                class="nav-item nav-link @if (Route::is('guest_prestasi')) active @endif">Prestasi</a>
            <a href="{{ route('guest_pendaftaran') }}"
                class="nav-item nav-link @if (Route::is('guest_pendaftaran')) active @endif">Pendaftaran</a>
        </div>
        <a href="{{ auth()->check() ? route('dashboard') : route('login') }}"
            class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">{{ auth()->check() ? 'Dashboard' : 'Login Admin' }}</a>
    </div>
</nav>
