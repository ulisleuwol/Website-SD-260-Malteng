<x-app-layout>
  @slot('title', 'Show Galaery Foto')
  <main id="main" class="main">

    <x-back.breadcrumb :title="$title" :breadcrumbs="$breadcrumbs" /><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <x-back.show-data :data="[
                        'judul' => $galery_foto->judul,
                        'deskripsi' => $galery_foto->deskripsi,
                        'penulis' => $galery_foto->user->name,
                        'foto' => $galery_foto->image,
                        'created_at' => $galery_foto->created_at,
                        'updated_at' => $galery_foto->updated_at,
                    ]" :backRoute="route('galery-foto.index')" :imagePathPrefix="'storage/' . $galery_foto->imagePathPrefix" />
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