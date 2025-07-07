<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Isi Box {{ $box->nama_box ?? 'Tidak diketahui' }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        .header {
            border-bottom: 2px solid #888;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            word-wrap: break-word;
            table-layout: fixed;
        }

        th {
            background-color: #f2f2f2;
            padding: 12px;
            text-align: center;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        td {
            padding: 10px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        .footer {
            margin-top: 20px;
            font-style: italic;
            font-size: 13px;
        }

        /* Tambahan: Responsif di layar kecil */
        @media (max-width: 600px) {
            body {
                margin: 10px;
            }

            .header h2 {
                font-size: 18px;
            }

            th, td {
                font-size: 12px;
                padding: 8px;
            }

            .footer {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<div class="header" style="text-align: center;">
    <img src="{{ url('public') }}/assets/images/logo-sipad.svg" alt="Logo SIPAD" style="height: 50px; max-width: 100%; margin-bottom: 10px;">

    <h2 style="margin: 0;">Daftar Arsip Dalam Box: {{ $box->nama_box ?? 'Tidak diketahui' }}</h2>
    <p style="margin: 0;">Dihasilkan pada: {{ now()->format('d M Y, H:i') }}</p>
</div>




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
                    <td>{{ $item->no_surat }}</td>
                    <td>{{ $item->nama_surat }}</td>
                    <td style="text-align: center;">{{ $item->urutan }}</td>
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
