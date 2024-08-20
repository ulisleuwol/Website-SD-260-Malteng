<x-guest.app-layout title="Fasilitas">
  <main id="main">

    {{-- start heading --}}
    <x-guest.heading title="Fasilitas" linkText="Fasilitas" content="Sekolah Dasar Negeri 260 Maluku Tengah" />
    {{-- End heading --}}

    <section class="fasilitas">
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

              @if ($fasilitas->count() == 0)
              <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto" style="max-width: 40%"
                alt="no data" loading="lazy">
              @else
              @foreach ($fasilitas as $data)
              <div class="col-xl-3 col-lg-4 col-md-6 ">
                <a href="{{ route('fasilitas-sekolah-show', $data->slug) }}">
                  <div class="card border-0">

                    <img src="{{ 'storage/'. $data->image }}" class="card-img-top" alt="Fasilitas" loading="lazy">
                    <span class="badge badge-fasilitas"><i class="bi bi-building"></i> Fasilitas</span>

                    <div class="card-body">
                      <h5 class="card-title">{{ $data->nama }}</h5>
                      <p class="card-text">{!! Str::limit(strip_tags($data->deskripsi), 100) !!}</p>
                      <span class="float-end badge rounded-pill text-bg-secondary"><i class="bi bi-bookmark-check"></i>
                        {{ $data->keterangan }}</span>
                    </div>
                  </div>
                </a>
              </div>
              @endforeach
              @endif
            </div>

            {{-- end content section --}}

            {{-- pagination --}}
            <div class="d-flex justify-content-center mt-5">
              {{ $fasilitas->links() }}
            </div>

          </div>
        </div>
    </section>

  </main><!-- End #main -->
</x-guest.app-layout>