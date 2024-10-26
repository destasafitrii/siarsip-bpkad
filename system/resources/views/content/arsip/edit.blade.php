@extends('template.admin')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Arsip</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('arsip.index') }}">Data Arsipan</a></li>
                            <li class="breadcrumb-item active">Edit Arsip</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Edit Arsip</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('arsip.update', $arsip->arsip_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="nama_arsip" class="form-label">Nama Arsip</label>
                                <input type="text" name="nama_arsip" class="form-control" id="nama_arsip" value="{{ $arsip->nama_arsip }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                <input type="text" name="nomor_surat" class="form-control" id="nomor_surat" value="{{ $arsip->nomor_surat }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ $arsip->tanggal }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="bidang" class="form-label">Bidang</label>
                                <select class="form-control" id="bidang" name="bidang" required>
                                    <option value="">Pilih Bidang</option>
                                    <option value="anggaran" {{ $arsip->bidang == 'anggaran' ? 'selected' : '' }}>Anggaran</option>
                                    <option value="pembendaharaan" {{ $arsip->bidang == 'pembendaharaan' ? 'selected' : '' }}>Pembendaharaan</option>
                                    <option value="akuntansi" {{ $arsip->bidang == 'akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                                    <option value="sekretariat" {{ $arsip->bidang == 'sekretariat' ? 'selected' : '' }}>Sekretariat</option>
                                </select>
                            </div>                            

                            <div class="mb-3">
                                <label for="jenis_arsip" class="form-label">Jenis Arsip</label>
                                <select class="form-control" id="jenis_arsip" name="jenis_arsip" required>
                                    <option value="">Pilih Jenis Arsip</option>
                                    @if($arsip->bidang == 'anggaran')
                                        <option value="APBD" {{ $arsip->jenis_arsip == 'APBD' ? 'selected' : '' }}>APBD</option>
                                    @elseif($arsip->bidang == 'pembendaharaan')
                                        <option value="SPD" {{ $arsip->jenis_arsip == 'SPD' ? 'selected' : '' }}>SPD</option>
                                        <option value="SP2D" {{ $arsip->jenis_arsip == 'SP2D' ? 'selected' : '' }}>SP2D</option>
                                    @elseif($arsip->bidang == 'akuntansi')
                                        <option value="SPJ" {{ $arsip->jenis_arsip == 'SPJ' ? 'selected' : '' }}>SPJ</option>
                                    @elseif($arsip->bidang == 'sekretariat')
                                        <option value="masuk" {{ $arsip->jenis_arsip == 'masuk' ? 'selected' : '' }}>Masuk</option>
                                        <option value="keluar" {{ $arsip->jenis_arsip == 'keluar' ? 'selected' : '' }}>Keluar</option>
                                    @endif
                                </select>
                            </div>
                            
                            
                            <div class="mb-3">
                                <label for="tujuan_dari" class="form-label">Tujuan/Dari</label>
                                <input type="text" name="tujuan_dari" class="form-control" id="tujuan_dari" value="{{ $arsip->tujuan_dari }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="no_berkas" class="form-label">Nomor Berkas</label>
                                <input type="text" name="no_berkas" class="form-control" id="no_berkas" value="{{ $arsip->no_berkas }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="urutan" class="form-label">Urutan</label>
                                <input type="text" name="urutan" class="form-control" id="urutan" value="{{ $arsip->urutan }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" id="lokasi" value="{{ $arsip->lokasi }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="keterangan" rows="3">{{ $arsip->keterangan }}</textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('arsip.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const bidangSelect = document.getElementById('bidang');
        const jenisArsipSelect = document.getElementById('jenis_arsip');

        // Fungsi untuk mengisi jenis arsip sesuai bidang yang dipilih
        function updateJenisArsip() {
            const bidang = bidangSelect.value;
            const jenisOptions = {
                'anggaran': ['APBD'],
                'pembendaharaan': ['SPD', 'SP2D'],
                'akuntansi': ['SPJ'],
                'sekretariat': ['masuk', 'keluar'],
            };

            // Bersihkan opsi yang ada
            jenisArsipSelect.innerHTML = '<option value="">Pilih Jenis Arsip</option>';

            // Tambahkan opsi sesuai bidang
            if (jenisOptions[bidang]) {
                jenisOptions[bidang].forEach(function (jenis) {
                    const option = document.createElement('option');
                    option.value = jenis;
                    option.textContent = jenis;
                    if (jenis === '{{ $arsip->jenis_arsip }}') {
                        option.selected = true;
                    }
                    jenisArsipSelect.appendChild(option);
                });
            }
        }

        // Panggil fungsi saat halaman dimuat dan saat bidang berubah
        updateJenisArsip();
        bidangSelect.addEventListener('change', updateJenisArsip);
    });
</script>
