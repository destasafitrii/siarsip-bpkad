@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Data Pengguna</h4>
                    <button class="btn btn-primary btn-sm d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#createModal">
                        </i> <span>Tambah Pengguna</span>
                    </button>
                </div>
                <div class="card-body">
                    <table id="pengguna_table" class="table table-hover table-bordered table-striped dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP / NIK</th>
                                <th>Jabatan</th>
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
                                    <td>{{ $p->pegawai?->nip ?? ($p->pegawai?->nik ?? '-') }}</td>
                                    <td>{{ $p->pegawai?->jabatan ?? '-' }}</td>
                                    <td>{{ $p->email }}</td>
                                    <td>{{ $p->role }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#detailModal{{ $p->id }}"><i
                                                class="mdi mdi-eye-outline"></i></button>

                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $p->id }}"><i
                                                class="mdi mdi-pencil"></i></button>

                                        <button class="btn btn-danger btn-sm btn-hapus-pengguna" data-bs-toggle="modal"
                                            data-bs-target="#hapusModal" data-id="{{ $p->id }}"
                                            data-nama="{{ $p->name }}">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $p->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('pengguna.update', $p->id) }}">
                                                @csrf @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $p->id }}">Edit
                                                        Pengguna</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Nama</label>
                                                        <input type="text" name="name" value="{{ $p->name }}"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>NIP / NIK</label>
                                                    <input type="text"
                                                        value="{{ $p->pegawai?->nip ?? ($p->pegawai?->nik ?? '-') }}"
                                                        class="form-control" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Jabatan</label>
                                                        <input type="text" name="jabatan"
                                                            value="{{ $p->pegawai?->jabatan ?? '-' }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Email</label>
                                                        <input type="email" name="email" value="{{ $p->email }}"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Password (Kosongkan jika tidak diubah)</label>
                                                        <input type="password" name="password" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Konfirmasi Password</label>
                                                        <input type="password" name="password_confirmation"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Detail -->
                                <div class="modal fade" id="detailModal{{ $p->id }}" tabindex="-1"
                                    aria-labelledby="detailModalLabel{{ $p->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel{{ $p->id }}">Detail
                                                    Pengguna</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div style="border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                    <strong>Nama:</strong><br> {{ $p->name }}
                                                </div>
                                                <div style="border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                    <strong>NIP / NIK:</strong><br>
                                                    {{ $p->pegawai?->nip ?? ($p->pegawai?->nik ?? '-') }}
                                                </div>
                                                <div style="border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                    <strong>Jabatan:</strong><br> {{ $p->pegawai?->jabatan ?? '-' }}
                                                </div>
                                                <div style="border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                    <strong>Golongan:</strong><br> {{ $p->pegawai?->golongan ?? '-' }}
                                                </div>
                                                <div style="border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                    <strong>Email:</strong><br> {{ $p->email }}
                                                </div>
                                                <div style="border-bottom: 1px solid #ccc; padding: 8px 0;">
                                                    <strong>Role:</strong><br> {{ ucfirst($p->role) }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

  <div class="modal fade" id="hapusModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" id="formHapusPengguna" class="modal-content">
      @csrf
      @method('DELETE')
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus akun <strong id="namaPenggunaHapus"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
    </form>
  </div>
</div>


    <!-- Modal Tambah Pengguna -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('pengguna.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="pegawai_id" id="pegawai_id">
                        <div class="mb-3">
                            <label>NIP / NIK</label>
                            <input type="text" name="nip" id="nip" class="form-control" placeholder="Masukkan NIP / NIK" required>
                            <input type="hidden" name="nik" id="nik">
                        </div>
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name" id="nama" class="form-control" placeholder="Nama akan terisi otomatis setelah NIP/NIK diinput" readonly required>
                        </div>
                        <div class="mb-3">
                            <label>Golongan</label>
                            <input type="text" name="golongan" id="golongan" class="form-control" placeholder="Golongan terisi otomatis dari NIP" readonly>
                        </div>
                        <div class="mb-3">
                            <label>Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Jabatan terisi otomatis dari NIP" readonly required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password Minimal 8 Karakter" required>
                        </div>
                        <div class="mb-3">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Masukkan Konfirmasi Password" required>
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
            $('#pengguna_table').DataTable({
                responsive: true,
                language: {
                    paginate: {
                        previous: "<i class='fas fa-chevron-left'></i>",
                        next: "<i class='fas fa-chevron-right'></i>"
                    }
                }
            });

            // Autocomplete data pegawai
            $(document).on('keyup', '#nip', function() {
                let nip = $(this).val();
                if (nip.length >= 5) {
                    $.ajax({
                        url: "{{ route('pengguna.getPegawaiByNipNik') }}",
                        type: 'GET',
                        data: {
                            nip: nip
                        },
                        success: function(data) {
                            $('#nama').val(data.nama);
                            $('#golongan').val(data.golongan);
                            $('#jabatan').val(data.jabatan);
                            $('#pegawai_id').val(data.pegawai_id);
                            $('#nik').val(data.nik);
                        },
                        error: function() {
                            $('#nama').val('');
                            $('#golongan').val('');
                            $('#jabatan').val('');
                            $('#pegawai_id').val('');
                        }
                    });
                } else {
                    $('#nama').val('');
                    $('#golongan').val('');
                    $('#jabatan').val('');
                    $('#pegawai_id').val('');
                }
            });

            // Modal hapus
            $(document).on('click', '.btn-hapus-pengguna', function() {
                const id = $(this).data('id');
                const nama = $(this).data('nama');
                const url = "{{ url('pengelola/pengguna') }}/" + id;

                $('#formHapusPengguna').attr('action', url);
                $('#namaPenggunaHapus').text(nama);
            });
        });
    </script>
@endsection
