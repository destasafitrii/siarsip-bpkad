@extends('template.admin')

@section('content')
<div class="page-content">
<div class="container-fluid">

    <h4 class="mb-4">Dashboard Super Admin</h4>

    {{-- CARD STATISTIK --}}
    <div class="row">
        <div class="col-md-3">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <h5 class="mb-2">Jumlah OPD</h5>
                    <h3>{{ $jumlahOpd }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stat bg-success text-white">
                <div class="card-body">
                    <h5 class="mb-2">Jumlah Pengelola</h5>
                    <h3>{{ $jumlahPengelola }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stat bg-info text-white">
                <div class="card-body">
                    <h5 class="mb-2">Arsip Masuk</h5>
                    <h3>{{ $totalArsipMasuk }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stat bg-warning text-white">
                <div class="card-body">
                    <h5 class="mb-2">Arsip Keluar</h5>
                    <h3>{{ $totalArsipKeluar }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL RINGKAS AKTIVITAS PER OPD --}}
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Aktivitas Arsip per OPD</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Nama OPD</th>
                        <th>Jumlah Arsip Masuk</th>
                        <th>Jumlah Arsip Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aktivitasPerOpd as $opd)
                        <tr>
                            <td>{{ $opd->nama_opd }}</td>
                            <td>{{ $opd->jumlah_masuk }}</td>
                            <td>{{ $opd->jumlah_keluar }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ARSIP TERBARU --}}
    {{-- <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Arsip Terbaru</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis Arsip</th>
                        <th>Nomor Surat</th>
                        <th>OPD</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arsipTerbaru as $arsip)
                        <tr>
                            <td>{{ $arsip->tanggal_surat }}</td>
                            <td>{{ $arsip->jenis }}</td>
                            <td>{{ $arsip->nomor_surat }}</td>
                            <td>{{ $arsip->opd->nama_opd ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}
    </div>

</div>
</div>
@endsection
