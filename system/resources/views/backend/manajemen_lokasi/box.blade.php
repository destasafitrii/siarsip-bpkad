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
              <table class="table table-bordered table-striped" id="boxTables">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Box</th>
                    <th>Lemari</th>
                    <th>QR Code</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($box as $b)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->nomor_box }}</td>
                    <td>{{ $b->lemari->nama_lemari ?? '-' }}</td>
                    <td>
                      @php
                        $url = $b->box_id ? url('/box/' . $b->box_id) : '#';
                      @endphp
                      {!! QrCode::size(100)->generate($url) !!}
                    </td>
                    <td>
                      <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBoxModal{{ $b->box_id }}"><i class="mdi mdi-pencil"></i></button>
                      <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusBoxModal{{ $b->box_id }}"><i class="mdi mdi-trash-can-outline"></i></button>
                      <a href="{{ url('/pengelola/cetak-qr-box/' . $b->box_id) }}" target="_blank" class="btn btn-success btn-sm"><i class="mdi mdi-printer"></i> Cetak QR</a>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td class="text-center" colspan="5">Tidak ada data box.</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            <!-- Modal Edit & Hapus Diletakkan di luar tabel -->
            @foreach ($box as $b)
            <!-- Modal Edit -->
            <div class="modal fade" id="editBoxModal{{ $b->box_id }}" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Box</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <form action="{{ route('box.update', $b->box_id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">Nomor Box</label>
                        <input type="text" name="nomor_box" class="form-control" value="{{ $b->nomor_box }}" required>
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
                      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Modal Hapus -->
            <div class="modal fade" id="hapusBoxModal{{ $b->box_id }}" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <form action="{{ route('box.destroy', $b->box_id) }}" method="POST">
                    @csrf @method('DELETE')
                    <div class="modal-body">
                      <p>Yakin ingin menghapus data ini </strong>?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            @endforeach

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="addBoxModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Box</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('box.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nomor Box</label>
            <input type="text" class="form-control" name="nomor_box" placeholder="Masukkan Nomor Box" required>
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

@push('scripts')
<script>
  $(document).ready(function () {
    // Cek apakah ada data di tabel
    @if($box->count() > 0)
    // Hanya inisialisasi DataTables jika ada data
    $('#boxTables').DataTable({
      "language": {
        "lengthMenu": "Show_MENU_ entries",
        "zeroRecords": "Data tidak ditemukan",
        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
        "infoEmpty": "Tidak ada data tersedia",
        "infoFiltered": "(difilter dari _MAX_ total data)",
        "search": "Cari:",
        "paginate": {
          "first": "Pertama",
          "last": "Terakhir",
           "next": "<i class='fas fa-chevron-right'></i>",
          "previous": "<i class='fas fa-chevron-left'></i>"
        }
      },
      "columnDefs": [
        {
          "targets": [3], // Kolom QR Code
          "orderable": false
        },
        {
          "targets": [4], // Kolom Aksi
          "orderable": false
        }
      ],
      "pageLength": 10
    });
    @else
    // Jika tidak ada data, tampilkan pesan tanpa DataTables
    console.log('Tidak ada data, DataTables tidak diinisialisasi');
    @endif
  });
</script>
@endpush