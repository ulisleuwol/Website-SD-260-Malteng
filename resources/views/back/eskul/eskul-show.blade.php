<x-app-layout>
  @slot('title', 'Show Eskstrakurikuler')
  <main id="main" class="main">

    <x-back.breadcrumb :title="$title" :breadcrumbs="$breadcrumbs" /><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <x-back.show-data :data="[
            'eskul' => $eskul->eskul,
            'deskripsi' => $eskul->deskripsi,
            'penulis' => $eskul->user->name,
            'hari' => $eskul->hari,
            'pendamping' =>  $eskul->pendamping,
            'foto' => $eskul->image,
            'created_at' => $eskul->created_at,
            'updated_at' => $eskul->updated_at,
            ]" :backRoute="route('eskul.index')" :imagePathPrefix="'storage/' . $eskul->imagePathPrefix" />
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