@extends('template.admin')

@section('content')
<div class="page-content">
<div class="container-fluid">

    <h4 class="mb-4 fw-bold">Dashboard Super Admin</h4>

    {{-- CARD STATISTIK --}}
    <div class="row g-3">
        <div class="col-md-3">
            <div class="card mini-stat shadow-sm" style="background: #22accb; color: #fff;"> {{-- biru lembut --}}
                <div class="card-body">
                    <h6 class="mb-2">Jumlah OPD</h6>
                    <h3>{{ $jumlahOpd }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card mini-stat shadow-sm" style="background: #10b981; color: #fff;"> {{-- hijau emerald --}}
                <div class="card-body">
                    <h6 class="mb-2">Jumlah Arsip Surat Masuk</h6>
                    <h3>{{ $totalArsipMasuk }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card mini-stat shadow-sm" style="background: #22accb; color: #fff;"> {{-- orange golden --}}
                <div class="card-body">
                    <h6 class="mb-2">Jumlah Arsip Surat Keluar</h6>
                    <h3>{{ $totalArsipKeluar }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card mini-stat shadow-sm" style="background: #10b981; color: #fff;"> {{-- ungu indigo --}}
                <div class="card-body">
                    <h6 class="mb-2">Jumlah Arsip Dokumen</h6>
                    <h3>{{ $totalArsipDokumen }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL RINGKAS AKTIVITAS PER OPD --}}
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h5 class="card-title mb-0">Aktivitas Arsip per OPD</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Nama OPD</th>
                            <th>Jumlah Arsip Masuk</th>
                            <th>Jumlah Arsip Keluar</th>
                            <th>Jumlah Arsip Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aktivitasPerOpd as $opd)
                            <tr>
                                <td>{{ $opd->nama_opd }}</td>
                                <td class="text-center">{{ $opd->jumlah_masuk }}</td>
                                <td class="text-center">{{ $opd->jumlah_keluar }}</td>
                                <td class="text-center">{{ $opd->jumlah_dokumen }}</td>
                            </tr>
                        @endforeach
                        @if($aktivitasPerOpd->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada data OPD</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</div>
@endsection
