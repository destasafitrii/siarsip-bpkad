@extends('template.admin')

@section('content')
<div class="page-content">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title-box">
          <h4 class="page-title">Manajemen Ruangan</h4>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-6">
                <h4 class="card-title">Daftar Ruangan</h4>
              </div>
              <div class="col-md-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRuanganModal">Tambah Ruangan</button>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Ruangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($ruangan as $key => $r)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $r->nama_ruangan }}</td>
                    <td>
                      <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRuanganModal{{ $r->ruangan_id }}">Edit</button>

                      <form action="{{ route('ruangan.destroy', $r->ruangan_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">
                          <i class="fas fa-trash-alt" style="font-size: 13px"></i>
                        </button>
                      </form>
                    </td>
                  </tr>

                  <!-- Modal Edit -->
                  <div class="modal fade" id="editRuanganModal{{ $r->ruangan_id }}" tabindex="-1" aria-labelledby="editRuanganModalLabel{{ $r->ruangan_id }}" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editRuanganModalLabel{{ $r->ruangan_id }}">Edit Ruangan</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('ruangan.update', $r->ruangan_id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="modal-body">
                            <div class="mb-3">
                              <label for="edit_nama_ruangan_{{ $r->ruangan_id }}" class="form-label">Nama Ruangan</label>
                              <input type="text" class="form-control" id="edit_nama_ruangan_{{ $r->ruangan_id }}" name="nama_ruangan" value="{{ $r->nama_ruangan }}" required>
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
                    <td colspan="3" class="text-center">Tidak ada data ruangan.</td>
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
<div class="modal fade" id="addRuanganModal" tabindex="-1" aria-labelledby="addRuanganModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addRuanganModalLabel">Tambah Ruangan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('ruangan.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
            <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" placeholder="Masukkan nama ruangan" required>
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
