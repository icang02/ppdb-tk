<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
      <img src="{{ asset('guest/img/logo-tk.png') }}" width="50" alt="">
      <span class="ms-1 h4 fw-bold mt-3">{{ str()->title(auth()->user()->username) }}</span>
    </a>
  </div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item @if (Route::is('dashboard')) active @endif">
      <a href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>

    @can('admin')
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Guru & Staff</span>
      </li>

      <li class="menu-item @if (Request::is('dashboard/guru-staff*')) active @endif">
        <a href="{{ route('auth_guru_staff') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Analytics">Tenaga Pendidik</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Kegiatan & Prestasi</span>
      </li>

      <li class="menu-item @if (Request::is('dashboard/akademik*')) active @endif">
        <a href="{{ route('auth_tema_belajar') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Analytics">Akademik</div>
        </a>
      </li>

      <li class="menu-item @if (Request::is('dashboard/non-akademik*')) active @endif">
        <a href="{{ route('auth_non_akademik') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-store"></i>
          <div data-i18n="Analytics">Non Akademik</div>
        </a>
      </li>

      <li class="menu-item @if (Request::is('dashboard/prestasi*')) active @endif">
        <a href="{{ route('auth_prestasi') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-crown"></i>
          <div data-i18n="Analytics">Prestasi</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Pendaftaran</span>
      </li>

      <li class="menu-item @if (Request::is('dashboard/data-pendaftar*')) active @endif">
        <a href="{{ route('auth_pendaftaran') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Analytics">Data Pendaftar</div>
        </a>
      </li>

      <li class="menu-item @if (Request::is('dashboard/tanggal*')) active @endif">
        <a href="{{ route('auth_tanggal_pendaftaran') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-calendar"></i>
          <div data-i18n="Analytics">Tanggal Pendaftaran</div>
        </a>
      </li>
    @endcan

    @can('kepsek')
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Pendaftaran</span>
      </li>

      <li class="menu-item @if (Request::is('dashboard/data-pendaftar*')) active @endif">
        <a href="{{ route('auth_pendaftaran') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Analytics">Data Pendaftar</div>
        </a>
      </li>

      <li class="menu-item @if (Request::is('dashboard/laporan*')) active @endif">
        <a href="{{ route('index_laporan_pembayaran') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Analytics">Laporan Pembayaran</div>
        </a>
      </li>
    @endcan
  </ul>
</aside>
