@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data Arsip Surat Keluar - Semua OPD</h4>
                        </div>
                        <div class="card-body">
                            <!-- Filter Section -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="opd_filter" class="form-label">Filter OPD</label>
                                    <select id="opd_filter" class="form-select">
                                        <option value="">Semua OPD</option>
                                        @foreach ($opds as $opd)
                                            <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="bidang_filter" class="form-label">Filter Bidang</label>
                                    <select id="bidang_filter" class="form-select">
                                        <option value="">Semua Bidang</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="kategori_filter" class="form-label">Filter Kategori</label>
                                    <select id="kategori_filter" class="form-select">
                                        <option value="">Semua Kategori</option>
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button id="filter_button" class="btn btn-primary">Filter</button>
                                    <button id="reset_filter" class="btn btn-secondary ms-2">Reset</button>
                                </div>
                            </div>

                            <!-- DataTable -->
                            <table id="arsip_surat_keluar" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>OPD</th>
                                        <th>Nomor Surat</th>
                                        <th>Nama Surat</th>
                                        <th>Bidang</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- DataTables akan mengisi -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var table = $('#arsip_surat_keluar').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('superadmin.arsip_keluar.index') }}",
                data: function(d) {
                    d.opd_id = $('#opd_filter').val();
                    d.bidang_id = $('#bidang_filter').val();
                    d.kategori_id = $('#kategori_filter').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'opd', name: 'opd' },
                { data: 'no_surat_keluar', name: 'no_surat_keluar' },
                { data: 'nama_surat_keluar', name: 'nama_surat_keluar' },
                { data: 'bidang_id', name: 'bidang.nama_bidang' },
                { data: 'kategori_id', name: 'kategori.nama_kategori' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            responsive: true,
            language: {
                paginate: {
                    previous: "<i class='fas fa-chevron-left'></i>",
                    next: "<i class='fas fa-chevron-right'></i>"
                }
            }
        });

        // Filter dinamis
        $('#opd_filter').on('change', function() {
            const opd_id = $(this).val();
            $('#bidang_filter').html('<option value="">Semua Bidang</option>');
            if (opd_id) {
                const url = "{{ route('superadmin.getBidangByOpd', ':id') }}".replace(':id', opd_id);
                $.get(url, function(data) {
                    if (data.length) {
                        data.forEach(function(b) {
                            $('#bidang_filter').append(`<option value="${b.bidang_id}">${b.nama_bidang}</option>`);
                        });
                    } else {
                        $('#bidang_filter').append('<option value="">Tidak ada bidang</option>');
                    }
                });
            }
        });

        $('#bidang_filter').on('change', function() {
            const bidang_id = $(this).val();
            $('#kategori_filter').html('<option value="">Semua Kategori</option>');
            if (bidang_id) {
                const url = "{{ route('superadmin.getKategoriByBidang', ':id') }}".replace(':id', bidang_id);
                $.get(url, function(data) {
                    if (data.length) {
                        data.forEach(function(k) {
                            $('#kategori_filter').append(`<option value="${k.kategori_id}">${k.nama_kategori}</option>`);
                        });
                    } else {
                        $('#kategori_filter').append('<option value="">Tidak ada kategori</option>');
                    }
                });
            }
        });

        $('#filter_button').click(function() {
            table.ajax.reload();
        });

        $('#reset_filter').click(function() {
            $('#opd_filter').val('');
            $('#bidang_filter').val('').html('<option value="">Semua Bidang</option>');
            $('#kategori_filter').val('').html('<option value="">Semua Kategori</option>');
            table.ajax.reload();
        });
    });
</script>
@endsection
