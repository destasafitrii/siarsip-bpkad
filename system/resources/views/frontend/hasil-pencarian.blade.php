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
                            <select name="tahun" class="form-control">
                                <option value="">Pilih Tahun</option>
                                @for ($year = date('Y'); $year >= 2000; $year--)
                                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
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
<section class="container py-5">
    @if (request('search') || request('bidang_id') || request('kategori_id') || request('tahun'))
        <div class="search-results-header bg-light p-4 rounded-3 mb-4 shadow-sm">
            <h5 class="mb-3">Filter Pencarian</h5>
            <div class="d-flex flex-wrap gap-2">
                @if (request('search'))
                    <span class="badge bg-primary bg-opacity-10 text-primary p-2" style="line-height: 0.5;">
                        <i class="fas fa-keyword me-1"></i> Kata Kunci: "{{ request('search') }}"
                    </span>
                @endif
                @if (request('bidang_id'))
                    <span class="badge bg-info bg-opacity-10 text-info p-2" style="line-height: 0.5;">
                        <i class="fas fa-layer-group me-1"></i> Bidang: {{ $bidangs->find(request('bidang_id'))->nama_bidang ?? '' }}
                    </span>
                @endif
                @if (request('kategori_id'))
                    <span class="badge bg-success bg-opacity-10 text-success p-2" style="line-height: 0.5;">
                        <i class="fas fa-tag me-1"></i> Kategori: {{ $kategoris->find(request('kategori_id'))->nama_kategori ?? '' }}
                    </span>
                @endif
                @if (request('tahun'))
                    <span class="badge bg-warning bg-opacity-10 text-warning p-2" style="line-height: 0.5;">
                        <i class="fas fa-calendar me-1"></i> Tahun: {{ request('tahun') }}
                    </span>
                @endif
            </div>
        </div>
    @endif

    <div class="row g-4">
        <!-- Hasil Pencarian Arsip Surat Masuk -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary bg-opacity-10 border-0">
                    <h5 class="mb-0 text-primary">
                        <i class="fas fa-inbox me-2"></i> Arsip Surat Masuk
                        <span class="badge bg-primary rounded-pill ms-2">{{ $ArsipSuratMasuk->total() }}</span>
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if ($ArsipSuratMasuk->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Tidak ada arsip surat masuk yang ditemukan</p>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach ($ArsipSuratMasuk as $item)
                                <a href="{{ route('arsip.masuk.show', ['id' => $item->surat_masuk_id]) }}"
                                    class="list-group-item list-group-item-action border-0 py-3 px-4 hover-effect">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="me-3">
                                            <h6 class="mb-1 fw-bold text-primary">{{ $item->nama_surat_masuk }}</h6>
                                            <div class="d-flex flex-wrap gap-4 mt-2">
                                                <small class="text-muted">
                                                    <i class="fas fa-hashtag me-1"></i> No. Surat: {{ $item->no_surat_masuk }}
                                                </small>
                                                <small class="text-muted">
                                                    <i class="fas fa-folder me-1"></i> No. Berkas: {{ $item->no_berkas_surat_masuk }}
                                                </small>
                                                <small class="text-muted">
                                                    <i class="fas fa-sort-numeric-down me-1"></i> Urutan: {{ $item->urutan_surat_masuk }}
                                                </small>
                                                <small class="text-muted">
                                                    <i class="fas fa-sort-numeric-down me-1"></i> Lokasi: {{ $item->lokasi_surat_masuk }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted d-block">
                                                <i class="fas fa-calendar-day me-1"></i> 
                                                {{ \Carbon\Carbon::parse($item->tanggal_surat_masuk)->translatedFormat('d F Y') }}
                                            </small>
                                            <div class="mt-2">
                                                @if($item->bidang_id)
                                                    <span class="badge bg-info bg-opacity-10 text-info me-1">
                                                        {{ $item->bidang->nama_bidang }}
                                                    </span>
                                                @endif
                                                @if($item->kategori_id)
                                                    <span class="badge bg-success bg-opacity-10 text-success">
                                                        {{ $item->kategori->nama_kategori }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @if(!$loop->last)
                                    <hr class="my-0 mx-4">
                                @endif
                            @endforeach
                        </div>
                        
                        <div class="card-footer bg-transparent border-0 py-3">
                            <div class="d-flex justify-content-center">
                                {{ $ArsipSuratMasuk->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Hasil Pencarian Arsip Surat Keluar -->
        <div class="col-12">
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-secondary bg-opacity-10 border-0">
                    <h5 class="mb-0 text-secondary">
                        <i class="fas fa-paper-plane me-2"></i> Arsip Surat Keluar
                        <span class="badge bg-secondary rounded-pill ms-2">{{ $ArsipSuratKeluar->total() }}</span>
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if ($ArsipSuratKeluar->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-paper-plane fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Tidak ada arsip surat keluar yang ditemukan</p>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach ($ArsipSuratKeluar as $item)
                                <a href="{{ route('arsip.keluar.show', ['id' => $item->surat_keluar_id]) }}"
                                    class="list-group-item list-group-item-action border-0 py-3 px-4 hover-effect">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="me-3">
                                            <h6 class="mb-1 fw-bold text-primary">{{ $item->nama_surat_keluar }}</h6>
                                            <div class="d-flex flex-wrap gap-4 mt-2">
                                                <small class="text-muted">
                                                    <i class="fas fa-hashtag me-1"></i> No. Surat: {{ $item->no_surat_keluar }}
                                                </small>
                                                <small class="text-muted">
                                                    <i class="fas fa-folder me-1"></i> No. Berkas: {{ $item->no_berkas_surat_keluar }}
                                                </small>
                                                <small class="text-muted">
                                                    <i class="fas fa-sort-numeric-down me-1"></i> Urutan: {{ $item->urutan_surat_keluar }}
                                                </small>
                                                <small class="text-muted">
                                                    <i class="fas fa-sort-numeric-down me-1"></i> Lokasi: {{ $item->lokasi_surat_keluar }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted d-block">
                                                <i class="fas fa-calendar-day me-1"></i> 
                                                {{ \Carbon\Carbon::parse($item->tanggal_surat_keluar)->translatedFormat('d F Y') }}
                                            </small>
                                            <div class="mt-2">
                                                @if($item->bidang_id)
                                                    <span class="badge bg-info bg-opacity-10 text-info me-1">
                                                        {{ $item->bidang->nama_bidang }}
                                                    </span>
                                                @endif
                                                @if($item->kategori_id)
                                                    <span class="badge bg-success bg-opacity-10 text-success">
                                                        {{ $item->kategori->nama_kategori }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @if(!$loop->last)
                                    <hr class="my-0 mx-4">
                                @endif
                            @endforeach
                        </div>
                        
                        <div class="card-footer bg-transparent border-0 py-3">
                            <div class="d-flex justify-content-center">
                                {{ $ArsipSuratKeluar->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.search-container {
    width: 100%;
    max-width: 1200px;
    margin: auto;
    padding: 25px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
}

.search-input, .form-select, .form-control {
    height: 48px;
    border-radius: 8px;
    font-size: 16px;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
}

.search-input:focus, .form-select:focus, .form-control:focus {
    border-color: #002454;
    box-shadow: 0 0 0 0.25rem rgba(0, 36, 84, 0.15);
}

.input-group-text {
    background-color: #fff;
    border-radius: 8px 0 0 8px !important;
}

.btn-primary {
    background-color: #002454;
    border-color: #002454;
    height: 48px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #002454;
    border-color: #002454;
    transform: translateY(-2px);
}

.hover-effect:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
    transition: all 0.2s ease;
}

.search-results-header {
    border-left: 4px solid #002454;
}

.badge {
    font-weight: 500;
    font-size: 0.85rem;
    color: white !important;
}


.card-header {
    padding: 1rem 1.5rem;
}

.list-group-item {
    transition: all 0.2s ease;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .search-container {
        padding: 15px;
    }
    
    .doc_banner_content h2 {
        font-size: 1.8rem;
    }
    
    .input-group-text {
        padding: 0.375rem 0.75rem;
    }
    
    .card-header h5 {
        font-size: 1.1rem;
    }
    
    .list-group-item {
        padding: 1rem;
    }
    
    .d-flex.gap-4 {
        gap: 1rem !important;
        flex-direction: column;
    }
}

/* Pagination styling */
.pagination .page-item.active .page-link {
    background-color: #002454;
    border-color: #002454;
}

.pagination .page-link {
    color: #002454;
    border-radius: 6px;
    margin: 0 3px;
    border: 1px solid #dee2e6;
}

.pagination .page-link:hover {
    background-color: #e9ecef;
}
/* Arsip Surat Masuk */
.card-header.bg-primary {
    background-color: #002454 !important;
    color: white !important;
}

.card-header.bg-primary h5 {
    color: white !important;
}

.badge.bg-primary {
    background-color: white !important;
    color: #002454 !important;
}

/* Arsip Surat Keluar */
.card-header.bg-secondary {
    background-color: #002454 !important;
    color: white !important;
}

.card-header.bg-secondary h5 {
    color: white !important;
}

.badge.bg-secondary {
    background-color: white !important;
    color: #002454 !important;
}

.d-flex .text-muted {
    margin-right: 20px; /* Menambah jarak antar elemen */
}

.d-flex .text-muted:last-child {
    margin-right: 0; /* Menghapus jarak pada elemen terakhir */
}


</style>
@endsection