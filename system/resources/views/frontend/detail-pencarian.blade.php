@extends('template.frontend')

@section('content')
<!--================Forum Breadcrumb Area =================-->
<section class="doc_banner_area search-banner-light" style="background-color: #002454">
    <div class="container">
        <div class="doc_banner_content">
            <form action="#" class="header_search_form">
                <div class="header_search_form_info">
                    <div class="form-group">
                        <div class="input-wrapper">
                            <i class="icon_search"></i>
                            <input type='search' id="searchbox" autocomplete="off" name="search"
                                   placeholder="Search for Topics...." />
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
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<section class="page_breadcrumb">
    <div class="container custom_container">
        <div class="row">
            <div class="col-sm-7">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Docs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Docy WordPress Theme</li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-5">
                <a href="#" class="date"><i class="icon_clock_alt"></i>Updated on March 03, 2020</a>
            </div>
        </div>
    </div>
</section>
<!--================End Forum Breadcrumb Area =================-->

<section class="doc_blog_grid_area sec_pad forum-single-content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Forum post top area -->
                
                <!-- Forum post content -->
                <div class="q-title">
                    <span class="question-icon" title="Question">Q:</span>
                    <h1>Sticky navbar is shown, but state is inactive</h1>
                </div>
                <div class="forum-post-content">
                    <div class="content">
                        <p>Daft blimey cor blimey guvnor jolly good don't get shirty with me what a load of rubbish no biggie ruddy cuppa cheesed off bleeding, arse spiffing it's your round codswallop gormless off his nut bodge I smashing, mufty chancer Oxford my good sir bobby it's all gone to pot bite your arm off wind up Harry. Blatant A bit of how's your father it's your round are you taking the piss gutted mate codswallop golly gosh, James Bond I old chimney pot is bum bag do one, fanny around crikey pukka tomfoolery nancy boy.  </p>
                        <p> Spiffing good time burke give us a bell absolutely bladdered gutted mate tosser cuppa happy days Harry young delinquent amongst car boot, baking cakes cheesed off I down the pub what a load of rubbish such a fibber knees up me old mucker wind up smashing. My lady cheeky faff about what a plonker so I said pardon you chimney pot cheesed off haggle quaint, cup of tea gormless excuse my French mush bleeding knackered squiffy mush, such a fibber dropped a clanger jolly good he lost his bottle vagabond no biggie fanny around brilliant. Chip shop absolutely bladdered cockup up the kyver cracking goal is pardon you cuppa easy peasy the full monty the bee's knees blatant, bugger pear shaped a load of old tosh zonked give us a bell up the duff bleeder fantastic James Bond chap. Off his nut the BBC mufty hotpot my lady I super tomfoolery nancy boy, loo fanny around bits and bobs nice one only a quid Eaton blow off barmy, knees up bobby cup of char barney a no biggie gormless.</p>
                    </div>
                    <div class="forum-post-btm">
                        <div class="taxonomy forum-post-tags">
                            <i class="icon_tags_alt"></i><a href="#">Bug</a>, <a href="#">Feature</a>, <a href="#">Error</a>
                        </div>
                        <div class="taxonomy forum-post-cat">
                            <img src="img/forum/logo-favicon.png" alt=""><a href="#">Docy Support</a>
                        </div>
                    </div>
                    <div class="action-button-container action-btns">
                        <a href="#" class="action_btn btn-ans ask-btn reply-btn">Reply</a>
                        <a href="#" class="action_btn btn-ans ask-btn too-btn">I have this question too (20)</a>
                    </div>
                </div>

                
            </div>
            <!-- /.col-lg-8 -->

            
            <!-- /.col-lg-4 -->
        </div>
    </div>
</section>

@endsection