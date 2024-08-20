<x-guest.app-layout title="Galery">
  <main id="main">

    {{-- start heading --}}
    <x-guest.heading title="Galery Foto" linkText="Galery Foto" content="Sekolah Dasar Negeri 260 Maluku Tengah" />
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
          <div class="col-lg-12 posts-list">
            <div class="row gy-4">

              @if ($foto->count() == 0)
              <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto" style="max-width: 40%"
                alt="no data" loading="lazy">
              @else
              @foreach ($foto as $data)
              <div class=" col-md-4">
                <a href="{{ route('galery-foto-show', $data->slug) }}">
                  <article class="text-dark">

                    <div class="post-img">
                      @php
                      $images = json_decode($data->image, true);
                      @endphp
                      @if ($images && count($images) > 0)
                      <img src="{{ asset('storage/' . $images[0]) }}" alt="{{ $data->judul }}" class="img-fluid">
                      @endif
                    </div>

                    <p class="small badge bg-secondary text-white">{{ count($images) }} Foto</p>

                    <h2 class="title">
                      {{ $data->judul }}
                    </h2>

                    <div class="d-flex justify-content-between">

                      <p class="small text-muted"><i class="me-2 icons bi bi-person-fill"></i>{{
                        $data->user->name
                        }}</p>
                      <p class="small text-muted"><i class="me-2 icons bi bi-calendar-date"></i>
                        {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM YYYY') }}
                      </p>

                    </div>

                  </article>
                </a>
              </div><!-- End post list item -->
              @endforeach
              @endif
            </div>

            <div class="float-end pt-4">

              {{ $foto->onEachSide(0) }}

            </div><!-- End pagination -->
          </div>
          {{-- end content section --}}
        </div>
      </div>
    </section>

  </main><!-- End #main -->
</x-guest.app-layout>