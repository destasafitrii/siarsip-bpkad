<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak QR Box {{ $box->nama_box }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 80px 20px;
        }
        h1 {
            font-size: 32px;
            margin-bottom: 0;
        }
        h3 {
            font-weight: normal;
            margin-top: 5px;
            font-size: 18px;
        }
        .qr {
            margin: 50px 0;
        }
        .qr svg {
            width: 400px !important;
            height: 400px !important;
        }
        .note {
            font-size: 14px;
            margin-top: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>BOX: {{ $box->nama_box }}</h1>
    <h3>Lemari: {{ $box->lemari->nama_lemari ?? '-' }} | Ruangan: {{ $box->lemari->ruangan->nama_ruangan ?? '-' }}</h3>

    <div class="qr">
        {!! \QrCode::size(400)->generate(url('/box/' . $box->box_id)) !!}
    </div>

    <div class="note">
        Scan QR ini untuk menampilkan isi arsip yang tersimpan dalam box ini.
    </div>

    <script>
        window.onload = () => window.print();
    </script>
</body>
</html>
