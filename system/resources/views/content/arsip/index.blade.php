@extends('template.admin')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">CARI ARSIPAN</h4>
                    <div class="page-title-right">
                        {{-- <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Datatable</a></li>
                            <li class="breadcrumb-item active">Base</li>
                        </ol> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Filter Arsipan</h4>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('arsip.index') }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nama_arsip" class="form-label">Nama Arsip</label>
                                        <input type="text" id="nama_arsip" name="nama_arsip" class="form-control" value="{{ request('nama_arsip') }}" placeholder="Masukkan Nama Arsip">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                        <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" value="{{ request('nomor_surat') }}" placeholder="Masukkan Nomor Surat">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="bidang" class="form-label">Bidang</label>
                                        <select id="bidang" name="bidang" class="form-select" onchange="updateJenisArsip(this.value)">
                                            <option value="">Pilih Bidang</option>
                                            <option value="anggaran" {{ request('bidang') == 'anggaran' ? 'selected' : '' }}>Anggaran</option>
                                            <option value="pembendaharaan" {{ request('bidang') == 'pembendaharaan' ? 'selected' : '' }}>Pembendaharaan</option>
                                            <option value="akuntansi" {{ request('bidang') == 'akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                                            <option value="sekretariat" {{ request('bidang') == 'sekretariat' ? 'selected' : '' }}>Sekretariat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="jenis_arsip" class="form-label">Jenis Arsip</label>
                                        <select id="jenis_arsip" name="jenis_arsip" class="form-select">
                                            <option value="">Pilih Jenis Arsip</option>
                                            <option value="APBD" {{ request('jenis_arsip') == 'APBD' ? 'selected' : '' }}>APBD</option>
                                            <option value="SPD" {{ request('jenis_arsip') == 'SPD' ? 'selected' : '' }}>SPD</option>
                                            <option value="SP2D" {{ request('jenis_arsip') == 'SP2D' ? 'selected' : '' }}>SP2D</option>
                                            <option value="SPJ" {{ request('jenis_arsip') == 'SPJ' ? 'selected' : '' }}>SPJ</option>
                                            <option value="masuk" {{ request('jenis_arsip') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                                            <option value="keluar" {{ request('jenis_arsip') == 'keluar' ? 'selected' : '' }}>Keluar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="tujuan_dari" class="form-label">Tujuan/Dari</label>
                                        <input type="text" id="tujuan_dari" name="tujuan_dari" class="form-control" value="{{ request('tujuan_dari') }}" placeholder="Masukkan Tujuan/Dari">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="no_berkas" class="form-label">Nomor Berkas</label>
                                        <input type="text" id="no_berkas" name="no_berkas" class="form-control" value="{{ request('no_berkas') }}" placeholder="Masukkan Nomor Berkas">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                    <a href="{{ route('arsip.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Arsipan Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Arsipan</h4>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Arsip</th>
                                    <th>Nomor Surat</th>
                                    <th>Tanggal</th>
                                    <th>Bidang</th>
                                    <th>Jenis Arsip</th>
                                    <th>Tujuan/Dari</th>
                                    <th>Nomor Berkas</th>
                                    <th>Urutan</th>
                                    <th>Lokasi</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list_arsip as $arsip)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $arsip->nama_arsip }}</td>
                                    <td>{{ $arsip->nomor_surat }}</td>
                                    <td>{{ $arsip->tanggal }}</td>
                                    <td>{{ $arsip->bidang }}</td>
                                    <td>{{ $arsip->jenis_arsip }}</td>
                                    <td>{{ $arsip->tujuan_dari }}</td>
                                    <td>{{ $arsip->no_berkas }}</td>
                                    <td>{{ $arsip->urutan }}</td>
                                    <td>{{ $arsip->lokasi }}</td>
                                    <td>{{ $arsip->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('arsip.edit', $arsip->arsip_id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit" style ="font-size: 10px"></i>
                                        </a>
                                        <form action="{{ route('arsip.destroy', $arsip->arsip_id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus arsip ini?')">
                                                <i class="fas fa-trash-alt" style="font-size: 13px"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>

<script>
    function updateJenisArsip(bidang) {
        const jenisArsipSelect = document.getElementById('jenis_arsip');
        const options = {
            anggaran: ['APBD'],
            pembendaharaan: ['SPD', 'SP2D'],
            akuntansi: ['SPJ'],
            sekretariat: ['masuk', 'keluar']
        };

        // Menghapus semua opsi sebelumnya
        jenisArsipSelect.innerHTML = '<option value="">Pilih Jenis Arsip</option>';

        // Menambahkan opsi baru berdasarkan bidang yang dipilih
        options[bidang]?.forEach(function(jenis) {
            const option = document.createElement('option');
            option.value = jenis;
            option.textContent = jenis;
            jenisArsipSelect.appendChild(option);
        });
    }
</script>

@endsection
