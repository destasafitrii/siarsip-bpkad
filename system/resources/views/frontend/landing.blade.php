@extends('template.frontend')

@section('content')
<section class="doc_banner_area search-banner-oneview">
    <div class="overlay"></div>
    <div class="background-animation"></div>
    <div class="container content-wrapper">
        <div class="doc_banner_content text-center">
            <img src="{{ asset('public/frontend/img/logo-ktp.png') }}" alt="Logo Ketapang" style="width: 100px; margin-bottom: 15px;">
            <h1 style="color: #fff; font-weight: 800; font-size: 32px; margin-bottom: 10px;">
                Selamat Datang di <span style="color: #ffc107;">SIPAD</span>
            </h1>
            <p style="color: #e0e0e0; font-size: 16px; margin-bottom: 25px;">
                Sistem Informasi Pengelolaan Arsip Perangkat Daerah<br>Kabupaten Ketapang
            </p>
            <a href="{{ route('login') }}" class="btn-custom">Masuk Ke Sistem</a>
        </div>
    </div>
</section>

<style>
.search-banner-oneview {
    position: relative;
    background: linear-gradient(135deg, #002454, #003b80);
    height: 100vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 24, 55, 0.85);
    top: 0;
    left: 0;
    z-index: 1;
}

.background-animation {
    position: absolute;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.04) 1px, transparent 1px);
    background-size: 40px 40px;
    top: -50%;
    left: -50%;
    animation: moveBg 60s linear infinite;
    z-index: 0;
}

@keyframes moveBg {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.content-wrapper {
    position: relative;
    z-index: 2;
    max-width: 700px;
    padding: 20px;
}

.btn-custom {
    background-color: #ffc107;
    color: #002454;
    border: none;
    padding: 12px 28px;
    font-size: 16px;
    border-radius: 8px;
    font-weight: bold;
    transition: all 0.3s ease-in-out;
    text-decoration: none;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}

.btn-custom:hover {
    background-color: #e0a800;
    color: #fff;
    transform: translateY(-2px);
}
</style>
@endsection
