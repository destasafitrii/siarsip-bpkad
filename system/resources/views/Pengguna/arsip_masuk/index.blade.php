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
                                         <th>Tanggal</th>
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
            url: "{{ route('pengguna.arsip_masuk.index') }}",
            type: 'GET',
            data: function(d) {
                d.bidang_id = $('#bidang_filter').val();
                d.kategori_id = $('#kategori_filter').val();
            },
            error: function(xhr, error, thrown) {
                console.error('DataTables Ajax Error:', xhr.responseText);
                console.error('Error:', error);
                console.error('Thrown:', thrown);

                $('.dataTables_processing').hide();

                if (xhr.status === 404) {
                    toastr.error('Halaman tidak ditemukan');
                } else if (xhr.status === 500) {
                    toastr.error('Terjadi kesalahan server');
                } else if (xhr.status === 0) {
                    toastr.error('Tidak ada koneksi internet');
                } else {
                    toastr.error('Terjadi kesalahan saat memuat data');
                }
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '5%' },
            { data: 'no_surat_masuk', name: 'no_surat_masuk', width: '15%' },
            { data: 'nama_surat_masuk', name: 'nama_surat_masuk', width: '25%' },
            { data: 'bidang_id', name: 'bidang.nama_bidang', width: '15%' },
            { data: 'kategori_id', name: 'kategori.nama_kategori', width: '15%' },
            { data: 'tanggal_surat_masuk', name: 'tanggal_surat_masuk', width: '10%' },
            { data: 'action', name: 'action', orderable: false, searchable: false, width: '10%' }
        ],
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        order: [[1, 'desc']],
        language: {
            paginate: {
                previous: "<i class='fas fa-chevron-left'></i>",
                next: "<i class='fas fa-chevron-right'></i>"
            },
            emptyTable: "Tidak ada data surat masuk yang tersedia",
            zeroRecords: "Tidak ada data yang cocok dengan pencarian",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
            infoFiltered: "(difilter dari _MAX_ total entri)",
            lengthMenu: "Show _MENU_ entries",
            search: "Cari:",
            processing: "Memproses data...",
            loadingRecords: "Memuat data...",
            searchPlaceholder: ""
        },
        drawCallback: function(settings) {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });

    $('#bidang_filter').on('change', function() {
        const bidang_id = $(this).val();
        const kategori_select = $('#kategori_filter');

        kategori_select.html('<option value="">Semua Kategori</option>');

        if (bidang_id) {
            kategori_select.prop('disabled', true);
            kategori_select.html('<option value="">Memuat...</option>');

            const url = "{{ url('pengguna/arsip-masuk/get-kategori-by-bidang') }}/" + bidang_id;

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    kategori_select.html('<option value="">Semua Kategori</option>');

                    if (data && data.length > 0) {
                        $.each(data, function(i, kategori) {
                            kategori_select.append(
                                '<option value="' + kategori.kategori_id + '">' + 
                                kategori.nama_kategori + '</option>'
                            );
                        });
                    } else {
                        kategori_select.append('<option value="">Tidak ada kategori</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading categories:', error);
                    kategori_select.html('<option value="">Gagal memuat kategori</option>');
                    toastr.error('Gagal memuat kategori');
                },
                complete: function() {
                    kategori_select.prop('disabled', false);
                }
            });
        }
    });

    $('#filter_button').on('click', function() {
        table.ajax.reload(null, false);
    });

    $('#reset_filter').on('click', function() {
        $('#bidang_filter').val('').trigger('change');
        $('#kategori_filter').val('');
        table.ajax.reload();
    });

    $('#custom_search').on('keyup', function() {
        table.search(this.value).draw();
    });

    setInterval(function() {
        table.ajax.reload(null, false);
    }, 300000); // 5 menit
});
</script>

@endsection
