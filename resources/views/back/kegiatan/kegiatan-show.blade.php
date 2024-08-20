<x-app-layout>
  @slot('title', 'Show Kegiatan')
  <main id="main" class="main">

    <x-back.breadcrumb :title="$title" :breadcrumbs="$breadcrumbs" /><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <x-back.show-data :data="[
                        'kegiatan' => $kegiatan->title,
                        'deskripsi' => $kegiatan->description,
                        'penulis' => $kegiatan->user->name,
                        'lokasi' => $kegiatan->location,
                        'foto' => $kegiatan->image,
                        'Waktu & Tanggal' => \Carbon\Carbon::parse($kegiatan->date_time)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm'),
                        'created_at' => $kegiatan->created_at,
                        'updated_at' => $kegiatan->updated_at,
                    ]" :backRoute="route('kegiatan.index')"
            :imagePathPrefix="'storage/' . $kegiatan->imagePathPrefix" />
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  @push('scripts')
  <!-- Bootstrap 5 -->
  <script type="text/javascript" src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Main js -->
  <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
  @endpush
</x-app-layout>