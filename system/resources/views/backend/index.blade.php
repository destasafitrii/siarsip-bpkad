@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    {{-- <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="fs-16 fw-semibold mb-1 mb-md-2">Dashboard Arsip</h4>
                       
                    </div> --}}
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Dashboard Arsip</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="d-flex justify-content-between align-items-center shadow-lg p-3">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Jumlah Arsip Hari Ini</p>
                                            <h5 class="mb-0">{{ $arsipHarian }}</h5>
                                        </div>
                                        <div class="text-success">
                                            <i class="mdi mdi-file-document"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="d-flex justify-content-between align-items-center shadow-lg p-3">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Jumlah Arsip Minggu Ini</p>
                                            <h5 class="mb-0">{{ $arsipMingguan }}</h5>
                                        </div>
                                        <div class="text-primary">
                                            <i class="mdi mdi-calendar-week"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="d-flex justify-content-between align-items-center shadow-lg p-3">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Jumlah Arsip Bulan Ini</p>
                                            <h5 class="mb-0">{{ $arsipBulanan }}</h5>
                                        </div>
                                        <div class="text-warning">
                                            <i class="mdi mdi-calendar-month"></i>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">

{{-- <h5 class="mb-3">Statistik Surat Masuk</h5>
<div class="row">
    <div class="col-sm-4">
        <div class="d-flex justify-content-between align-items-center shadow-lg p-3">
            <div>
                <p class="text-muted text-truncate mb-2">Hari Ini</p>
                <h5 class="mb-0">{{ $arsipMasukHarian }}</h5>
            </div>
            <div class="text-primary">
                <i class="mdi mdi-email-open-outline mdi-36px"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="d-flex justify-content-between align-items-center shadow-lg p-3">
            <div>
                <p class="text-muted text-truncate mb-2">Bulan Ini</p>
                <h5 class="mb-0">{{ $arsipMasukBulanan }}</h5>
            </div>
            <div class="text-info">
                <i class="mdi mdi-calendar-month-outline mdi-36px"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="d-flex justify-content-between align-items-center shadow-lg p-3">
            <div>
                <p class="text-muted text-truncate mb-2">Total Seluruh</p>
                <h5 class="mb-0">{{ $arsipMasukTotal }}</h5>
            </div>
            <div class="text-success">
                <i class="mdi mdi-database mdi-36px"></i>
            </div>
        </div>
    </div>
</div>

<h5 class="mt-5 mb-3">Statistik Surat Keluar</h5>
<div class="row">
    <div class="col-sm-4">
        <div class="d-flex justify-content-between align-items-center shadow-lg p-3">
            <div>
                <p class="text-muted text-truncate mb-2">Hari Ini</p>
                <h5 class="mb-0">{{ $arsipKeluarHarian }}</h5>
            </div>
            <div class="text-danger">
                <i class="mdi mdi-email-send-outline mdi-36px"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="d-flex justify-content-between align-items-center shadow-lg p-3">
            <div>
                <p class="text-muted text-truncate mb-2">Bulan Ini</p>
                <h5 class="mb-0">{{ $arsipKeluarBulanan }}</h5>
            </div>
            <div class="text-warning">
                <i class="mdi mdi-calendar-month-outline mdi-36px"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="d-flex justify-content-between align-items-center shadow-lg p-3">
            <div>
                <p class="text-muted text-truncate mb-2">Total Seluruh</p>
                <h5 class="mb-0">{{ $arsipKeluarTotal }}</h5>
            </div>
            <div class="text-success">
                <i class="mdi mdi-database mdi-36px"></i>
            </div>
        </div>
    </div>
</div> --}}

                                


                            </div>
                            <div id="arsip_chart" data-colors='["--bs-primary", "--bs-success", "--bs-warning"]'
                                class="apex-charts" dir="ltr"></div>
                            @push('scripts')
                                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        var options = {
                                            chart: {
                                                type: 'bar',
                                                height: 350
                                            },
                                            series: [{
                                                    name: 'Surat Masuk',
                                                    data: {!! json_encode(array_column($chartData, 'masuk')) !!}
                                                },
                                                {
                                                    name: 'Surat Keluar',
                                                    data: {!! json_encode(array_column($chartData, 'keluar')) !!}
                                                }
                                            ],
                                            xaxis: {
                                                categories: {!! json_encode(array_column($chartData, 'bulan')) !!}
                                            },
                                            colors: ['#0d6efd', '#198754']
                                        };

                                        var chart = new ApexCharts(document.querySelector("#arsip_chart"), options);
                                        chart.render();
                                    });
                                </script>
                            @endpush

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
