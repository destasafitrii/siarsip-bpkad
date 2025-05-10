@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Detail Arsip Surat Keluar</h4>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Bagian Kiri (Data Arsip 1) -->
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>No Surat</th>
                                            <td>{{ $arsip_surat_keluar->no_surat_keluar }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Surat</th>
                                            <td>{{ $arsip_surat_keluar->nama_surat_keluar }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal</th>
                                            <td>{{ $arsip_surat_keluar->tanggal_surat_keluar }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bidang</th>
                                            <td>{{ $arsip_surat_keluar->bidang->nama_bidang ?? 'Tidak Diketahui' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Surat</th>
                                            <td>{{ $arsip_surat_keluar->kategori->nama_kategori ?? 'Tidak Diketahui' }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Bagian Kanan (Data Arsip 2) -->
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Tujuan Surat</th>
                                            <td>{{ $arsip_surat_keluar->tujuan_surat_keluar }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Berkas</th>
                                            <td>{{ $arsip_surat_keluar->no_berkas_surat_keluar }}</td>
                                        </tr>
                                        <tr>
                                            <th>Urutan</th>
                                            <td>{{ $arsip_surat_keluar->urutan_surat_keluar }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi</th>
                                            <td>{{ $arsip_surat_keluar->lokasi_surat_keluar }}</td>
                                        </tr>
                                        <tr>
                                            <th>Keterangan</th>
                                            <td>{{ $arsip_surat_keluar->keterangan_surat_keluar }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bukti Arsip</th>
                                            <td>
                                                <a href="{{ asset('system/storage/app/public/' . $arsip_surat_keluar->file_surat_keluar) }}" target="_blank">Lihat File</a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Pratinjau Arsip -->
                            <div class="mt-4">
                                <h5>Pratinjau Arsip</h5>
                                <iframe src="{{ url('system/storage/app/public/' . $arsip_surat_keluar->file_surat_keluar) }}" 
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
        .table th, .table td {
            white-space: normal !important;
        }
    </style>
@endsection
