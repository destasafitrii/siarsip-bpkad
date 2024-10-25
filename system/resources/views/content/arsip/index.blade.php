@extends('template.admin')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">CARI ARSIPAN</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Datatable</a></li>
                            <li class="breadcrumb-item active">Base</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Filter Arsipan</h4>
                    </div>
                    <div class="card-body">
                     sdsds
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Arsipan</h4>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nomor Surat</th>
                                    <th>Tanggal</th>
                                    <th>Bidang</th>
                                    <th>Jenis Arsip</th>
                                    <th>Tujuan/Dari</th>
                                    <th>Nomor Berkas</th>
                                    <th>Urutan</th>
                                    <th>Lokasi</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list_arsip as $arsip)
                                <tr>
                                    <td>{{ $arsip->nomor_surat }}</td>
                                    <td>{{ $arsip->tanggal }}</td>
                                    <td>{{ $arsip->bidang }}</td>
                                    <td>{{ $arsip->jenis_arsip }}</td>
                                    <td>{{ $arsip->tujuan_dari }}</td>
                                    <td>{{ $arsip->no_berkas }}</td>
                                    <td>{{ $arsip->urutan }}</td>
                                    <td>{{ $arsip->lokasi }}</td>
                                    <td>{{ $arsip->keterangan }}</td>
                                    <td>
                                        <!-- Button Read -->
                                        {{-- <a href="{{ route('arsip.show', $arsip->arsip_id) }}" class="btn btn-info btn-sm" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a> --}}
                                        
                                        <!-- Button Edit -->
                                        <a href="{{ route('arsip.edit', $arsip->arsip_id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <!-- Button Delete -->
                                        <form action="{{ route('arsip.destroy', $arsip->arsip_id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus arsip ini?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>
@endsection
