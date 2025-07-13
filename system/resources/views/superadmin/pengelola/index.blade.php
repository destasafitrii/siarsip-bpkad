@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Manajemen Pengelola OPD</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h4 class="card-title">Daftar Pengelola OPD</h4>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah
                                        Pengelola</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="pengelolaTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>NIP</th>
                                            <th>Jabatan</th>
                                            <th>OPD</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($admins as $admin)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->email }}</td>
                                                <td>{{ $admin->nip ?? '-' }}</td>
                                                <td>{{ $admin->jabatan ?? '-' }}</td>
                                                <td>{{ $admin->opd->nama_opd ?? '-' }}</td>
                                                <td>
                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#detailModal{{ $admin->id }}">
                                                        <i class="mdi mdi-eye-outline" style="font-size: 14px;"></i> 
                                                    </button>

                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $admin->id }}">
                                                        <i class="mdi mdi-pencil" style="font-size: 14px;"></i>
                                                    </button>

                                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#hapusPengelolaModal{{ $admin->id }}" title="Hapus">
                                                    <i class="mdi mdi-trash-can-outline" style="font-size: 14px;"></i>
                                                </button>
                                                </td>

                                            </tr>

                              <!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="hapusPengelolaModal{{ $admin->id }}" tabindex="-1"
    aria-labelledby="hapusPengelolaModalLabel{{ $admin->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusPengelolaModalLabel{{ $admin->id }}">
                    Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini
                <strong>{{ $admin->nama }}</strong>?
            </div>
            <div class="modal-footer">
                <form action="{{ route('pengelola.destroy', $admin->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editModal{{ $admin->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel{{ $admin->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="{{ route('pengelola.update', $admin->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Pengelola OPD</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Nama</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" value="{{ $admin->name }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Email</label>
                                                                            <input type="email" class="form-control"
                                                                                name="email" value="{{ $admin->email }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Password
                                                                                <small>(kosongkan jika tidak
                                                                                    diubah)</small></label>
                                                                            <input type="password" class="form-control"
                                                                                name="password">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Konfirmasi
                                                                                Password</label>
                                                                            <input type="password" class="form-control"
                                                                                name="password_confirmation">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">NIP</label>
                                                                            <input type="text" class="form-control"
                                                                                name="nip" value="{{ $admin->nip }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Jabatan</label>
                                                                            <input type="text" class="form-control"
                                                                                name="jabatan"
                                                                                value="{{ $admin->jabatan }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Golongan</label>
                                                                            <input type="text" class="form-control"
                                                                                name="golongan"
                                                                                value="{{ $admin->golongan }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">OPD</label>
                                                                            <select name="opd_id" class="form-control"
                                                                                required>
                                                                                @foreach (\App\Models\Opd::all() as $opd)
                                                                                    <option value="{{ $opd->id }}"
                                                                                        {{ $admin->opd_id == $opd->id ? 'selected' : '' }}>
                                                                                        {{ $opd->nama_opd }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Detail -->
                                            <div class="modal fade" id="detailModal{{ $admin->id }}" tabindex="-1"
                                                aria-labelledby="detailModalLabel{{ $admin->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Pengelola OPD</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-group">
                                                                <li class="list-group-item"><strong>Nama:</strong>
                                                                    {{ $admin->name }}</li>
                                                                <li class="list-group-item"><strong>Email:</strong>
                                                                    {{ $admin->email }}</li>
                                                                <li class="list-group-item"><strong>NIP:</strong>
                                                                    {{ $admin->nip ?? '-' }}</li>
                                                                <li class="list-group-item"><strong>Jabatan:</strong>
                                                                    {{ $admin->jabatan ?? '-' }}</li>
                                                                <li class="list-group-item"><strong>Golongan:</strong>
                                                                    {{ $admin->golongan ?? '-' }}</li>
                                                                <li class="list-group-item"><strong>OPD:</strong>
                                                                    {{ $admin->opd->nama_opd ?? '-' }}</li>
                                                                <li class="list-group-item"><strong>Role:</strong>
                                                                    {{ ucfirst($admin->role) }}</li>
                                                                <li class="list-group-item"><strong>Dibuat:</strong>
                                                                    {{ $admin->created_at->format('d-m-Y H:i') }}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada data pengelola.</td>
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
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- modal-lg agar cukup menampung 2 kolom -->
            <div class="modal-content">
                <form action="{{ route('pengelola.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pengelola OPD</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control" placeholder="Masukkan Nama" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="8 Karakter" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password"required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">NIP</label>
                                    <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control" placeholder="Masukkan Jabatan">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Golongan</label>
                                    <input type="text" name="golongan" class="form-control" placeholder="Masukkan Golongan">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">OPD</label>
                                    <select name="opd_id" class="form-control" required>
                                        <option value="">-- Pilih OPD --</option>
                                        @foreach (\App\Models\Opd::all() as $opd)
                                            <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#pengelolaTable').DataTable({
                responsive: true,
                language: {
                  search: "Cari:",
                  lengthMenu: "Show _MENU_ entries",
                  zeroRecords: "Data tidak ditemukan",
                  info: "Showing _START_ to _END_ of _TOTAL_ entries",
                  infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                  paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "<i class='fas fa-chevron-right'></i>",
                    previous: "<i class='fas fa-chevron-left'></i>"
                  },
                }
            });
        });
    </script>
@endsection
