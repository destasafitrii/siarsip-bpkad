@extends('template.admin')

@section('content')
<div class="page-content">
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Edit Pengguna</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('pengguna.update', $pengguna->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama:</label>
                    <input type="text" name="name" class="form-control" value="{{ $pengguna->name }}" required>
                </div>

                <div class="mb-3">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ $pengguna->email }}" required>
                </div>

                <div class="mb-3">
                    <label>Password Baru (Opsional):</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>

                <div class="mb-3">
                    <label>Konfirmasi Password Baru:</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
