<x-guest.app-layout title="Kontak">
  <main id="main">

    {{-- start heading --}}
    <x-guest.heading title="Kontak" linkText="Kontak" content="Sekolah Dasar Negeri 260 Maluku Tengah" />
    {{-- End heading --}}

    <!-- ======= Content Section ======= -->
    <section id="kontak">

      <!-- ======= Contact Section ======= -->
      <section class="contact">
        <div class="container" data-aos="fade-up">
          <div class="section-header">
            <h2>Hubungi Kami</h2>
            <p>Silahkan kirimkan saran atau kritik di bawah ini</p>
          </div>

          {{-- Tangkap sesion success --}}
          @if (Session::has('success'))
          <span class="alert alert-success alert-dismissible fade show small m-auto d-block my-2" role="alert">
            {{ Session::get('success') }}
            <span type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></span>
          </span>
          @endif

          <div class="row gx-lg-0 gy-4 mb-5">
            <div class="col-lg-5">
              <div class="info-container d-flex flex-column align-items-center justify-content-center">
                <div class="info-item d-flex">
                  <i class="bi bi-geo-alt flex-shrink-0"></i>
                  <div>
                    <h4>Location:</h4>
                    <p>{{ $kontak['alamat'] }}</p>
                  </div>
                </div><!-- End Info Item -->

                <div class="info-item d-flex">
                  <i class="bi bi-envelope flex-shrink-0"></i>
                  <div>
                    <h4>Email:</h4>
                    <p>{{ $kontak['email'] }}</p>
                  </div>
                </div><!-- End Info Item -->

                <div class="info-item d-flex">
                  <i class="bi bi-phone flex-shrink-0"></i>
                  <div>
                    <h4>Call:</h4>
                    <p>{{ $kontak['telp'] }}</p>
                  </div>
                </div><!-- End Info Item -->

                <div class="info-item d-flex">
                  <i class="bi bi-clock flex-shrink-0"></i>
                  <div>
                    <h4>Open Hours:</h4>
                    <p>{{ $kontak['jam_kerja'] }}</p>
                  </div>
                </div><!-- End Info Item -->
              </div>
            </div>
            <div class="col-lg-7">
              <form action="{{ route('kontak-send') }}" method="POST" class="email-form">
                @csrf
                <div class="row">
                  <div class="form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                      value="{{ old('name') }}" required>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 mb-0 pb-0 small text-danger" />
                  </div>
                  <div class="form-group mt-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                      value="{{ old('email') }}" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 mb-0 pb-0 small text-danger" />
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                    value="{{ old('subject') }}" required>
                  <x-input-error :messages="$errors->get('subject')" class="mt-2 mb-0 pb-0 small text-danger" />
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" rows="7"
                    placeholder="Message" required>{{ old('message') }}</textarea>
                  <x-input-error :messages="$errors->get('message')" class="mt-2 mb-0 pb-0 small text-danger" />
                </div>
                <div class="text-center">
                  <button type="submit">Kirim Pesan</button>
                </div>
              </form>
            </div><!-- End Contact Form -->

          </div>

          <div class="section-header">
            <h2>Peta Lokasi</h2>
            <p>Lokasi Sekolah Dasar Negeri 260 Maluku Tengah</p>
          </div>
          <div class="row overflow-hidden rounded-3 shadow mx-md-0 mx-2">
            <!-- Google Maps -->
            <iframe class="px-0 mx-0" src="{{ $kontak['map'] }}" frameborder="0"
              style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
          </div>
        </div>
      </section><!-- End Contact Section -->


    </section><!-- End Content Section -->

  </main><!-- End #main -->
</x-guest.app-layout>