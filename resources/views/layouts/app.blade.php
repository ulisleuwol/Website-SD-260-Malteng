<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ isset($title) ? $title . ' / ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    @if($pengaturan && $pengaturan->favicon)
    <link href="{{ asset('storage/' . $pengaturan->favicon) }}" rel="icon">
    @endif

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    {{--
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet"> --}}

    @stack('link')

    <!-- Template Main CSS File -->

</head>

<body>

    <!-- ======= Header ======= -->
    @include('layouts.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <x-back.sidebar />
    <!-- End Sidebar-->

    {{-- page content --}}

    {{-- main --}}

    {{ $slot }}

    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <x-back.footer />
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader" class="d-flex justify-content-center align-items-center">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>


    <!-- Vendor JS Files -->

    {{-- <script src="assets/vendor/apexcharts/apexcharts.min.js"></script> --}}
    {{-- <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script> --}}
    {{--
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script> --}}

    <!-- Template Main JS File -->

    @stack('scripts')


</body>

</html>