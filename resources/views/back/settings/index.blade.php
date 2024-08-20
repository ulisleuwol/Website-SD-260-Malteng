<x-app-layout>
  <main id="main" class="main">
    @slot('title', 'Pengaturan')

    <x-back.breadcrumb :title="$title" :breadcrumbs="$breadcrumbs" />

    <section class="section contact">
      <div class="row gy-4">
        <div class="col-xl-12">
          <div class="card p-4">
            <div class="card-body pt-3">
              <!-- Nav Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#general-settings"
                    data-tab-target="general-settings">General
                    Settings</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#social-media"
                    data-tab-target="social-media">Social Media</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#images"
                    data-tab-target="images">Images</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#deskripsi"
                    data-tab-target="deskripsi">Description</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#akreditas"
                    data-tab-target="akreditas">Accreditation</button>
                </li>
              </ul>
              <!-- Form Start -->
              <form action="{{ route('pengaturan.update', $pengaturan->id) }}" method="POST"
                enctype="multipart/form-data" id="modalForm">
                @method('PUT')
                @csrf
                <!-- Tab Content -->
                <div class="tab-content pt-2">
                  <!-- General Settings Tab -->
                  <div class="tab-pane fade" id="general-settings">
                    <h5 class="card-title">General Settings</h5>
                    <div class="row mb-3">
                      <label for="nama_web" class="col-md-4 col-form-label">Nama Website</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="nama_web" name="nama_web"
                          value="{{ $pengaturan->nama_web }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-form-label">Email</label>
                      <div class="col-md-8">
                        <input type="email" class="form-control" id="email" name="email"
                          value="{{ $pengaturan->email }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="telp" class="col-md-4 col-form-label">No Telp / Hp</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="telp" name="telp" value="{{ $pengaturan->telp }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="jam_kerja" class="col-md-4 col-form-label">Jam Kerja</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="jam_kerja" name="jam_kerja"
                          value="{{ $pengaturan->jam_kerja }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="alamat" class="col-md-4 col-form-label">Alamat</label>
                      <div class="col-md-8">
                        <textarea class="form-control" id="alamat" name="alamat">{{ $pengaturan->alamat }}</textarea>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="map" class="col-md-4 col-form-label">Map</label>
                      <div class="col-md-8">
                        <textarea class="form-control" id="map" name="map" rows="8">{{ $pengaturan->map }}</textarea>
                      </div>
                    </div>
                  </div>

                  <!-- Social Media Tab -->
                  <div class="tab-pane fade" id="social-media">
                    <h5 class="card-title">Social Media</h5>
                    <div class="row mb-3">
                      <label for="twitter" class="col-md-4 col-form-label">Twitter</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="twitter" name="twitter"
                          value="{{ $pengaturan->twitter }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="ig" class="col-md-4 col-form-label">Instagram</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="ig" name="ig" value="{{ $pengaturan->ig }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="facebook" class="col-md-4 col-form-label">Facebook</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="facebook" name="facebook"
                          value="{{ $pengaturan->facebook }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="youtube" class="col-md-4 col-form-label">YouTube</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="youtube" name="youtube"
                          value="{{ $pengaturan->youtube }}">
                      </div>
                    </div>
                  </div>

                  <!-- Images Tab -->
                  <div class="tab-pane fade" id="images">
                    <h5 class="card-title">Images</h5>
                    <div class="mb-3">
                      <label for="logo" class="form-label">Logo</label>
                      <img id="logo-preview" class="img-preview img-fluid col-sm-2 py-2 d-block"
                        src="{{ $pengaturan->logo ? asset('storage/' . $pengaturan->logo) : '' }}"
                        style="{{ $pengaturan->logo ? '' : 'display: none;' }}">
                      <input type="file" class="form-control" name="logo" id="logo" accept="image/*"
                        onchange="previewImage('logo')">
                    </div>
                    <div class="mb-3">
                      <label for="banner" class="form-label">Banner</label>
                      <img id="banner-preview" class="img-preview img-fluid col-sm-2 py-2 d-block"
                        src="{{ $pengaturan->banner ? asset('storage/' . $pengaturan->banner) : '' }}"
                        style="{{ $pengaturan->banner ? '' : 'display: none;' }}">
                      <input type="file" class="form-control" name="banner" id="banner" accept="image/*"
                        onchange="previewImage('banner')">
                    </div>
                    <div class="mb-3">
                      <label for="background" class="form-label">Background</label>
                      <img id="background-preview" class="img-preview img-fluid col-sm-2 py-2 d-block"
                        src="{{ $pengaturan->background ? asset('storage/' . $pengaturan->background) : '' }}"
                        style="{{ $pengaturan->background ? '' : 'display: none;' }}">
                      <input type="file" class="form-control" name="background" id="background" accept="image/*"
                        onchange="previewImage('background')">
                    </div>
                    <div class="mb-3">
                      <label for="favicon" class="form-label">Favicon</label>
                      <img id="favicon-preview" class="img-preview img-fluid col-sm-2 py-2 d-block"
                        src="{{ $pengaturan->favicon ? asset('storage/' . $pengaturan->favicon) : '' }}"
                        style="{{ $pengaturan->favicon ? '' : 'display: none;' }}">
                      <input type="file" class="form-control" name="favicon" id="favicon" accept="image/*"
                        onchange="previewImage('favicon')">
                    </div>
                  </div>

                  <!-- Description Tab -->
                  <div class="tab-pane fade" id="deskripsi">
                    <h5 class="card-title">Description</h5>
                    <div class="row mb-3">
                      <label for="deskripsi" class="col-md-4 col-form-label">Deskripsi</label>
                      <div class="col-md-8">
                        <textarea class="form-control" id="deskripsi" name="deskripsi" cols="30"
                          rows="3">{{ $pengaturan->deskripsi }}</textarea>
                      </div>
                    </div>
                  </div>

                  <!-- Accreditation Tab -->
                  <div class="tab-pane fade" id="akreditas">
                    <h5 class="card-title">Accreditation</h5>
                    <div class="row mb-3">
                      <label for="akreditas" class="col-md-4 col-form-label">Akreditasi</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="akreditas" name="akreditas"
                          value="{{ $pengaturan->akreditas }}">
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Submit Button -->
                <div class="float-end">
                  <x-button class="" type="submit" title="">
                    <i class="bi bi-pencil-square"></i> Ubah
                  </x-button>
                </div>
              </form>
              <!-- End Bordered Tabs -->
            </div>

          </div>
        </div>
      </div>
    </section>
  </main>

  @push('scripts')
  <!-- Jquery 3 -->
  <script type="text/javascript" src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

  <!-- Bootstrap 5 -->
  <script type="text/javascript" src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>

  <!-- Main js -->
  <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>

  <!-- Laravel Javascript Validation -->
  <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
  {!! JsValidator::formRequest('App\Http\Requests\PengaturanRequest', '#modalForm') !!}

  <!-- Sweet Alert2 -->
  <script type="text/javascript" src="{{ asset('assets/vendor/sweetalert/sweetalert2.js') }}"></script>

  <script>
    @if (session('success'))
      Swal.fire({
        icon: "success",
        title: "Sukses",
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000,
      });
    @endif

    @if (session('error'))
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "{{ session('error') }}",
        showConfirmButton: false,
        timer: 2000,
      });
    @endif

    function previewImage(id) {
      const input = document.getElementById(id);
      const preview = document.getElementById(`${id}-preview`);
      const file = input.files[0];
      const reader = new FileReader();

      reader.onloadend = function() {
        preview.src = reader.result;
        preview.style.display = 'block';
      };

      if (file) {
        reader.readAsDataURL(file);
      } else {
        preview.src = '';
        preview.style.display = 'none';
      }
    }

    var activeTabGeneralSettings = localStorage.getItem('activeTabGeneralSettings');
    var defaultTabGeneralSettings = 'general-settings'; // Default tab if no tab is saved

    if (!activeTabGeneralSettings) {
      localStorage.setItem('activeTabGeneralSettings', defaultTabGeneralSettings);
      activeTabGeneralSettings = defaultTabGeneralSettings;
    }

    var tabGeneralSettings = document.querySelector('[data-tab-target="' + activeTabGeneralSettings + '"]');
    if (tabGeneralSettings) {
      tabGeneralSettings.classList.add('active');
      var targetGeneralSettings = document.querySelector('#' + activeTabGeneralSettings);
      if (targetGeneralSettings) {
        targetGeneralSettings.classList.add('active', 'show');
      }
    }

    var tabsGeneralSettings = document.querySelectorAll('.nav-tabs .nav-link');
    tabsGeneralSettings.forEach(function (tab) {
      tab.addEventListener('click', function () {
        var target = tab.getAttribute('data-tab-target');
        localStorage.setItem('activeTabGeneralSettings', target);
      });
    });
  </script>
  @endpush
</x-app-layout>