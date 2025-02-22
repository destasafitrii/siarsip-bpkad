{{-- @extends('template.admin')

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
                                                    <label for="nama_surat" class="form-label">Nama Surat</label>
                                                    <input type="text" class="form-control" id="nama_surat" name="nama_surat"
                                                        placeholder="Masukkan Nama Surat" value="{{ request('nama_surat') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="tanggal" class="form-label">Tanggal</label>
                                                    <input type="date" class="form-control" id="tanggal"
                                                        name="tanggal" value="{{ request('tanggal') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="jenis_arsip" class="form-label">Jenis Arsip</label>
                                                    <select name="jenis_arsip" id="jenis_arsip" class="form-control">
                                                        <option value="">Semua Jenis</option>
                                                        <option value="masuk" {{ request('jenis_arsip') == 'masuk' ? 'selected' : '' }}>Surat Masuk</option>
                                                        <option value="keluar" {{ request('jenis_arsip') == 'keluar' ? 'selected' : '' }}>Surat Keluar</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="bidang" class="form-label">Bidang</label>
                                                    <select name="bidang" class="form-control">
                                                        <option value="">Semua Bidang</option>
                                                        @foreach ($list_bidang as $bidang)
                                                            <option value="{{ $bidang->bidang_id }}" 
                                                                {{ old('bidang', request('bidang')) == $bidang->bidang_id ? 'selected' : '' }}>{{ $bidang->nama_bidang }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="no_surat" class="form-label">Nomor Surat</label>
                                                    <input type="text" class="form-control" id="no_surat" name="no_surat"
                                                        placeholder="Masukkan nomor surat" value="{{ request('no_surat') }}">
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
                                    <!-- Arsip Surat Masuk -->
                                    @if ($arsip_surat_masuk->isNotEmpty())
                                        <h5>Arsip Surat Masuk</h5>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No Surat</th>
                                                    <th>Nama Surat</th>
                                                    <th>Tanggal</th>
                                                    <th>Bidang</th>
                                                    <th>Kategori</th>
                                                    <th>Asal Surat</th>
                                                    <th>No Berkas</th>
                                                    <th>Urutan</th>
                                                    <th>Lokasi</th>
                                                    <th>Keterangan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($arsip_surat_masuk as $arsip)
                                                    <tr>
                                                        <td>{{ $arsip->no_surat_masuk }}</td>
                                                        <td>{{ $arsip->nama_surat_masuk }}</td>
                                                        <td>{{ $arsip->tanggal_surat_masuk }}</td>
                                                        <td>{{ $arsip->bidang ? $arsip->bidang->nama_bidang : 'Tidak ada bidang' }}</td>
                                                        <td>{{ $arsip->kategori ? $arsip->kategori->nama_kategori : 'Tidak ada kategori' }}</td>
                                                        <td>{{ $arsip->asal_surat_masuk }}</td>
                                                        <td>{{ $arsip->no_berkas_surat_masuk }}</td>
                                                        <td>{{ $arsip->urutan_surat_masuk }}</td>
                                                        <td>{{ $arsip->lokasi_surat_masuk }}</td>
                                                        <td>{{ $arsip->keterangan }}</td>
                                                        <td>
                                                            <a href="{{ route('arsip_masuk.show', $arsip->surat_masuk_id) }}"
                                                                class="btn btn-primary btn-sm">Lihat</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $arsip_surat_masuk->links() }}
                                    @else
                                        <p class="text-muted">Tidak ada arsip surat masuk yang ditemukan.</p>
                                    @endif

                                    <!-- Arsip Surat Keluar -->
                                    @if ($arsip_surat_keluar->isNotEmpty())
                                        <h5>Arsip Surat Keluar</h5>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No Surat</th>
                                                    <th>Nama Surat</th>
                                                    <th>Tanggal</th>
                                                    <th>Bidang</th>
                                                    <th>Kategori</th>
                                                    <th>Tujuan Surat</th>
                                                    <th>No Berkas</th>
                                                    <th>Urutan</th>
                                                    <th>Lokasi</th>
                                                    <th>Keterangan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($arsip_surat_keluar as $arsip)
                                                    <tr>
                                                        <td>{{ $arsip->no_surat_keluar }}</td>
                                                        <td>{{ $arsip->nama_surat_keluar }}</td>
                                                        <td>{{ $arsip->tanggal_surat_keluar }}</td>
                                                        <td>{{ $arsip->bidang ? $arsip->bidang->nama_bidang : 'Tidak ada bidang' }}</td>
                                                        <td>{{ $arsip->kategori ? $arsip->kategori->nama_kategori : 'Tidak ada kategori' }}</td>
                                                        <td>{{ $arsip->tujuan_surat_keluar }}</td>
                                                        <td>{{ $arsip->no_berkas_surat_keluar }}</td>
                                                        <td>{{ $arsip->urutan_surat_keluar }}</td>
                                                        <td>{{ $arsip->lokasi_surat_keluar }}</td>
                                                        <td>{{ $arsip->keterangan }}</td>
                                                        <td>
                                                            <a href="{{ route('arsip_keluar.show', $arsip->surat_keluar_id) }}"
                                                                class="btn btn-primary btn-sm">Lihat</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $arsip_surat_keluar->links() }}
                                    @else
                                        <p class="text-muted">Tidak ada arsip surat keluar yang ditemukan.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
