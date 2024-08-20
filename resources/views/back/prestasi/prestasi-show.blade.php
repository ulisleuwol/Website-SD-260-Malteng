<x-app-layout>
  @slot('title', 'Show Kegiatan')
  <main id="main" class="main">

    <x-back.breadcrumb :title="$title" :breadcrumbs="$breadcrumbs" /><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <x-back.show-data :data="[
                        'prestasi' => $prestasi->title,
                        'nama' => $prestasi->nama,
                        'deskripsi' => $prestasi->description,
                        'penulis' => $prestasi->user->name,
                        'foto' => $prestasi->image,
                        'tanggal' => $prestasi->date,
                        'jenis' => $prestasi->jenis,
                        'created_at' => $prestasi->created_at,
                        'updated_at' => $prestasi->updated_at,
                    ]" :backRoute="route('prestasi.index')"
            :imagePathPrefix="'storage/' . $prestasi->imagePathPrefix" />
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