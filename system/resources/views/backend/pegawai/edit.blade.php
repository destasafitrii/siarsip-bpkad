@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Pegawai</h4>
                    <a href="{{ route('pegawai.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Pegawai</label>
                            <input type="text" name="nama" class="form-control" value="{{ $pegawai->nama }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="status_kepegawaian" class="form-label">Status Kepegawaian</label>
                            <select name="status_kepegawaian" class="form-select" id="status_kepegawaian" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="ASN" {{ $pegawai->status_kepegawaian == 'ASN' ? 'selected' : '' }}>ASN</option>
                                <option value="Honor" {{ $pegawai->status_kepegawaian == 'Honor' ? 'selected' : '' }}>Honor</option>
                            </select>
                        </div>

                        <div class="mb-3" id="form_nip" style="display: none;">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" name="nip" id="nip" class="form-control" value="{{ $pegawai->nip }}">
                        </div>

                        <div class="mb-3" id="form_nik" style="display: none;">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" name="nik" id="nik" class="form-control" value="{{ $pegawai->nik }}">
                        </div>

                        <div class="mb-3" id="form_golongan">
                            <label for="golongan" class="form-label">Golongan</label>
                            <input type="text" name="golongan" id="golongan" class="form-control" value="{{ $pegawai->golongan }}">
                        </div>

                        <div class="mb-3" id="form_jabatan">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ $pegawai->jabatan }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleFields() {
            const status = document.getElementById('status_kepegawaian').value;
            const isAsn = status === 'ASN';

            document.getElementById('form_nip').style.display = isAsn ? 'block' : 'none';
            document.getElementById('form_nik').style.display = isAsn ? 'none' : 'block';
            document.getElementById('form_golongan').style.display = isAsn ? 'block' : 'none';
            document.getElementById('form_jabatan').style.display = isAsn ? 'block' : 'none';

            document.getElementById('nip').required = isAsn;
            document.getElementById('nik').required = !isAsn;
            document.getElementById('golongan').required = isAsn;
            document.getElementById('jabatan').required = isAsn;
        }

        document.addEventListener('DOMContentLoaded', function () {
            toggleFields();
            document.getElementById('status_kepegawaian').addEventListener('change', toggleFields);
        });
    </script>
@endpush
