<x-app-layout>
  @slot('title', 'Show Fasilitas')
  <main id="main" class="main">

    <x-back.breadcrumb :title="$title" :breadcrumbs="$breadcrumbs" /><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <x-back.show-data :data="[
                        'fasilitas' => $fasilitas->nama,
                        'deskripsi' => $fasilitas->deskripsi,
                        'penulis' => $fasilitas->user->name,
                        'foto' => $fasilitas->image,
                        'keterangan' => $fasilitas->keterangan,
                        'created_at' => $fasilitas->created_at,
                        'updated_at' => $fasilitas->updated_at,
                    ]" :backRoute="route('fasilitas.index')" :imagePathPrefix="'storage/' . $fasilitas->imagePathPrefix" />
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