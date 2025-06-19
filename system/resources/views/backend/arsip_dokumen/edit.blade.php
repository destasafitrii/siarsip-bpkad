@extends('template.admin')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Edit Arsip Dokumen</h4>
                        <a href="{{ route('arsip_dokumen.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('arsip_dokumen.update', $arsip_dokumen->dokumen_id) }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="no_dokumen" class="form-label">Nomor Dokumen</label>
                                        <input type="text" class="form-control" id="no_dokumen" name="no_dokumen"
                                            value="{{ old('no_dokumen', $arsip_dokumen->no_dokumen) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                                        <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen"
                                            value="{{ old('nama_dokumen', $arsip_dokumen->nama_dokumen) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_dokumen" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal_dokumen" name="tanggal_dokumen"
                                            value="{{ old('tanggal_dokumen', $arsip_dokumen->tanggal_dokumen) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bidang_id" class="form-label">Bidang</label>
                                        <select name="bidang_id" id="bidang_id" class="form-control" required>
                                            <option value="">-- Pilih Bidang --</option>
                                            @foreach ($list_bidang as $bidang)
                                                <option value="{{ $bidang->bidang_id }}"
                                                    {{ old('bidang_id', $arsip_dokumen->bidang_id) == $bidang->bidang_id ? 'selected' : '' }}>
                                                    {{ $bidang->nama_bidang }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori_id" class="form-label">Kategori</label>
                                        <select name="kategori_id" id="kategori_id" class="form-control">
                                            <option value="">-- Pilih Kategori (Opsional) --</option>
                                            @if($list_kategori)
                                                @foreach ($list_kategori as $kategori)
                                                    <option value="{{ $kategori->kategori_id }}"
                                                        {{ old('kategori_id', $arsip_dokumen->kategori_id) == $kategori->kategori_id ? 'selected' : '' }}>
                                                        {{ $kategori->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                                            value="{{ old('keterangan', $arsip_dokumen->keterangan) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="ruangan_id" class="form-label">Ruangan</label>
                                        <select name="ruangan_id" id="ruangan_id" class="form-control" required>
                                            <option value="">-- Pilih Ruangan --</option>
                                            @foreach ($list_ruangan as $ruangan)
                                                <option value="{{ $ruangan->ruangan_id }}"
                                                    {{ old('ruangan_id', $arsip_dokumen->ruangan_id) == $ruangan->ruangan_id ? 'selected' : '' }}>
                                                    {{ $ruangan->nama_ruangan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lemari_id" class="form-label">Lemari</label>
                                        <select name="lemari_id" id="lemari_id" class="form-control" required>
                                            <option value="">-- Pilih Lemari --</option>
                                            @if($list_lemari)
                                                @foreach ($list_lemari as $lemari)
                                                    <option value="{{ $lemari->lemari_id }}"
                                                        {{ old('lemari_id', $arsip_dokumen->lemari_id) == $lemari->lemari_id ? 'selected' : '' }}>
                                                        {{ $lemari->nama_lemari }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="box_id" class="form-label">Box</label>
                                        <select name="box_id" id="box_id" class="form-control" required>
                                            <option value="">-- Pilih Box --</option>
                                            @if($list_box)
                                                @foreach ($list_box as $box)
                                                    <option value="{{ $box->box_id }}"
                                                        {{ old('box_id', $arsip_dokumen->box_id) == $box->box_id ? 'selected' : '' }}>
                                                        {{ $box->nama_box }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="urutan_dokumen" class="form-label">Urutan</label>
                                        <input type="text" class="form-control" id="urutan_dokumen" name="urutan_dokumen"
                                            value="{{ old('urutan_dokumen', $arsip_dokumen->urutan_dokumen) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="file_dokumen" class="form-label">Unggah File Baru (Opsional)</label>
                                        <input type="file" class="form-control" id="file_dokumen" name="file_dokumen">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengganti file. Maks 1MB, PDF.</small>
                                        @if ($arsip_dokumen->file_dokumen)
                                            <div class="mt-2">
                                                <a href="{{ asset('storage/arsip_dokumen/' . $arsip_dokumen->file_dokumen) }}" target="_blank">Lihat File Saat Ini</a>
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

{{-- Include JQuery & Script Dinamis --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var initialBidang = $('#bidang_id').val();
        var initialKategori = "{{ $arsip_dokumen->kategori_id }}";
        var initialRuangan = $('#ruangan_id').val();
        var initialLemari = "{{ $arsip_dokumen->lemari_id }}";
        var initialBox = "{{ $arsip_dokumen->box_id }}";

        // Saat halaman dimuat: ambil kategori berdasarkan bidang
        if (initialBidang) {
            $.ajax({
                url: '{{ url('pengelola/arsip_dokumen/getKategoriByBidang') }}/' + initialBidang,
                type: 'GET',
                success: function (data) {
                    $('#kategori_id').empty().append('<option value="">-- Pilih Kategori (Opsional) --</option>');
                    $.each(data, function (index, kategori) {
                        let selected = (kategori.kategori_id == initialKategori) ? 'selected' : '';
                        $('#kategori_id').append('<option value="' + kategori.kategori_id + '" ' + selected + '>' + kategori.nama_kategori + '</option>');
                    });
                }
            });
        }

        // Saat halaman dimuat: ambil lemari berdasarkan ruangan
        if (initialRuangan) {
            $.ajax({
                url: '{{ url('pengelola/arsip_dokumen/getLemariByRuangan') }}/' + initialRuangan,
                type: 'GET',
                success: function (data) {
                    $('#lemari_id').empty().append('<option value="">-- Pilih Lemari --</option>');
                    $.each(data, function (index, lemari) {
                        let selected = (lemari.lemari_id == initialLemari) ? 'selected' : '';
                        $('#lemari_id').append('<option value="' + lemari.lemari_id + '" ' + selected + '>' + lemari.nama_lemari + '</option>');
                    });

                    // Setelah lemari terisi, ambil box-nya
                    if (initialLemari) {
                        $.ajax({
                            url: '{{ url('pengelola/arsip_dokumen/getBoxByLemari') }}/' + initialLemari,
                            type: 'GET',
                            success: function (data) {
                                $('#box_id').empty().append('<option value="">-- Pilih Box --</option>');
                                $.each(data, function (index, box) {
                                    let selected = (box.box_id == initialBox) ? 'selected' : '';
                                    $('#box_id').append('<option value="' + box.box_id + '" ' + selected + '>' + box.nama_box + '</option>');
                                });
                            }
                        });
                    }
                }
            });
        }

        // Event change bidang_id → ambil kategori
        $('#bidang_id').change(function () {
            var bidang_id = $(this).val();
            if (bidang_id) {
                $.ajax({
                    url: '{{ url('pengelola/arsip_dokumen/getKategoriByBidang') }}/' + bidang_id,
                    type: 'GET',
                    success: function (data) {
                        $('#kategori_id').empty().append('<option value="">-- Pilih Kategori (Opsional) --</option>');
                        $.each(data, function (index, kategori) {
                            $('#kategori_id').append('<option value="' + kategori.kategori_id + '">' + kategori.nama_kategori + '</option>');
                        });
                    }
                });
            } else {
                $('#kategori_id').empty().append('<option value="">-- Pilih Kategori (Opsional) --</option>');
            }
        });

        // Event change ruangan_id → ambil lemari
        $('#ruangan_id').change(function () {
            var ruangan_id = $(this).val();
            if (ruangan_id) {
                $.ajax({
                    url: '{{ url('pengelola/arsip_dokumen/getLemariByRuangan') }}/' + ruangan_id,
                    type: 'GET',
                    success: function (data) {
                        $('#lemari_id').empty().append('<option value="">-- Pilih Lemari --</option>');
                        $('#box_id').empty().append('<option value="">-- Pilih Box --</option>');
                        $.each(data, function (index, lemari) {
                            $('#lemari_id').append('<option value="' + lemari.lemari_id + '">' + lemari.nama_lemari + '</option>');
                        });
                    }
                });
            } else {
                $('#lemari_id').empty().append('<option value="">-- Pilih Lemari --</option>');
                $('#box_id').empty().append('<option value="">-- Pilih Box --</option>');
            }
        });

        // Event change lemari_id → ambil box
        $('#lemari_id').change(function () {
            var lemari_id = $(this).val();
            if (lemari_id) {
                $.ajax({
                    url: '{{ url('pengelola/arsip_dokumen/getBoxByLemari') }}/' + lemari_id,
                    type: 'GET',
                    success: function (data) {
                        $('#box_id').empty().append('<option value="">-- Pilih Box --</option>');
                        $.each(data, function (index, box) {
                            $('#box_id').append('<option value="' + box.box_id + '">' + box.nama_box + '</option>');
                        });
                    }
                });
            } else {
                $('#box_id').empty().append('<option value="">-- Pilih Box --</option>');
            }
        });
    });
</script>


@endsection
