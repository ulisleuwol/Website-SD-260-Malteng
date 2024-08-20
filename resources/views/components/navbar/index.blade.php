<!-- ======= Header ======= -->
<section id="topbar" class="topbar d-flex align-items-center">
  <div class="container d-flex justify-content-center justify-content-md-between">
    <div class="contact-info d-flex align-items-center">
      <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:{{ $pengaturan->email }}">{{
          $pengaturan->email }}</a></i>
      <i class="bi bi-phone d-flex align-items-center ms-4"><span>{{ $pengaturan->telp }}</span></i>
    </div>
    <div class="social-links d-none d-md-flex align-items-center">
      <a href="{{ url('ppdb-sekolah') }}"
        class="small {{ request()->routeIs('ppdb-sekolah') ? 'text-white' : '' }}">Info PPDB</a>
      <a href="{{ url('eskul-sekolah') }}"
        class="small {{ request()->routeIs('eskul-sekolah') ? 'text-white' : '' }}">Ekstrakurikuler</a>

      {{-- Cek apakah sudah login --}}
      @if (Auth::check())
      <a href="{{ url('dashboard') }}"><span class="badge text-bg-warning text-white p-2 ms-2"><i
            class="bi bi-person-circle me-1"></i>Dashboard</span></a>
      @else
      <a href="{{ url('login') }}"><span class="badge text-bg-warning text-white p-2 ms-2"><i
            class="bi bi-box-arrow-in-right me-1"></i>Login</span></a>
      @endif
    </div>
  </div>
</section><!-- End Top Bar -->

<header id="header" class="header d-flex align-items-center">

  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <a href="{{ url('/') }}" class="logo d-flex align-items-center">
      <h1>SDN 260 Malteng<span>.</span></h1>
    </a>
    <nav id="navbar" class="navbar">
      <ul>
        <li><a href="{{ url('/') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>

        <li class="dropdown">
          <span
            class="{{ request()->routeIs('visi-misi-sekolah*', 'guru*', 'fasilitas-sekolah*', 'sejarah-sekolah*') ? 'active' : '' }}">Profil
            Sekolah<i class="bi bi-chevron-down dropdown-indicator"></i></span>
          <ul>
            <li><a href="{{ url('visi-misi-sekolah') }}"
                class="{{ request()->routeIs('visi-misi-sekolah*') ? 'active' : '' }}">Visi & Misi</a></li>
            <li><a href="{{ url('data-guru') }}" class="{{ request()->routeIs('guru') ? 'active' : '' }}">Data Guru /
                Staff</a></li>
            <li><a href="{{ url('fasilitas-sekolah') }}"
                class="{{ request()->routeIs('fasilitas-sekolah*') ? 'active' : '' }}">Fasilitas</a></li>
            <li><a href="{{ url('sejarah-sekolah') }}"
                class="{{ request()->routeIs('sejarah-sekolah*') ? 'active' : '' }}">Sejarah</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <span
            class="{{ request()->routeIs('kegiatan-sekolah*', 'agenda-sekolah*', 'pengumuman-sekolah*', 'prestasi-ak*') ? 'active' : '' }}">Informasi<i
              class="bi bi-chevron-down dropdown-indicator"></i></span>
          <ul>
            <li><a href="{{ url('kegiatan-sekolah') }}"
                class="{{ request()->routeIs('kegiatan-sekolah*') ? 'active' : '' }}">Kegiatan</a></li>
            <li><a href="{{ url('agenda-sekolah') }}"
                class="{{ request()->routeIs('agenda-sekolah*') ? 'active' : '' }}">Agenda</a></li>
            <li><a href="{{ url('pengumuman-sekolah') }}"
                class="{{ request()->routeIs('pengumuman-sekolah*') ? 'active' : '' }}">Pengumuman</a></li>
            <li><a href="{{ url('prestasi-ak') }}"
                class="{{ request()->routeIs('prestasi-ak*') ? 'active' : '' }}">Prestasi</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <span class="{{ request()->routeIs('galery-foto-sekolah', 'galery-video-sekolah') ? 'active' : '' }}">Galery<i
              class="bi bi-chevron-down dropdown-indicator"></i></span>
          <ul>
            <li><a href="{{ url('galery-foto-sekolah') }}"
                class="{{ request()->routeIs('galery-foto-sekolah') ? 'active' : '' }}">Galery Foto</a></li>
            <li><a href="{{ url('galery-video-sekolah') }}"
                class="{{ request()->routeIs('galery-video-sekolah') ? 'active' : '' }}">Galery Video</a></li>
          </ul>
        </li>

        <li><a href="{{ url('kontak-sekolah') }}"
            class="{{ request()->routeIs('kontak-sekolah') ? 'active' : '' }}">Kontak</a>
        </li>

        <li class="d-md-none d-sm-block">
          @if (Auth::check())
          <a href="{{ url('dashboard') }}"> <span class="badge text-bg-warning text-white p-2 ms-2"><i
                class="bi bi-person-circle me-1"></i>Dashboard</span></a>
          @else
          <a href="{{ url('login') }}"><span class="badge text-bg-warning text-white p-2 ms-2"><i
                class="bi bi-box-arrow-in-right me-1"></i>Login</span></a>
          @endif
        </li>

      </ul>
    </nav><!-- .navbar -->

    <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
    <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

  </div>
</header><!-- End Header -->