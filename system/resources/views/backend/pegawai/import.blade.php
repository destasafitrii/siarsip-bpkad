@extends('template.admin')

@section('content')
<div class="page-content">
    <div class="container">
        <div class="card">
            <div class="card-header"><h5>Import Data Pegawai</h5></div>
            <div class="card-body">
                <form action="{{ route('pegawai.import.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File Excel</label>
                        <input type="file" class="form-control" name="file" required>
                        <small class="text-muted">Format yang didukung: .xls, .xlsx (max 2MB)</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Import</button>
                    <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
