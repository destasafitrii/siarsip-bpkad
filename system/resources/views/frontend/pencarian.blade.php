@extends('template.frontend')

@section('content')
<section class="doc_banner_area search-banner-light" style="background-color: #002454; padding: 40px 0;">
    <div class="container">
        <div class="doc_banner_content text-center">
            <h2 class="wow fadeInUp" style="color: white;">Temukan Arsip Dengan Mudah!</h2>
            <form action="{{ route('hasil-pencarian') }}" method="GET" class="header_search_form">
                <div class="search-container">
                    <!-- ROW 1: Pencarian Kata Kunci -->
                    <div class="row w-100 mb-2">
                        <div class="col-md-12">
                            <input type="text" name="search" placeholder="Masukkan Kata Kunci..." class="form-control" value="{{ request('search') }}">
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

.form-control {
    width: 100%;
    height: 45px;
    padding: 12px;
    border: 2px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    outline: none;
    transition: border-color 0.3s ease-in-out;
}

.form-control:focus {
    border-color: #007BFF;
}

.btn-primary {
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Responsif */
@media (max-width: 768px) {
    .search-container {
        padding: 10px;
    }

    .row .col-md-4, .row .col-md-3, .row .col-md-1 {
        margin-bottom: 10px;
    }
}

.search-banner-light {
    background-color: #002454 !important;
    width: 100%;
    min-height: 100vh; /* Menutupi seluruh layar */
    display: flex;
    align-items: center;
    justify-content: center;
}

</style>
@endsection
