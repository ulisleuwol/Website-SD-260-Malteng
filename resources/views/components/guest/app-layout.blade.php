<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>
    @isset($title)
    {{ $title }} | SDN 260 Malteng
    @else
    SDN 260 Malteng
    @endisset
  </title>

  <!-- Favicons -->
  @if($pengaturan && $pengaturan->favicon)
  <link href="{{ asset('storage/' . $pengaturan->favicon) }}" rel="icon">
  @endif

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('guest/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('guest/assets/vendor/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('guest/assets/vendor/aos/aos.css')  }}" rel="stylesheet">
  <link href="{{ asset('guest/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('guest/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="{{ asset('guest/assets/css/style.css') }}">

  @stack('link')
</head>

<body class="font-sans antialiased ">

  {{-- ketika di bagian login tidak usah menampilkan --}}
  @if (Request::segment(1) != 'login' && Request::segment(1) != 'register' && Request::segment(1) != 'forgot-password'
  && Request::segment(1) != 'reset-password' && Request::segment(1) != 'verify-email' && Request::segment(1) !=
  'confirm-password')
  <x-navbar />
  @endif

  {{-- content --}}
  {{ $slot }}
  {{-- end content --}}

  @if (Request::segment(1) != 'login' && Request::segment(1) != 'register' && Request::segment(1) != 'forgot-password'
  && Request::segment(1) != 'reset-password' && Request::segment(1) != 'verify-email' && Request::segment(1) !=
  'confirm-password')
  <x-guest.footer />
  @endif


  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-rocket"></i></a>

  <div id="preloader" class="d-flex justify-content-center align-item-center">
    <h1 class="fw-bold">SDN Negeri 260 Malteng</h1>
  </div>


  <!-- Vendor JS Files -->
  <script src="{{ asset('guest/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('guest/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('guest/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('guest/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('guest/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('guest/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('guest/assets/vendor/php-email-form/validate.js') }}"></script>

  @stack('script')
  <script src="{{ asset('guest/assets/js/main.js') }}"></script>
  <!-- Template Main JS File -->



</body>

</html>