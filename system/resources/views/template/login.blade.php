<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Sistem Pengelolaan Arsip Perangkat Daerah Kab Ketapang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{url('public')}}/assets/images/logo-ktg.png">

    <!-- Bootstrap Css -->
    <link href="{{url('public')}}/assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Icons Css -->
    <link href="{{url('public')}}/assets/css/icons.min.css" rel="stylesheet" />
    <!-- App Css-->
    <link href="{{url('public')}}/assets/css/app.min.css" rel="stylesheet" />

    @yield('style')
</head>
<body class="authentication-bg d-flex align-items-center justify-content-center" style="min-height: 100vh; background: #f3f4f7;">

    @yield('content')

    <script src="{{url('public')}}/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{url('public')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('public')}}/assets/js/app.js"></script>
</body>
</html>
