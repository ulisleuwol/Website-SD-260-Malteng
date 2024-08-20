<x-app-layout>
  @slot('title', 'Show Sejarah')
  <main id="main" class="main">

    <x-back.breadcrumb :title="$title" :breadcrumbs="$breadcrumbs" /><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <x-back.show-data :data="[
                        'sejarah' => $sejarah->title,
                        'deskripsi' => $sejarah->deskripsi,
                        'penulis' => $sejarah->user->name,
                        'foto' => $sejarah->image,
                        'created_at' => $sejarah->created_at,
                        'updated_at' => $sejarah->updated_at,
                    ]" :backRoute="route('sejarah.index')" :imagePathPrefix="'storage/' . $sejarah->imagePathPrefix"/>
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