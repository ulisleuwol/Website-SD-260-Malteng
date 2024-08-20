<x-guest.app-layout title="Kegiatan">
  <main id="main">

    {{-- start heading --}}
    <x-guest.heading title="Kegiatan" linkText="Kegiatan" content="Sekolah Dasar Negeri 260 Maluku Tengah" />
    {{-- End heading --}}

    <section class="blog kegiatan">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">

          {{-- search start --}}
          <div class="col-lg-6 m-auto mt-5">
            <x-guest.search />
          </div>
          {{-- search end --}}

          <!-- ======= Content Section ======= -->
          <div class="col-lg-12">

            <div class="row gy-4">
              {{-- Kegiatan terbaru --}}

              {{-- kalau ga ada data --}}
              @if ($kegiatan->count() == 0)
              <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto" style="max-width: 40%"
                alt="no data">
              @else
              @foreach ($kegiatan as $data)
              <div class="col-md-4">
                <div class="kegiatan-item position-relative">
                  <div class="image position-relative">
                    <div class="date-card position-absolute bg-dark-transparent rounded">
                      <div class="position-relative text-center py-1 text-white">
                        <div class="hari fs-1 fw-bold" style="font-size: 1rem;">{{ (new
                          \Carbon\Carbon($data->created_at))->format('d') }}</div>
                        <div class="bulan" style="font-size: 0.8rem;">{{ (new
                          \Carbon\Carbon($data->created_at))->format('F,
                          Y') }}</div>
                      </div>
                    </div>
                    {{-- kalau ada image --}}
                    <div class="card-img">
                      @if ($data->image != null)
                      <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->title }}" class="card-img"
                        loading="lazy">
                      @else
                      <img src="{{ asset('guest/assets/img/keg-sekolah.svg') }}" class="card-img" alt="no data"
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
                      <div class="text-muted col-6 small"><i class="icons bi bi-geo-fill"></i> {{ $data->location
                        }}</div>
                      <div class="text-muted col-6 small"><i class="icons bi bi-person-fill"></i> {{
                        $data->user->name
                        }}</div>
                    </div>
                  </div>
                </div>

              </div>
              @endforeach
              @endif
            </div>

            <div class="float-end pt-4">

              {{ $kegiatan->onEachSide(0) }}

            </div><!-- End pagination -->

          </div>
          {{-- end content section --}}

        </div>
      </div>
    </section>

  </main><!-- End #main -->
</x-guest.app-layout>