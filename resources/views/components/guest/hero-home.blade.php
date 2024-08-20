<section id="hero" class="hero">
  <div class="hero-banner">
    <img src="{{ asset('storage/' . $banner) }}"
      class="img-fluid img-hero position-absolute top-0 start-0 w-100" loading="lazy" alt="Banner">
    <div class="container position-relative py-4 my-4 z-2">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-12 d-flex flex-column justify-content-center text-start text-content">
          <h4 class="text-warning fw-bold fst-italic">Selamat Datang👋</h4>
          <h2>{{ $title }}</h2>
          <p>{{ $home }}</p>
          <div class="d-flex justify-content-start">
            <a href="{{ url('ppdb-sekolah') }}" class="tombol">Info PPDB</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="icon-boxes position-relative">
    <div class="container position-relative">
      <div class="icon-box row gy-4 mt-5 justify-content-center m-auto" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-6 col-md-12">
          <h3 class="text-white fw-bold">{{ $judul }}</h3>
          <p class="text-start">{!! $deskripsi !!}</p>
          <a href="{{ url('sejarah-sekolah') }}" class="">Lihat Detail <i
              class="ms-2 bi bi-arrow-right-circle-fill"></i></a>
        </div>
        <div class="col-lg-6 col-md-12">
          <h3 class="text-white fw-bold">Data Sekolah</h3>

          <div class="row justify-content-center box-data">
            <div class="text-white col-lg-3 col-6">
              <span class="d-block fs-1 fw-bold">
                @if ($guru == 0)
                0
                @else
                {{ $guru }}
                @endif
              </span>
              <span class="d-block small">Guru & Staff</span>
            </div>
            <div class="text-white col-lg-3 col-6">
              <span class="d-block fs-1 fw-bold">
                @if ($fasilitas == 0)
                0
                @else
                {{ $fasilitas }}
                @endif
              </span>
              <span class="d-block small">Fasilitas</span>
            </div>
            <div class="text-white col-lg-3 col-6">
              <span class="d-block fs-1 fw-bold">{{ $akreditas }}</span>
              <span class="d-block small">Akreditas</span>
            </div>
            <div class="text-white col-lg-3 col-6">
              <span class="d-block fs-1 fw-bold">
                @if ($prestasi == 0)
                0
                @else
                {{ $prestasi }}
                @endif
              </span>
              <span class="d-block small">Prestasi</span>
            </div>
            <div>
              <a href="{{ url('visi-misi-sekolah') }}" class="btn btn-sm border text-white mt-5"><i
                  class="bi bi-record-circle"></i> Visi & Misi</a>
            </div>
          </div>
        </div>
      </div>
      <!--End Icon Box -->


    </div>
  </div>

</section>