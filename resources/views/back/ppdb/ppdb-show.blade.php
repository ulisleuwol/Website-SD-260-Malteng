<x-app-layout>
  @slot('title', 'Show PPDB')
  <main id="main" class="main">

    <x-back.breadcrumb :title="$title" :breadcrumbs="$breadcrumbs" /><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <x-back.show-data :data="[
            'Title' => $ppdb->name,
            'deskripsi' => $ppdb->deskripsi,
            'penulis' => $ppdb->user->name,
            'foto' => $ppdb->image,
            'created_at' => $ppdb->created_at,
            'updated_at' => $ppdb->updated_at,
            ]" :backRoute="route('ppdb.index')" :imagePathPrefix="'storage/' . $ppdb->imagePathPrefix" />
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