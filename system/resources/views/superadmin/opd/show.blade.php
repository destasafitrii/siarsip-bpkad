@extends('template.admin')

@section('content')
<div class="page-content">
        <div class="card shadow rounded">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class=""></i> Detail {{ $opd->nama_opd }}</h4>
                <a href="{{ route('opd.index') }}" class="btn btn-secondary btn-sm">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 border-bottom pb-2">
                            <strong>Kode OPD</strong>
                            <p class="text-muted mb-0">{{ $opd->kode_opd }}</p>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <strong>Nama OPD</strong>
                            <p class="text-muted mb-0">{{ $opd->nama_opd }}</p>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <strong>Alamat</strong>
                            <p class="text-muted mb-0">{{ $opd->alamat ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3 border-bottom pb-2">
                            <strong>Email</strong>
                            <p class="text-muted mb-0">{{ $opd->surel ?? '-' }}</p>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <strong>Kepala Dinas</strong>
                            <p class="text-muted mb-0">{{ $opd->kepala_dinas ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Google Maps full width, tetap di bawah --}}
                <div class="mt-4">
                    <strong>Lokasi pada Google Maps</strong>
                    @if ($opd->maps)
                        <div class="ratio ratio-16x9 mt-2">
                            <iframe src="{{ $opd->maps }}" class="rounded" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    @else
                        <p class="text-muted mt-2">Tidak ada link maps</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
