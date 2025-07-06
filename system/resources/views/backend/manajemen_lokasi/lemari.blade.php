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
              <table id="lemariTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Lemari</th>
                    <th>Nama Lemari</th>
                    <th>Jumlah Rak</th>
                    <th>Ruangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody></tbody>
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
    <form action="{{ route('lemari.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Tambah Lemari</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Kode Lemari</label>
          <input type="text" class="form-control" name="kode_lemari" placeholder="Masukkan Kode Lemari" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Nama Lemari</label>
          <input type="text" class="form-control" name="nama_lemari" placeholder="Masukkan Nama Lemari" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Jumlah Rak</label>
          <input type="number" class="form-control" name="jumlah_rak" placeholder="Masukkan Jumlah Rak" required>
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

<!-- Modal Hapus -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" id="deleteForm" class="modal-content">
      @csrf
      @method('DELETE')
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus lemari <strong id="namaLemariToDelete"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editLemariModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="editLemariForm" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Edit Lemari</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="lemari_id" id="edit_lemari_id">
        <div class="mb-3">
          <label class="form-label">Kode Lemari</label>
          <input type="text" class="form-control" name="kode_lemari" id="edit_kode_lemari" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Nama Lemari</label>
          <input type="text" class="form-control" name="nama_lemari" id="edit_nama_lemari" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Jumlah Rak</label>
          <input type="number" class="form-control" name="jumlah_rak" id="edit_jumlah_rak" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Ruangan</label>
          <select name="ruangan_id" id="edit_ruangan_id" class="form-control" required>
            <option value="">-- Pilih Ruangan --</option>
            @foreach($ruangan as $r)
              <option value="{{ $r->ruangan_id }}">{{ $r->nama_ruangan }}</option>
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
@endsection

@section('scripts')
<script>
  $(document).ready(function () {
    const table = $('#lemariTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('lemari.data') }}",
      columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'kode_lemari', name: 'kode_lemari' },
        { data: 'nama_lemari', name: 'nama_lemari' },
        { data: 'jumlah_rak', name: 'jumlah_rak' },
        { data: 'ruangan', name: 'ruangan.nama_ruangan' },
        { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
      ],
    language: {
        search: "Cari:",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ entries",
        paginate: {
          first: "Awal",
          last: "Akhir",
          next: "<i class='fas fa-chevron-right'></i>",
          previous: "<i class='fas fa-chevron-left'></i>"
        },
        zeroRecords: "Data tidak ditemukan",
        infoEmpty: "Tidak ada data ditampilkan",
        infoFiltered: "(difilter dari _MAX_ total entri)"
      }
    });

    // Tombol hapus
    $(document).on('click', '.btn-hapus', function () {
      const id = $(this).data('id');
      const nama = $(this).data('nama');
      $('#deleteForm').attr('action', `{{ url('pengelola/lemari') }}/${id}`);
      $('#namaLemariToDelete').text(nama);
      $('#deleteConfirmModal').modal('show');
    });

    // Tombol edit
    $(document).on('click', '.btn-edit', function () {
      const id = $(this).data('id');
      $.get(`{{ url('pengelola/lemari') }}/${id}/edit`, function (data) {
        $('#editLemariForm').attr('action', `{{ url('pengelola/lemari') }}/${id}`);
        $('#edit_lemari_id').val(data.id);
        $('#edit_kode_lemari').val(data.kode_lemari);
        $('#edit_nama_lemari').val(data.nama_lemari);
        $('#edit_jumlah_rak').val(data.jumlah_rak);
        $('#edit_ruangan_id').val(data.ruangan_id);
        $('#editLemariModal').modal('show');
      }).fail(function () {
        alert('Gagal mengambil data lemari.');
      });
    });

    // Submit form edit
    $('#editLemariForm').submit(function (e) {
      e.preventDefault();
      const form = $(this);
      const actionUrl = form.attr('action');
      const formData = form.serialize();

      $.post(actionUrl, formData)
        .done(function () {
          $('#editLemariModal').modal('hide');
          $('#lemariTable').DataTable().ajax.reload(null, false);
        })
        .fail(function () {
          alert('Gagal menyimpan perubahan!');
        });
    });
  });
</script>
@endsection
