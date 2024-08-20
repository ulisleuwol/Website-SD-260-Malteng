<x-guest.app-layout>
  <!-- ======= Hero Section ======= -->
  <x-guest.hero-home :title='$nama_web' :banner='$banner' :deskripsi='$deskripsi' :judul='$title'
    :akreditas='$akreditas' :guru='$total' :fasilitas='$fasilitas' :prestasi='$prestasi' :home='$home' />

  <!-- End Hero Section -->

  {{-- Main --}}
  <main id="main">

    <!-- ======= Kegiatan Section ======= -->
    <section id="kegiatan" class="kegiatan ">
      <div class="container" data-aos="fade-up">

        <div class="mb-5 row text-center align-items-center justify-content-between">
          <div class="col-md-4">
            <h2 class="fw-bold">Kegiatan</h2>
          </div>
          <div class="col-md-4">
            <p class="small">Berbagai kegiatan dari SD Negeri 260 Maluku Tengah</p>
          </div>
          <div class="col-md-4 text-md-end">
            <a href="{{ url('kegiatan-sekolah') }}" class="btn btn-sm btn-outline-primary">
              Lihat Semua Kegiatan
            </a>
          </div>
        </div>


        <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">

          {{-- Kegiatan terbaru --}}
          @if ($kegiatan->count() == 0)
          <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto" style="max-width: 40%" alt="Foto"
            loading="lazy">
          @else
          @foreach ($kegiatan as $data)
          <div class="col-lg-4 col-md-6">
            <div class="kegiatan-item position-relative">
              <div class="image position-relative">
                <div class="date-card position-absolute bg-dark-transparent rounded">
                  <div class="position-relative text-center py-1 text-white">
                    <div class="hari fs-1 fw-bold" style="font-size: 1rem;">{{ (new
                      \Carbon\Carbon($data->created_at))->format('d') }}</div>
                    <div class="bulan" style="font-size: 0.8rem;">{{ (new \Carbon\Carbon($data->created_at))->format('F,
                      Y') }}</div>
                  </div>
                </div>
                {{-- kalau ada image --}}
                <div class="card-img">
                  @if ($data->image != null)
                  <img src="{{ 'storage/' . $data->image }}" alt="{{ $data->title }}" class="card-img" loading="lazy">
                  @else
                  <img src="{{ asset('guest/assets/img/keg-sekolah.svg') }}" alt="Kegiatan Sekolah" class="card-img"
                    loading="lazy">
                  @endif
                </div>
              </div>
              <div class="content">
                <h3>{{ $data->title }}</h3>
                <p class="">{{ $data->excerpt }}</p>

                <a href="{{ route('kegiatan-sekolah-show', $data->slug) }}"
                  class="readmore stretched-link text-end d-block"></a>

                <div class="row justify-content-between border-top pt-2 mt-2">
                  <div class="text-muted col-6 small"><i class="icons bi bi-geo-fill"></i> {{ $data->location }}
                  </div>
                  <div class="text-muted col-6 small"><i class="icons bi bi-person-fill"></i> {{
                    $data->user->name
                    }}</div>
                </div>
              </div>
            </div>

          </div>
          @endforeach
          @endif
          <!-- End Kegiatan Item -->
        </div>
      </div>
    </section><!-- End Our kegiatan Section -->

    <!-- ======= Agenda Home Section ======= -->
    <section id="agenda-home" class="agenda-home">
      <div class="container" data-aos="fade-up">

        <div class="mb-5 row text-center d-flex flex-wrap text-white align-items-center justify-content-between">
          <div class="col-md-4">
            <h2 class="fw-bold">Agenda</h2>
          </div>
          <div class="col-md-4">
            <p class="small">Berbagai agenda dari SD Negeri 260 Maluku Tengah</p>
          </div>
          <div class="col-md-4 text-md-end">
            <a href="{{ url('agenda-sekolah') }}" class="btn btn-sm btn-outline-light">
              Lihat Semua Agenda
            </a>
          </div>
        </div>

        <div class=" item-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            {{-- Agenda terbaru --}}
            @if ($agenda->count() == 0)
            <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto" style="max-width: 40%"
              alt="no data" loading="lazy">
            @else
            @foreach ($agenda as $data)
            <div class="swiper-slide d-flex justify-content-center">
              <div class="card overflow-hidden" style="width: 20rem;">
                <a data-bs-toggle="modal" class="card-text" data-bs-target="#modalagenda{{ $data->id }}">
                  <div class="card-body">
                    <div class="d-flex justify-content-between head">
                      <span class="small mb-2 text-body-secondary"><i class="me-2 icons bi bi-calendar3"></i>{{
                        \Carbon\Carbon::parse($data->date_time)->format('d F Y') }}</span>
                      <span class="small mb-2 text-body-secondary"><i class="me-2 icons bi bi-clock"></i>{{
                        \Carbon\Carbon::parse($data->date_time)->format('H:i') }} WIT - Selesai</span>
                    </div>
                    <h5 class="pt-2">
                      {{-- batasi hanya 33 karakter dari title --}}
                      {{ \Illuminate\Support\Str::limit($data->title, 20) }}
                    </h5>
                    <p class="small text-body-secondary mt-3"><i class="me-2 icons bi bi-geo-alt-fill"></i>{{
                      $data->location
                      }}</p>
                  </div>
                </a>
              </div>
            </div>
            @endforeach
            @endif

          </div>
          <div class="swiper-pagination"></div>
        </div>

        {{-- include modal --}}
        @foreach ($agenda as $item)
        <x-guest.modal :title="$item->title" :dateTime="$item->date_time" :description="$item->description"
          :location="$item->location" type="agenda" :id="$item->id" :author="$item->user->name"
          :created_at="$item->created_at" />
        @endforeach

      </div>
    </section>
    <!-- End Agenda Home Section -->

    <!-- ======= Pengumuman Section ======= -->
    <section id="pengumumans" class="pengumumans sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="mb-5 row text-center d-flex flex-wrap align-items-center justify-content-between">
          <div class="col-md-4">
            <h2 class="fw-bold">Pengumuman</h2>
          </div>
          <div class="col-md-4">
            <p class="small">Menyajikan Publikasi Pengumuman dari SD Negeri 260 Maluku Tengah</p>
          </div>
          <div class="col-md-4 text-md-end">
            <a href="{{ url('pengumuman-sekolah') }}" class="btn btn-sm btn-outline-primary">
              Lihat Semua Pengumuman
            </a>
          </div>
        </div>

        <div class="item-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            @if ($pengumuman->count() == 0)
            <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto" style="max-width: 40%"
              alt="no data" loading="lazy">
            @else
            @foreach ( $pengumuman as $data)
            <div class="swiper-slide">
              <div class="pengumuman-wrap">
                <div class="pengumuman-item">
                  <div class="d-flex align-items-center">
                    <span><i class="bi bi-megaphone-fill fs-4 pengumuman-img p-2"></i></span>
                    <div>
                      <h3>{{ \Illuminate\Support\Str::limit($data->title, 30) }}</h3>
                    </div>
                  </div>
                  <span class="pt-4 d-block"> <i class="bi bi-info-circle-fill me-1 text-primary"></i> Detail
                    Pengumuman</span>
                  <p class="text-muted small">
                    {{ $data->excerpt }}
                  </p>
                  <div class="d-flex justify-content-between">
                    <a data-bs-toggle="modal" data-bs-target="#modalannouncement{{ $data->id }}">
                      <button type="button" class="btn btn-sm btn-outline-primary"><i
                          class="bi bi-eye-fill me-1"></i>Lihat</button>
                    </a>
                    @if ($data->file)
                    <a href="{{ asset('storage/'.$data->file) }}" target="_blank">
                      <button type="button" class="btn btn-sm btn-primary">
                        <i class="bi bi-download me-1"></i> Unduh
                      </button>
                    </a>
                    @endif
                  </div>
                </div>
              </div>
            </div><!-- End pengumuman item -->
            @endforeach
            @endif

          </div>
          <div class="swiper-pagination"></div>
        </div>

        {{-- include modal --}}
        @foreach ($pengumuman as $item)
        <x-guest.modal :title="$item->title" :description="$item->body" :file="$item->file"
          :created_at="$item->created_at" type="announcement" :id="$item->id" :author="$item->user->name" />
        @endforeach

      </div>
    </section><!-- End Pengumuman Section -->

    <!-- ======= Ekstrakurikuler Section ======= -->
    <section id="eskul" class="eskul">
      <div class="container" data-aos="fade-up">

        <div class="mb-5 row text-center d-flex flex-wrap align-items-center justify-content-between">
          <div class="col-md-4">
            <h2 class="fw-bold">Ekstrakurikuler</h2>
          </div>
          <div class="col-md-4">
            <p class="small">Kegiatan Ekstrakurikuler yang ada di SD Negeri 260 Maluku Tengah</p>
          </div>
          <div class="col-md-4 text-md-end">
            <a href="{{ url('eskul-sekolah') }}" class="btn btn-sm btn-outline-primary">
              Lihat Semua
            </a>
          </div>
        </div>

        <div class="slides-4 swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            {{-- eskul terbaru --}}
            @if ($eskul->count() == 0)
            <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto" style="max-width: 40%"
              alt="no data" loading="lazy">
            @else
            @foreach ($eskul as $data)
            <div class="swiper-slide">

              <a href="{{ route('eskul-sekolah-show', $data->slug) }}">
                <article>
                  <div class="eskul-img">
                    <span class="badge badge-eskul"><i class="bi bi-universal-access-circle"></i> Eskul</span>
                    <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->eskul }}" class="img"
                      loading="lazy">
                  </div>

                  <h2 class="title text-center pt-3">
                    {{ $data->eskul }}
                  </h2>
                </article>
              </a>
            </div>
            <!-- End eskul list item -->
            @endforeach
            @endif

          </div>
        </div><!-- End eskuls list -->

      </div>
    </section><!-- End Ekstrakurikuler Section -->

    <!-- ======= Data Guru Section ======= -->
    <section id="guru" class="guru sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Daftar Guru & Staff</h2>
          <p>Berkenalan Dengan Guru-Guru SD Negeri 260 Maluku Tengah</p>
        </div>

        <div class="slides-4 swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            @if ($guru->count() == 0)
            <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto" style="max-width: 40%"
              alt="no data" loading="lazy">
            @else
            @foreach ($guru as $data)
            <div class="swiper-slide my-4 d-flex justify-content-center img-guru" data-aos="fade-up"
              data-aos-delay="100">
              <div class="member">
                <span class="badge badge-guru text-white"><i class="bi bi-person-fill-check"></i> {{ $data->jabatan
                  }}</span>

                <img src="{{ 'storage/guru-images/thumbnail/'. $data->image  }}" class="card-img"
                  alt="{{ $data->nama }}" loading="lazy">
                <h4>{{ $data->nama }}</h4>
              </div>
            </div><!-- End guru -->
            @endforeach
            @endif

          </div>
        </div>

        <div class="text-center py-4 my-4">
          <a href="{{ url('data-guru') }}" class="btn btn-sm btn-outline-primary">Lihat Semua Guru <i
              class="bi bi-arrow-right"></i></a>
        </div>

      </div>
    </section>
    <!-- End Data Guru Section -->

  </main><!-- End #main -->

</x-guest.app-layout>