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
              <table id="kategoriTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Bidang</th>
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
<div class="modal fade" id="addKategoriModal" tabindex="-1" aria-labelledby="addKategoriModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('kategori.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Tambah Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nama Kategori</label>
          <input type="text" class="form-control" name="nama_kategori" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Bidang</label>
          <select name="bidang_id" class="form-select" required>
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" id="deleteForm" class="modal-content">
      @csrf
      @method('DELETE')
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus kategori <strong id="namaKategoriToDelete"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="editKategoriModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="editKategoriForm" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Edit Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="kategori_id" id="edit_kategori_id">
        <div class="mb-3">
          <label class="form-label">Nama Kategori</label>
          <input type="text" class="form-control" name="nama_kategori" id="edit_nama_kategori" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Bidang</label>
          <select name="bidang_id" class="form-select" id="edit_bidang_id" required>
            <option value="" disabled>Pilih Bidang</option>
            @foreach ($bidang as $b)
              <option value="{{ $b->bidang_id }}">{{ $b->nama_bidang }}</option>
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
    const table = $('#kategoriTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{ route('kategori.data') }}',
      columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'nama_kategori', name: 'nama_kategori' },
        { data: 'bidang', name: 'bidang.nama_bidang' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
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
    $(document).on('click', '.btn-delete', function () {
  const id = $(this).data('id');
  const nama = $(this).data('nama');
  $('#deleteForm').attr('action', `{{ url('pengelola/kategori') }}/${id}`);
  $('#namaKategoriToDelete').text(nama);
  $('#deleteConfirmModal').modal('show');
});


    // Tombol edit
    $(document).on('click', '.btn-edit', function () {
      const id = $(this).data('id');
      $.ajax({
       url: `{{ url('pengelola/kategori') }}/${id}/edit`,

        method: 'GET',
        success: function (data) {
         $('#editKategoriForm').attr('action', '{{ url('pengelola/kategori') }}/' + id);

          $('#edit_kategori_id').val(data.kategori_id);
          $('#edit_nama_kategori').val(data.nama_kategori);
          $('#edit_bidang_id').val(data.bidang_id);
          $('#editKategoriModal').modal('show');
        },
        error: function () {
          alert('Gagal mengambil data kategori.');
        }
      });
    });
  });
</script>
@endsection
