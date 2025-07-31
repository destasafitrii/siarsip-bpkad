@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Manajemen Bidang</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h4 class="card-title">Daftar Bidang</h4>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addBidangModal">Tambah Bidang</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="bidangTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Bidang</th>
                                            <th>Nama Bidang</th>
                                            <th>Penanggung Jawab</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addBidangModal" tabindex="-1" aria-labelledby="addBidangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('bidang.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Bidang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Ganti input kode_bidang jadi readonly dan auto-generated (bisa disembunyikan juga) --}}
                    <div class="mb-3">
                        <label class="form-label">Kode Bidang</label>
                        <input type="text" class="form-control" id="kode_bidang_input" name="kode_bidang" readonly
                            required>
                        <small class="text-muted fst-italic">Kode bidang dibuat otomatis</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Bidang</label>
                        <input type="text" class="form-control" id="nama_bidang_input" name="nama_bidang" placeholder="Masukkan Nama Bidang" required>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Penanggung Jawab</label>
                        <input type="text" class="form-control" name="penanggung_jawab"
                            placeholder="Masukkan Nama Penanggung Jawab" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editBidangModal" tabindex="-1" aria-labelledby="editBidangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="editBidangForm" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Penanggung Jawab</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="bidang_id" id="edit_bidang_id">

                    <div class="mb-3">
                        <label class="form-label">Kode Bidang</label>
                        <input type="text" class="form-control" id="edit_kode_bidang" name="kode_bidang" readonly>
                        <small class="text-muted fst-italic">Kode tidak dapat diubah</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Bidang</label>
                        <input type="text" class="form-control" name="nama_bidang" id="edit_nama_bidang" readonly>
                        <small class="text-muted fst-italic">Nama tidak dapat diubah</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Penanggung Jawab</label>
                        <input type="text" class="form-control" name="penanggung_jawab" id="edit_penanggung_jawab"
                            required placeholder="Masukkan Penanggung Jawab">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" id="deleteForm" class="modal-content">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const table = $('#bidangTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('bidang.data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kode_bidang',
                        name: 'kode_bidang'
                    },
                    {
                        data: 'nama_bidang',
                        name: 'nama_bidang'
                    },
                    {
                        data: 'penanggung_jawab',
                        name: 'penanggung_jawab'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    search: "Cari:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "<i class='fas fa-chevron-right'></i>",
                        previous: "<i class='fas fa-chevron-left'></i>"
                    },
                    zeroRecords: "Data tidak ditemukan",
                    infoEmpty: "Tidak ada data ditampilkan",
                    infoFiltered: "(difilter dari _MAX_ total entri)"
                }
            });

            // Tombol hapus
            $(document).on('click', '.btn-delete', function() {
                const id = $(this).data('id');
                const nama = $(this).data('nama');
                $('#deleteForm').attr('action', `{{ url('pengelola/bidang') }}/${id}`);
                $('#namaBidangToDelete').text(nama);
                $('#deleteConfirmModal').modal('show');
            });

            // Tombol edit
            $(document).on('click', '.btn-edit', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: `{{ url('pengelola/bidang') }}/${id}/edit`,
                    method: 'GET',
                    success: function(data) {
                        $('#editBidangForm').attr('action', '{{ url('pengelola/bidang') }}/' +
                            id);
                        $('#edit_bidang_id').val(data.bidang_id);
                        $('#edit_kode_bidang').val(data.kode_bidang);
                        $('#edit_nama_bidang').val(data.nama_bidang);
                        $('#edit_penanggung_jawab').val(data.penanggung_jawab);
                        $('#editBidangModal').modal('show');
                    },
                    error: function() {
                        alert('Gagal mengambil data bidang.');
                    }
                });
            });
        });
     $(document).ready(function() {
    // ... kode DataTable dan lainnya

    // Tambahkan ini ke dalam blok ready
    $('#nama_bidang_input').on('input', function () {
        const nama = $(this).val();

        if (nama.length >= 3) {
            $.get('{{ route('bidang.generateKode') }}', function (data) {
                $('#kode_bidang_input').val(data.kode);
            }).fail(function () {
                alert('Gagal mengambil kode bidang otomatis.');
            });
        } else {
            $('#kode_bidang_input').val('');
        }
    });
});

    </script>
@endsection
