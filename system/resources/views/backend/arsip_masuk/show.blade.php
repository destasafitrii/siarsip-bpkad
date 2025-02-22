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
                            <table class="table table-striped">
                                <tr>
                                    <th>Nomor Surat</th>
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
                                    <th>Jenis Arsip</th>
                                    <td>{{ $arsip_surat_masuk->kategori->nama_kategori ?? 'Tidak Diketahui' }}</td>
                                </tr>
                                <tr>
                                    <th>Asal Surat</th>
                                    <td>{{ $arsip_surat_masuk->asal_surat_masuk }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Berkas</th>
                                    <td>{{ $arsip_surat_masuk->no_berkas_surat_masuk }}</td>
                                </tr>
                                <tr>
                                    <th>Urutan</th>
                                    <td>{{ $arsip_surat_masuk->urutan_surat_masuk }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi</th>
                                    <td>{{ $arsip_surat_masuk->lokasi_surat_masuk }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>{{ $arsip_surat_masuk->keterangan }}</td>
                                </tr>
                                <tr>
                                    <th>Bukti Arsip</th>
                                    <td>
                                        <a href="{{ asset('storage/' . $arsip_surat_masuk->file_surat_masuk) }}"
                                            target="_blank">Lihat File</a>
                                    </td>
                                </tr>
                            </table>
                            <div class="mt-4">
                                <h5>Pratinjau Arsip</h5>
                                <iframe src="{{ asset('storage/' . $arsip_surat_masuk->file_surat_masuk) }}" width="100%"
                                    height="600px" frameborder="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
