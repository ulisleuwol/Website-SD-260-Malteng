<x-app-layout>
  @slot('title', 'Show Agenda')
  <main id="main" class="main">

    <x-back.breadcrumb :title="$title" :breadcrumbs="$breadcrumbs" /><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <x-back.show-data :data="[
            'agenda' => $agenda->title,
            'deskripsi' => $agenda->description,
            'penulis' => $agenda->user->name,
            'lokasi' => $agenda->location,
            'waktu & tanggal' => \Carbon\Carbon::parse($agenda->date_time)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm'),
            'status' =>  $agenda->date_time,
            'created_at' => $agenda->created_at,
            'updated_at' => $agenda->updated_at,
            ]" :backRoute="route('agenda.index')" />
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