<div class="modal fade" id="addOpdModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('opd.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambah OPD</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3"><label>Kode OPD</label><input type="text" name="kode_opd" class="form-control" placeholder="Masukkan Kode OPD" required></div>
          <div class="mb-3"><label>Nama OPD</label><input type="text" name="nama_opd" class="form-control" placeholder="Masukkan Nama OPD" required></div>
          <div class="mb-3"><label>Alamat</label><input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat"></div>
          <div class="mb-3"><label>Email</label><input type="email" name="surel" class="form-control" placeholder="Masukkan Email"></div>
          <div class="mb-3"><label>Link Maps</label><input type="textarea" name="maps" class="form-control" placeholder="Masukkan Link Maps"></div>
          <div class="mb-3"><label>Kepala Dinas</label><input type="text" name="kepala_dinas" class="form-control" placeholder="Masukkan Kepala Dinas"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
