@extends('template.frontend')

@section('content')
    <section class="doc_banner_area_dip">
        <ul class="list-unstyled banner_shap_img_dip">
            <li><img data-parallax='{"x": 180, "y": 80, "rotateY":2000}' src="img/home-tow/icon/plus-1.png" alt="">
            </li>
            <li><img data-parallax='{"x": 180, "y": 80, "rotateY":2000}' src="img/home-tow/icon/plus-1.png" alt="">
            </li>
            <li><img data-parallax='{"x": 180, "y": 80, "rotateY":2000}' src="img/home-tow/icon/plus-1.png" alt="">
            </li>
            <li><img src="{{ url('public') }}/frontend/img/home-tow/icon/slide-1.png" alt=""></li>
            <li><img src="{{ url('public') }}/frontend/img/home-tow/icon/slide-2.png" alt=""></li>
            <li><img src="{{ url('public') }}/frontend/img/home-tow/icon/slide-3.png" alt=""></li>
            <li><img src="{{ url('public') }}/frontend/img/home-tow/icon/slide-4.png" alt=""></li>
            <li><img src="{{ url('public') }}/frontend/img/home-tow/icon/slide-5.png" alt=""></li>
            <li><img src="{{ url('public') }}/frontend/img/home-tow/icon/slide-6.png" alt=""></li>
            <li><img src="{{ url('public') }}/frontend/img/home-tow/icon/slide-7.png" alt=""></li>
            <li><img src="{{ url('public') }}/frontend/img/home-tow/icon/slide-8.png" alt=""></li>
        </ul>
        <div class="container">
            <div class="doc_banner_content">
                <h2 class="wow fadeInUp">Temukan Arsip Dengan Mudah !</h2>
                <form action="#" class="header_search_form">
                    <div class="header_search_form_info">
                        <div class="form-group">
                            <div class="input-wrapper">
                                <input type='search' id="searchbox" autocomplete="off" name="search"
                                    placeholder="ketikan kata kunci...." />
                                <div class="header_search_form_panel">
                                    <ul class="list-unstyled">
                                        <li>Help Desk
                                            <ul class="list-unstyled search_item">
                                                <li><span>Configuration</span><a href="#">How to edit host and
                                                        port?</a></li>
                                                <li><span>Configuration</span><a href="#">The dev Property</a></li>
                                            </ul>
                                        </li>
                                        <li>Support
                                            <ul class="list-unstyled search_item">
                                                <li><span>Pages</span><a href="#">The asyncData Method</a></li>
                                            </ul>
                                        </li>
                                        <li>Documentation
                                            <ul class="list-unstyled search_item">
                                                <li><span>Getting Started</span><a href="#">The asyncData Method</a>
                                                </li>
                                                <li><span>Getting Started</span><a href="#">The asyncData Method</a>
                                                </li>
                                                <li><span>Getting Started</span><a href="#">The asyncData Method</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <button type="submit" class="submit_btn">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
