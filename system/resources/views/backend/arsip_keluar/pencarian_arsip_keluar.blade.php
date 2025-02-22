@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Pencarian Arsip Surat Keluar -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Pencarian Arsip Surat Keluar</h4>
                        </div>
                        <div class="card-body">
                            <!-- Filter Form -->
                            <form method="GET" action="{{ route('pencarian-arsip-keluar') }}" class="d-flex mb-3">
                                <input type="text" name="keyword" class="form-control me-2"
                                    placeholder="Cari berdasarkan No. Surat, Nama Surat, atau Tujuan Surat"
                                    value="{{ request('keyword') }}">

                                <!-- Filter Bidang -->
                                <select name="bidang_id" class="form-control me-2" id="bidang_id">
                                    <option value="">Pilih Bidang</option>
                                    @foreach ($bidangs as $bidang)
                                        <option value="{{ $bidang->bidang_id }}"
                                            {{ request('bidang_id') == $bidang->bidang_id ? 'selected' : '' }}>
                                            {{ $bidang->nama_bidang }}</option>
                                    @endforeach
                                </select>

                                <!-- Filter Kategori -->
                                <select name="kategori_id" class="form-control me-2" id="kategori_id">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->kategori_id }}"
                                            {{ request('kategori_id') == $kategori->kategori_id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>

                                <!-- Filter Tanggal Surat -->
                                <input type="date" name="tanggal_surat_keluar" class="form-control me-2"
                                    value="{{ request('tanggal_surat_keluar') }}">


                                <button class="btn btn-primary" type="submit">Cari</button>
                            </form>

                            @if ($ArsipSuratKeluar->count() > 0)
                                <table id="arsip_surat_keluar"
                                    class="table table-hover table-bordered table-striped dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No. Surat</th>
                                            <th>Nama Surat</th>
                                            <th>Tanggal Surat</th>
                                            <th>Tujuan Surat</th>
                                            <th>Bidang</th>
                                            <th>Kategori</th>
                                            <th>No Berkas</th>
                                            <th>Urutan</th>
                                            <th>Lokasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ArsipSuratKeluar as $index => $arsip)
                                            <tr>
                                                <td>{{ $ArsipSuratKeluar->firstItem() + $index }}</td>
                                                <td>{{ $arsip->no_surat_keluar }}</td>
                                                <td>{{ $arsip->nama_surat_keluar }}</td>
                                                <td>{{ $arsip->tanggal_surat_keluar }}</td>
                                                <td>{{ $arsip->tujuan_surat_keluar }}</td>
                                                <td>{{ $arsip->bidang ? $arsip->bidang->nama_bidang : 'Tidak ada bidang' }}
                                                </td>
                                                <td>{{ $arsip->kategori ? $arsip->kategori->nama_kategori : 'Tidak ada kategori' }}
                                                </td>
                                                <td>{{ $arsip->no_berkas_surat_keluar }}</td>
                                                <td>{{ $arsip->urutan_surat_keluar }}</td>
                                                <td>{{ $arsip->lokasi_surat_keluar }}</td>
                                                <td>
                                                    <a href="{{ route('arsip_keluar.show', $arsip->surat_keluar_id) }}"
                                                        class="btn btn-info btn-sm">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination Bootstrap -->
                                <div class="d-flex justify-content-center my-3">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <!-- Previous Page Link -->
                                            @if ($ArsipSuratKeluar->onFirstPage())
                                                <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $ArsipSuratKeluar->previousPageUrl() }}">Previous</a></li>
                                            @endif

                                            <!-- Page Number Links -->
                                            @foreach ($ArsipSuratKeluar->getUrlRange(1, $ArsipSuratKeluar->lastPage()) as $page => $url)
                                                <li
                                                    class="page-item {{ $page == $ArsipSuratKeluar->currentPage() ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endforeach

                                            <!-- Next Page Link -->
                                            @if ($ArsipSuratKeluar->hasMorePages())
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $ArsipSuratKeluar->nextPageUrl() }}">Next</a></li>
                                            @else
                                                <li class="page-item disabled"><span class="page-link">Next</span></li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            @else
                                <div class="alert alert-warning">Data tidak ditemukan.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('bidang_id').addEventListener('change', function() {
            var bidangId = this.value;
            var kategoriSelect = document.getElementById('kategori_id');

            // Hapus semua opsi kategori
            kategoriSelect.innerHTML = '<option value="">Pilih Kategori</option>';

            if (bidangId) {
                // Request untuk mendapatkan kategori berdasarkan bidang yang dipilih
                fetch(`/siarsip/kategoris/bidang/${bidangId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.kategoris.forEach(kategori => {
                            var option = document.createElement('option');
                            option.value = kategori.id;
                            option.textContent = kategori.nama_kategori;
                            kategoriSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching categories:', error);
                    });
            }
        });
    </script>
@endsection
