@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Edit Arsip Surat Masuk</h4>
                            <a href="{{ route('arsip_masuk.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('arsip_masuk.update', $arsip_surat_masuk->surat_masuk_id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

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
                                                name="no_surat_masuk" required
                                                value="{{ old('no_surat_masuk', $arsip_surat_masuk->no_surat_masuk) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_surat_masuk" class="form-label">Nama Surat</label>
                                            <input type="text" class="form-control" id="nama_surat_masuk"
                                                name="nama_surat_masuk" required
                                                value="{{ old('nama_surat_masuk', $arsip_surat_masuk->nama_surat_masuk) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_surat_masuk" class="form-label">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal_surat_masuk"
                                                name="tanggal_surat_masuk" required
                                                value="{{ old('tanggal_surat_masuk', $arsip_surat_masuk->tanggal_surat_masuk) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="bidang_id" class="form-label">Bidang</label>
                                            <select name="bidang_id" id="bidang_id" class="form-control" required>
                                                <option value="">-- Pilih Bidang --</option>
                                                @foreach ($list_bidang as $bidang)
                                                    <option value="{{ $bidang->bidang_id }}"
                                                        {{ old('bidang_id', $arsip_surat_masuk->bidang_id) == $bidang->bidang_id ? 'selected' : '' }}>
                                                        {{ $bidang->nama_bidang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kategori_id" class="form-label">Kategori</label>
                                            <select name="kategori_id" id="kategori_id" class="form-control">
                                                <option value="">-- Pilih Kategori (Opsional) --</option>
                                                @if (isset($arsip_surat_masuk->kategori_id))
                                                    @foreach ($list_kategori as $kategori)
                                                        <option value="{{ $kategori->kategori_id }}"
                                                            {{ old('kategori_id', $arsip_surat_masuk->kategori_id) == $kategori->kategori_id ? 'selected' : '' }}>
                                                            {{ $kategori->nama_kategori }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="asal_surat_masuk" class="form-label">Asal</label>
                                            <input type="text" class="form-control" id="asal_surat_masuk"
                                                name="asal_surat_masuk" required
                                                value="{{ old('asal_surat_masuk', $arsip_surat_masuk->asal_surat_masuk) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="ruangan_id" class="form-label">Pilih Ruangan</label>
                                            <select name="ruangan_id" id="ruangan" class="form-control">
                                                <option value="">-- Pilih Ruangan --</option>
                                                @foreach ($list_ruangan as $ruangan)
                                                    <option value="{{ $ruangan->ruangan_id }}"
                                                        {{ $arsip_surat_masuk->box->lemari->ruangan_id == $ruangan->ruangan_id ? 'selected' : '' }}>
                                                        {{ $ruangan->nama_ruangan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lemari_id" class="form-label">Pilih Lemari</label>
                                            <select name="lemari_id" id="lemari" class="form-control">
                                                <option value="">-- Pilih Lemari --</option>
                                                @foreach ($list_lemari as $lemari)
                                                    <option value="{{ $lemari->lemari_id }}"
                                                        {{ $arsip_surat_masuk->box->lemari_id == $lemari->lemari_id ? 'selected' : '' }}>
                                                        {{ $lemari->nama_lemari }}
                                                    </option>
                                                @endforeach
                                            </select>


                                        </div>
                                        <div class="mb-3">
                                            <label for="box_id" class="form-label">Pilih Box</label>
                                            <select name="box_id" id="box" class="form-control">
                                                <option value="">-- Pilih Box --</option>
                                                @foreach ($list_box as $box)
                                                    <option value="{{ $box->box_id }}"
                                                        {{ $arsip_surat_masuk->box->box_id == $box->box_id ? 'selected' : '' }}>
                                                        {{ $box->nama_box }}
                                                    </option>
                                                @endforeach
                                            </select>


                                        </div>
                                        <div class="mb-3">
                                            <label for="urutan_surat_masuk" class="form-label">Urutan</label>
                                            <input type="number" class="form-control" id="urutan_surat_masuk"
                                                name="urutan_surat_masuk" required
                                                value="{{ old('urutan_surat_masuk', $arsip_surat_masuk->urutan_surat_masuk) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <input type="text" class="form-control" id="keterangan" name="keterangan"
                                                required value="{{ old('keterangan', $arsip_surat_masuk->keterangan) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="file_surat_masuk" class="form-label">Unggah File</label>
                                            <input type="file" class="form-control" id="file_surat_masuk"
                                                name="file_surat_masuk">
                                            <small class="text-muted">Maksimal ukuran file 5MB. Format PDF, JPEG, PNG, JPG.</small>
                                            @if ($arsip_surat_masuk->file_surat_masuk)
                                                <div class="mt-2">
                                                    <small>File saat ini:
                                                        <a href="{{ asset('storage/' . $arsip_surat_masuk->file_surat_masuk) }}"
                                                            target="_blank">
                                                            {{ basename($arsip_surat_masuk->file_surat_masuk) }}
                                                        </a>
                                                    </small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
            var initialRuangan = $('#ruangan').val();
            var initialLemari = "{{ $arsip_surat_masuk->box->lemari_id }}";
            var initialBox = "{{ $arsip_surat_masuk->box->box_id }}";

            // Trigger Ajax ketika halaman dimuat (jika ada nilai ruangan dan lemari sebelumnya)
            if (initialRuangan) {
                $.ajax({
                    url: '{{ url('pengelola/arsip_masuk/getLemariByRuangan') }}/' + initialRuangan,
                    type: 'GET',
                    success: function(data) {
                        $('#lemari').empty().append('<option value="">-- Pilih Lemari --</option>');
                        $.each(data, function(key, lemari) {
                            let selected = (lemari.lemari_id == initialLemari) ? 'selected' :
                                '';
                            $('#lemari').append('<option value="' + lemari.lemari_id + '" ' +
                                selected + '>' + lemari.nama_lemari + '</option>');
                        });

                        // Setelah lemari diisi, langsung isi box
                        if (initialLemari) {
                            $.ajax({
                                url: '{{ url('pengelola/arsip_masuk/getBoxByLemari') }}/' +
                                    initialLemari,
                                type: 'GET',
                                success: function(data) {
                                    $('#box').empty().append(
                                        '<option value="">-- Pilih Box --</option>');
                                    $.each(data, function(key, box) {
                                        let selected = (box.box_id == initialBox) ?
                                            'selected' : '';
                                        $('#box').append('<option value="' + box
                                            .box_id + '" ' + selected + '>' +
                                            box.nama_box + '</option>');
                                    });
                                }
                            });
                        }
                    }
                });
            }


            // Ketika bidang_id dipilih
            $('#bidang_id').change(function() {
                var bidang_id = $(this).val();

                if (bidang_id) {
                    $.ajax({
                        url: '{{ url('pengelola/arsip_masuk/getKategoriByBidang') }}/' + bidang_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#kategori_id').empty();
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
                            console.error('Terjadi kesalahan: ' + error);
                        }
                    });
                } else {
                    $('#kategori_id').empty().append('<option value="">-- Pilih Kategori --</option>');
                }
            });

            $('#ruangan').on('change', function() {
                var ruanganID = $(this).val();
                if (ruanganID) {
                    $.ajax({
                        url: '{{ url('pengelola/arsip_masuk/getLemariByRuangan') }}/' + ruanganID,


                        type: 'GET',
                        success: function(data) {
                            $('#lemari').empty().append(
                                '<option value="">-- Pilih Lemari --</option>');
                            $('#box').empty().append(
                                '<option value="">-- Pilih Box --</option>');
                            $.each(data, function(key, lemari) {
                                $('#lemari').append('<option value="' + lemari
                                    .lemari_id + '">' + lemari.nama_lemari +
                                    '</option>');
                            });
                            $('#lemari').val(initialLemari).trigger('change');
                        }
                    });
                }
            });

            $('#lemari').on('change', function() {
                var lemariID = $(this).val();
                if (lemariID) {
                    $.ajax({
                        url: '{{ url('pengelola/arsip_masuk/getBoxByLemari') }}/' + lemariID,


                        type: 'GET',
                        success: function(data) {
                            $('#box').empty().append(
                                '<option value="">-- Pilih Box --</option>');
                            $.each(data, function(key, box) {
                                $('#box').append('<option value="' + box.box_id + '">' +
                                    box.nama_box + '</option>');
                            });

                        }
                    });
                }
            });
        });
    </script>
@endsection
