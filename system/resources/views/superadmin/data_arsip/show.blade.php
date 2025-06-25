@extends('template.admin')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="card-title mb-0">Detail Arsip Surat {{ ucfirst($jenis) }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>No Surat</th>
                        <td>{{ $jenis === 'masuk' ? $arsip->no_surat_masuk : $arsip->no_surat_keluar }}</td>
                    </tr>
                    <tr>
                        <th>Nama Surat</th>
                        <td>{{ $jenis === 'masuk' ? $arsip->nama_surat_masuk : $arsip->nama_surat_keluar }}</td>
                    </tr>
                    <tr>
                        <th>Bidang</th>
                        <td>{{ $arsip->bidang->nama_bidang ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $arsip->kategori->nama_kategori ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Surat</th>
                        <td>{{ $jenis === 'masuk' ? $arsip->tanggal_surat_masuk : $arsip->tanggal_surat_keluar }}</td>
                    </tr>
                    <tr>
                        <th>Asal Surat</th>
                        <td>{{ $jenis === 'masuk' ? $arsip->asal_surat_masuk : $arsip->asal_surat_keluar }}</td>
                    </tr>
                    <tr>
                        <th>Ruangan</th>
                        <td>{{ $arsip->box->lemari->ruangan->nama_ruangan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Lemari</th>
                        <td>{{ $arsip->box->lemari->nama_lemari ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Box</th>
                        <td>{{ $arsip->box->nama_box ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Urutan</th>
                        <td>{{ $jenis === 'masuk' ? $arsip->urutan_surat_masuk : $arsip->urutan_surat_keluar }}</td>
                    </tr>
                </table>
                <a href="{{ route('data_arsip.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
