<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="shortcut icon" href="{{url ('public')}}/frontend/img/logo-ktp.png" type="image/x-icon">
  <title>Pengelola Arsip Perangkat Daerah Kab Ketapang</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{url ('public')}}/frontend/assets/bootstrap/css/bootstrap.min.css">
  <!-- icon css-->
  <link rel="stylesheet" href="{{url ('public')}}/frontend/assets/elagent-icon/style.css">
  <link rel="stylesheet" href="{{url ('public')}}/frontend/https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{url ('public')}}/frontend/assets/niceselectpicker/nice-select.css">
  <link rel="stylesheet" href="{{url ('public')}}/frontend/assets/animation/animate.css">
  <link rel="stylesheet" href="{{url ('public')}}/frontend/assets/mcustomscrollbar/jquery.mCustomScrollbar.min.css">
  <link rel="stylesheet" href="{{url ('public')}}/frontend/css/style-main.css">
  <link rel="stylesheet" href="{{url ('public')}}/frontend/css/responsive.css">
  <script src="{{url ('public')}}/frontend/js/video-active.js"></script>
  <script src="{{url ('public')}}/frontend/js/theme.js"></script>
</head>

<body data-scroll-animation="true">
  {{-- <div id="preloader">
    <div id="ctn-preloader" class="ctn-preloader">
      <div class="round_spinner">
        <div class="spinner"></div>
        <div class="text">
          <img src="{{url ('public')}}/frontend/img/spinner_logo.png" alt="">
          <h4><span>Docy</span></h4>
        </div>
      </div>
      <h2 class="head">Did You Know?</h2>
      <p></p>
    </div>
  </div> --}}
  <div class="body_wrapper">

    <!--================Menu Area =================-->
    @include('section.frontend.header')
    <!--================End Menu Area =================-->

    <!--================Home Advanced Search Area =================-->
    @yield('content')
    <!--================End Home Advanced Search Area =================-->


    
    <!--================Footer Area =================-->
    @include('section.frontend.footer')
    <!--================End Footer Area =================-->

  </div>

  <!-- Back to top button -->
  <a id="back-to-top" title="Back to Top"></a>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="{{url ('public')}}/frontend/js/jquery-3.5.1.min.js"></script>
  <script src="{{url ('public')}}/frontend/assets/bootstrap/js/popper.min.js"></script>
  <script src="{{url ('public')}}/frontend/assets/bootstrap/js/bootstrap.min.js"></script>
  {{-- <script src="{{url ('public')}}/frontend/js/pre-loader.js"></script> --}}
  <script src="{{url ('public')}}/frontend/assets/slick/slick.min.js"></script>
  <script src="{{url ('public')}}/frontend/js/jquery.parallax-scroll.js"></script>
  <script src="{{url ('public')}}/frontend/assets/niceselectpicker/jquery.nice-select.min.js"></script>
  <script src="{{url ('public')}}/frontend/assets/wow/wow.min.js"></script>
  <script src="{{url ('public')}}/frontend/assets/mcustomscrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="{{url ('public')}}/frontend/assets/video/artplayer.js"></script>

  <script src="{{url ('public')}}/frontend/assets/magnify-pop/jquery.magnific-popup.min.js"></script>
  <script src="{{url ('public')}}/frontend/js/plugins.js"></script>
  <script src="{{url ('public')}}/frontend/js/theme.js"></script>
  <script src="{{url ('public')}}/frontend/js/video-active.js"></script>
  <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
  <script src="{{url ('public')}}/frontend/js/main.js"></script>
</body>

</html>