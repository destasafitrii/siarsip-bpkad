@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">
                                @isset($arsip_surat_keluar)
                                    Edit Arsip Surat Keluar
                                @else
                                    Tambah Arsip Surat Keluar
                                @endisset
                            </h4>
                            <a href="{{ route('arsip_keluar.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <form
                                action="{{ isset($arsip_surat_keluar) ? route('arsip_keluar.update', $arsip_surat_keluar->surat_keluar_id) : route('arsip_keluar.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($arsip_surat_keluar))
                                    @method('PUT')
                                @endif

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
                                            <input type="text" class="form-control" id="no_surat_keluar"
                                                name="no_surat_keluar" placeholder="Masukkan nomor surat" required
                                                value="{{ old('no_surat_keluar', $arsip_surat_keluar->no_surat_keluar ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_surat_keluar" class="form-label">Nama Surat</label>
                                            <input type="text" class="form-control" id="nama_surat_keluar"
                                                name="nama_surat_keluar" placeholder="Masukkan nama surat" required
                                                value="{{ old('nama_surat_keluar', $arsip_surat_keluar->nama_surat_keluar ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_surat_keluar" class="form-label">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal_surat_keluar"
                                                name="tanggal_surat_keluar" required
                                                value="{{ old('tanggal_surat_keluar', $arsip_surat_keluar->tanggal_surat_keluar ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="bidang_id" class="form-label">Bidang</label>
                                            <select name="bidang_id" id="bidang_id" class="form-control" required>
                                                <option value="">-- Pilih Bidang --</option>
                                                @foreach ($list_bidang as $bidang)
                                                    <option value="{{ $bidang->bidang_id }}"
                                                        {{ old('bidang_id', $arsip_surat_keluar->bidang_id) == $bidang->bidang_id ? 'selected' : '' }}>
                                                        {{ $bidang->nama_bidang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="mb-3">
                                            <label for="kategori_id" class="form-label">Kategori</label>
                                            <select name="kategori_id" id="kategori_id" class="form-control" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($list_kategori as $kategori)
                                                    <option value="{{ $kategori->kategori_id }}"
                                                        {{ old('kategori_id', $arsip_surat_keluar->kategori_id) == $kategori->kategori_id ? 'selected' : '' }}>
                                                        {{ $kategori->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tujuan_surat_keluar" class="form-label">Tujuan Surat</label>
                                            <input type="text" class="form-control" id="tujuan_surat_keluar"
                                                name="tujuan_surat_keluar" placeholder="Masukkan tujuan surat" required
                                                value="{{ old('tujuan_surat_keluar', $arsip_surat_keluar->tujuan_surat_keluar ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="no_berkas_surat_keluar" class="form-label">Nomor Berkas</label>
                                            <input type="text" class="form-control" id="no_berkas_surat_keluar"
                                                name="no_berkas_surat_keluar" placeholder="Masukkan nomor berkas" required
                                                value="{{ old('no_berkas_surat_keluar', $arsip_surat_keluar->no_berkas_surat_keluar ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="urutan_surat_keluar" class="form-label">Urutan</label>
                                            <input type="text" class="form-control" id="urutan_surat_keluar"
                                                name="urutan_surat_keluar" placeholder="Masukkan urutan" required
                                                value="{{ old('urutan_surat_keluar', $arsip_surat_keluar->urutan_surat_keluar ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="lokasi_surat_keluar" class="form-label">Lokasi</label>
                                            <input type="text" class="form-control" id="lokasi_surat_keluar"
                                                name="lokasi_surat_keluar" placeholder="Masukkan lokasi" required
                                                value="{{ old('lokasi_surat_keluar', $arsip_surat_keluar->lokasi_surat_keluar ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="keterangan_surat_keluar" class="form-label">Keterangan</label>
                                            <input type="text" class="form-control" id="keterangan_surat_keluar"
                                                name="keterangan_surat_keluar" placeholder="Masukkan lokasi" required
                                                value="{{ old('keterangan_surat_keluar', $arsip_surat_keluar->keterangan_surat_keluar ?? '') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="file_surat_masuk" class="form-label">Unggah File</label>
                                            <input type="file" class="form-control" id="file_surat_masuk"
                                                name="file_surat_masuk" accept=".pdf,.">
                                            <small class="text-muted">Maksimal ukuran file 1MB. Format yang diperbolehkan:
                                                PDF.</small>
                                        </div>
                                    
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    @isset($arsip_surat_keluar)
                                        Simpan Perubahan
                                    @else
                                        Simpan
                                    @endisset
                                </button>
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
            $('#bidang_id').on('change', function() {
                var bidangId = $(this).val();

                // Pastikan bidangId memiliki nilai
                if (bidangId) {
                    $.ajax({
                        url: '/siarsip/arsip_masuk/getKategoriByBidang/' + bidangId,
                        type: 'GET',
                        success: function(data) {
                            $('#kategori_id').empty(); // Kosongkan dropdown kategori
                            $('#kategori_id').append(
                                '<option value="">-- Pilih Kategori --</option>');

                            if (data.length > 0) {
                                $.each(data, function(index, kategori) {
                                    $('#kategori_id').append('<option value="' +
                                        kategori.kategori_id + '">' + kategori
                                        .nama_kategori + '</option>');
                                });
                            } else {
                                $('#kategori_id').append(
                                    '<option value="">Tidak ada kategori untuk bidang ini</option>'
                                );
                            }
                        },
                        error: function(xhr) {
                            console.error('Error:', xhr.status);
                        }
                    });

                } else {
                    $('#kategori_id').empty();
                    $('#kategori_id').append('<option value="">-- Pilih Kategori --</option>');
                }
            });
        });
    </script>

@endsection
