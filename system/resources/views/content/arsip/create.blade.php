@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Tambah Arsip Baru</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('arsip.index') }}">Data Arsip</a></li>
                                <li class="breadcrumb-item active">Tambah Arsip</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Tambah Data Arsip</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form Tambah Data Arsip -->
                            <form action="{{ route('arsip.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="nama_arsip" class="form-label">Nama Arsip</label>
                                    <input type="text" class="form-control" id="nama_arsip" name="nama_arsip"
                                        value="{{ old('nama_arsip') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                    <input type="text" class="form-control" id="nomor_surat" name="nomor_surat"
                                        value="{{ old('nomor_surat') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                                        value="{{ old('tanggal') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="bidang" class="form-label">Bidang</label>
                                    <select class="form-control" id="bidang" name="bidang" required>
                                        <option value="">Pilih Bidang</option>
                                        <option value="anggaran" {{ old('bidang') == 'anggaran' ? 'selected' : '' }}>
                                            Anggaran</option>
                                        <option value="pembendaharaan"
                                            {{ old('bidang') == 'pembendaharaan' ? 'selected' : '' }}>Pembendaharaan
                                        </option>
                                        <option value="akuntansi" {{ old('bidang') == 'akuntansi' ? 'selected' : '' }}>
                                            Akuntansi</option>
                                        <option value="sekretariat" {{ old('bidang') == 'sekretariat' ? 'selected' : '' }}>
                                            Sekretariat</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="jenis_arsip" class="form-label">Jenis Arsip</label>
                                    <select class="form-control" id="jenis_arsip" name="jenis_arsip" required>
                                        <option value="">Pilih Jenis Arsip</option>
                                        <!-- Opsi akan diisi berdasarkan bidang yang dipilih dengan JavaScript -->
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tujuan_dari" class="form-label">Tujuan/Dari</label>
                                    <input type="text" class="form-control" id="tujuan_dari" name="tujuan_dari"
                                        value="{{ old('tujuan_dari') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="no_berkas" class="form-label">Nomor Berkas</label>
                                    <input type="text" class="form-control" id="no_berkas" name="no_berkas"
                                        value="{{ old('no_berkas') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="urutan" class="form-label">Urutan</label>
                                    <input type="text" class="form-control" id="urutan" name="urutan"
                                        value="{{ old('urutan') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control" id="lokasi" name="lokasi"
                                        value="{{ old('lokasi') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan">{{ old('keterangan') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="file_arsip" class="form-label">Unggah File</label>
                                    <input type="file" class="form-control" id="file_arsip" name="file_arsip" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('arsip.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                            <!-- End Form Tambah Data Arsip -->
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    <!-- JavaScript untuk mengatur jenis arsip berdasarkan bidang -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bidangSelect = document.getElementById('bidang');
            const jenisArsipSelect = document.getElementById('jenis_arsip');

            // Data jenis arsip berdasarkan bidang
            const jenisArsipOptions = {
                'anggaran': ['APBD'],
                'pembendaharaan': ['SPD', 'SP2D'],
                'akuntansi': ['SPJ'],
                'sekretariat': ['masuk', 'keluar']
            };

            // Fungsi untuk mengupdate opsi jenis arsip berdasarkan bidang yang dipilih
            bidangSelect.addEventListener('change', function() {
                const selectedBidang = bidangSelect.value;
                const options = jenisArsipOptions[selectedBidang] || [];

                // Hapus semua opsi sebelumnya
                jenisArsipSelect.innerHTML = '<option value="">Pilih Jenis Arsip</option>';

                // Tambahkan opsi baru
                options.forEach(function(jenis) {
                    const option = document.createElement('option');
                    option.value = jenis;
                    option.textContent = jenis;
                    jenisArsipSelect.appendChild(option);
                });
            });
        });
    </script>
@endsection
