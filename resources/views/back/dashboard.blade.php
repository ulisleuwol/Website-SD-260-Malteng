<x-app-layout>
    @push('link')
    <link href="DataTables/datatables.min.css" rel="stylesheet">
    @endpush
    @slot('title', 'Dashboard')
    <main id="main" class="main">
        <div class="row justify-content-between align-items-center flex-wrap ">

            <x-back.breadcrumb :title="$title" :breadcrumbs="$breadcrumbs" />

        </div>

        <section class="section dashboard">
            <div class="row">

                <!-- header Card -->
                <div class="col-xl-12 ">

                    <div class="card info-card customers-card">

                        <div class="card-body">
                            {{-- Greating --}}
                            @php
                            $currentHour=now()->setTimezone(config('app.timezone'))->hour;
                            @endphp

                            <div class="d-flex justyfy-content-center align-items-center">
                                <h5 class="card-title" id="greeting"></h5> &#124;
                                <span> {{ Auth::user()->name}}👋</span>
                            </div>


                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-building"></i>
                                </div>
                                <div class="ps-3">
                                    <h1 class="title-head">Portal Sekolah Dasar Negeri 260 Maluku Tengah
                                    </h1>
                                </div>
                            </div>

                        </div>
                    </div>

                </div><!-- End header Card -->

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="dropdown pb-3">
                        <x-button class="btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-funnel-fill"></i>Filter
                        </x-button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item {{ $activeFilter === 'today' ? 'active' : '' }}"
                                    href="{{ route('dashboard', ['filter' => 'today']) }}">Today</a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ $activeFilter === 'this_month' ? 'active' : '' }}"
                                    href="{{ route('dashboard', ['filter' => 'this_month']) }}">This Month</a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ $activeFilter === 'this_year' ? 'active' : '' }}"
                                    href="{{ route('dashboard', ['filter' => 'this_year']) }}">This Year</a>
                            </li>
                        </ul>
                    </div>

                    <div class="row">

                        <!-- kegiatan Card -->
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Kegiatan <span>| {{ ucfirst(str_replace('_', ' ',
                                            request()->query('filter', 'today'))) }}</span></h5>

                                    <div class="d-flex justify-content-around align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-clipboard-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <a href="{{ route('kegiatan.index') }}"
                                                class="text-primary small pt-1 fw-bold">
                                                <h6 class="text-center">{{ $kegiatan_count }}</h6>
                                                Lihat Kegiatan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End kegiatan Card -->



                        <!-- Prestasi Card -->
                        <div class="col-xxl-3 col-lg-4 col-sm-6">

                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Prestasi <span>| {{ ucfirst(str_replace('_', ' ',
                                            request()->query('filter', 'today'))) }}</span></h5>

                                    <div class="d-flex justify-content-around align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-award"></i>
                                        </div>
                                        <div class="ps-3">
                                            <a href="{{ route('prestasi.index') }}"
                                                class="text-danger small pt-1 fw-bold">
                                                <h6 class="text-center">
                                                    <h6 class="text-center">{{ $prestasi_count }}</h6>
                                                </h6>
                                                Lihat Prestasi
                                            </a>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Prestasi Card -->

                        <!-- Agenda Card -->
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Agenda <span>| {{ ucfirst(str_replace('_', ' ',
                                            request()->query('filter', 'today'))) }}</span></h5>

                                    <div class="d-flex justify-content-around align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <a href="{{ route('agenda.index') }}"
                                                class="text-success small pt-1 fw-bold">
                                                <h6 class="text-center">{{ $agenda_count }}</h6>
                                                Lihat Agenda
                                            </a>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Agenda Card -->

                        <!-- Pengumuman Card -->
                        <div class="col-xxl-3 col-lg-4 col-sm-6">

                            <div class="card info-card customers-card">


                                <div class="card-body">
                                    <h5 class="card-title">Pengumuman <span>| {{ ucfirst(str_replace('_', ' ',
                                            request()->query('filter', 'today'))) }}</span></h5>

                                    <div class="d-flex justify-content-around align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-megaphone"></i>
                                        </div>
                                        <div class="ps-3">
                                            <a href="{{ route('pengumuman.index') }}"
                                                class="text-danger small pt-1 fw-bold">
                                                <h6 class="text-center">{{ $pengumuman_count }}</h6>
                                                Lihat Pengumuman
                                            </a>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Pengumuman Card -->

                    </div>

                    <div class="row">
                        <!-- Left side columns -->
                        <div class="col-lg-8">

                            <!-- Agenda Terbaru -->
                            <div class="col">
                                <div class="card recent-sales overflow-x-auto">
                                    <div class="card-body">
                                        <h5 class="card-title">Agenda <span>| Terbaru</span></h5>

                                        @if ($agenda->count())
                                        <table class="table datatable table-responsive table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Judul</th>
                                                    <th scope="col">Waktu</th>
                                                    <th scope="col">Lokasi</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($agenda as $data)

                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td><a href="{{ route('agenda.show', $data->slug) }}">{{
                                                            $data->title
                                                            }}</a></td>
                                                    <td>{{ (new \Carbon\Carbon($data->date_time))->format('d F Y H:i')
                                                        }}
                                                    </td>
                                                    <td>{{ $data->location }}</td>
                                                    <td>
                                                        @if (\Carbon\Carbon::parse($data->date_time)->isToday())
                                                        <span class="badge bg-warning">Sedang Berlangsung</span>

                                                        @elseif (\Carbon\Carbon::parse($data->date_time)->isFuture())
                                                        <span class="badge bg-info">Segera</span>

                                                        @elseif (\Carbon\Carbon::parse($data->date_time)->isPast())
                                                        <span class="badge bg-secondary">Berakhir</span>
                                                        @endif
                                                    </td>
                                                </tr>

                                                @endforeach
                                            </tbody>
                                            @else
                                            <span class="text-center d-block text-secondary">
                                                <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid"
                                                    style="max-width: 40%" alt="">
                                                <p>Tidak Ada Agenda Terbaru</p>
                                            </span>

                                            @endif
                                        </table>

                                    </div>

                                </div>
                            </div><!-- End Agenda Terbaru -->

                            <!-- Top Selling -->
                            <div class="col">
                                <div class="card top-selling overflow-auto">

                                    <div class="card-body pb-0">
                                        <h5 class="card-title">Prestasi <span>| Terbaru</span></h5>

                                        @if ($prestasi->count())
                                        <table class="table datatable table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Prestasi</th>
                                                    <th scope="col">Deskripsi</th>
                                                    <th scope="col">Jenis</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($prestasi as $data)

                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td><a href="{{ route('prestasi.show', $data->slug) }}">{{
                                                            $data->title
                                                            }}</a></td>
                                                    <td>{!! Str::limit(strip_tags($data->description), 50) !!}</td>
                                                    <td>{{ $data->jenis }}</td>

                                                </tr>

                                                @endforeach
                                            </tbody>
                                            @else
                                            <span class="text-center d-block text-secondary">
                                                <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid"
                                                    style="max-width: 40%" alt="">
                                                <p>Tidak Ada Prestasi Terbaru</p>
                                            </span>

                                            @endif
                                        </table>

                                    </div>

                                </div>
                            </div><!-- End Top Selling -->
                        </div><!-- End Left side columns -->

                        <!-- Right side columns -->
                        <div class="col-lg-4">

                          
                            <!-- Kegiatan Terbaru  -->
                            <div class="card">
                                <div class="card-body pb-0">
                                    <h5 class="card-title">Kegiatan<span> | Terbaru</span></h5>

                                    @if ($kegiatan->count())
                                    @foreach ($kegiatan as $data)
                                    <div class="news pb-3">
                                        <div class="post-item clearfix">
                                            @if ($data->image == null)
                                            <img src="{{ asset('guest/assets/img/keg-sekolah.svg') }}"
                                                alt="{{ $data->title }}" class="card-img" loading="lazy">
                                            @else
                                            <img src="{{ asset('storage/'. $data->image) }}" alt="Foto" loding="lazy">
                                            @endif
                                            <h4><a href="{{ route('kegiatan.show', $data->slug) }}">{{ $data->title
                                                    }}</a></h4>
                                            <p>{!! Str::limit(strip_tags($data->description), 100) !!}</p>
                                        </div>
                                    </div><!-- End sidebar recent posts-->
                                    @endforeach
                                    @else
                                    <span class="text-center text-secondary">
                                        <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid" alt="">
                                        <p>Tidak Ada Kegiatan Terbaru</p>
                                    </span>

                                    @endif

                                </div>
                            </div><!-- End Kegiatan Terbaru -->

                        </div><!-- End Right side columns -->
                    </div>

                </div>
        </section>

    </main>

    @push('scripts')

    <!-- Bootstrap 5 -->
    <script type="text/javascript" src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Main js -->
    <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Datatables -->
    <script type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"> </script>



    <script>
        
        function updateGreeting() {
            const currentHour = new Date().getHours();
            let greeting;
    
            if (currentHour >= 1 && currentHour < 12) {
                greeting = 'Selamat Pagi';
            } else if (currentHour >= 12 && currentHour < 15) {
                greeting = 'Selamat Siang';
            } else if (currentHour >= 15 && currentHour < 18) {
                greeting = 'Selamat Sore';
            } else {
                greeting = 'Selamat Malam';
            }
    
            document.getElementById('greeting').innerText = greeting;
        }
    
        // Set initial greeting
        updateGreeting();
    
        // Update greeting every minute
        setInterval(updateGreeting, 60000); // 60000ms = 1 minute
    </script>
    @endpush
</x-app-layout>