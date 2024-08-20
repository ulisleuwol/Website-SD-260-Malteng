{{-- <x-app-layout>
  @slot('title', 'Tambah Visi Misi')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Tambah Visi Misi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Informasi</li>
          <li class="breadcrumb-item active">Tambah Visi Misi</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body ">
              <div class="card-title">
                <x-button as="a" href="{{ route('visi-misi.index') }}" class="btn-sm">
                  <i class="bi bi-arrow-left-circle"></i> Kembali
                </x-button>
              </div>

              <!-- Form update data kegiatan -->
              <form action="{{ route('visi-misi.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="jenis" class="form-label">Jenis</label>
                  <input type="text" class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis"
                    value="{{ old('jenis') }}">
                  @error('jenis')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label" for="deskripsi">Deskripsi</label>
                  <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi"
                    name="deskripsi" rows="5">{{ old('deskripsi') }}</textarea>

                  @error('deskripsi')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>


                <div class="mb-3 float-end">
                  <x-button class="btn-danger" type="reset">Reset</x-button>
                  <x-button>Simpan</x-button>
                </div>
              </form>
              <!-- End Form update data kegiatan -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

</x-app-layout> --}}