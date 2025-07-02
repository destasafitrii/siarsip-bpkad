@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data Arsip Dokumen - Semua OPD</h4>
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
                            <table id="arsip_dokumen_table"
                                   class="table table-hover table-bordered table-striped dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>OPD</th>
                                        <th>No Dokumen</th>
                                        <th>Nama Dokumen</th>
                                        <th>Bidang</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Diisi otomatis oleh DataTables -->
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
            var table = $('#arsip_dokumen_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('superadmin.arsip_dokumen.index') }}",
                    data: function(d) {
                        d.opd_id = $('#opd_filter').val();
                        d.bidang_id = $('#bidang_filter').val();
                        d.kategori_id = $('#kategori_filter').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'opd', name: 'opd' },
                    { data: 'no_dokumen', name: 'no_dokumen' },
                    { data: 'nama_dokumen', name: 'nama_dokumen' },
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

            // Filter bidang berdasarkan OPD
            $('#opd_filter').on('change', function() {
                const opd_id = $(this).val();
                $('#bidang_filter').html('<option value="">Semua Bidang</option>');
                $('#kategori_filter').html('<option value="">Semua Kategori</option>');
                if (opd_id) {
                    const url = "{{ route('superadmin.getBidangByOpdDokumen', ':id') }}".replace(':id', opd_id);
                    $.get(url, function(data) {
                        $.each(data, function(i, val) {
                            $('#bidang_filter').append('<option value="' + val.bidang_id + '">' + val.nama_bidang + '</option>');
                        });
                    });
                }
            });

            // Filter kategori berdasarkan bidang
            $('#bidang_filter').on('change', function() {
                const bidang_id = $(this).val();
                $('#kategori_filter').html('<option value="">Semua Kategori</option>');
                if (bidang_id) {
                    const url = "{{ route('superadmin.getKategoriByBidangDokumen', ':id') }}".replace(':id', bidang_id);
                    $.get(url, function(data) {
                        $.each(data, function(i, val) {
                            $('#kategori_filter').append('<option value="' + val.kategori_id + '">' + val.nama_kategori + '</option>');
                        });
                    });
                }
            });

            // Filter DataTable
            $('#filter_button').on('click', function() {
                table.ajax.reload();
            });

            // Reset filter
            $('#reset_filter').on('click', function() {
                $('#opd_filter').val('');
                $('#bidang_filter').html('<option value="">Semua Bidang</option>');
                $('#kategori_filter').html('<option value="">Semua Kategori</option>');
                table.ajax.reload();
            });
        });
    </script>
@endsection
