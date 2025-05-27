@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Detail Arsip Surat Masuk</h4>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="row d-flex align-items-stretch">
                                <!-- Bagian Kiri (Data Arsip 1) -->
                                <div class="col-md-6 d-flex flex-column">
                                    <table class="table table-bordered flex-grow-1">
                                        <tr>
                                            <th>No Surat</th>
                                            <td>{{ $arsip_surat_masuk->no_surat_masuk }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Surat</th>
                                            <td>{{ $arsip_surat_masuk->nama_surat_masuk }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal</th>
                                            <td>{{ $arsip_surat_masuk->tanggal_surat_masuk }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bidang</th>
                                            <td>{{ $arsip_surat_masuk->bidang->nama_bidang ?? 'Tidak Diketahui' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Surat</th>
                                            <td>{{ $arsip_surat_masuk->kategori->nama_kategori ?? 'Tidak Diketahui' }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Bagian Kanan (Data Arsip 2) -->
                                <div class="col-md-6 d-flex flex-column">
                                    <table class="table table-bordered flex-grow-1">
                                        <tr>
                                            <th>Asal Surat</th>
                                            <td>{{ $arsip_surat_masuk->asal_surat_masuk }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ruangan</th>
                                            <td>{{ $arsip_surat_masuk->box->lemari->ruangan->nama_ruangan ?? 'Tidak Diketahui' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Lemari</th>
                                            <td>{{ $arsip_surat_masuk->box->lemari->nama_lemari ?? 'Tidak Diketahui' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Box</th>
                                            <td>{{ $arsip_surat_masuk->box->nama_box ?? 'Tidak Diketahui' }}</td>
                                        </tr>
                                         <tr>
                                            <th>Urutan</th>
                                            <td>{{ $arsip_surat_masuk->urutan_surat_masuk }}</td>
                                        </tr>
                                        <tr>
                                            <th>Keterangan</th>
                                            <td>{{ $arsip_surat_masuk->keterangan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bukti Arsip</th>
                                            <td>
                                                <a href="{{ asset('system/storage/app/public/' . $arsip_surat_masuk->file_surat_masuk) }}"
                                                    target="_blank">Lihat File</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>QR Code Box</th>
                                            <td>
                                                @php
                                                    use SimpleSoftwareIO\QrCode\Facades\QrCode;
                                                @endphp

                                                {!! QrCode::size(100)->generate(url('/box/' . $arsip_surat_masuk->no_berkas_surat_masuk)) !!}
                                            </td>
                                        </tr>
                                    </table>
                                </div>


                            </div>
                        </div>

                        <!-- Pratinjau Arsip -->
                        <div class="mt-4">
                            <h5>Pratinjau Arsip</h5>
                            <iframe src="{{ asset('system/storage/app/public/' . $arsip_surat_masuk->file_surat_masuk) }}"
                                width="100%" height="600px" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <style>
        /* Menyamakan tinggi kedua kolom */
        .row.d-flex {
            display: flex;
            flex-wrap: wrap;
        }

        .col-md-6.d-flex {
            display: flex;
            flex-direction: column;
        }

        .table {
            flex-grow: 1;
            height: 100%;
            margin-bottom: 0;
        }

        /* Menghilangkan scroll */
        .table th,
        .table td {
            white-space: normal !important;
        }
    </style>
@endsection
