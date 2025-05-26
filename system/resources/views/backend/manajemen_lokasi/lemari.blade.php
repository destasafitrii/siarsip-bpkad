@extends('template.admin')

@section('content')
<div class="page-content">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title-box">
          <h4 class="page-title">Manajemen Lemari</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

            <div class="row mb-3">
              <div class="col-md-6">
                <h4 class="card-title">Daftar Lemari</h4>
              </div>
              <div class="col-md-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLemariModal">Tambah Lemari</button>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Lemari</th>
                    <th>Ruangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($lemari as $key => $l)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $l->nama_lemari }}</td>
                    <td>{{ $l->ruangan->nama_ruangan ?? '-' }}</td>
                    <td>
                      <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editLemariModal{{ $l->lemari_id }}">Edit</button>

                      <form action="{{ route('lemari.destroy', $l->lemari_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus lemari ini?')">Hapus</button>
                      </form>
                    </td>
                  </tr>

                  <!-- Modal Edit -->
                  <div class="modal fade" id="editLemariModal{{ $l->lemari_id }}" tabindex="-1" aria-labelledby="editLemariModalLabel{{ $l->lemari_id }}" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editLemariModalLabel{{ $l->lemari_id }}">Edit Lemari</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('lemari.update', $l->lemari_id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="modal-body">
                            <div class="mb-3">
                              <label class="form-label">Nama Lemari</label>
                              <input type="text" class="form-control" name="nama_lemari" value="{{ $l->nama_lemari }}" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Ruangan</label>
                              <select name="ruangan_id" class="form-control" required>
                                <option value="">-- Pilih Ruangan --</option>
                                @foreach($ruangan as $r)
                                  <option value="{{ $r->ruangan_id }}" {{ $l->ruangan_id == $r->ruangan_id ? 'selected' : '' }}>
                                    {{ $r->nama_ruangan }}
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
                    <td colspan="4" class="text-center">Tidak ada data lemari.</td>
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
<div class="modal fade" id="addLemariModal" tabindex="-1" aria-labelledby="addLemariModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addLemariModalLabel">Tambah Lemari</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('lemari.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Lemari</label>
            <input type="text" class="form-control" name="nama_lemari" placeholder="Masukkan nama lemari" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Ruangan</label>
            <select name="ruangan_id" class="form-control" required>
              <option value="">-- Pilih Ruangan --</option>
              @foreach($ruangan as $r)
                <option value="{{ $r->ruangan_id }}">{{ $r->nama_ruangan }}</option>
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
