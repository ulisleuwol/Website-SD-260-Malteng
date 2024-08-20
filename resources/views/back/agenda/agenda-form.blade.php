<div class="modal fade" id="dataModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="ms-auto">
        <button type="button" class="btn-close fs-4" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <h1 class="modal-title fs-5 text-center fw-bold" id="staticBackdropLabel"></h1>
      <div class="modal-body">
        <!-- Form update data -->
        <form id="modalForm">
          @csrf
          <input type="hidden" name="slug" id="slug">

          <div class="mb-3">
            <label for="title" class="form-label">Agenda<span class="text-danger">*</span></label>
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