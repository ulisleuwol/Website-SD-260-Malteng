<x-app-layout>
  @slot('title', 'Profil')
  <main id="main" class="main">

    <x-back.breadcrumb :title="$title" :breadcrumbs="$breadcrumbs" /><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-md-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              @if (Auth::user()->image)
              <img src="{{ asset('storage/'. Auth::user()->image) }}" alt="Profile" class="rounded-circle img-fluid">
              @else
              <i class="bi bi-person-circle fs-1"></i>
              @endif

              <h2>{{ Auth::user()->name }}</h2>
              <h3>{{ Auth::user()->email }}</h3>

            </div>
          </div>
        </div>

        <div class="col-md-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Nav Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#info-akun"
                    data-tab-target="info-akun">Informasi Akun</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#perbarui-password"
                    data-tab-target="perbarui-password">Perbarui Password</button>
                </li>
              </ul>

              <!-- Tab Contents -->
              <div class="tab-content pt-2">

                <div class="pt-3 tab-pane fade" id="info-akun">

                  <small class="d-block mb-3 text-muted">Perbarui informasi profil akun Anda.</small>

                  <!-- Profile Edit Form -->
                  <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                  </form>

                  <form method="post" action="{{ route('profile.update', $user->id) }}" class="mt-6 space-y-6"
                    enctype="multipart/form-data" id="modalForm">
                    @csrf
                    @method('patch')

                    <div class="row mb-3">
                      <input type="hidden" name="oldImage" value="{{ $user->image }}">
                      <label for="image" class="col-md-4 col-lg-3 col-form-label">{{ __('Foto') }}</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                          id="image">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="name" class="col-md-4 col-lg-3 col-form-label">{{ __('Name') }}</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="name"
                          value="{{ old('name', $user->name) }}" required autocomplete="name">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">{{ __('Email') }}</label>
                      <div class="col-md-8 col-lg-9">
                        <input id="email" name="email" type="email" class="form-control"
                          value="{{ old('email', $user->email) }}" required autocomplete="username" />
                      </div>
                    </div>

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                      <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="btn btn-link">
                          {{ __('Click here to re-send the verification email.') }}
                        </button>
                      </p>

                      @if (session('status') === 'verification-link-sent')
                      <p class="mt-2 font-medium text-sm text-success">
                        {{ __('A new verification link has been sent to your email address.') }}
                      </p>
                      @endif
                    </div>
                    @endif

                    <div class="text-center float-end">
                      <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> {{ __('Simpan')
                        }}</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="pt-3 tab-pane fade" id="perbarui-password">

                  <small class="d-block mb-3 text-muted">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak
                    agar tetap
                    aman</small>

                  <!-- Change Password Form -->
                  <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6" id="modalForm">
                    @csrf
                    @method('put')

                    <div class="row mb-3">
                      <label for="update_password_current_password" class="col-md-4 col-lg-3 col-form-label">Password
                        Saat Ini</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="current_password" type="password" class="form-control"
                          id="update_password_current_password" autocomplete="current-password" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="update_password_password" class="col-md-4 col-lg-3 col-form-label">Password
                        Baru</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="update_password_password"
                          autocomplete="new-password" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="update_password_password_confirmation"
                        class="col-md-4 col-lg-3 col-form-label">Konfirmasi
                        Password Baru</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password_confirmation" type="password" class="form-control"
                          id="update_password_password_confirmation" autocomplete="new-password" required>
                      </div>
                    </div>

                    <div class="text-center float-end">
                      <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> {{ __('Simpan')
                        }}</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>
              </div>
            </div>
          </div><!-- End Nav Tabs -->
        </div>
      </div>
    </section>

  </main><!-- End #main -->
  @push('scripts')

  <!-- Jquery 3 -->
  <script type="text/javascript" src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

  <!-- Bootstrap 5 -->
  <script type="text/javascript" src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>

  <!-- Main js -->
  <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>

  <!-- Laravel Javascript Validation -->
  <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
  {!! JsValidator::formRequest('App\Http\Requests\ProfileUpdateRequest', '#modalForm') !!}

  <!-- Sweet Alert2 -->
  <script type="text/javascript" src="{{ asset('assets/vendor/sweetalert/sweetalert2.js') }}"></script>

  <script>
    @if (session('success'))
        window.sessionStorage.setItem("successMessage", "{{ session('success') }}");
    @endif
    
    @if (session('error'))
        window.sessionStorage.setItem("errorMessage", "{{ session('error') }}");
    @endif

    document.addEventListener('DOMContentLoaded', function () {
      // Fungsi pertama
      var activeTabInfoAkun = localStorage.getItem('activeTabInfoAkun');
      var defaultTabInfoAkun = 'info-akun'; // Default tab if no tab is saved

      if (!activeTabInfoAkun) {
        localStorage.setItem('activeTabInfoAkun', defaultTabInfoAkun);
        activeTabInfoAkun = defaultTabInfoAkun;
      }

      var tabInfoAkun = document.querySelector('[data-tab-target="' + activeTabInfoAkun + '"]');
      if (tabInfoAkun) {
        tabInfoAkun.classList.add('active');
        var targetInfoAkun = document.querySelector('#' + activeTabInfoAkun);
        if (targetInfoAkun) {
          targetInfoAkun.classList.add('active', 'show');
        }
      }

      var tabsInfoAkun = document.querySelectorAll('.nav-tabs .nav-link');
      tabsInfoAkun.forEach(function (tab) {
        tab.addEventListener('click', function () {
          var target = tab.getAttribute('data-tab-target');
          localStorage.setItem('activeTabInfoAkun', target);
        });
      });
    });
  
  </script>
  @endpush
</x-app-layout>