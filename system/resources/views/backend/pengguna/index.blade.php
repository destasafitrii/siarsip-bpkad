@extends('template.admin') 

@section('content')
<div class="page-content">
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Pengguna</h4>
            <a href="{{ route('pengguna.create') }}" class="btn btn-primary btn-sm float-end">Tambah Pengguna</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengguna as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->email }}</td>
                        <td>{{ $p->role }}</td>
                        <td>
                            <a href="{{ route('pengguna.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pengguna.destroy', $p->id) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus data ini?')" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
    });
</script>
@endsection

