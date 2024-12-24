@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Data Arsipan Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data Arsip Surat Keluar</h4>
                            <a href="{{ route('arsip_keluar.create') }}"
                                class="btn btn-primary btn-sm d-flex align-items-center" title="Tambah Data">
                                <i class="fas fa-plus me-1"></i> <span>Tambah Data</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="arsip_surat_keluar"
                                class="table table-hover table-bordered table-striped dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>Nama Surat</th>
                                        <th>Tanggal</th>
                                        <th>Bidang</th>
                                        <th>Jenis Arsip</th>
                                        <th>Tujuan Surat</th>
                                        <th>Nomor Berkas</th>
                                        <th>Urutan</th>
                                        <th>Lokasi</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_arsip_surat_keluar as $arsip_surat_keluar)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $arsip_surat_keluar->no_surat_keluar }}</td>
                                            <td>{{ $arsip_surat_keluar->nama_surat_keluar }}</td>
                                            <td>{{ $arsip_surat_keluar->tanggal_surat_keluar }}</td>
                                            <td>{{ $arsip_surat_keluar->bidang }}</td>
                                            <td>{{ $arsip_surat_keluar->jenis_arsip }}</td>
                                            <td>{{ $arsip_surat_keluar->tujuan_surat_keluar }}</td>
                                            <td>{{ $arsip_surat_keluar->no_berkas_surat_keluar }}</td>
                                            <td>{{ $arsip_surat_keluar->urutan_surat_keluar }}</td>
                                            <td>{{ $arsip_surat_keluar->lokasi_surat_keluar }}</td>
                                            <td>{{ $arsip_surat_keluar->keterangan }}</td>
                                            <td>
                                                <a href="{{ route('arsip_keluar.show', $arsip_surat_keluar->surat_keluar_id) }}"
                                                    class="btn btn-info btn-sm" title="Detail">
                                                    <i class="fas fa-eye" style="font-size: 10px"></i>
                                                </a>
                                                <a href="{{ route('arsip_keluar.edit', $arsip_surat_keluar->surat_keluar_id) }}"
                                                    class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit" style="font-size: 10px"></i>
                                                </a>
                                                <form
                                                    action="{{ route('arsip_keluar.destroy', $arsip_surat_keluar->surat_keluar_id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus arsip_surat_keluar ini?')">
                                                        <i class="fas fa-trash-alt" style="font-size: 13px"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center my-3">
                                <ul class="pagination"
                                    style="font-size: 16px; padding-left: 0; list-style: none; display: flex;">
                                    @if ($list_arsip_surat_keluar->onFirstPage())
                                        <li class="page-item disabled" style="margin: 0 5px;">
                                            <span class="page-link"
                                                style="padding: 8px 16px; border: 1px solid #dee2e6; color: #6c757d; cursor: not-allowed;">Previous</span>
                                        </li>
                                    @else
                                        <li class="page-item" style="margin: 0 5px;">
                                            <a href="{{ $list_arsip_surat_keluar->previousPageUrl() }}" class="page-link"
                                                style="padding: 8px 16px; border: 1px solid #dee2e6; color: #38c66c; text-decoration: none;">Previous</a>
                                        </li>
                                    @endif

                                    @foreach ($list_arsip_surat_keluar->links()->elements[0] as $page => $route)
                                        @if ($page == $list_arsip_surat_keluar->currentPage())
                                            <li class="page-item active" style="margin: 0 5px;">
                                                <span class="page-link"
                                                    style="padding: 8px 16px; border: 1px solid #38c66c; background-color: #38c66c; color: white;">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item" style="margin: 0 5px;">
                                                <a href="{{ $route }}" class="page-link"
                                                    style="padding: 8px 16px; border: 1px solid #dee2e6; color: #38c66c; text-decoration: none;">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($list_arsip_surat_keluar->hasMorePages())
                                        <li class="page-item" style="margin: 0 5px;">
                                            <a href="{{ $list_arsip_surat_keluar->nextPageUrl() }}" class="page-link"
                                                style="padding: 8px 16px; border: 1px solid #dee2e6; color: #38c66c; text-decoration: none;">Next</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled" style="margin: 0 5px;">
                                            <span class="page-link"
                                                style="padding: 8px 16px; border: 1px solid #dee2e6; color: #6c757d; cursor: not-allowed;">Next</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
