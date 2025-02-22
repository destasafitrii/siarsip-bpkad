@extends('template.admin')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="fs-16 fw-semibold mb-1 mb-md-2">Dashboard Arsip</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Statistik Arsip</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xxl-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Statistik Arsip</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="d-flex justify-content-between align-items-center shadow-lg p-3">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Arsip Hari Ini</p>
                                        {{-- <h5 class="mb-0">{{ $arsipHarian }}</h5> --}}
                                    </div>
                                    <div class="text-success">
                                        <i class="mdi mdi-file-document"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="d-flex justify-content-between align-items-center shadow-lg p-3">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Arsip Minggu Ini</p>
                                        {{-- <h5 class="mb-0">{{ $arsipMingguan }}</h5> --}}
                                    </div>
                                    <div class="text-primary">
                                        <i class="mdi mdi-calendar-week"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="d-flex justify-content-between align-items-center shadow-lg p-3">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Arsip Bulan Ini</p>
                                        {{-- <h5 class="mb-0">{{ $arsipBulanan }}</h5> --}}
                                    </div>
                                    <div class="text-warning">
                                        <i class="mdi mdi-calendar-month"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="arsip_chart" data-colors='["--bs-primary", "--bs-success", "--bs-warning"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
