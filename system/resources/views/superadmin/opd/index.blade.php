@extends('template.admin')

@section('content')
<div class="page-content">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title-box">
          <h4 class="page-title">Manajemen OPD</h4>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-6">
                <h4 class="card-title">Daftar OPD</h4>
              </div>
              <div class="col-md-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOpdModal">Tambah OPD</button>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama OPD</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($opds as $key => $opd)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $opd->nama_opd }}</td>
                    <td>
                      <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editOpdModal{{ $opd->id }}">Edit</button>

                      <form action="{{ route('opd.destroy', $opd->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus OPD ini?')">
                          <i class="fas fa-trash-alt" style="font-size: 13px"></i>
                        </button>
                      </form>
                    </td>
                  </tr>

                  <!-- Modal Edit -->
                  <div class="modal fade" id="editOpdModal{{ $opd->id }}" tabindex="-1" aria-labelledby="editOpdModalLabel{{ $opd->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Edit OPD</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('opd.update', $opd->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="modal-body">
                            <div class="mb-3">
                              <label for="nama_opd" class="form-label">Nama OPD</label>
                              <input type="text" class="form-control" name="nama_opd" value="{{ $opd->nama_opd }}" required>
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
                    <td colspan="3" class="text-center">Tidak ada data OPD.</td>
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
<div class="modal fade" id="addOpdModal" tabindex="-1" aria-labelledby="addOpdModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah OPD</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('opd.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_opd" class="form-label">Nama OPD</label>
            <input type="text" class="form-control" name="nama_opd" placeholder="Masukkan nama OPD" required>
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
