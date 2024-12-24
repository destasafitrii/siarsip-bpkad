@extends('template.admin')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Tambah Arsip Surat Masuk</h4>
                            <a href="{{ route('arsip_masuk.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('arsip_masuk.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="no_surat_masuk" class="form-label">Nomor Surat</label>
                                    <input type="text" class="form-control" id="no_surat_masuk" name="no_surat_masuk"
                                        placeholder="Masukkan nomor surat" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_surat_masuk" class="form-label">Nama Surat</label>
                                    <input type="text" class="form-control" id="nama_surat_masuk" name="nama_surat_masuk"
                                        placeholder="Masukkan nama surat" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_surat_masuk" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal_surat_masuk"
                                        name="tanggal_surat_masuk" required>
                                </div>
                                <!-- Formulir Pilih Bidang -->
                                <div class="mb-3">
                                    <label for="bidang_id" class="form-label">Bidang</label>
                                    <select name="bidang_id" id="bidang_id" class="form-control" required>
                                        <option value="">-- Pilih Bidang --</option>
                                        @foreach ($list_bidang as $bidang)
                                            <option value="{{ $bidang->bidang_id }}">{{ $bidang->nama_bidang }}</option>
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
                                    <label for="lokasi_surat_masuk" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control" id="lokasi_surat_masuk"
                                        name="lokasi_surat_masuk" placeholder="Masukkan lokasi" required>
                                </div>
                                <div class="mb-3">
                                    <label for="file_surat_masuk" class="form-label">Unggah File</label>
                                    <input type="file" class="form-control" id="file_surat_masuk"
                                        name="file_surat_masuk">
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Ketika bidang dipilih
            $('#bidang_id').change(function() {
                var bidang_id = $(this).val(); // Ambil nilai bidang yang dipilih

                // Jika bidang_id ada (tidak kosong)
                if (bidang_id) {
                    $.ajax({
                        url: '/getKategoriByBidang/' + bidang_id, // URL ke route
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Kosongkan pilihan kategori
                            $('#kategori_id').empty();
                            $('#kategori_id').append(
                                '<option value="">-- Pilih Kategori --</option>');

                            // Periksa apakah data kategori ada
                            if (data.length > 0) {
                                // Menambahkan kategori ke dropdown
                                $.each(data, function(key, value) {
                                    $('#kategori_id').append('<option value="' + value
                                        .kategori_id + '">' + value.nama_kategori +
                                        '</option>');
                                });
                            } else {
                                $('#kategori_id').append(
                                    '<option value="">Kategori tidak ditemukan</option>');
                            }
                        },
                        error: function(xhr, status, error) {
                            // Menampilkan pesan kesalahan jika terjadi masalah
                            alert('Terjadi kesalahan: ' + error);
                        }
                    });
                } else {
                    $('#kategori_id').empty();
                    $('#kategori_id').append('<option value="">-- Pilih Kategori --</option>');
                }
            });
        });
    </script>
@endpush
