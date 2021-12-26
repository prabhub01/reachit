@php
$currentURL = URL::current();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ config('app.name') }}">
    <meta name="keywords" content="{{ config('app.name') }}">
    <meta name="author" content="{{ config('app.name') }}">
    
    <meta name="docsearch:language" content="en">
    <meta name="docsearch:version" content="4.5">
    <meta http-equiv="ScreenOrientation" content="autoRotate:disabled">

    <title>ReachIt | @yield('title') </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('frontend/res/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('frontend/res/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/res/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/res/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/res/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/res/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/res/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/res/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/res/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('frontend/res/css/style.css') }}" rel="stylesheet">

    {{-- og meta tags --}}
    <meta property="og:url" content="{{ $currentURL }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image"
        content="https://project.peacenepal.com/mypay/public/storage/banner/2021/12/banner_1639981000.png" />
</head>

<body>
    @include('layouts.frontend.inc.header')
    @include('layouts.frontend.inc.banner')

    @yield('content')

    @include('layouts.frontend.inc.footer')

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('frontend/res/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('frontend/res/aos/aos.js') }}"></script>
    <script src="{{ asset('frontend/res/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/res/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/res/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('frontend/res/js/main.js') }}"></script>

</body>

</html>