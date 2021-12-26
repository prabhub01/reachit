<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="admin ">
    <meta name="author" content="">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('/backend/images/ico/apple-icon-120.png') }}') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/backend/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/themes/semi-dark-layout.min.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/backend/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/custom.css') }}">
    <!-- END: Custom CSS-->


    @yield('styles')
    @livewireStyles
</head>

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static @guest blank-page @endguest"
    data-open="click" data-menu="vertical-menu-modern" data-col="@guest blank-page @endguest">
    @guest
        @yield('content')
    @else
        @include('layouts.admin.inc.header')
        @include('layouts.admin.inc.sidebar')

        <!-- BEGIN: Content-->
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    @yield('content')
                </div>
            </div>
        </div>
        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
        @include('layouts.admin.inc.footer')
    @endguest
    <script src="{{ asset('/backend/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('/backend/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('/backend/js/core/app.min.js') }}"></script>
    <script src="{{ asset('/backend/js/custom.js') }}"></script>

    <script src="{{ asset('dashboard/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/ckeditor/jquery.js') }}"></script>
    <script>
        var baseUrl = '{!! url('') !!}';
        var CKEDITOR_BASEPATH = baseUrl + '/js/ckeditor/';
        var options = {
            filebrowserBrowseUrl: baseUrl + '/ckfinder/browser',
            // Use named CKFinder connector route
            filebrowserUploadUrl: baseUrl + '/ckfinder/connector?command=QuickUpload&type=Files',
            height: 300,
            allowedContent: true
        };
        CKEDITOR.replaceAll('.editor');

        $('.editor').ckeditor(options);

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    </script>
    @yield('scripts')
    @livewireScripts
</body>

</html>
