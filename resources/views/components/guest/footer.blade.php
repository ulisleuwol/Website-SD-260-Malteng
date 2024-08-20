<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

  <div class="container">
    <div class="row gy-4">
      <div class="col-lg-5 col-md-12 footer-info">
        <a href="index.html" class="logo d-flex align-items-center">
          <span>SDN 260 Malteng</span>
        </a>

        <p>{{ $pengaturan->deskripsi }}</p>

        <div class="social-links d-flex mt-4">
          <a href="{{ $pengaturan->twitter }}" class="twitter" target="_blank"><i class="bi bi-twitter-x"></i></a>
          <a href="{{ $pengaturan->facebook }}" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
          <a href="{{ $pengaturan->ig }}" class="instagram" target="_blank"><i class="bi bi-instagram"></i></a>
          <a href="{{ $pengaturan->youtube }}" class="youtube" target="_blank"><i class="bi bi-youtube"></i></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-md-12 footer-links text-center text-md-start">
        <h4>Menu Lainnya</h4>
        <ul>
          <li><a href="{{ route('eskul-sekolah') }}" class="{{ request()->routeIs('eskul-sekolah') ? 'text-white fw-semibold' : '' }}">Ekstrakurikuler</a></li>
          <li><a href="{{ route('ppdb-sekolah') }}" class="{{ request()->routeIs('ppdb-sekolah') ? 'text-white fw-semibold' : '' }}">Info PPDB</a></li>
          <li><a href="{{ route('prestasi-ak') }}" class="{{ request()->routeIs('prestasi-ak') ? 'text-white fw-semibold' : '' }}">Prestasi</a></li>
          <li><a href="{{ route('fasilitas-sekolah') }}" class="{{ request()->routeIs('fasilitas-sekolah') ? 'text-white fw-semibold' : '' }}">Fasilitas</a></li>
          <li><a href="{{ route('sejarah-sekolah') }}" class="{{ request()->routeIs('sejarah-sekolah') ? 'text-white fw-semibold' : '' }}">Sejarah</a></li>
        </ul>
      </div>

      <div class="col-lg-4 col-md-12 footer-contact text-center text-md-start">
        <h4>Kontak Kami</h4>
        <p>
          <span class="d-block">{{ $pengaturan->alamat }}</span>
          <strong>Phone :</strong> {{ $pengaturan->telp }}<br>
          <strong>Email :</strong> {{ $pengaturan->email }}<br>
        </p>

      </div>

    </div>
  </div>

  <hr>

  <div class="container mt-4">
    <div class="copyright">
      Copyright &copy; {{ now()->format('Y') }} <strong><span>{{ config('app.name') }}</span></strong>. All Rights
      Reserved
    </div>
    {{-- <div class="credits">
      Designed by <a href="https://www.instagram.com/ulis_leu_sari/" class="text-warning" target="_blank">Ulax</a>
    </div> --}}
  </div>

</footer><!-- End Footer -->