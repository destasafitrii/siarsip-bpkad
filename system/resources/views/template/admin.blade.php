<!doctype html>
<html lang="en">

<head>
@yield('style')
    <meta charset="utf-8" />
    <title>Pengelolaan Arsip Perangkat Daerah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Codebucks" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/frontend/img/logo-ktp.png') }}" height="50">

     <!-- DataTables -->
     <link href="{{url('public')}}/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />

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
   @include('section.backend.header')
    <!-- End topbar -->

    <!-- ========== Left Sidebar Start ========== -->
    @include('section.backend.sidebar')
    <!-- Left Sidebar End -->


    <!-- Start right Content here -->

    <div class="main-content" style="margin-left: 245px;">

        @include('utils.notif')

        <!-- Page-content -->
        @yield('content')

        <!-- End Page-content -->

        @include('section.backend.footer')

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
<script src="{{url('public')}}/assets/js/pages/datatables-base.init.js"></script>
<script src="{{url('public')}}/assets/js/pages/datatables-advanced.init.js"></script>
<script src="{{url('public')}}/assets/js/pages/datatables-extension.init.js"></script>

@yield('scripts')
@stack('scripts')


<!-- App js -->
<script src="{{url('public')}}/assets/js/app.js"></script>
</body>

</html>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('btnLogout').addEventListener('click', function () {
        Swal.fire({
            title: 'Keluar dari sistem?',
            text: "Anda yakin ingin logout sekarang?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formLogout').submit();
            }
        });
    });
</script>
