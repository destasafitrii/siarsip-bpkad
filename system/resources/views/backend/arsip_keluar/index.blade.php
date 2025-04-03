@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Data Arsipan Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data Arsip Surat Keluar</h4>
                            <a href="{{ route('arsip_keluar.create') }}"
                                class="btn btn-primary btn-sm d-flex align-items-center" title="Tambah Data">
                                <i class="fas fa-plus me-1"></i> <span>Tambah Data</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="bidang_filter" class="form-label">Filter Bidang</label>
                                    <select id="bidang_filter" class="form-select">
                                        <option value="">Semua Bidang</option>
                                        @foreach($list_bidang as $bidang)
                                            <option value="{{ $bidang->bidang_id }}">{{ $bidang->nama_bidang }}</option>
                                        @endforeach
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

                            <table id="arsip_surat_keluar"
                                class="table table-hover table-bordered table-striped dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>Nama Surat</th>
                                        <th>Tanggal</th>
                                        <th>Bidang</th>
                                        <th>Jenis Arsip</th>
                                        <th>Tujuan Surat</th>
                                        <th>Nomor Berkas</th>
                                        <th>Urutan</th>
                                        <th>Lokasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan diisi oleh DataTables secara otomatis -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            var table = $('#arsip_surat_keluar').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('arsip_keluar.index') }}",
                    data: function (d) {
                        d.bidang_id = $('#bidang_filter').val();
                        d.kategori_id = $('#kategori_filter').val();
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'no_surat_keluar', name: 'no_surat_keluar'},
                    {data: 'nama_surat_keluar', name: 'nama_surat_keluar'},
                    {data: 'tanggal_surat_keluar', name: 'tanggal_surat_keluar'},
                    {data: 'bidang_id', name: 'bidang.nama_bidang'},
                    {data: 'kategori_id', name: 'kategori.nama_kategori'},
                    {data: 'tujuan_surat_keluar', name: 'tujuan_surat_keluar'},
                    {data: 'no_berkas_surat_keluar', name: 'no_berkas_surat_keluar'},
                    {data: 'urutan_surat_keluar', name: 'urutan_surat_keluar'},
                    {data: 'lokasi_surat_keluar', name: 'lokasi_surat_keluar'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                responsive: true,
                language: {
                    paginate: {
                        previous: "<i class='fas fa-chevron-left'></i>",
                        next: "<i class='fas fa-chevron-right'></i>"
                    }
                }
            });

            // Ketika bidang dipilih, ambil kategori terkait
            $('#bidang_filter').change(function() {
                var bidang_id = $(this).val();
                $('#kategori_filter').html('<option value="">Semua Kategori</option>');

                if (bidang_id) {
                    $.ajax({
                        url: "{{ route('getKategoriByBidang', '') }}/" + bidang_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $('#kategori_filter').append('<option value="'+ value.kategori_id +'">'+ value.nama_kategori +'</option>');
                            });
                        }
                    });
                }
            });

            // Filter data ketika tombol filter diklik
            $('#filter_button').click(function() {
                table.ajax.reload();
            });

            // Reset filter
            $('#reset_filter').click(function() {
                $('#bidang_filter').val('');
                $('#kategori_filter').val('').html('<option value="">Semua Kategori</option>');
                table.ajax.reload();
            });
        });
    </script>
@endsection