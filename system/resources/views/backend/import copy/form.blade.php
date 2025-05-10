@extends('template.admin')

@section('content')
<div class="page-content">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title-box">
          <h4 class="page-title">Import Data Arsip</h4>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Form Import Arsip</h4>

            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif

            @if (session('error'))
              <div class="alert alert-danger">
                {{ session('error') }}
              </div>
            @endif

            <form action="{{ route('import.process') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="file" class="form-label">File Excel</label>
                <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" required>
                @error('file')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">
                  Format file harus .xlsx atau .xls (maksimal 2MB)
                </small>
              </div>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-upload"></i> Import
              </button>
              <a href="{{ route('import.index') }}" class="btn btn-secondary">
                <i class="fas fa-list"></i> Lihat Data
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection