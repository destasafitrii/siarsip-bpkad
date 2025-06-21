@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Pegawai</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('pegawai.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="status_kepegawaian" class="form-label">Status Kepegawaian</label>
                            <select name="status_kepegawaian" class="form-select" id="status_kepegawaian" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="ASN">ASN</option>
                                <option value="Honor">Honor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Pegawai</label>
                            <input type="text" name="nama" class="form-control" required
                            placeholder="Masukkan Nama Pegawai">
                        </div>



                        <div class="mb-3" id="form-nip">
                            <label for="nip" class="form-label">NIP</label>
                           <input type="text" class="form-control" name="nip" id="nip" placeholder="Masukkan NIP">
                        </div>

                        <div class="mb-3" id="form-nik" style="display: none;">
                            <label for="nik" class="form-label">NIK</label>
                           <input type="text" class="form-control" name="nik" id="nik" placeholder="Masukkan NIK">
                        </div>
                        <div class="mb-3" id="form_golongan">
                            <label for="golongan" class="form-label">Golongan</label>
                            <input type="text" name="golongan" id="golongan" class="form-control"
                            placeholder="Masukkan Golongan">
                        </div>

                        <div class="mb-3" id="form_jabatan">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control"
                            placeholder="Masukkan Jabatan">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleFields() {
            const status = document.getElementById('status_kepegawaian').value;
            const isAsn = status === 'ASN';
            const isHonor = status === 'Honor';

            // Ambil elemen-elemen form
            const formNip = document.getElementById('form-nip');
            const formNik = document.getElementById('form-nik');
            const formGol = document.getElementById('form_golongan');
            const formJab = document.getElementById('form_jabatan');

            // Reset dulu: sembunyikan semua
            formNip.style.display = 'none';
            formNik.style.display = 'none';
            formGol.style.display = 'none';
            formJab.style.display = 'none';

            // Hilangkan required dulu
            document.getElementById('nip').required = false;
            document.getElementById('nik').required = false;
            document.getElementById('golongan').required = false;
            document.getElementById('jabatan').required = false;

            // Tampilkan sesuai pilihan
            if (isAsn) {
                formNip.style.display = 'block';
                formGol.style.display = 'block';
                formJab.style.display = 'block';
                document.getElementById('nip').required = true;
                document.getElementById('golongan').required = true;
                document.getElementById('jabatan').required = true;
            } else if (isHonor) {
                formNik.style.display = 'block';
                document.getElementById('nik').required = true;
            }
            // Jika belum pilih status: semua tetap hidden
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleFields();
            document.getElementById('status_kepegawaian').addEventListener('change', toggleFields);
        });
    </script>
@endpush
