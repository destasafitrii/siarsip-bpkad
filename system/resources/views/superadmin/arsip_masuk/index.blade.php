@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data Arsip Surat Masuk - Semua OPD</h4>
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
                            <table id="arsip_surat_masuk"
                                class="table table-hover table-bordered table-striped dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>OPD</th>
                                        <th>Nomor Surat</th>
                                        <th>Nama Surat</th>
                                        <th>Bidang</th>
                                        <th>Kategori</th>
                                        {{-- <th>Ruangan</th>
                                        <th>Lemari</th>
                                        <th>Box</th>
                                        <th>Urutan</th>
                                        <th>Tanggal Surat</th>
                                        <th>Asal Surat</th> --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan diisi oleh DataTables secara otomatis -->
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
            // Debug: Pastikan jQuery dan elemen tersedia
            console.log('jQuery ready, checking elements...');
            console.log('OPD Filter element:', $('#opd_filter').length);
            console.log('Bidang Filter element:', $('#bidang_filter').length);

            // Inisialisasi DataTable
            var table = $('#arsip_surat_masuk').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('superadmin.arsip_masuk.index') }}",
                    data: function(d) {
                        d.opd_id = $('#opd_filter').val();
                        d.bidang_id = $('#bidang_filter').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'opd',
                        name: 'opd'
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
                    // {
                    //     data: 'box.lemari.ruangan.nama_ruangan',
                    //     name: 'box.lemari.ruangan.nama_ruangan',
                    //     defaultContent: '-'
                    // },
                    // {
                    //     data: 'box.lemari.nama_lemari',
                    //     name: 'box.lemari.nama_lemari',
                    //     defaultContent: '-'
                    // },
                    // {
                    //     data: 'box_id',
                    //     name: 'box.nama_box',
                    //     defaultContent: '-'
                    // },
                    // {
                    //     data: 'urutan_surat_masuk',
                    //     name: 'urutan_surat_masuk'
                    // },
                    // {
                    //     data: 'tanggal_surat_masuk',
                    //     name: 'tanggal_surat_masuk'
                    // },
                    // {
                    //     data: 'asal_surat_masuk',
                    //     name: 'asal_surat_masuk'
                    // },
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

            // Event handler untuk perubahan OPD dengan debug
            $('#opd_filter').on('change', function() {
                var opd_id = $(this).val();
                console.log('OPD changed to:', opd_id);

                // Reset dropdown bidang
                $('#bidang_filter').html('<option value="">Semua Bidang</option>');
                console.log('Bidang filter reset');

                // Ambil bidang berdasarkan OPD
                if (opd_id && opd_id !== '') {
                    console.log('Making AJAX request for OPD ID:', opd_id);

                    // Buat URL secara manual untuk debug
                    var url = "{{ route('superadmin.getBidangByOpd', ':id') }}".replace(':id', opd_id);

                    console.log('AJAX URL:', url);

                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "json",
                        beforeSend: function() {
                            console.log('AJAX request started...');
                        },
                        success: function(data) {
                            console.log('AJAX Success - Response data:', data);
                            console.log('Data length:', data.length);

                            if (data && data.length > 0) {
                                $.each(data, function(index, value) {
                                    console.log('Adding bidang:', value.nama_bidang);
                                    $('#bidang_filter').append(
                                        '<option value="' + value.bidang_id + '">' +
                                        value.nama_bidang + '</option>'
                                    );
                                });
                                console.log('All bidang options added');
                            } else {
                                console.log('No bidang data found for this OPD');
                                $('#bidang_filter').append(
                                    '<option value="">Tidak ada bidang</option>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', {
                                status: status,
                                error: error,
                                responseText: xhr.responseText,
                                statusCode: xhr.status
                            });

                            // Tampilkan error ke user
                            alert('Gagal memuat data bidang. Status: ' + xhr.status + ' - ' +
                                error);
                        }
                    });
                } else {
                    console.log('No OPD selected, skipping AJAX request');
                }
            });

            $('#bidang_filter').on('change', function() {
                const bidang_id = $(this).val();
                $('#kategori_filter').html('<option value="">Semua Kategori</option>');

                if (bidang_id) {
                    const url = "{{ route('superadmin.getKategoriByBidang', ':id') }}".replace(':id',
                        bidang_id);
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data.length > 0) {
                                $.each(data, function(i, kategori) {
                                    $('#kategori_filter').append('<option value="' +
                                        kategori.kategori_id + '">' + kategori
                                        .nama_kategori + '</option>');
                                });
                            } else {
                                $('#kategori_filter').append(
                                    '<option value="">Tidak ada kategori</option>');
                            }
                        },
                        error: function(xhr) {
                            alert('Gagal memuat data kategori. Status: ' + xhr.status);
                        }
                    });
                }
            });

            // Filter data ketika tombol filter diklik
            $('#filter_button').click(function() {
                console.log('Filter applied:', {
                    opd: $('#opd_filter').val(),
                    bidang: $('#bidang_filter').val()
                });
                table.ajax.reload();
            });

            // Reset filter
            $('#reset_filter').click(function() {
                console.log('Resetting filters...');
                $('#opd_filter').val('');
                $('#bidang_filter').val('').html('<option value="">Semua Bidang</option>');
                table.ajax.reload();
            });

            // Test manual untuk debugging
            window.testBidangAjax = function(opd_id) {
                console.log('Manual test for OPD ID:', opd_id);
                var url = "{{ url('') }}/master/arsip-masuk/get-bidang-by-opd/" + opd_id;

                $.get(url)
                    .done(function(data) {
                        console.log('Manual test success:', data);
                    })
                    .fail(function(xhr) {
                        console.error('Manual test failed:', xhr.responseText);
                    });
            };
        });
    </script>
@endsection