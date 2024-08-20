<div class="sidebar">
  <div class="slides-1 swiper sidebar-item">
    <div class="d-flex justify-content-between align-items-center sidebar-header">
      <h3 class="sidebar-title">Agenda</h3>
      <a href="{{ url('agenda-sekolah') }}" class="btn btn-sm btn-outline-primary">
        Lihat Semua
      </a>
    </div>
    <div class="mt-3 swiper-wrapper pb-4 pt-4">
      @if ($agenda->count() == 0)
      <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto" style="max-width: 50%" alt="Foto"
        loading="lazy">
      @else
      @foreach ( $agenda as $data)
      <div class="swiper-slide sidebar-post px-2 mb-3">
        <div class="card overflow-hidden" style="width:16rem;">
          <a href="#" data-bs-toggle="modal" class="card-text" data-bs-target="#modalagenda{{ $data->id }}">
            <div class="card-body">
              <div class="d-flex justify-content-between head">
                <span class="small mb-2 text-body-secondary"><i class="me-2 icons bi bi-calendar3"></i>{{
                  \Carbon\Carbon::parse($data->date_time)->isoFormat('D/MM/YYYY') }}</span>
                <span class="small mb-2 text-body-secondary"><i class="me-2 icons bi bi-clock"></i>{{
                  \Carbon\Carbon::parse($data->date_time)->format('H:i') }} WIT - Selesai</span>
              </div>
              <h3 class="pt-2 small text-dark">
                {{-- batasi hanya 33 karakter dari title --}}
                {{ \Illuminate\Support\Str::limit($data->title, 20) }}
              </h3>
              <span class="small text-muted mt-3"><i class="me-2 icons bi bi-geo-alt-fill"></i>{{
                $data->location
                }}</span>
            </div>
          </a>
        </div>
      </div>
      @endforeach
      @endif
    </div>
    <div class="swiper-pagination pt-5"></div>
  </div><!-- End sidebar agenda-->

  <hr class="pb-3">

  <div class="slides-1 swiper sidebar-item">
    <div class="d-flex justify-content-between align-items-center sidebar-header">
      <h3 class="sidebar-title">Kegiatan</h3>
      <a href="{{ url('kegiatan-sekolah') }}" class="btn btn-sm btn-outline-primary">
        Lihat Semua
      </a>
    </div>
    <div class="mt-3 swiper-wrapper pt-4">
      @if ($kegiatan->count() == 0)
      <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto" style="max-width: 50%" alt="Foto"
        loading="lazy">
      @else
      @foreach ( $kegiatan as $data)
      <div class="swiper-slide sidebar-post px-2 position-relative mb-3">
        <div class="image position-relative">

          <div class="date-card position-absolute bg-dark-transparent rounded">
            <div class="position-relative text-center text-white">
              <div class="hari fs-4 fw-bold" style="font-size: 0.4rem;">{{ (new
                \Carbon\Carbon($data->created_at))->format('d') }}</div>
              <div class="bulan" style="font-size: 0.7rem;">{{ (new \Carbon\Carbon($data->created_at))->format('F,
                Y') }}</div>
            </div>
          </div>

          @if ($data->image != null)
          <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->title }}" class="img" loading="lazy">
          @else
          <img src="{{ asset('guest/assets/img/keg-sekolah.svg') }}" class="img" alt="no data" loading="lazy">
          @endif
        </div>
        <div class="py-3">
          <h5 class="fw-bold small">{{ $data->title }}</h5>

          <a href="{{ route('kegiatan-sekolah-show', $data->slug) }}"
            class="readmore stretched-link text-end d-block"></a>
        </div>
      </div>
      @endforeach
      @endif
    </div>
    <div class="swiper-pagination pt-5"></div>
  </div><!-- End sidebar kegiatan -->

  <hr class="pb-3">

  <!-- sidebar pengumuman -->
  <div class="slides-1 swiper sidebar-item">
    <div class="d-flex justify-content-between align-items-center sidebar-header">
      <h3 class="sidebar-title">Pengumuman</h3>
      <a href="{{ url('pengumuman-sekolah') }}" class="btn btn-sm btn-outline-primary">
        Lihat Semua
      </a>
    </div>
    <div class="mt-3 swiper-wrapper pb-4 pt-4">
      @if ($pengumuman->count() == 0)
      <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto" style="max-width: 50%" alt="Foto"
        loading="lazy">
      @else
      @foreach ( $pengumuman as $data)
      <div class="swiper-slide sidebar-post px-2 mb-3">
        <div class="pengumuman-wrap">
          <div class="pengumuman-item">
            <div class="d-flex align-items-center">
              <div>
                <h5 class="fw-bold small">{{ $data->title }}</h5>
              </div>
            </div>
            <span class="pt-4 d-block small"> <i class="bi bi-info-circle-fill me-1 text-primary"></i> Detail
              Pengumuman</span>
            <p class="text-muted small pt-2">{{ $data->excerpt }}</p>
            <div class="d-flex justify-content-between">
              <a data-bs-toggle="modal" data-bs-target="#modalannouncement{{ $data->id }}">
                <button type="button" class="btn btn-sm btn-outline-primary"><i
                    class="bi bi-eye-fill me-1"></i>Lihat</button>
              </a>
              @if ($data->file)
              <a href="{{ asset('storage/'.$data->file) }}" download>
                <button type="button" class="btn btn-sm btn-primary"><i class="bi bi-download me-1"></i>Unduh</button>
              </a>
              @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @endif
    </div>
    <div class="swiper-pagination pt-5"></div>
  </div><!-- End sidebar pengumuman-->

</div><!-- End Blog Sidebar -->