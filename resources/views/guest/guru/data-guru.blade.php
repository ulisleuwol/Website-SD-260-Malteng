<x-guest.app-layout title="Data Guru">
  @push('link')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
  @endpush
  <main id="main">

    {{-- start heading --}}
    <x-guest.heading title="Data Guru" linkText="Data Guru" content="Sekolah Dasar Negeri 260 Maluku Tengah" />
    {{-- End heading --}}

    <section id="blog" class="guru">
      <div class="container" data-aos="fade-up">

        <div class="row">

          {{-- search start --}}
          <div class="col-lg-6 m-auto">
            <x-guest.search />
          </div>
          {{-- search end --}}

          <!-- ======= Data Pendidik  ======= -->
          <div class="col-lg-12">

            <div class="row gy-4">
              @if ($guru->count() == 0)
              <div class="py-5 my-5 text-center">
                <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid" style="max-width: 40%" alt="No Data"
                  loading="lazy">
                <p class="text-center text-muted">Tidak Ada Data Yang Bisa Di Tampilkan</p>
              </div>
              @else
              @foreach ($guru as $data)
              <div class="col-md-3 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="member">
                  <a href="{{ asset('storage/guru-images/'. $data->image)  }}" data-fancybox="guru"
                    data-caption="{{ $data->nama }}">
                    <img src="{{ asset('storage/guru-images/thumbnail/'. $data->image)  }}" class="guru-photo card-img"
                      alt="{{ $data->nama }}" loading="lazy">
                  </a>
                  <h4>{{ $data->nama }}</h4>
                  <span>{{ $data->jabatan }}</span>
                </div>
              </div><!-- End Guru -->
              @endforeach
              @endif
            </div>

            <div class="float-end pt-4">
              {{ $guru->onEachSide(0) }}
            </div><!-- End pagination -->

          </div>
          <!-- End Data Pendidik Section -->
        </div>

      </div>
    </section>

  </main><!-- End #main -->

  @push('script')
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  @endpush

</x-guest.app-layout>