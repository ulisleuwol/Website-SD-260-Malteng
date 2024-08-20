<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? '' : 'collapsed' }}"
                href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('kegiatan*', 'agenda*', 'pengumuman*', 'prestasi*') ? '' : 'collapsed' }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-info-square"></i><span>Informasi</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse {{ request()->routeIs('kegiatan*', 'agenda*', 'pengumuman*', 'prestasi*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('kegiatan.index') }}"
                        class="{{ request()->routeIs('kegiatan*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Kegiatan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('agenda.index') }}" class="{{ request()->routeIs('agenda*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Agenda</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengumuman.index') }}"
                        class="{{ request()->routeIs('pengumuman*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Pengumuman</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('prestasi.index') }}"
                        class="{{ request()->routeIs('prestasi*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Prestasi</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link  {{ request()->routeIs('guru*', 'fasilitas*', 'visi-misi*', 'sejarah*') ? '' : 'collapsed' }}" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Profil Sekolah</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse  {{ request()->routeIs('guru*', 'fasilitas*', 'visi-misi*', 'sejarah*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('guru.index') }}" class="{{ request()->routeIs('guru*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Guru</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('fasilitas.index') }}"
                        class="{{ request()->routeIs('fasilitas*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Fasilitas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('visi-misi.index') }}"
                        class="{{ request()->routeIs('visi-misi*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Visi Misi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('sejarah.index') }}" class="{{ request()->routeIs('sejarah*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Sejarah</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('galery-foto*', 'galery-video*') ? '' : 'collapsed' }}" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-images"></i><span>Galery</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse {{ request()->routeIs('galery-foto*', 'galery-video*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('galery-foto.index') }}"
                        class="{{ request()->routeIs('galery-foto*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Galery Foto</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('galery-video.index') }}"
                        class="{{ request()->routeIs('galery-video*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Galery Video</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('eskul*') ? '' : 'collapsed' }}" href="{{ route('eskul.index') }}">
                <i class="bi bi-universal-access-circle"></i>
                <span>Ekstrakurikuler</span>
            </a>
        </li><!-- End Eskul -->

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('ppdb*') ? '' : 'collapsed' }}" href="{{ route('ppdb.index') }}">
                <i class="bi bi-person-fill-exclamation"></i>
                <span>PPDB</span>
            </a>
        </li><!-- End PPDB -->

        <li class="nav-heading">Setting</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('pengaturan*') ? '' : 'collapsed' }}" href="{{ route('pengaturan.index') }}">
                <i class="bi bi-gear"></i>
                <span>Pengaturan</span>
            </a>
        </li><!-- End Pengaturan -->
    </ul>
</aside>