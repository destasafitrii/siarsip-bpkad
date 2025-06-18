@extends('template.admin')

@section('content')
<div class="page-content">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title-box">
          <h4 class="page-title">Manajemen Pengelola</h4>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-6">
                <h4 class="card-title">Daftar Pengelola</h4>
              </div>
              <div class="col-md-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Pengelola</button>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>OPD</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($admins as $admin)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->opd->nama_opd ?? '-' }}</td>
                    <td>
                      <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $admin->id }}">Edit</button>
                      <form action="{{ route('pengelola.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                          <i class="fas fa-trash-alt" style="font-size: 13px"></i>
                        </button>
                      </form>
                    </td>
                  </tr>

                  <!-- Modal Edit -->
                  <div class="modal fade" id="editModal{{ $admin->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $admin->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="{{ route('pengelola.update', $admin->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Pengelola</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="mb-3">
                              <label class="form-label">Nama</label>
                              <input type="text" class="form-control" name="name" value="{{ $admin->name }}" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Email</label>
                              <input type="email" class="form-control" name="email" value="{{ $admin->email }}" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Password <small>(kosongkan jika tidak diubah)</small></label>
                              <input type="password" class="form-control" name="password">
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Konfirmasi Password</label>
                              <input type="password" class="form-control" name="password_confirmation">
                            </div>
                            <div class="mb-3">
                              <label class="form-label">OPD</label>
                              <select name="opd_id" class="form-control" required>
                                @foreach(\App\Models\Opd::all() as $opd)
                                <option value="{{ $opd->id }}" {{ $admin->opd_id == $opd->id ? 'selected' : '' }}>
                                  {{ $opd->nama_opd }}
                                </option>
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
                    <td colspan="5" class="text-center">Tidak ada data pengelola.</td>
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
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('pengelola.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambah Pengelola</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">OPD</label>
            <select name="opd_id" class="form-control" required>
              <option value="">-- Pilih OPD --</option>
              @foreach(\App\Models\Opd::all() as $opd)
              <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
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
@endsection
