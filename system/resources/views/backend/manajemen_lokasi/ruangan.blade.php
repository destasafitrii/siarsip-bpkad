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
              <table id="ruanganTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Keterangan</th>
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
<div class="modal fade" id="addRuanganModal" tabindex="-1" aria-labelledby="addRuanganModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('ruangan.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Tambah Ruangan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Kode Ruangan</label>
          <input type="text" class="form-control" name="kode_ruangan" placeholder="Masukkan Kode Ruangan" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Nama Ruangan</label>
          <input type="text" class="form-control" name="nama_ruangan" placeholder="Masukkan Nama Ruangan" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Alamat</label>
          <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat Ruangan">
        </div>
        <div class="mb-3">
          <label class="form-label">Keterangan</label>
          <textarea class="form-control" name="keterangan" placeholder="Masukkan Keterangan"></textarea>
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
        Apakah Anda yakin ingin menghapus ruangan <strong id="namaRuanganToDelete"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editRuanganModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="editRuanganForm" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Edit Ruangan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="ruangan_id" id="edit_ruangan_id">
        <div class="mb-3">
          <label class="form-label">Kode Ruangan</label>
          <input type="text" class="form-control" name="kode_ruangan" id="edit_kode_ruangan" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Nama Ruangan</label>
          <input type="text" class="form-control" name="nama_ruangan" id="edit_nama_ruangan" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Alamat</label>
          <input type="text" class="form-control" name="alamat" id="edit_alamat">
        </div>
        <div class="mb-3">
          <label class="form-label">Keterangan</label>
          <textarea class="form-control" name="keterangan" id="edit_keterangan"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
<!-- Modal Detail -->
<div class="modal fade" id="detailRuanganModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Ruangan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item"><strong>Kode:</strong> <span id="detail_kode_ruangan"></span></li>
          <li class="list-group-item"><strong>Nama:</strong> <span id="detail_nama_ruangan"></span></li>
          <li class="list-group-item"><strong>Alamat:</strong> <span id="detail_alamat"></span></li>
          <li class="list-group-item"><strong>Keterangan:</strong> <span id="detail_keterangan"></span></li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
  $(document).ready(function () {
    const table = $('#ruanganTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('ruangan.data') }}",
      columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'kode_ruangan', name: 'kode_ruangan' },
        { data: 'nama_ruangan', name: 'nama_ruangan' },
        { data: 'alamat', name: 'alamat' },
        { data: 'keterangan', name: 'keterangan' },
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
      const namaRuangan = $(this).data('namaruangan');
      $('#deleteForm').attr('action', `{{ url('pengelola/ruangan') }}/${id}`);
      $('#namaRuanganToDelete').text(namaRuangan);
      $('#deleteConfirmModal').modal('show');
    });

    // Tombol edit
    $(document).on('click', '.btn-edit', function () {
      const id = $(this).data('id');
      $.ajax({
        url: `{{ url('pengelola/ruangan') }}/${id}/edit`,
        method: 'GET',
        success: function (data) {
          $('#editRuanganForm').attr('action', `{{ url('pengelola/ruangan') }}/${id}`);
          $('#edit_ruangan_id').val(data.ruangan_id);
          $('#edit_kode_ruangan').val(data.kode_ruangan);
          $('#edit_nama_ruangan').val(data.nama_ruangan);
          $('#edit_alamat').val(data.alamat);
          $('#edit_keterangan').val(data.keterangan);
          $('#editRuanganModal').modal('show');
        },
        error: function () {
          alert('Gagal mengambil data ruangan.');
        }
      });
    });
  });
  $('#editRuanganForm').submit(function(e) {
    e.preventDefault(); // Mencegah submit form biasa
    const form = $(this);
    const actionUrl = form.attr('action');
    const formData = form.serialize();

    $.ajax({
        url: actionUrl,
        method: 'POST',
        data: formData,
        success: function(res) {
            $('#editRuanganModal').modal('hide');
            $('#ruanganTable').DataTable().ajax.reload(null, false); // reload data
        },
        error: function(xhr) {
            alert('Gagal menyimpan perubahan!');
        }
    });
});

  // Tombol detail
$(document).on('click', '.btn-detail', function () {
  const id = $(this).data('id');
  $.ajax({
    url: `{{ url('pengelola/ruangan') }}/${id}/edit`,
    method: 'GET',
    success: function (data) {
      $('#detail_kode_ruangan').text(data.kode_ruangan || '-');
      $('#detail_nama_ruangan').text(data.nama_ruangan || '-');
      $('#detail_alamat').text(data.alamat || '-');
      $('#detail_keterangan').text(data.keterangan || '-');
      $('#detailRuanganModal').modal('show');
    },
    error: function () {
      alert('Gagal mengambil detail ruangan.');
    }
  });
});

</script>
@endsection




