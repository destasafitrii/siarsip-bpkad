<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Isi Box {{ $box_id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            color: #333;
        }

        .header {
            border-bottom: 2px solid #888;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #f2f2f2;
            padding: 12px;
            text-align: center;
            border: 1px solid #ccc;
        }

        td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        .footer {
            margin-top: 20px;
            font-style: italic;
            font-size: 13px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Daftar Arsip Dalam Box ID: {{ $box_id }}</h2>
        <p>Dihasilkan pada: {{ now()->format('d M Y, H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No Surat</th>
                <th>Nama Surat</th>
                <th>Urutan / Jilid</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($arsip as $item)
                <tr>
                    <td>{{ $item['no_surat'] }}</td>
                    <td>{{ $item['nama_surat'] }}</td>
                    <td style="text-align: center;">{{ $item['urutan'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center; font-style: italic;">Tidak ada arsip dalam box ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Total arsip dalam box ini: {{ $arsip->count() }}
    </div>

</body>
</html>
