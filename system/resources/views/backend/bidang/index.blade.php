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
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBidangModal">
                                    Tambah Bidang
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Bidang</th>
                                        <th>Nama Bidang</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bidang as $b)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $b->kode_bidang }}</td>
                                        <td>{{ $b->nama_bidang }}</td>
                                        <td>{{ $b->penanggung_jawab }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editBidangModal{{ $b->bidang_id }}">Edit</button>

                                            <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"
                                                data-id="{{ $b->bidang_id }}" data-nama="{{ $b->nama_bidang }}"
                                                title="Hapus">
                                                <i class="fas fa-trash-alt" style="font-size: 13px"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editBidangModal{{ $b->bidang_id }}" tabindex="-1"
                                        aria-labelledby="editBidangModalLabel{{ $b->bidang_id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="editBidangModalLabel{{ $b->bidang_id }}">Edit Bidang</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('bidang.update', $b->bidang_id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Kode Bidang</label>
                                                            <input type="text" class="form-control" name="kode_bidang"
                                                                value="{{ $b->kode_bidang }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Bidang</label>
                                                            <input type="text" class="form-control" name="nama_bidang"
                                                                value="{{ $b->nama_bidang }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Penanggung Jawab</label>
                                                            <input type="text" class="form-control"
                                                                name="penanggung_jawab"
                                                                value="{{ $b->penanggung_jawab }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data bidang.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
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
                <div class="mb-3">
                    <label class="form-label">Kode Bidang</label>
                    <input type="text" class="form-control" name="kode_bidang" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Bidang</label>
                    <input type="text" class="form-control" name="nama_bidang" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penanggung Jawab</label>
                    <input type="text" class="form-control" name="penanggung_jawab" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="deleteForm" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus bidang <strong id="namaBidangToDelete"></strong>?
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
    document.addEventListener('DOMContentLoaded', function () {
        var deleteForm = document.getElementById('deleteForm');
        var namaBidangToDelete = document.getElementById('namaBidangToDelete');

        document.querySelectorAll('.btn-delete').forEach(function (button) {
            button.addEventListener('click', function () {
                var bidangId = this.getAttribute('data-id');
                var namaBidang = this.getAttribute('data-nama');

                // SET URL YANG BENAR SESUAI BASE URL
                deleteForm.action = `{{ url('pengelola/bidang') }}/${bidangId}`;
                namaBidangToDelete.textContent = namaBidang;
            });
        });
    });
</script>
@endsection
