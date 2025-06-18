@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Data Arsip Seluruh OPD</h4>
                </div>
                <div class="card-body">
                    <!-- Filter -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label for="filter_opd" class="form-label">Filter OPD</label>
                            <select id="filter_opd" class="form-select">
                                <option value="">-- Semua OPD --</option>
                                @foreach ($opds as $opd)
                                    <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filter_jenis" class="form-label">Jenis Arsip</label>
                            <select id="filter_jenis" class="form-select">
                                <option value="">Semua Jenis</option>
                                <option value="masuk">Surat Masuk</option>
                                <option value="keluar">Surat Keluar</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filter_bidang" class="form-label">Bidang</label>
                            <select id="filter_bidang" class="form-select">
                                <option value="">Semua Bidang</option>
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->bidang_id }}">{{ $bidang->nama_bidang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filter_kategori" class="form-label">Kategori Arsip</label>
                            <select id="filter_kategori" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->kategori_id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <div class="d-flex w-100">
                                <button id="btn_filter" class="btn btn-primary w-100 me-2">Terapkan Filter</button>
                                <button id="btn_reset" class="btn btn-secondary w-100">Reset</button>
                            </div>
                        </div>
                    </div>


                    <!-- Table -->
                    <div class="table-responsive">
                        <table id="arsip-opd-table" class="table table-bordered table-striped table-hover nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Surat</th>
                                    <th>Nama Surat</th>
                                    <th>Bidang</th>
                                    <th>Kategori</th>
                                    <th>Ruangan</th>
                                    <th>Lemari</th>
                                    <th>Box</th>
                                    <th>Urutan</th>
                                    <th>Tanggal Surat</th>
                                    <th>Asal Surat</th>
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const table = $('#arsip-opd-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('data_arsip.data') }}',
                    type: 'GET',
                    data: function(d) {
                        d.opd_id = $('#filter_opd').val();
                        d.jenis_arsip = $('#filter_jenis').val();
                        d.bidang_id = $('#filter_bidang').val();
                        d.kategori_id = $('#filter_kategori').val();
                    }
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'no_surat',
                        name: 'no_surat'
                    },
                    {
                        data: 'nama_surat',
                        name: 'nama_surat'
                    },
                    {
                        data: 'bidang',
                        name: 'bidang'
                    },
                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'ruangan',
                        name: 'ruangan'
                    },
                    {
                        data: 'lemari',
                        name: 'lemari'
                    },
                    {
                        data: 'box',
                        name: 'box'
                    },
                    {
                        data: 'urutan',
                        name: 'urutan'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'asal',
                        name: 'asal'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],

                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json' // Bahasa Indonesia (opsional)
                }
            });

            $('#btn_filter').click(function() {
                table.ajax.reload();
            });

            $('#btn_reset').click(function() {
                $('#filter_opd').val('');
                $('#filter_jenis').val('');
                $('#filter_bidang').val('');
                $('#filter_kategori').val('');
                table.ajax.reload();
            });
        });
    </script>
@endsection
