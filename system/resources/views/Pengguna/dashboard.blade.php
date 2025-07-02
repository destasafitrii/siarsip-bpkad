@extends('template.admin')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h4 class="mb-2 fw-bold">Dashboard Pegawai OPD</h4>
        <p class="text-muted mb-4">Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Semoga harimu menyenangkan 😊</p>

        <div class="row">
            <!-- Arsip Surat Masuk -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                            <i class="fas fa-envelope-open-text fa-lg"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1 text-muted">Arsip Surat Masuk</h6>
                            <h3 class="mb-0 text-primary">{{ $jumlahSuratMasuk }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Arsip Surat Keluar -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                            <i class="fas fa-paper-plane fa-lg"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1 text-muted">Arsip Surat Keluar</h6>
                            <h3 class="mb-0 text-success">{{ $jumlahSuratKeluar }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Arsip Dokumen -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                            <i class="fas fa-file-alt fa-lg"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1 text-muted">Arsip Dokumen</h6>
                            <h3 class="mb-0 text-warning">{{ $jumlahDokumen }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Font Awesome CDN -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush
@endsection
