<x-guest.app-layout title="Agenda">
  <main id="main">
    {{-- start heading --}}
    <x-guest.heading title="Agenda" linkText="Agenda" content="Sekolah Dasar Negeri 260 Maluku Tengah" />
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

              @if ($agenda->count() == 0)
              <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto mt-5" style="max-width: 40%"
                alt="no data" loading="lazy" />
              @else
              @foreach ($agenda as $item)
              <div class="col-md-4">
                <a href="#" data-bs-toggle="modal" data-bs-target="#modalagenda{{ $item->id }}">
                  <article class="text-dark">
                    <div class="d-flex justify-content-between">
                      <span class="small"><i class="me-2 icons bi bi-calendar3"></i>{{
                        \Carbon\Carbon::parse($item->date_time)->isoFormat('D/MM/YYYY') }}</span>
                      <span class="small"><i class="me-2 icons bi bi-clock"></i> {{
                        \Carbon\Carbon::parse($item->date_time)->format('H:i') }} WIT - Selesai</span>
                    </div>
                    <h2 class="title pt-3">
                      {{ $item->title }}
                    </h2>
                    <div class="row justify-content-between">
                      <div class="small col-6"><i class="me-2 icons bi bi-geo-fill"></i>{{ $item->location }}
                      </div>
                      <div class="small col-6"><i class="me-2 icons bi bi-person-circle"></i>{{ $item->user->name
                        }}</div>
                    </div>
                  </article>
                </a>
              </div><!-- End post list item -->
              @endforeach
              @endif
            </div>
            <div class="float-end pt-4">
              {{ $agenda->onEachSide(0) }}
            </div><!-- End pagination -->
          </div>
          {{-- end content section --}}
          {{-- sidebar start --}}
          {{-- <div class="col-lg-4">
            <x-guest.sidebar />
          </div> --}}
          {{-- sidebar end --}}
        </div>
      </div>
    </section>

    {{-- include modal --}}
    @foreach ($agenda as $item)
    <x-guest.modal :title="$item->title" :dateTime="$item->date_time" :description="$item->description"
      :location="$item->location" type="agenda" :id="$item->id" :author="$item->user->name"
      :created_at="$item->created_at" />
    @endforeach
  </main><!-- End #main -->
</x-guest.app-layout>