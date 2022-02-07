<!doctype html>
<html lang="en">

<head>
    <base href="{{ asset('/') }}">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="backend/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="backend/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="backend/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="backend/assets/css/pace.min.css" rel="stylesheet" />
    <script src="backend/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="backend/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="backend/assets/css/app.css" rel="stylesheet">
    <link href="backend/assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="backend/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="backend/assets/css/semi-dark.css" />
    <link rel="stylesheet" href="backend/assets/css/header-colors.css" />
    <title>{{ env('APP_NAME') }} - {{ $page_title }}</title>
    @livewireStyles

    @stack('styles')
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('backend.includes.sidebar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('backend.includes.header')
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                {{ $slot }}

            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        @include('backend.includes.footer')
    </div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->
    <script src="backend/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="backend/assets/js/jquery.min.js"></script>
    <script src="backend/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="backend/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="backend/assets/plugins/chartjs/js/Chart.min.js"></script>
    <script src="backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="backend/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="backend/assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
    <script src="backend/assets/plugins/jquery-knob/excanvas.js"></script>
    <script src="backend/assets/plugins/jquery-knob/jquery.knob.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {
            $(".knob").knob();
        });

    </script>
    <script src="backend/assets/js/index.js"></script>
    <!--app JS-->
    <script src="backend/assets/js/app.js"></script>

    @livewireScripts

    @stack('scripts')
</body>

</html>
