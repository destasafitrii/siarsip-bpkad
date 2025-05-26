<!DOCTYPE html>
<html>
<head>
    <title>Isi Box {{ $no_berkas }}</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        h2 { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Isi Box: {{ $no_berkas }}</h2>

    <table>
        <thead>
            <tr>
                <th>No Surat</th>
                <th>Nama Surat</th>
                <th>Urutan / Jilid</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($arsip as $item)
                <tr>
                    <td>{{ $item->no_surat_masuk }}</td>
                    <td>{{ $item->nama_surat_masuk }}</td>
                    <td>{{ $item->urutan_surat_masuk }}</td>
                    <td>{{ $item->lokasi_surat_masuk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
