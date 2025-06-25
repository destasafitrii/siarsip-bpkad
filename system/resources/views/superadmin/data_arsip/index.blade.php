@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <h4>Data Arsip Seluruh OPD</h4>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered" id="arsip-table">
                        <thead>
                            <tr>
                                <th>Jenis Arsip</th>
                                <th>No Surat / Dokumen</th>
                                <th>Nama Surat / Dokumen</th>
                                <th>OPD</th>
                                <th>Bidang</th>
                                <th>Kategori</th>
                                <th>Ruangan</th>
                                <th>Lemari</th>
                                <th>Box</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            $(function() {
                $('#arsip-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('data_arsip.data') }}',
                    columns: [{
                            data: 'jenis',
                            name: 'jenis'
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
                            data: 'opd',
                            name: 'opd'
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
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'aksi',
                            name: 'aksi',
                            orderable: false,
                            searchable: false
                        } // <-- Tambahkan ini
                    ]

                });
            });
        </script>
    @endpush
