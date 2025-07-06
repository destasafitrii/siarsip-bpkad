@extends('template.admin')

@section('content')
    <div class="page-content" style="background-color: #f0f4f8; min-height: 100vh;">
        <div class="container-fluid">

            {{-- Judul halaman --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fw-bold text-dark mb-0">Dashboard Pengelola OPD</h4>
                    </div>
                </div>
            </div>

            {{-- Statistik Arsip --}}
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow rounded-4 bg-success-subtle">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-dark mb-1">Jumlah Arsip Hari Ini</p>
                                <h4 class="fw-bold text-dark mb-0">{{ $arsipHarian }}</h4>
                            </div>
                            <div class="bg-success text-white rounded-circle p-3">
                                <i class="mdi mdi-file-document fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow rounded-4 bg-primary-subtle">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-dark mb-1">Jumlah Arsip Minggu Ini</p>
                                <h4 class="fw-bold text-dark mb-0">{{ $arsipMingguan }}</h4>
                            </div>
                            <div class="bg-primary text-white rounded-circle p-3">
                                <i class="mdi mdi-calendar-week fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow rounded-4 bg-warning-subtle">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-dark mb-1">Jumlah Arsip Bulan Ini</p>
                                <h4 class="fw-bold text-dark mb-0">{{ $arsipBulanan }}</h4>
                            </div>
                            <div class="bg-warning text-white rounded-circle p-3">
                                <i class="mdi mdi-calendar-month fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    {{-- Script Grafik --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var options = {
                    chart: {
                        type: 'bar',
                        height: 350,
                        toolbar: { show: false }
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
                    colors: ['#0d6efd', '#198754'],
                    plotOptions: {
                        bar: {
                            borderRadius: 6,
                            columnWidth: '45%'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        position: 'top'
                    }
                };

                var chart = new ApexCharts(document.querySelector("#arsip_chart"), options);
                chart.render();
            });
        </script>
    @endpush
@endsection
