@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container">
                <div class="col-lg-12">
                    <div class="page-title-box d-flex justify-content-between align-items-center">
                        <h4 class="page-title">Manajemen OPD</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOpdModal">Tambah
                            OPD</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="opdTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode OPD</th>
                                    <th>Nama OPD</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>Kepala Dinas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($opds as $key => $opd)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $opd->kode_opd }}</td>
                                        <td style="max-width: 200px;" class="text-truncate">{{ $opd->nama_opd }}</td>
                                        <td style="max-width: 100px;" class="text-truncate">{{ $opd->alamat }}</td>
                                        <td style="max-width: 200px;" class="text-truncate">{{ $opd->surel }}</td>
                                        <td style="max-width: 200px;" class="text-truncate"
                                            title="{{ $opd->kepala_dinas }}">
                                            {{ $opd->kepala_dinas }}
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex gap-1 justify-content-center">
                                                <a href="{{ route('opd.show', $opd->id) }}" class="btn btn-info btn-sm"
                                                    title="Detail">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </a>

                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editOpdModal{{ $opd->id }}" title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>

                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#hapusOpdModal{{ $opd->id }}" title="Hapus">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </div>
                                        </td>


                                    </tr>
                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="hapusOpdModal{{ $opd->id }}" tabindex="-1"
                                        aria-labelledby="hapusOpdModalLabel{{ $opd->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusOpdModalLabel{{ $opd->id }}">
                                                        Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data OPD
                                                    <strong>{{ $opd->nama_opd }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('opd.destroy', $opd->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($opds->isEmpty())
                        {{-- <div class="text-center my-3">Tidak ada data OPD.</div> --}}
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    @include('superadmin.opd.create')

    <!-- Modal Edit untuk setiap OPD -->
    @foreach ($opds as $opd)
        @include('superadmin.opd.edit', ['opd' => $opd])
    @endforeach
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#opdTable').DataTable();
        });
        $('#opdTable').DataTable({
      "language": {
        "lengthMenu": "Show_MENU_ entries",
        "zeroRecords": "Data tidak ditemukan",
        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
        "infoEmpty": "Tidak ada data tersedia",
        "infoFiltered": "(difilter dari _MAX_ total data)",
        "search": "Cari:",
        "paginate": {
          "first": "Pertama",
          "last": "Terakhir",
           "next": "<i class='fas fa-chevron-right'></i>",
          "previous": "<i class='fas fa-chevron-left'></i>"
        }
      },
        });
    </script>
@endsection
