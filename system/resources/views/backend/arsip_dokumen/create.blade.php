@extends('template.admin')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Tambah Arsip Dokumen</h4>
                            <a href="{{ route('arsip_dokumen.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('arsip_dokumen.store') }}" method="POST" enctype="multipart/form-data">
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
                                            <label for="nama_dokumen" class="form-label">Nomor Dokumen</label>
                                            <input type="text" class="form-control" id="no_dokumen" name="no_dokumen"
                                                placeholder="Masukkan nomor dokumen" required value="{{ old('no_dokumen') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                                            <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen"
                                                placeholder="Masukkan nama dokumen" required value="{{ old('nama_dokumen') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_dokumen" class="form-label">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal_dokumen"
                                                name="tanggal_dokumen" required value="{{ old('tanggal_dokumen') }}">
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
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <input type="text" class="form-control" id="keterangan" name="keterangan"
                                                placeholder="Masukkan keterangan" required value="{{ old('keterangan') }}">
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
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="urutan" class="form-label">Urutan</label>
                                            <input type="number" class="form-control" id="urutan"
                                                name="urutan" placeholder="Masukkan urutan arsip di dalam box" required
                                                value="{{ old('urutan') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="file_dokumen" class="form-label">Unggah File</label>
                                            <input type="file" class="form-control" id="file_dokumen" name="file_dokumen">
                                            <small class="text-muted">Maksimal ukuran file 5MB. Format yang diperbolehkan: PDF, JPEG, PNG, JPG.</small>
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

    {{-- JQuery & Script dinamis --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
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

            $('#ruangan_id').change(function() {
                let ruangan_id = $(this).val();
                if (ruangan_id) {
                    $.ajax({
                        url: 'getLemariByRuangan/' + ruangan_id,
                        type: 'GET',
                        success: function(data) {
                            $('#lemari_id').empty().append('<option value="">-- Pilih Lemari --</option>');
                            $.each(data, function(index, lemari) {
                                $('#lemari_id').append('<option value="' + lemari.lemari_id + '">' + lemari.nama_lemari + '</option>');
                            });
                            $('#box_id').empty().append('<option value="">-- Pilih Box --</option>');
                        }
                    });
                }
            });

            $('#lemari_id').change(function() {
                let lemari_id = $(this).val();
                if (lemari_id) {
                    $.ajax({
                        url: 'getBoxByLemari/' + lemari_id,
                        type: 'GET',
                        success: function(data) {
                            $('#box_id').empty().append('<option value="">-- Pilih Box --</option>');
                            $.each(data, function(index, box) {
                                $('#box_id').append('<option value="' + box.box_id + '">' + box.nama_box + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
