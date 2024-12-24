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
                            <form action="{{ route('arsip_masuk.update', $arsip_surat_masuk->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="no_surat_masuk" class="form-label">Nomor Surat</label>
                                    <input type="text" class="form-control" id="no_surat_masuk" name="no_surat_masuk" value="{{ $arsip_surat_masuk->no_surat_masuk }}" placeholder="Masukkan nomor surat" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bidang_id" class="form-label">Bidang</label>
                                    <select class="form-control" id="bidang_id" name="bidang_id" required>
                                        <option value="">-- Pilih Bidang --</option>
                                        @foreach($bidang as $b)
                                            <option value="{{ $b->id }}" {{ $b->id == $arsip_surat_masuk->bidang_id ? 'selected' : '' }}>
                                                {{ $b->nama_bidang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kategori_id" class="form-label">Kategori</label>
                                    <select class="form-control" id="kategori_id" name="kategori_id" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($kategori as $k)
                                            <option value="{{ $k->id }}" {{ $k->id == $arsip_surat_masuk->kategori_id ? 'selected' : '' }}>
                                                {{ $k->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
