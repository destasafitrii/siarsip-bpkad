@extends('template.frontend')

@section('content')
    <!--================ Forum Breadcrumb Area =================-->
    <section class="doc_banner_area search-banner-light" style="background-color: #002454">
        <div class="container-fluid pl-60 pr-60">
            <div class="doc_banner_content">
                <form action="{{ route('hasil-pencarian') }}" method="GET" class="header_search_form">
                    <div class="header_search_form_info d-flex align-items-center">
                        <div class="form-group flex-grow-1 mb-0">
                            <div class="input-wrapper d-flex align-items-center">
                                <i class="icon_search"></i>
                                <input type="search" id="searchbox" autocomplete="off" name="search"
                                    placeholder="Cari Arsip..." value="{{ $keyword }}" class="form-control" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ml-3 d-flex align-items-center">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <!--================ Forum Body Area =================-->
    <section class="forum_sidebar_area" id="sticky_doc">
        <div class="container-fluid pl-60 pr-60">
            <div class="row">
                <div class="col-lg-11">
                    <div class="forum_topic_list_inner">
                        <div class="forum_l_inner">
                            <div class="forum_head d-flex justify-content-between">
                                <h4>Hasil Pencarian</h4>
                            </div>
                            <div class="forum_body">
                                @if ($ArsipSuratMasuk->isEmpty())
                                    <p class="text-center">Tidak ada arsip surat masuk yang ditemukan.</p>
                                @else
                                    <ul class="navbar-nav topic_list">
                                        @foreach ($ArsipSuratMasuk as $item)
                                            <li>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div class="t_title">
                                                            <h4>{{ $item->judul }}</h4>
                                                        </div>
                                                        <h6>
                                                            <i class="icon_clock_alt"></i>
                                                            Terakhir diperbarui: {{ $item->updated_at->format('d M Y') }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <!-- Pagination for Surat Masuk -->
                            @if ($ArsipSuratMasuk->hasPages())
                                <div class="row pagination_inner">
                                    <div class="col-lg-12 d-flex justify-content-center">
                                        {{ $ArsipSuratMasuk->links() }}
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Arsip Surat Keluar -->
                        <div class="forum_head d-flex justify-content-between mt-5">
                            <h4>Hasil Pencarian Arsip Surat Keluar</h4>
                        </div>
                        <div class="forum_body">
                            @if ($ArsipSuratKeluar->isEmpty())
                                <p class="text-center">Tidak ada arsip surat keluar yang ditemukan.</p>
                            @else
                                <ul class="navbar-nav topic_list">
                                    @foreach ($ArsipSuratKeluar as $item)
                                        <li>
                                            <div class="media">
                                                <div class="media-body">
                                                    <div class="t_title">
                                                        <h4>{{ $item->judul }}</h4>
                                                    </div>
                                                    <h6>
                                                        <i class="icon_clock_alt"></i>
                                                        Terakhir diperbarui: {{ $item->updated_at->format('d M Y') }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <!-- Pagination for Surat Keluar -->
                        @if ($ArsipSuratKeluar->hasPages())
                            <div class="row pagination_inner">
                                <div class="col-lg-12 d-flex justify-content-center">
                                    {{ $ArsipSuratKeluar->links() }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Forum Body Area =================-->
@endsection
