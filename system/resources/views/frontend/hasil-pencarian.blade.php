@extends('template.frontend')

@section('content')
<section class="doc_banner_area search-banner-light" style="background-color: #002454; padding: 40px 0;">
    <div class="container">
        <div class="doc_banner_content text-center">
            <form action="{{ route('hasil-pencarian') }}" method="GET" class="header_search_form">
                <div class="search-container">
                    <!-- ROW 1: Pencarian Kata Kunci -->
                    <div class="row w-100 mb-2">
                        <div class="col-md-12">
                            <input type="text" name="search" placeholder="Masukan Kata Kunci..." class="form-control" value="{{ request('search') }}">
                        </div>
                    </div>

                    <!-- ROW 2: Filter Bidang, Kategori, dan Bulan/Tahun -->
                    <div class="row w-100">
                        <div class="col-md-4">
                            <select name="bidang_id" class="form-control" id="bidang_id">
                                <option value="">Pilih Bidang</option>
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->bidang_id }}" {{ request('bidang_id') == $bidang->bidang_id ? 'selected' : '' }}>
                                        {{ $bidang->nama_bidang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <select name="kategori_id" class="form-control" id="kategori_id">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->kategori_id }}" {{ request('kategori_id') == $kategori->kategori_id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="month" name="bulan_tahun" class="form-control" value="{{ request('bulan_tahun') }}">
                        </div>

                        <div class="col-md-1 text-center">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Section Hasil Pencarian -->
<section class="container py-4">
    @if (request('search') || request('bidang_id') || request('kategori_id') || request('bulan_tahun'))
        <p class="text-center text-muted">
            Menampilkan hasil pencarian untuk
            <strong>{{ request('search') ?: '' }}</strong>
            @if (request('bidang_id'))
                , Bidang:
                <strong>{{ $bidangs->find(request('bidang_id'))->nama_bidang ?? 'Bidang tidak ditemukan' }}</strong>
            @endif

            @if (request('kategori_id'))
                , Kategori:
                <strong>{{ $kategoris->find(request('kategori_id'))->nama_kategori ?? 'Kategori tidak ditemukan' }}</strong>
            @endif
            @if (request('bulan_tahun'))
                , Bulan/Tahun: <strong>{{ date('F Y', strtotime(request('bulan_tahun'))) }}</strong>
            @endif
        </p>
    @endif

    <div class="row">
        <!-- Hasil Pencarian Arsip Surat Masuk -->
        <div class="col-12">
            <h5 class="text-center" style="color:#002454;">Hasil Pencarian Arsip Surat Masuk</h5>
            @if ($ArsipSuratMasuk->isEmpty())
                <p class="text-muted text-center">Tidak ada arsip ditemukan.</p>
            @else
                <div class="list-group">
                    @foreach ($ArsipSuratMasuk as $item)
                        <a href="{{ route('arsip.masuk.show', ['id' => $item->surat_masuk_id]) }}"
                            class="list-group-item list-group-item-action shadow-sm mb-2">
                            <h6 class="mb-1">{{ $item->nama_surat_masuk }}</h6>
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                <small><strong>No Surat:</strong> {{ $item->no_surat_masuk }}</small>
                                <small><strong>No Berkas:</strong> {{ $item->no_berkas_surat_masuk }}</small>
                                <small><strong>Urutan:</strong> {{ $item->urutan_surat_masuk }}</small>
                                <small><strong>Lokasi:</strong> {{ $item->lokasi_surat_masuk }}</small>
                                <small><strong>Bidang:</strong>
                                    {{ $item->bidang_id ? $item->bidang->nama_bidang : '-' }}</small>
                                <small><strong>Kategori:</strong>
                                    {{ $item->kategori_id ? $item->kategori->nama_kategori : '-' }}</small>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $ArsipSuratMasuk->links() }}
                </div>
            @endif
        </div>

        <div class="col-12">
            <h5 class="text-center" style="color:#002454;">Hasil Pencarian Arsip Surat Keluar</h5>
            @if ($ArsipSuratKeluar->isEmpty())
                <p class="text-muted text-center">Tidak ada arsip ditemukan.</p>
            @else
                <div class="list-group">
                    @foreach ($ArsipSuratKeluar as $item)
                        <a href="{{ route('arsip.keluar.show', ['id' => $item->surat_keluar_id]) }}"
                            class="list-group-item list-group-item-action shadow-sm mb-2">
                            <h6 class="mb-1">{{ $item->nama_surat_keluar }}</h6>
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                <small><strong>No Surat:</strong> {{ $item->no_surat_keluar }}</small>
                                <small><strong>No Berkas:</strong> {{ $item->no_berkas_surat_keluar }}</small>
                                <small><strong>Urutan:</strong> {{ $item->urutan_surat_keluar }}</small>
                                <small><strong>Lokasi:</strong> {{ $item->lokasi_surat_keluar }}</small>
                                <small><strong>Bidang:</strong>
                                    {{ $item->bidang_id ? $item->bidang->nama_bidang : '-' }}</small>
                                <small><strong>Kategori:</strong>
                                    {{ $item->kategori_id ? $item->kategori->nama_kategori : '-' }}</small>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $ArsipSuratKeluar->links() }}
                </div>
            @endif
        </div>
    </div>
</section>

<style>
.search-container {
    width: 100%;
    max-width: 1000px;
    margin: auto;
    padding: 15px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.search-input, .custom-select, .custom-input {
    width: 100%;
    height: 45px;
    padding: 12px;
    border: 2px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    outline: none;
    transition: border-color 0.3s ease-in-out;
}

.custom-select {
    appearance: none;
    background: white url('data:image/svg+xml;utf8,<svg fill="black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20px" height="20px"><path d="M7 10l5 5 5-5z"/></svg>') no-repeat right 10px center;
    background-size: 16px;
    padding-right: 30px;
}

.search-input:focus, .custom-select:focus, .custom-input:focus {
    border-color: #007BFF;
}

.custom-btn {
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.custom-btn:hover {
    background-color: #0056b3;
}

/* Styling agar lebih responsif */
@media (max-width: 768px) {
    .search-container {
        padding: 10px;
    }

    .row .col-md-4, .row .col-md-3, .row .col-md-1 {
        margin-bottom: 10px;
    }
}
</style>
@endsection
