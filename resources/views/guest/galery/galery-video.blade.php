<x-guest.app-layout title="Galery Video">
  @push('link')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
  @endpush
  <main id="main">

    {{-- start heading --}}
    <x-guest.heading title="Galery Video" linkText="Galery Video" content="Sekolah Dasar Negeri 260 Maluku Tengah" />
    {{-- End heading --}}

    <section class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">

             {{-- search start --}}
             <div class="col-lg-6 m-auto mt-3">
              <x-guest.search />
            </div>
            {{-- search end --}}

          <!-- ======= Content Section ======= -->
          <div class="col-lg-12 galery">
            <div class="row gy-4">
              @if ($video->count() == 0)
              <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto"
              style="max-width: 40%" alt="no data" loading="lazy">
              @else
              @foreach ($video as $data)
              <div class="col-md-4">
                <a data-fancybox="gallery" href="https://www.youtube.com/watch?v={{ $data->judul }}">
                <article class="post">
                  <div class="post-img d-flex align-items-center justify-content-center position-relative">
                      <img src="https://img.youtube.com/vi/{{ $data->judul }}/hqdefault.jpg" alt="{{ $data->judul }}" class="img-fluid full-image">
                      <div class="overlay">
                        <p class="badge rounded bg-secondary small overlay-top-left"><i class="bi bi-camera-reels-fill"></i> Galery Video</p>
                        <h2 class="title overlay-center">
                          <p>{{ $data->deskripsi }}</p>
                          <i class="bi bi-play-circle-fill"></i>
                        </h2>
                        <div class="d-flex justify-content-between overlay-bottom">
                          <p class="small"><i class="icons bi bi-person-circle"></i> {{ $data->user->name }}</p>
                          <p class="small"><i class="icons bi bi-calendar3"></i> {{ (new \Carbon\Carbon($data->created_at))->format('d F Y') }}</p>
                        </div>
                      </div>
                    </div>
                  </article>
                </a>
              </div><!-- End post list item -->
              @endforeach
              @endif
            </div>
            <div class="float-end pt-4">
              {{ $video->links() }}
            </div><!-- End pagination -->
          </div>
          {{-- end content section --}}
        </div>
      </div>
    </section>

  </main><!-- End #main -->
  @push('script')
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  @endpush
</x-guest.app-layout>
