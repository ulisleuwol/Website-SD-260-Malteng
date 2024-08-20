<x-app-layout>
  @slot('title', 'Show Galery Video')
  <main id="main" class="main">

    <x-back.breadcrumb :title="$title" :breadcrumbs="$breadcrumbs" /><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <x-back.show-data :data="[
                        'tautan' => $galery_video->judul,
                        'deskripsi' => $galery_video->deskripsi,
                        'created_at' => $galery_video->created_at,
                        'updated_at' => $galery_video->updated_at,
                    ]" :backRoute="route('galery-video.index')" />
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