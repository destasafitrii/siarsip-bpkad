@extends('template.admin')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Tambah Arsip Surat Keluar</h4>
                            <a href="{{ route('arsip_keluar.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('arsip_keluar.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Menampilkan Pesan Validasi jika ada error -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="no_surat_keluar" class="form-label">Nomor Surat</label>
                                    <input type="text" class="form-control" id="no_surat_keluar" name="no_surat_keluar"
                                        placeholder="Masukkan nomor surat" required value="{{ old('no_surat_keluar') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="nama_surat_keluar" class="form-label">Nama Surat</label>
                                    <input type="text" class="form-control" id="nama_surat_keluar" name="nama_surat_keluar"
                                        placeholder="Masukkan nama surat" required value="{{ old('nama_surat_keluar') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_surat_keluar" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal_surat_keluar"
                                        name="tanggal_surat_keluar" required value="{{ old('tanggal_surat_keluar') }}">
                                </div>
                                <!-- Formulir Pilih Bidang -->
                                <div class="mb-3">
                                    <label for="bidang_id" class="form-label">Bidang</label>
                                    <select name="bidang_id" id="bidang_id" class="form-control" required>
                                        <option value="">-- Pilih Bidang --</option>
                                        @foreach ($list_bidang as $bidang)
                                            <option value="{{ $bidang->bidang_id }}"
                                                {{ old('bidang_id') == $bidang->bidang_id ? 'selected' : '' }}>
                                                {{ $bidang->nama_bidang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Formulir Pilih Kategori -->
                                <div class="mb-3">
                                    <label for="kategori_id" class="form-label">Kategori</label>
                                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                                        <option value="">-- Pilih Kategori --</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tujuan_surat_keluar" class="form-label">Tujuan Surat</label>
                                    <input type="text" class="form-control" id="tujuan_surat_keluar"
                                        name="tujuan_surat_keluar" placeholder="Masukkan tujuan surat" required value="{{ old('tujuan_surat_keluar') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="no_berkas_surat_keluar" class="form-label">No Berkas</label>
                                    <input type="text" class="form-control" id="no_berkas_surat_keluar"
                                        name="no_berkas_surat_keluar" placeholder="Masukkan No Berkas" required value="{{ old('no_berkas_surat_keluar') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="urutan_surat_keluar" class="form-label">Urutan</label>
                                    <input type="text" class="form-control" id="urutan_surat_keluar"
                                        name="urutan_surat_keluar" placeholder="Masukkan lokasi" required value="{{ old('urutan_surat_keluar') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="lokasi_surat_keluar" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control" id="lokasi_surat_keluar"
                                        name="lokasi_surat_keluar" placeholder="Masukkan lokasi" required value="{{ old('lokasi_surat_keluar') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan_surat_keluar" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan_surat_keluar"
                                        name="keterangan_surat_keluar" placeholder="Masukkan keterangan" required value="{{ old('keterangan_surat_keluar') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="file_surat_keluar" class="form-label">Unggah File</label>
                                    <input type="file" class="form-control" id="file_surat_keluar"
                                        name="file_surat_keluar">
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ketika bidang_id dipilih
            $('#bidang_id').change(function() {
                var bidang_id = $(this).val();

                if (bidang_id) {
                    $.ajax({
                        url: 'getKategoriByBidang/' + bidang_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#kategori_id').empty();  // Kosongkan jenis arsip sebelumnya
                            $('#kategori_id').append('<option value="">-- Pilih Jenis Arsip --</option>');

                            if (data.length > 0) {
                                $.each(data, function(key, value) {
                                    $('#kategori_id').append('<option value="' + value.kategori_id + '">' + value.nama_kategori + '</option>');
                                });
                            } else {
                                $('#kategori_id').append('<option value="">Kategori tidak ditemukan</option>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Terjadi kesalahan: ' + error); // Debugging di console
                            alert('Terjadi kesalahan: ' + error); // Menampilkan error di alert
                        }
                    });
                } else {
                    $('#kategori_id').empty();
                    $('#kategori_id').append('<option value="">-- Pilih Jenis Arsip --</option>');
                }
            });
        });
    </script>
@endsection
