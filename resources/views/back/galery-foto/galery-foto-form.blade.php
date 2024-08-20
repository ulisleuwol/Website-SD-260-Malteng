<div class="modal fade" id="dataModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="ms-auto">
        <button type="button" class="btn-close fs-4" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel"></h1>
      <div class="modal-body">
        <!-- Form update data  -->
        <form id="modalForm">
          @csrf
          <input type="hidden" name="slug" id="slug">
          <input type="hidden" name="oldImage" value="">

          <div class="mb-3">
            <label for="judul" class="form-label">Judul<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required
              autofocus>
          </div>

          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control deskripsi" id="summernote" name="deskripsi">{{ old('deskripsi') }}</textarea>
          </div>

          <div class="mb-3">
            <label for="image" class="form-label">Foto<span class="text-danger">*</span></label>
            <div id="image-preview-container" class="py-2 d-flex gap-2 align-items-center flex-wrap"></div>
            <input type="file" class="form-control" name="image[]" id="image" accept="image/*" multiple
              onchange="previewImage()">
            <span class="text-muted small ms-2">Ukuran file maksimal 2 MB</span>
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