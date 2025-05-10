@extends('template.admin')

@section('content')
<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data Arsip yang Telah Diimpor</h4>
            <a href="{{ route('import.form') }}" class="btn btn-primary btn-sm d-flex align-items-center">
              <i class="fas fa-plus me-1"></i> <span>Import Data Baru</span>
            </a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="arsip_table" class="table table-bordered table-striped table-hover w-100" style="font-size: 12px;">
                <thead>
                  <tr>
                    <th style="width: 40px;">No</th>
                    <th style="min-width: 200px;">Uraian Informasi</th>
                    <th style="min-width: 120px;">Nomor Surat</th>
                    <th style="min-width: 100px;">Tanggal</th>
                    <th style="min-width: 150px;">Tujuan/Dari</th>
                    <th style="min-width: 80px;">No Berkas</th>
                    <th style="min-width: 60px;">Urutan</th>
                    <th style="min-width: 50px;">Lokasi</th>
                    <th style="min-width: 150px;">Keterangan</th>
                    <th style="min-width: 60px;">Tahun</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function () {
    $('#arsip_table').DataTable({
      processing: true,
      serverSide: true,
      scrollX: true,
      autoWidth: false,
      ajax: "{{ route('import.index') }}",
      columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'uraian_informasi_arsip', name: 'uraian_informasi_arsip' },
        { data: 'nomor_surat', name: 'nomor_surat' },
        { data: 'tanggal', name: 'tanggal' },
        { data: 'tujuan_atau_dari', name: 'tujuan_atau_dari' },
        { data: 'no_berkas', name: 'no_berkas' },
        { data: 'urutan', name: 'urutan' },
        { data: 'lokasi', name: 'lokasi' },
        { data: 'keterangan', name: 'keterangan' },
        { data: 'tahun', name: 'tahun' },
      ],
      createdRow: function (row, data, dataIndex) {
        // Atur font-size semua cell ke 12px
        $('td', row).css('font-size', '12px');
      }
    });
  });
</script>
@endsection
