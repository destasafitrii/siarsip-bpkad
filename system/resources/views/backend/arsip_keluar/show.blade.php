@extends('template.admin')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header bg-white text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Arsip Surat Keluar</h5>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Kolom kiri -->
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
                                        <th>Kategori</th>
                                        <td>{{ $arsip_surat_keluar->kategori->nama_kategori ?? 'Tidak Diketahui' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tujuan Surat</th>
                                        <td>{{ $arsip_surat_keluar->tujuan_surat_keluar }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Kolom kanan -->
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Ruangan</th>
                                        <td>{{ $arsip_surat_keluar->box->lemari->ruangan->nama_ruangan ?? 'Tidak Diketahui' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lemari</th>
                                        <td>{{ $arsip_surat_keluar->box->lemari->nama_lemari ?? 'Tidak Diketahui' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Box</th>
                                        <td>{{ $arsip_surat_keluar->box->nama_box ?? 'Tidak Diketahui' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Urutan</th>
                                        <td>{{ $arsip_surat_keluar->urutan_surat_keluar }}</td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td>{{ $arsip_surat_keluar->keterangan_surat_keluar ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bukti Arsip</th>
                                        <td>
                                            @if ($arsip_surat_keluar->file_surat_keluar)
                                                <a href="{{ asset('system/storage/app/public/' . $arsip_surat_keluar->file_surat_keluar) }}" target="_blank" class="btn btn-info btn-sm">
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

                        <!-- Pratinjau Dokumen -->
                        @if ($arsip_surat_keluar->file_surat_keluar)
                        <div class="mt-4">
                            <h5>Pratinjau Arsip</h5>
                            <iframe src="{{ asset('system/storage/app/public/' . $arsip_surat_keluar->file_surat_keluar) }}" width="100%" height="600px" frameborder="0"></iframe>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
