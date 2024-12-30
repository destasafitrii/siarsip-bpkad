<!doctype html>
<html lang="en">

<head>
@yield('style')
    <meta charset="utf-8" />
    <title>Pengelola Arsip Perangkat Daerah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Codebucks" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('public')}}/assets/images/logo-ktg.png" height="50">

     <!-- DataTables -->
     {{-- <link href="{{url('public')}}/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" /> --}}

     <!-- Responsive datatable examples -->
     <link href="{{url('public')}}/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />


    <!-- dark layout js -->
    <script src="{{url('public')}}/assets/js/pages/layout.js"></script>

    <!-- Bootstrap Css -->
    <link href="{{url('public')}}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{url('public')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- simplebar css -->
    <link href="{{url('public')}}/assets/libs/simplebar/simplebar.min.css" rel="stylesheet">
    <!-- App Css-->
    <link href="{{url('public')}}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

<div id="layout-wrapper">

    
    <!-- Start topbar -->
   @include('section.header')
    <!-- End topbar -->

    <!-- ========== Left Sidebar Start ========== -->
    @include('section.sidebar')
    <!-- Left Sidebar End -->


    <!-- Start right Content here -->

    <div class="main-content">
        @include('utils.notif')

        <!-- Page-content -->
        @yield('content')

        <!-- End Page-content -->

        @include('section.footer')

    </div>
    <!-- end main content-->
</div>
<!-- end layout-wrapper -->


<!-- JAVASCRIPT -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{url('public')}}/assets/libs/jquery/jquery.min.js"></script>
<script src="{{url('public')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{url('public')}}/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{url('public')}}/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{url('public')}}/assets/libs/node-waves/waves.min.js"></script>


<!-- apexcharts -->
<script src="{{url('public')}}/assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Required datatable js -->
<script src="{{url('public')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{url('public')}}/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>

<!-- Responsive examples -->
<script src="{{url('public')}}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('public')}}/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>

<!-- Datatable init js -->
<script src="{{url('public')}}/assets/js/pages/datatables-base.init.js"></script>
<script src="{{url('public')}}/assets/js/pages/toaster.init.js"></script>

<script src="{{url('public')}}/assets/js/pages/dashboard.init.js"></script>

<!-- Datatable init js -->
{{-- <script src="{{url('public')}}/assets/js/pages/datatables-base.init.js"></script> --}}

<!-- App js -->
<script src="{{url('public')}}/assets/js/app.js"></script>
</body>

</html>