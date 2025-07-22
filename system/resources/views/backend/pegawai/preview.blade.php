@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-dark">
                    <h5 class="mb-0"><i class=""></i>Pratinjau Data Pegawai yang Akan Diimpor</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('pegawai.import.save') }}" method="POST">
                        @csrf

                        <div class="table-responsive border rounded shadow-sm">
                            <table class="table table-bordered mb-0" id="previewTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        @foreach ($rows[0] as $key => $val)
                                            <th>{{ $key }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $index => $row)
                                        @php
                                            $duplikat = false;
                                            if (($row['Status Kepegawaian'] ?? '') === 'ASN' && isset($row['NIP'])) {
                                                $duplikat = \App\Models\Pegawai::where('nip', $row['NIP'])->exists();
                                            } elseif (($row['Status Kepegawaian'] ?? '') === 'Honor' && isset($row['NIK'])) {
                                                $duplikat = \App\Models\Pegawai::where('nik', $row['NIK'])->exists();
                                            }
                                        @endphp
                                        <tr @if ($duplikat) class="table-danger" @endif>
                                            <td>{{ $loop->iteration }}</td>
                                            @foreach ($row as $key => $val)
                                                <td>
                                                    {{ $val }}
                                                    @if (
                                                        ($key === 'NIP' && $row['Status Kepegawaian'] === 'ASN' && $duplikat) ||
                                                        ($key === 'NIK' && $row['Status Kepegawaian'] === 'Honor' && $duplikat)
                                                    )
                                                        <i class="fas fa-exclamation-circle text-danger ms-1"
                                                            data-bs-toggle="tooltip"
                                                            title="{{ $key }} sudah ada, tidak bisa diimpor."></i>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <input type="hidden" name="data" value="{{ json_encode($rows) }}">

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('pegawai.import.form') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
