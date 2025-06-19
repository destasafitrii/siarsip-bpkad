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
                                        <input type="date" class="form-control" id="tanggal_surat_keluar" name="tanggal_surat_keluar"
                                            required value="{{ old('tanggal_surat_keluar') }}">
                                    </div>
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
                                    <div class="mb-3">
                                        <label for="kategori_id" class="form-label">Kategori</label>
                                        <select name="kategori_id" id="kategori_id" class="form-control">
                                            <option value="">-- Pilih Kategori --</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tujuan_surat_keluar" class="form-label">Tujuan Surat</label>
                                        <input type="text" class="form-control" id="tujuan_surat_keluar" name="tujuan_surat_keluar"
                                            placeholder="Masukkan tujuan surat" required value="{{ old('tujuan_surat_keluar') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
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
                                    <div class="mb-3">
                                        <label for="lemari_id" class="form-label">Pilih Lemari</label>
                                        <select name="lemari_id" id="lemari_id" class="form-control" required>
                                            <option value="">-- Pilih Lemari --</option>
                                        </select>
                                    </div>
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
                                        <label for="urutan_surat_keluar" class="form-label">Urutan</label>
                                        <input type="text" class="form-control" id="urutan_surat_keluar" name="urutan_surat_keluar"
                                            placeholder="Masukkan urutan penyimpanan" required
                                            value="{{ old('urutan_surat_keluar') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                                            placeholder="Masukkan keterangan" required value="{{ old('keterangan') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="file_surat_keluar" class="form-label">Unggah File</label>
                                        <input type="file" class="form-control" id="file_surat_keluar" name="file_surat_keluar">
                                        <small class="text-muted">Maksimal ukuran file 1MB. Format: PDF.</small>
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

{{-- Script JQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#bidang_id').change(function () {
            var bidang_id = $(this).val();
            if (bidang_id) {
                $.ajax({
                    url: 'getKategoriByBidang/' + bidang_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#kategori_id').empty().append('<option value="">-- Pilih Kategori --</option>');
                        if (data.length > 0) {
                            $.each(data, function (key, value) {
                                $('#kategori_id').append('<option value="' + value.kategori_id + '">' + value.nama_kategori + '</option>');
                            });
                        } else {
                            $('#kategori_id').append('<option value="">Kategori tidak ditemukan</option>');
                        }
                    },
                    error: function () {
                        alert('Terjadi kesalahan saat mengambil data kategori.');
                    }
                });
            } else {
                $('#kategori_id').empty().append('<option value="">-- Pilih Kategori --</option>');
            }
        });

        $('#ruangan_id').change(function () {
            var ruangan_id = $(this).val();
            if (ruangan_id) {
                $.ajax({
                    url: 'getLemariByRuangan/' + ruangan_id,
                    type: 'GET',
                    success: function (data) {
                        $('#lemari_id').empty().append('<option value="">-- Pilih Lemari --</option>');
                        $.each(data, function (index, lemari) {
                            $('#lemari_id').append('<option value="' + lemari.lemari_id + '">' + lemari.nama_lemari + '</option>');
                        });
                        $('#box_id').empty().append('<option value="">-- Pilih Box --</option>');
                    },
                    error: function () {
                        alert('Gagal mengambil data lemari');
                    }
                });
            }
        });

        $('#lemari_id').change(function () {
            var lemari_id = $(this).val();
            if (lemari_id) {
                $.ajax({
                    url: 'getBoxByLemari/' + lemari_id,
                    type: 'GET',
                    success: function (data) {
                        $('#box_id').empty().append('<option value="">-- Pilih Box --</option>');
                        $.each(data, function (key, box) {
                            $('#box_id').append('<option value="' + box.box_id + '">' + box.nama_box + '</option>');
                        });
                    },
                    error: function () {
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
