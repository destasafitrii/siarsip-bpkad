<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak QR Box {{ $box->nama_box }}</title>
    <link rel="icon" type="image/png" href="{{ asset('public/frontend/img/logo-ktp.png') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 40px;
            background: #fff;
        }
        .logo {
            width: 90px;
            margin-bottom: 10px;
        }
        h1 {
            font-size: 26px;
            margin-bottom: 5px;
        }
        h3 {
            font-weight: normal;
            font-size: 15px;
            color: #444;
            margin-top: 0;
        }
        .qr-container {
            display: inline-block;
            padding: 20px;
            background: #fff;
            border: 2px dashed #ccc;
            margin-top: 30px;
        }
        .qr svg {
            width: 280px !important;
            height: 280px !important;
        }
        .footer-note {
            margin-top: 25px;
            font-size: 13px;
            color: #555;
        }
        .small-info {
            font-size: 12px;
            margin-top: 5px;
            color: #999;
        }
    </style>
</head>
<body>

    <!-- Logo Instansi -->
    <img src="{{ asset('public/frontend/img/logo-ktp.png') }}" class="logo" alt="Logo Ketapang">

    <!-- Judul Box -->
    <h1>{{ strtoupper($box->nama_box) }}</h1>
    <h3>Lemari: {{ $box->lemari->nama_lemari ?? '-' }}<br>Ruangan: {{ $box->lemari->ruangan->nama_ruangan ?? '-' }}</h3>

    <!-- QR Code -->
    <div class="qr-container">
        {!! QrCode::size(280)->generate(url('/box/' . $box->box_id)) !!}
    </div>

    <!-- Catatan Tambahan -->
    <div class="footer-note">
        Scan QR ini untuk menampilkan isi arsip fisik pada box ini.
    </div>
    <div class="small-info">
        SIPAD - Sistem Pengelolaan Arsip Perangkat Daerah Kabupaten Ketapang
    </div>

    <script>
        window.onload = () => window.print();
    </script>
</body>
</html>
