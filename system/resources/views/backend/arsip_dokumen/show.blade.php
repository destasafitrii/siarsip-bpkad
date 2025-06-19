@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header text-white d-flex justify-content-between align-items-center"
                            style="background-color: #ffffff;">

                            <h5 class="mb-0">Detail Arsip Dokumen</h5>
                            <a href="{{ route('arsip_dokumen.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Kolom kiri -->
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Nomor Dokumen</th>
                                            <td>{{ $arsip_dokumen->no_dokumen }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Dokumen</th>
                                            <td>{{ $arsip_dokumen->nama_dokumen }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bidang</th>
                                            <td>{{ $arsip_dokumen->bidang->nama_bidang ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kategori</th>
                                            <td>{{ $arsip_dokumen->kategori->nama_kategori ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Dokumen</th>
                                            <td>{{ $arsip_dokumen->tanggal_dokumen }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Kolom kanan -->
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Ruangan</th>
                                            <td>{{ $arsip_dokumen->box->lemari->ruangan->nama_ruangan ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lemari</th>
                                            <td>{{ $arsip_dokumen->box->lemari->nama_lemari ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Box</th>
                                            <td>{{ $arsip_dokumen->box->nama_box ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Keterangan</th>
                                            <td>{{ $arsip_dokumen->keterangan ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>File Dokumen</th>
                                            <td>
                                                @if ($arsip_dokumen->file_dokumen)
                                                    <a href="{{ asset('system/storage/app/public/' . $arsip_dokumen->file_dokumen) }}"
                                                        target="_blank" class="btn btn-info btn-sm">
                                                        <i class="fas fa-file-alt"></i> Lihat File
                                                    </a>
                                                @else
                                                    <span class="text-muted">Tidak ada file</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pratinjau Arsip -->
                    @if ($arsip_dokumen->file_dokumen)
                        <div class="card mt-4">
                            <div class="card-body">
                                <h5>Pratinjau Arsip</h5>
                                <iframe src="{{ asset('system/storage/app/public/' . $arsip_dokumen->file_dokumen) }}"
                                    width="100%" height="600px" frameborder="0"></iframe>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
