<x-app-layout>
  @slot('title', 'Show Pengumuman')
  <main id="main" class="main">

    <x-back.breadcrumb :title="$title" :breadcrumbs="$breadcrumbs" /><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <x-back.show-data :data="[
            'pengumuman' => $pengumuman->title,
            'deskripsi' => $pengumuman->body,
            'penulis' => $pengumuman->user->name,
            'file' => $pengumuman->file,
            'created_at' => $pengumuman->created_at,
            'updated_at' => $pengumuman->updated_at,
            ]" :backRoute="route('pengumuman.index')" />
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