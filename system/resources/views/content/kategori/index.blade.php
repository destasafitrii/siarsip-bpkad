@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Manajemen Kategori</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h4 class="card-title">Daftar Kategori</h4>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addKategoriModal">Tambah Kategori</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kategori</th>
                                            <th>Bidang</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kategori as $key => $k)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $k->nama_kategori }}</td>
                                                <td>{{ $k->bidang->nama_bidang ?? '-' }}</td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm editKategoriBtn"
                                                        data-id="{{ $k->kategori_id }}" data-nama="{{ $k->nama_kategori }}"
                                                        data-bidang="{{ $k->bidang_id ?? '' }}" data-bs-toggle="modal"
                                                        data-bs-target="#editKategoriModal">
                                                        Edit
                                                    </button>
                                                    <a href="{{ url('kategori', $k->kategori_id) }}/delete"
                                                        class="btn btn-danger btn-sm" title="Hapus"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                        <i class="fas fa-trash-alt" style="font-size: 13px"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="addKategoriModal" tabindex="-1" aria-labelledby="addKategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addKategoriModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                placeholder="Masukkan nama kategori" required>
                        </div>
                        <div class="mb-3">
                            <label for="bidang_id" class="form-label">Bidang</label>
                            <select class="form-select" id="bidang_id" name="bidang_id" required>
                                <option value="" disabled selected>Pilih Bidang</option>
                                @foreach ($bidang as $b)
                                    <option value="{{ $b->bidang_id }}">{{ $b->nama_bidang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kategori -->
    <div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="editKategoriModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategoriModalLabel">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editKategoriForm" method="POST" action="{{ url('kategori.update', ['kategori' => '']) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="edit_nama_kategori" name="nama_kategori"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_bidang_id" class="form-label">Bidang</label>
                            <select class="form-select" id="edit_bidang_id" name="bidang_id" required>
                                <option value="" disabled selected>Pilih Bidang</option>
                                @foreach ($bidang as $b)
                                    <option value="{{ $b->bidang_id }}">{{ $b->nama_bidang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.editKategoriBtn');
            const editForm = document.getElementById('editKategoriForm');
            const editNamaInput = document.getElementById('edit_nama_kategori');
            const editBidangSelect = document.getElementById('edit_bidang_id');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const nama = this.getAttribute('data-nama');
                    const bidang = this.getAttribute('data-bidang');

                    // Set data ke input form
                    editNamaInput.value = nama;
                    editBidangSelect.value = bidang;

                    // Update action form dengan URL yang sesuai untuk update
                    const baseUrl = @json(url('kategori')); // Use the correct base URL
                    editForm.action =
                    `${baseUrl}/${id}/edit`; // Use the correct endpoint for updating
                });
            });
        });
    </script>
@endsection
