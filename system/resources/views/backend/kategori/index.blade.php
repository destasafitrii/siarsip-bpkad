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
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKategoriModal">Tambah Kategori</button>
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
                  @forelse ($kategori as $k)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->nama_kategori }}</td>
                    <td>{{ $k->bidang->nama_bidang ?? '-' }}</td>
                    <td>
                      <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editKategoriModal{{ $k->kategori_id }}">Edit</button>

                      <button class="btn btn-danger btn-sm btn-delete" 
                              data-bs-toggle="modal" 
                              data-bs-target="#deleteConfirmModal"
                              data-id="{{ $k->kategori_id }}" 
                              data-nama="{{ $k->nama_kategori }}">
                        <i class="fas fa-trash-alt" style="font-size: 13px"></i>
                      </button>
                    </td>
                  </tr>

                  <!-- Modal Edit -->
                  <div class="modal fade" id="editKategoriModal{{ $k->kategori_id }}" tabindex="-1" aria-labelledby="editKategoriModalLabel{{ $k->kategori_id }}" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editKategoriModalLabel{{ $k->kategori_id }}">Edit Kategori</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('kategori.update', $k->kategori_id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="modal-body">
                            <div class="mb-3">
                              <label for="edit_nama_kategori_{{ $k->kategori_id }}" class="form-label">Nama Kategori</label>
                              <input type="text" class="form-control" id="edit_nama_kategori_{{ $k->kategori_id }}" name="nama_kategori" value="{{ $k->nama_kategori }}" required>
                            </div>
                            <div class="mb-3">
                              <label for="edit_bidang_id_{{ $k->kategori_id }}" class="form-label">Bidang</label>
                              <select class="form-select" id="edit_bidang_id_{{ $k->kategori_id }}" name="bidang_id" required>
                                <option value="" disabled>Pilih Bidang</option>
                                @foreach ($bidang as $b)
                                <option value="{{ $b->bidang_id }}" {{ $b->bidang_id == $k->bidang_id ? 'selected' : '' }}>{{ $b->nama_bidang }}</option>
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
                  @empty
                  <tr>
                    <td colspan="4" class="text-center">Tidak ada data kategori.</td>
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
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan nama kategori" required>
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="deleteForm">
      @csrf
      @method('DELETE')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteConfirmModalLabel">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin menghapus kategori <strong id="namaKategoriToDelete"></strong>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var deleteConfirmModal = document.getElementById('deleteConfirmModal');
    var deleteForm = document.getElementById('deleteForm');
    var namaKategoriToDelete = document.getElementById('namaKategoriToDelete');

    // Tangkap semua tombol delete
    var deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        var kategoriId = this.getAttribute('data-id');
        var namaKategori = this.getAttribute('data-nama');

        // Set action form sesuai id kategori yang akan dihapus
         deleteForm.action = `{{ url('pengelola/kategori') }}/${kategoriId}`;
        // Tampilkan nama kategori di modal
        namaKategoriToDelete.textContent = namaKategori;
      });
    });
  });
</script>
@endsection
