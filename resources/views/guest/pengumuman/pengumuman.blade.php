<x-guest.app-layout title="Pengumuman">
  <main id="main">
    {{-- start heading --}}
    <x-guest.heading title="Pengumuman" linkText="Pengumuman" content="Sekolah Dasar Negeri 260 Maluku Tengah" />
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

              @if ($pengumuman->count() == 0)
              <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto mt-5" style="max-width: 40%"
                alt="no data" loading="lazy" />
              @else
              @foreach ($pengumuman as $item)
              <div class="col-md-4">
                <a href="#" data-bs-toggle="modal" data-bs-target="#modalannouncement{{ $item->id }}">
                <article class="text-dark">
                  <div class="post-img mt-4">
                    <img src="{{ asset('guest/assets/img/pengumuman-logo.svg') }}" alt="{{ $item->title }}"
                      class="img-fluid" loading="lazy">
                  </div>
                  <h2 class="title">
                      {{ $item->title }}
                    </h2>
                    <p>{{ $item->excerpt }}</p>
                    <div class="d-flex justify-content-between">
                      <p class="small"><i class="me-2 icons bi bi-calendar3"></i>{{
                        \Carbon\Carbon::parse($item->updated_at)->locale('id')->diffForHumans() }}</p>
                    <p class="small"><i class="me-2 icons bi bi-person-circle"></i>{{ $item->user->name }}</p>
                  </div>
                </article>
              </a>
              </div><!-- End post list item -->
              @endforeach
              @endif
            </div>
            <div class="float-end pt-4">

              {{ $pengumuman->onEachSide(0) }}

            </div><!-- End pagination -->
          </div>
        </div>
      </div>
    </section>

    {{-- include modal --}}
    @foreach ($pengumuman as $item)
    <x-guest.modal :title="$item->title" :description="$item->body" :file="$item->file" :created_at="$item->created_at" :author="$item->user->name" type="announcement"
      :id="$item->id" />
    @endforeach
  </main><!-- End #main -->
</x-guest.app-layout>