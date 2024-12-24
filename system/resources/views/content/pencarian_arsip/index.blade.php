@extends('template.admin')

<style>
    .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }

    .pagination .page-item {
        margin: 0 5px;
    }

    .pagination .page-link {
        padding: 8px 15px;
        border-radius: 5px;
        color: #38c66c;
        border: 1px solid #38c66c;
    }

    .pagination .page-item.active .page-link {
        background-color: #38c66c;
        color: white;
        border-color: #38c66c;
    }

    .pagination .page-item.disabled .page-link {
        color: #ccc;
        border-color: #ccc;
    }
</style>

@section('content')
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Pencarian Arsip</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="card-title">Pencarian Arsip</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('pencarian_arsip.index') }}" method="GET">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="keyword" class="form-label">Kata Kunci</label>
                                                    <input type="text" class="form-control" id="keyword" name="keyword"
                                                        placeholder="Masukkan kata kunci pencarian">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="tanggal" class="form-label">Tanggal</label>
                                                    <input type="date" class="form-control" id="tanggal"
                                                        name="tanggal">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="jenis_arsip" class="form-label">Jenis Arsip</label>
                                                    <select name="jenis_arsip" id="jenis_arsip" class="form-control">
                                                        <option value="">Semua Jenis</option>
                                                        <option value="masuk"
                                                            {{ request('jenis_arsip') == 'masuk' ? 'selected' : '' }}>Surat
                                                            Masuk</option>
                                                        <option value="keluar"
                                                            {{ request('jenis_arsip') == 'keluar' ? 'selected' : '' }}>Surat
                                                            Keluar</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="bidang" class="form-label">Bidang</label>
                                                    <select name="bidang" id="bidang" class="form-control">
                                                        <option value="">Semua Bidang</option>
                                                        <option value="bidang1"
                                                            {{ request('bidang') == 'bidang1' ? 'selected' : '' }}>Bidang 1</option>
                                                        <option value="bidang2"
                                                            {{ request('bidang') == 'bidang2' ? 'selected' : '' }}>Bidang 2</option>
                                                        <option value="bidang3"
                                                            {{ request('bidang') == 'bidang3' ? 'selected' : '' }}>Bidang 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="no_surat" class="form-label">Nomor Surat</label>
                                                    <input type="text" class="form-control" id="no_surat" name="no_surat"
                                                        placeholder="Masukkan nomor surat">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary">Cari Arsip</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="card-title">Hasil Pencarian Arsip</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <!-- Filtered Data: Hanya tampil jika ada pencarian -->
                                    @if (request('keyword') || request('tanggal') || request('jenis_arsip') || request('bidang') || request('no_surat'))
                                        @if (request('jenis_arsip') == 'masuk' || !request('jenis_arsip'))
                                            <h4 class="mb-3"
                                                style="
                                        text-align: center;
                                        padding-top: 10px;
                                    ">
                                                Hasil Arsip Surat Masuk</h4>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>No Surat</th>
                                                            <th>Nama Surat</th>
                                                            <th>Tanggal Surat</th>
                                                            <th>Asal Surat</th>
                                                            <th>Nomor Berkas</th>
                                                            <th>Urutan</th>
                                                            <th>Lokasi</th>
                                                            <th>Bidang</th>
                                                            <th>Keterangan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($arsip_surat_masuk as $ArsipSuratMasuk)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $ArsipSuratMasuk->no_surat_masuk }}</td>
                                                                <td>{{ $ArsipSuratMasuk->nama_surat_masuk }}</td>
                                                                <td>{{ $ArsipSuratMasuk->tanggal_surat_masuk }}</td>
                                                                <td>{{ $ArsipSuratMasuk->asal_surat_masuk }}</td>
                                                                <td>{{ $ArsipSuratMasuk->no_berkas_surat_masuk }}</td>
                                                                <td>{{ $ArsipSuratMasuk->urutan_surat_masuk }}</td>
                                                                <td>{{ $ArsipSuratMasuk->lokasi_surat_masuk }}</td>
                                                                <td>{{ $ArsipSuratMasuk->bidang }}</td>
                                                                <td>{{ $ArsipSuratMasuk->keterangan }}</td>
                                                                <td>
                                                                    <!-- Tambahkan aksi, jika diperlukan -->
                                                                    <a href="#" class="btn btn-sm btn-info">Detail</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    
                                                </table>
                                            </div>
                                            <div class="pagination justify-content-center">
                                                {{ $arsip_surat_masuk->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                                            </div>
                                        @endif

                                        @if (request('jenis_arsip') == 'keluar' || !request('jenis_arsip'))
                                            <h4 class="mt-4 mb-3"
                                                style="
                                        text-align: center;
                                        padding-top: 10px;
                                    ">
                                                Hasil Arsip Surat Keluar</h4>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>No Surat</th>
                                                            <th>Nama Surat</th>
                                                            <th>Tanggal Surat</th>
                                                            <th>Tujuan Surat</th>
                                                            <th>Nomor Berkas</th>
                                                            <th>Urutan</th>
                                                            <th>Lokasi</th>
                                                            <th>Bidang</th>
                                                            <th>Keterangan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($arsip_surat_keluar as $ArsipSuratKeluar)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $ArsipSuratKeluar->no_surat_keluar }}</td>
                                                                <td>{{ $ArsipSuratKeluar->nama_surat_keluar }}</td>
                                                                <td>{{ $ArsipSuratKeluar->tanggal_surat_keluar }}</td>
                                                                <td>{{ $ArsipSuratKeluar->tujuan_surat_keluar }}</td>
                                                                <td>{{ $ArsipSuratKeluar->no_berkas_surat_keluar }}</td>
                                                                <td>{{ $ArsipSuratKeluar->urutan_surat_keluar }}</td>
                                                                <td>{{ $ArsipSuratKeluar->lokasi_surat_keluar }}</td>
                                                                <td>{{ $ArsipSuratKeluar->bidang }}</td>
                                                                <td>{{ $ArsipSuratKeluar->keterangan }}</td>
                                                                <td>
                                                                    <!-- Tambahkan aksi, jika diperlukan -->
                                                                    <a href="#" class="btn btn-sm btn-info">Detail</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    
                                                </table>
                                            </div>
                                            <div class="pagination justify-content-center">
                                                {{ $arsip_surat_keluar->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                                            </div>
                                        @endif
                                    @else
                                        <p class="text-muted">Silakan masukkan kata kunci, tanggal, jenis arsip, bidang, atau nomor surat untuk
                                            mencari arsip.</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
