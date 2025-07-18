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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="no_surat_masuk" class="form-label">Nomor Surat</label>
                                            <input type="text" class="form-control" id="no_surat_masuk"
                                                name="no_surat_masuk" placeholder="Masukkan nomor surat" required
                                                value="{{ old('no_surat_masuk') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_surat_masuk" class="form-label">Nama Surat</label>
                                            <input type="text" class="form-control" id="nama_surat_masuk"
                                                name="nama_surat_masuk" placeholder="Masukkan nama surat" required
                                                value="{{ old('nama_surat_masuk') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_surat_masuk" class="form-label">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal_surat_masuk"
                                                name="tanggal_surat_masuk" required
                                                value="{{ old('tanggal_surat_masuk') }}">
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
                                            <select name="kategori_id" id="kategori_id" class="form-control">
                                                <option value="">-- Pilih Kategori --</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="asal_surat_masuk" class="form-label">Asal</label>
                                            <input type="text" class="form-control" id="asal_surat_masuk"
                                                name="asal_surat_masuk" placeholder="Masukkan asal surat" required
                                                value="{{ old('asal_surat_masuk') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Formulir Pilih Ruangan -->
                                        <div class="mb-3">
                                            <label for="ruangan_id" class="form-label">Pilih Ruangan</label>
                                            <select name="ruangan_id" id="ruangan_id" class="form-control" required>
                                                <option value="">-- Pilih Ruangan --</option>
                                                @foreach ($list_ruangan as $ruangan)
                                                    <option value="{{ $ruangan->ruangan_id }}"
                                                        {{ old('ruangan_id') == $ruangan->ruangan_id ? 'selected' : '' }}>
                                                        {{ $ruangan->nama_ruangan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Formulir Pilih Lemari -->
                                        <div class="mb-3">
                                            <label for="lemari_id" class="form-label">Pilih Lemari</label>
                                            <select name="lemari_id" id="lemari_id" class="form-control"required>
                                                <option value="">-- Pilih Lemari --</option>
                                                {{-- Akan diisi secara dinamis berdasarkan ruangan --}}
                                            </select>
                                        </div>

                                        <!-- Formulir Pilih Box -->
                                        <div class="mb-3">
                                            <label for="box_id" class="form-label">Pilih Box</label>
                                            <select name="box_id" id="box_id" class="form-control" required>
                                                <option value="">-- Pilih Box --</option>
                                                @foreach ($list_box as $box)
                                                    <option value="{{ $box->box_id }}"
                                                        {{ old('box_id') == $box->box_id ? 'selected' : '' }}>
                                                        {{ $box->nama_box }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="mb-3">
                                            <label for="urutan_surat_masuk" class="form-label">Urutan</label>
                                            <input type="text" class="form-control" id="urutan_surat_masuk"
                                                name="urutan_surat_masuk" placeholder="Masukkan urutan penyimpanan" required
                                                value="{{ old('urutan_surat_masuk') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <input type="text" class="form-control" id="keterangan" name="keterangan"
                                                placeholder="Masukkan keterangan" required
                                                value="{{ old('keterangan') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="file_surat_masuk" class="form-label">Unggah File</label>
                                            <input type="file" class="form-control" id="file_surat_masuk"
                                                name="file_surat_masuk">
                                            <small class="text-muted">Maksimal ukuran file 5MB. Format yang diperbolehkan:
                                                PDF, JPEG, PNG, JPG.</small>
                                        </div>
                                    </div>

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
                            $('#kategori_id').empty(); // Kosongkan kategori sebelumnya
                            $('#kategori_id').append(
                                '<option value="">-- Pilih Kategori --</option>');

                            if (data.length > 0) {
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
                            console.error('Terjadi kesalahan: ' +
                                error); // Debugging di console
                            alert('Terjadi kesalahan: ' + error); // Menampilkan error di alert
                        }
                    });
                } else {
                    $('#kategori_id').empty();
                    $('#kategori_id').append('<option value="">-- Pilih Kategori --</option>');
                }
            });

            $('#ruangan_id').change(function() {
                var ruangan_id = $(this).val();
                console.log("Ruangan yang dipilih:", ruangan_id);

                if (ruangan_id) {
                    $.ajax({
                        url: 'getLemariByRuangan/' + ruangan_id,
                        type: 'GET',
                        success: function(data) {
                            console.log("Data lemari yang diterima:", data);
                            $('#lemari_id').empty().append(
                                '<option value="">-- Pilih Lemari --</option>');
                            $.each(data, function(index, lemari) {
                                $('#lemari_id').append('<option value="' + lemari
                                    .lemari_id + '">' + lemari.nama_lemari +
                                    '</option>');
                            });
                            $('#box_id').empty().append(
                                '<option value="">-- Pilih Box --</option>');
                        },
                        error: function(xhr) {
                            alert('Gagal mengambil data lemari');
                        }
                    });
                }
            });

            // Saat lemari dipilih → ambil data box
            $('#lemari_id').change(function() {
                var lemari_id = $(this).val();
                if (lemari_id) {
                    $.ajax({
                        url: 'getBoxByLemari/' + lemari_id,
                        type: 'GET',
                        success: function(data) {
                            $('#box_id').empty().append(
                                '<option value="">-- Pilih Box --</option>');
                            $.each(data, function(key, box) {
                                $('#box_id').append('<option value="' + box.box_id +
                                    '">' + box
                                    .nama_box + '</option>');
                            });
                        },
                        error: function(xhr) {
                            alert('Gagal mengambil data box');
                        }
                    });
                } else {
                    $('#box_id').empty().append('<option value="">-- Pilih Box --</option>');
                }
            });
        });
    </script>
@endsection
