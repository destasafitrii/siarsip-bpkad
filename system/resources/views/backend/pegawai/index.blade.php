@extends('template.admin')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Data Pegawai Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Data Pegawai</h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('pegawai.import') }}"
                                class="btn btn-success btn-sm d-flex align-items-center" title="Import Pegawai">
                                <i class="fas fa-file-excel me-1"></i> <span>Import Data Pegawai</span>
                            </a>
                            <a href="{{ route('pegawai.create') }}"
                                class="btn btn-primary btn-sm d-flex align-items-center" title="Tambah Data">
                                <i class="fas fa-plus me-1"></i> <span>Tambah Data</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tabel_pegawai"
                            class="table table-hover table-bordered table-striped dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP/NIK</th>
                                    <th>Nama Pegawai</th>
                                    <th>Golongan</th>
                                    <th>Jabatan</th>
                                    <th>Status Kepegawaian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data diisi oleh DataTables -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

<!-- Modal Hapus Pegawai -->
<div class="modal fade" id="modalHapusPegawai" tabindex="-1" aria-labelledby="modalHapusPegawaiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formHapusPegawai" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHapusPegawaiLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pegawai <strong id="namaPegawaiHapus"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus/button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#tabel_pegawai').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pegawai.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'nip', name: 'nip' },
                { data: 'nama', name: 'nama' },
                { data: 'golongan', name: 'golongan' },
                { data: 'jabatan', name: 'jabatan' },
                { data: 'status_kepegawaian', name: 'status_kepegawaian' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
            ],
            responsive: true,
            language: {
                paginate: {
                    previous: "<i class='fas fa-chevron-left'></i>",
                    next: "<i class='fas fa-chevron-right'></i>"
                }
            }
        });

        // Tangani klik tombol hapus pegawai
        $('#tabel_pegawai').on('click', '.btn-hapus-pegawai', function(e) {
            e.preventDefault();
            let url = $(this).data('url');
            let nama = $(this).data('nama');

            $('#formHapusPegawai').attr('action', url);
            $('#namaPegawaiHapus').text(nama);
            $('#modalHapusPegawai').modal('show');
        });
    });
</script>
@endsection
