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
                                <div class="mb-3">
                                    <label for="no_surat_keluar" class="form-label">Nomor Surat</label>
                                    <input type="text" class="form-control" id="no_surat_keluar" name="no_surat_keluar" placeholder="Masukkan nomor surat" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_surat_keluar" class="form-label">Nama Surat</label>
                                    <input type="text" class="form-control" id="nama_surat_keluar" name="nama_surat_keluar" placeholder="Masukkan nama surat" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_surat_keluar" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal_surat_keluar" name="tanggal_surat_keluar" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bidang" class="form-label">Bidang</label>
                                    <input type="text" class="form-control" id="bidang" name="bidang" placeholder="Masukkan bidang" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_arsip" class="form-label">Jenis Arsip</label>
                                    <input type="text" class="form-control" id="jenis_arsip" name="jenis_arsip" placeholder="Masukkan jenis arsip" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tujuan_surat_keluar" class="form-label">Tujuan Surat</label>
                                    <input type="text" class="form-control" id="tujuan_surat_keluar" name="tujuan_surat_keluar" placeholder="Masukkan tujuan surat" required>
                                </div>
                                <div class="mb-3">
                                    <label for="no_berkas_surat_keluar" class="form-label">Nomor Berkas</label>
                                    <input type="text" class="form-control" id="no_berkas_surat_keluar" name="no_berkas_surat_keluar" placeholder="Masukkan nomor berkas" required>
                                </div>
                                <div class="mb-3">
                                    <label for="urutan_surat_keluar" class="form-label">Urutan</label>
                                    <input type="text" class="form-control" id="urutan_surat_keluar" name="urutan_surat_keluar" placeholder="Masukkan urutan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lokasi_surat_keluar" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control" id="lokasi_surat_keluar" name="lokasi_surat_keluar" placeholder="Masukkan lokasi" required>
                                </div>

                                <div class="mb-3">
                                    <label for="file_surat_keluar" class="form-label">Unggah File</label>
                                    <input type="file" class="form-control" id="file_surat_keluar" name="file_surat_keluar">
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan keterangan"></textarea>
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
