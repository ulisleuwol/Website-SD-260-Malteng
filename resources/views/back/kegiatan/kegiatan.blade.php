<div class="row">
  <div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <x-button onclick="showModal()" class="btn-sm" title="Tambah Data">
            <i class="bi bi-patch-plus"></i> Tambah Data
          </x-button>
        </div>

        <!-- Tombol Hapus Terpilih -->
        <form id="bulk-delete-form" action="#" method="POST" data-url="{{ route('kegiatan.bulk_delete') }}"
          style="display: none;">
          @csrf
          @method('DELETE')
          <input type="hidden" id="bulk-delete-ids" name="ids">
          <x-button id="delete-selected" class="btn-sm btn-danger mb-3"><i class="bi bi-trash"></i>Hapus
            Terpilih
          </x-button>
        </form>

        <!-- Table -->
        {{ $dataTable->table(['class' => 'table table-striped table-hover', 'style' => 'width:100%']) }}
        <!-- End Table -->

      </div>
    </div>

  </div>
</div>


{{-- Modal Kegiatan --}}
<div class="modal fade" id="dataModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="ms-auto">
        <button type="button" class="btn-close fs-4" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel"></h1>
      <div class="modal-body">
        <!-- Form input/update data  -->
        <form id="modalForm">
          @csrf
          <input type="hidden" name="slug" id="slug">
          <input type="hidden" name="oldImage" value="">

          <div class="mb-3">
            <label for="title" class="form-label">Kegiatan<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required
              autofocus>
          </div>

          <div class="mb-3">
            <label class="form-label" for="description">Deskripsi<span class="text-danger">*</span></label>
            <textarea class="form-control description" id="summernote" name="description" rows="5"
              value="{{ old('description') }}">{{ old('description') }}</textarea>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="date_time" class="form-label">Waktu & Tanggal<span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control" id="date_time" name="date_time"
                  value="{{ old('date_time') }}" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="location" class="form-label">Lokasi<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}"
                  required>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="image" class="form-label">Foto</label>

            <img id="image-preview" class="img-preview img-fluid col-sm-2 py-2 d-block" style="display: none;">

            <input type="file" class="form-control" name="image" id="image" accept="image/*" onchange="previewImage()">
          </div>


          <div class="float-end">
            <div class="m-3">
              <x-button type="button" class="btn-secondary" data-bs-dismiss="modal">Keluar</x-button>
              <x-button class="btnSubmit"></x-button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>