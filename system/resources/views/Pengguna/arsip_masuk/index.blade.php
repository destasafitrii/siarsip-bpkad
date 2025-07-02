@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data Arsip Surat Masuk</h4>
                        </div>
                        <div class="card-body">
                            <!-- Filter Section -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="bidang_filter" class="form-label">Filter Bidang</label>
                                    <select id="bidang_filter" class="form-select">
                                        <option value="">Semua Bidang</option>
                                        @foreach ($bidangs as $bidang)
                                            <option value="{{ $bidang->bidang_id }}">{{ $bidang->nama_bidang }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-md-4">
                                    <label for="kategori_filter" class="form-label">Filter Kategori</label>
                                    <select id="kategori_filter" class="form-select">
                                        <option value="">Semua Kategori</option>
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->kategori_id }}">{{ $kategori->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-md-4 d-flex align-items-end">
                                    <button id="filter_button" class="btn btn-primary">Filter</button>
                                    <button id="reset_filter" class="btn btn-secondary ms-2">Reset</button>
                                </div>
                            </div>

                            <!-- DataTable -->
                            <table id="arsip_surat_masuk"
                                class="table table-hover table-bordered table-striped dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>Nama Surat</th>
                                        <th>Bidang</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Diisi oleh DataTables -->
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
            const table = $('#arsip_surat_masuk').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('pengguna.arsip_masuk.index') }}", // ROUTE untuk pengguna
                    data: function(d) {
                        d.bidang_id = $('#bidang_filter').val();
                        d.kategori_id = $('#kategori_filter').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'no_surat_masuk',
                        name: 'no_surat_masuk'
                    },
                    {
                        data: 'nama_surat_masuk',
                        name: 'nama_surat_masuk'
                    },
                    {
                        data: 'bidang_id',
                        name: 'bidang.nama_bidang'
                    },
                    {
                        data: 'kategori_id',
                        name: 'kategori.nama_kategori'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                responsive: true,
                language: {
                    paginate: {
                        previous: "<i class='fas fa-chevron-left'></i>",
                        next: "<i class='fas fa-chevron-right'></i>"
                    }
                }
            });



            // Ketika bidang berubah
            $('#bidang_filter').on('change', function() {
                const bidang_id = $(this).val();
                $('#kategori_filter').html('<option value="">Semua Kategori</option>');

                if (bidang_id) {
                    const url = "{{ url('pengguna/arsip-masuk/get-kategori-by-bidang') }}/" + bidang_id;

                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(i, kategori) {
                                $('#kategori_filter').append('<option value="' +
                                    kategori.kategori_id + '">' + kategori
                                    .nama_kategori + '</option>');
                            });
                        },
                        error: function() {
                            alert('Gagal memuat kategori.');
                        }
                    });
                }
            });

            // Filter dan reset
            $('#filter_button').click(function() {
                table.ajax.reload();
            });

            $('#reset_filter').click(function() {
                $('#bidang_filter').val('');
                $('#kategori_filter').val('');
                table.ajax.reload();
            });
        });
    </script>
@endsection
