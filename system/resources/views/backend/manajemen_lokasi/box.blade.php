@extends('template.admin')

@section('content')
<div class="page-content">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title-box">
          <h4 class="page-title">Manajemen Box</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-6">
                <h4 class="card-title">Daftar Box</h4>
              </div>
              <div class="col-md-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBoxModal">Tambah Box</button>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Box</th>
                    <th>Lemari</th>
                    <th>QR Code</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($box as $b)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->nama_box }}</td>
                    <td>{{ $b->lemari->nama_lemari ?? '-' }}</td>
                    <td>{!! QrCode::size(100)->generate(url('/box/' . $b->box_id)) !!}</td>
                    <td>
                      <!-- Tombol Edit -->
                      <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBoxModal{{ $b->box_id }}" title="Edit">
                        <i class="mdi mdi-pencil"></i>
                      </button>

                      <!-- Tombol Hapus (pakai modal) -->
                      <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusBoxModal{{ $b->box_id }}" title="Hapus">
                        <i class="mdi mdi-delete"></i>
                      </button>

                      <!-- Tombol Cetak QR -->
                      <a href="{{ url('/pengelola/cetak-qr-box/' . $b->box_id) }}" target="_blank" class="btn btn-success btn-sm mt-1" title="Cetak QR">
                        <i class="mdi mdi-printer"></i> Cetak QR
                      </a>
                    </td>
                  </tr>

                  <!-- Modal Edit -->
                  <div class="modal fade" id="editBoxModal{{ $b->box_id }}" tabindex="-1" aria-labelledby="editBoxModalLabel{{ $b->box_id }}" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editBoxModalLabel{{ $b->box_id }}">Edit Box</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('box.update', $b->box_id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="modal-body">
                            <div class="mb-3">
                              <label class="form-label">Nama Box</label>
                              <input type="text" class="form-control" name="nama_box" value="{{ $b->nama_box }}" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Lemari</label>
                              <select name="lemari_id" class="form-control" required>
                                <option value="">-- Pilih Lemari --</option>
                                @foreach ($lemari as $l)
                                  <option value="{{ $l->lemari_id }}" {{ $l->lemari_id == $b->lemari_id ? 'selected' : '' }}>
                                    {{ $l->nama_lemari }}
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

                  <!-- Modal Hapus -->
                  <div class="modal fade" id="hapusBoxModal{{ $b->box_id }}" tabindex="-1" aria-labelledby="hapusBoxModalLabel{{ $b->box_id }}" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="hapusBoxModalLabel{{ $b->box_id }}">Konfirmasi Hapus</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('box.destroy', $b->box_id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus box <strong>{{ $b->nama_box }}</strong>?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  @empty
                  <tr>
                    <td colspan="5" class="text-center">Tidak ada data box.</td>
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
<div class="modal fade" id="addBoxModal" tabindex="-1" aria-labelledby="addBoxModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addBoxModalLabel">Tambah Box</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('box.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Box</label>
            <input type="text" class="form-control" name="nama_box" placeholder="Masukkan nama box" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Lemari</label>
            <select name="lemari_id" class="form-control" required>
              <option value="">-- Pilih Lemari --</option>
              @foreach ($lemari as $l)
              <option value="{{ $l->lemari_id }}">{{ $l->nama_lemari }}</option>
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
