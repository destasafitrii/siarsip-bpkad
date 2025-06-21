@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Manajemen Ruangan</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h4 class="card-title">Daftar Ruangan</h4>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRuanganModal">Tambah Ruangan</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Ruangan</th>
                                            <th>Nama Ruangan</th>
                                            <th>Alamat</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($ruangan as $r)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $r->kode_ruangan }}</td>
                                                <td>{{ $r->nama_ruangan }}</td>
                                                <td>{{ $r->alamat ?? '-' }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($r->keterangan, 30, '...') }}</td>
                                                <td>
                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#detailRuanganModal{{ $r->ruangan_id }}">
                                                        Detail
                                                    </button>

                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#editRuanganModal{{ $r->ruangan_id }}">Edit</button>

                                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#hapusRuanganModal{{ $r->ruangan_id }}"
                                                        title="Hapus">
                                                        <i class="fas fa-trash-alt" style="font-size: 13px"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal Detail -->
                                            <div class="modal fade" id="detailRuanganModal{{ $r->ruangan_id }}"
                                                tabindex="-1" aria-labelledby="detailRuanganModalLabel{{ $r->ruangan_id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="detailRuanganModalLabel{{ $r->ruangan_id }}">Detail Ruangan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div style="border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                                <strong>Kode Ruangan:</strong><br> {{ $r->kode_ruangan }}
                                                            </div>
                                                            <div style="border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                                <strong>Nama Ruangan:</strong><br> {{ $r->nama_ruangan }}
                                                            </div>
                                                            <div style="border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                                <strong>Alamat:</strong><br> {{ $r->alamat }}
                                                            </div>
                                                            <div style="border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                                <strong>Keterangan:</strong><br> {{ $r->keterangan }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editRuanganModal{{ $r->ruangan_id }}"
                                                tabindex="-1" aria-labelledby="editRuanganModalLabel{{ $r->ruangan_id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editRuanganModalLabel{{ $r->ruangan_id }}">Edit Ruangan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('ruangan.update', $r->ruangan_id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Kode Ruangan</label>
                                                                    <input type="text" class="form-control" name="kode_ruangan" value="{{ $r->kode_ruangan }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Nama Ruangan</label>
                                                                    <input type="text" class="form-control" name="nama_ruangan" value="{{ $r->nama_ruangan }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Alamat</label>
                                                                    <input type="text" class="form-control" name="alamat" value="{{ $r->alamat }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Keterangan</label>
                                                                    <textarea class="form-control" name="keterangan">{{ $r->keterangan }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Hapus -->
                                            <div class="modal fade" id="hapusRuanganModal{{ $r->ruangan_id }}" tabindex="-1"
                                                aria-labelledby="hapusRuanganModalLabel{{ $r->ruangan_id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="hapusRuanganModalLabel{{ $r->ruangan_id }}">Konfirmasi Hapus</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('ruangan.destroy', $r->ruangan_id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus ruangan <strong>{{ $r->nama_ruangan }}</strong>?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data ruangan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addRuanganModal" tabindex="-1" aria-labelledby="addRuanganModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRuanganModalLabel">Tambah Ruangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('ruangan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Kode Ruangan</label>
                            <input type="text" class="form-control" name="kode_ruangan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Ruangan</label>
                            <input type="text" class="form-control" name="nama_ruangan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
