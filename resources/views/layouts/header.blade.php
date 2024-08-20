<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block">SDN 260 Malteng</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item me-4 d-none d-md-block">
                <div id="live-clock" class="text-muted" style="font-size: smaller;">
                    <script>
                        function updateClock() {
                        const now = new Date();
                        const clock = document.getElementById('live-clock');
                        const options = { 
                            weekday: 'long', 
                            day: '2-digit', 
                            month: 'long', 
                            year: 'numeric', 
                            hour: '2-digit', 
                            minute: '2-digit', 
                            second: '2-digit', 
                            hour12: false, 
                            timeZone: '{{ config('app.timezone') }}',
                            timeZoneName: 'short' 
                        };
                        const formattedDate = now.toLocaleString('id-ID', options).replace(':', '');
                        clock.innerText = formattedDate;
                    }
                    setInterval(updateClock, 1000);
                    updateClock();
                    </script>
                </div>
            </li>

            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    @if (Auth::user()->image)
                    <img src="{{ asset('storage/'. Auth::user()->image) }}" alt="Profile"
                        class="rounded-circle img-fluid">
                    @else
                    <i class="bi bi-person-circle fs-3"></i>
                    @endif
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                </a><!-- End Profile Image Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->name }}</h6>
                        <span>{{ Auth::user()->email }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('home') }}">
                            <i class="bi bi-house"></i>
                            <span>Home</span>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person"></i>
                            <span>Profil Saya</span>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('pengaturan.index') }}">
                            <i class="bi bi-gear"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item d-flex align-items-center" href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </a>
                        </form>
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->
</header>