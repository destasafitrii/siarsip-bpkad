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
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBidangModal">Tambah Bidang</button>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Bidang</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($bidang as $key => $b)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->nama_bidang }}</td>
                    <td>{{ $b->created_at }}</td>
                    <td>
                      <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBidangModal{{ $b->bidang_id }}">Edit</button>

                      <form action="{{ route('bidang.destroy', $b->bidang_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus bidang ini?')">
                          <i class="fas fa-trash-alt" style="font-size: 13px"></i>
                        </button>
                      </form>
                    </td>
                  </tr>

                  <!-- Modal Edit -->
                  <div class="modal fade" id="editBidangModal{{ $b->bidang_id }}" tabindex="-1" aria-labelledby="editBidangModalLabel{{ $b->bidang_id }}" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editBidangModalLabel{{ $b->bidang_id }}">Edit Bidang</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('bidang.update', $b->bidang_id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="modal-body">
                            <div class="mb-3">
                              <label for="edit_nama_bidang_{{ $b->bidang_id }}" class="form-label">Nama Bidang</label>
                              <input type="text" class="form-control" id="edit_nama_bidang_{{ $b->bidang_id }}" name="nama_bidang" value="{{ $b->nama_bidang }}" required>
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
                    <td colspan="4" class="text-center">Tidak ada data bidang.</td>
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
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addBidangModalLabel">Tambah Bidang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('bidang.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_bidang" class="form-label">Nama Bidang</label>
            <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" placeholder="Masukkan nama bidang" required>
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
@endsection
