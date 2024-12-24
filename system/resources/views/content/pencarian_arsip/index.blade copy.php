@extends('template.admin')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="card-title">Pencarian Arsip</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <form action="{{ url('/') }}" method="GET">
                                    <div class="mb-3">
                                        <label for="keyword" class="form-label">Kata Kunci</label>
                                        <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Masukkan kata kunci pencarian" value="{{ request('keyword') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_arsip" class="form-label">Jenis Arsip</label>
                                        <select class="form-control" id="jenis_arsip" name="jenis_arsip">
                                            <option value="">Pilih Jenis Arsip</option>
                                            <option value="masuk" {{ request('jenis_arsip') == 'masuk' ? 'selected' : '' }}>Arsip Masuk</option>
                                            <option value="keluar" {{ request('jenis_arsip') == 'keluar' ? 'selected' : '' }}>Arsip Keluar</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </form>    
                            </div>
                        </div>

                        <!-- Tabel Arsip hanya muncul jika ada hasil pencarian -->
                        @if($arsip->isNotEmpty())
                        <div class="row mt-4">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No Surat</th>
                                            <th>Nama Surat</th>
                                            <th>Tanggal Surat</th>
                                            <th>Asal/Tujuan Surat</th>
                                            <th>Nomor Berkas</th>
                                            <th>Urutan</th>
                                            <th>Lokasi</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($arsip as $item)
                                        <tr>
                                            <td>{{ $item->no_surat_masuk ?? $item->no_surat_keluar }}</td>
                                            <td>{{ $item->nama_surat_masuk ?? $item->nama_surat_keluar }}</td>
                                            <td>{{ $item->tanggal_surat_masuk ?? $item->tanggal_surat_keluar }}</td>
                                            <td>{{ $item->asal_surat_masuk ?? $item->tujuan_surat_keluar }}</td>
                                            <td>{{ $item->no_berkas_surat_masuk ?? $item->no_berkas_surat_keluar }}</td>
                                            <td>{{ $item->urutan_surat_masuk ?? $item->urutan_surat_keluar }}</td>
                                            <td>{{ $item->lokasi_surat_masuk ?? $item->lokasi_surat_keluar }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $arsip->links() }}
                            </div>
                        </div>
                        @else
                            <div class="row mt-4">
                                <div class="col-12">
                                    <p>Tidak ada arsip yang ditemukan.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>
@endsection
