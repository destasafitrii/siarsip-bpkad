<!-- Modal Edit OPD -->
<div class="modal fade" id="editOpdModal{{ $opd->id }}" tabindex="-1" aria-labelledby="editOpdModalLabel{{ $opd->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('opd.update', $opd->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editOpdModalLabel{{ $opd->id }}">Edit OPD</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3"><label>Kode OPD</label><input type="text" name="kode_opd" value="{{ $opd->kode_opd }}" class="form-control" required></div>
          <div class="mb-3"><label>Nama OPD</label><input type="text" name="nama_opd" value="{{ $opd->nama_opd }}" class="form-control" required></div>
          <div class="mb-3"><label>Alamat</label><input type="text" name="alamat" value="{{ $opd->alamat }}" class="form-control"></div>
          <div class="mb-3"><label>Email</label><input type="email" name="surel" value="{{ $opd->surel }}" class="form-control"></div>
          <div class="mb-3"><label>Link Maps</label><input type="url" name="maps" value="{{ $opd->maps }}" class="form-control"></div>
          <div class="mb-3"><label>Kepala Dinas</label><input type="text" name="kepala_dinas" value="{{ $opd->kepala_dinas }}" class="form-control"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
