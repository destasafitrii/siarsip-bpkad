@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class=""></i>Import Arsip Surat Masuk</h5>
                    <a href="{{ asset('public/template/arsip_surat_masuk_template.xlsx') }}" target="_blank"
                        class="btn btn-primary btn-sm d-flex align-items-center">
                        <i class="fas fa-file-excel me-1"></i> Download Template Excel
                    </a>
                </div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('arsip_masuk.import.preview') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="file" class="fw-semibold">Pilih File Excel</label>
                            <input type="file" name="file" class="form-control" accept=".xlsx,.xls" required>
                            <small class="form-text text-muted">Maksimal ukuran file 3MB. Format: .xlsx atau .xls</small>
                        </div>
                        <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-eye me-1"></i> Preview Data
                            </button>
                            <a href="{{ route('arsip_masuk.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
