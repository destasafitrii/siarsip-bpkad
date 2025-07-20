@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Card untuk Preview Data -->
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Pratinjau Data Arsip Surat Masuk yang Akan Diimpor</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('arsip_masuk.import.save') }}" method="POST">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="previewTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th>No</th>
                                                @foreach (array_keys($rows[0]) as $key)
                                                    @if ($key !== 'Status Nomor Surat' && $key !== 'Status')
                                                        <th>{{ $key }}</th>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rows as $index => $row)
                                                @if (!empty(array_filter($row)))
                                                    <tr data-index="{{ $index }}"
                                                        @if (isset($row['Status']) && strtolower($row['Status']) === 'tidak dapat diimpor (nomor duplikat)') class="table-danger" @endif>
                                                        <td>{{ $loop->iteration }}</td>
                                                        @foreach ($row as $key => $val)
                                                            @if ($key === 'Nomor Surat')
                                                                <td>
                                                                    {{ $val }}
                                                                    @if (isset($row['Status']) && strtolower($row['Status']) === 'tidak dapat diimpor (nomor duplikat)')
                                                                        <i class="fas fa-exclamation-circle text-danger ms-1"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="right"
                                                                            title="Nomor surat ini sudah ada, tidak bisa disimpan."></i>
                                                                    @endif
                                                                </td>
                                                            @elseif ($key !== 'Status Nomor Surat' && $key !== 'Status')
                                                                <td>
                                                                    {{ $val instanceof \DateTimeInterface ? $val->format('Y-m-d') : $val }}
                                                                </td>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <input type="hidden" name="data" value="{{ json_encode($rows) }}">

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Simpan
                                    </button>
                                    <a href="{{ route('arsip_masuk.import.form') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-1"></i> Kembali
                                    </a>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- end container-fluid -->
    </div> <!-- end page-content -->
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#previewTable').DataTable({
            paging: true,
            ordering: true,
            info: true
        });

        // Tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Aktifkan menu sidebar
        let currentUrl = window.location.href;
        document.querySelectorAll('.left-menu a').forEach(function (link) {
            if (link.href === currentUrl) {
                let parent = link.closest('ul.sub-menu');
                if (parent) {
                    parent.style.display = 'block';
                    let mainMenu = parent.closest('li');
                    if (mainMenu) {
                        mainMenu.classList.add('mm-active');
                    }
                }
            }
        });
    });
</script>
@endpush
