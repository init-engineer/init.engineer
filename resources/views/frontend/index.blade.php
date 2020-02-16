@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    <div class="carousel slide d-none d-md-block" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                {{-- 吉祥物 --}}
                {{-- <img class="position-fixed" style="right: 24px; max-width: 192px; bottom: 0px;z-index: 1;" src="https://upload.cc/i1/2018/11/07/7l1RGe.gif" alt="贊助吉祥物"> --}}
                <img src="{{ asset("img/frontend/background/rlaVme5.png") }}" class="d-block w-100" alt="你是工程師嗎">
                <div class="carousel-caption text-left mb-5 pb-5 text-dark">
                    <h1 class="text-black-stroke display-3">純靠北工程師</h1>
                    <p class="lead">發源自臉書──全台最大工程師廢文社群</p>
                    <a class="btn btn-warning btn-lg shake-slow shake-constant shake-constant--hover" href="{{ route('frontend.social.cards.create') }}" role="button">開始去發廢文 <i class="fas fa-poop"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="carousel slide d-md-none" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                {{-- 吉祥物 --}}
                {{-- <img class="position-fixed" style="right: 0px; max-width: 128px; bottom: 0px; z-index: 1;" src="https://upload.cc/i1/2018/11/07/7l1RGe.gif" alt="贊助吉祥物"> --}}
                <img src="{{ asset("img/frontend/background/vznInUz.png") }}" class="d-block w-100" alt="你是工程師嗎">
                <div class="carousel-caption text-left mb-5 text-dark">
                    <h3 class="text-black-stroke">純靠北工程師</h3>
                    <a class="btn btn-warning btn-md shake-slow shake-constant shake-constant--hover" href="{{ route('frontend.social.cards.create') }}" role="button">開始去發廢文 <i class="fas fa-poop"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mb-5 animated fadeIn">
        <div class="row my-4">
            <div class="col-md-12 mb-2">
                <h1 class="h1-responsive font-weight-bold display-4 text-center text-white my-5 shake-slow shake-constant shake-constant--hover"><span class="badge badge-danger">HOT</span> 2019 排行榜</h1>
            </div>
            <div class="col-md-4 my-2">
                <a href="{{ route('frontend.leaderboard.2019.show.yuu-chien') }}">
                    <img src="https://i.imgur.com/4drN4eL.png" class="rounded w-100 h-100 border border-w-5" alt="純靠北工程師 2019 年度排行榜 | Author by @yuu-chien">
                </a>
            </div>
            <div class="col-md-4 my-2">
                <a href="{{ route('frontend.leaderboard.2019.show.fizzy-elt') }}">
                    <img src="https://i.imgur.com/pAGZXNU.png" class="rounded w-100 h-100 border border-w-5" alt="純靠北工程師 2019 年度排行榜 | Author by @fizzy-elt">
                </a>
            </div>
            <div class="col-md-4 my-2">
                <a href="{{ route('frontend.leaderboard.2019.show.dong-gua-lemon') }}">
                    <img src="https://i.imgur.com/zXQhFp2.png" class="rounded w-100 h-100 border border-w-5" alt="純靠北工程師 2019 年度排行榜 | Author by @dong-gua-lemon">
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid my-5 animated fadeIn">
        <div class="row">
            <div class="col-md-12 my-4">
                <fake-cards></fake-cards>
            </div>
        </div>
    </div>

    <div class="container my-5 animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="main-timeline">
                    <div class="timeline">
                        <div class="timeline-icon"><i class="fas fa-globe-americas"></i></div>
                        <span class="year">不曉得什麼時候</span>
                        <div class="timeline-content">
                            <h5 class="title animated fadeInLeft delay-1s">諾亞學會了備份這個概念</h5>
                            <p class="description animated fadeInLeft delay-1s">諾亞在很久以前，PM 命令他去建造了一艘大船，把世界上的各種陸上生物都備份進那艘船當中，以免哪天地球壞掉，資料救不回來。</p>
                        </div>
                    </div>
                    <div class="timeline">
                        <div class="timeline-icon"><i class="fa fa-robot"></i></div>
                        <span class="year">1912</span>
                        <div class="timeline-content">
                            <h5 class="title animated fadeInRight delay-1s">艾倫·圖靈</h5>
                            <p class="description animated fadeInRight delay-1s">圖靈建造了一台可以破解密碼的機電機器，據說這台機器還可以破解側漏小天使，此外，圖靈提出的著名的圖靈機模型為現代計算機的邏輯工作方式奠定了基礎。 </p>
                        </div>
                    </div>
                    <div class="timeline">
                        <div class="timeline-icon"><i class="fa fa-bug"></i></div>
                        <span class="year">2017</span>
                        <div class="timeline-content">
                            <h5 class="title animated fadeInLeft delay-1s">純靠北工程師</h5>
                            <p class="description animated fadeInLeft delay-1s">我們很懷念最開始的那個靠北工程師，這個版將會以舊文重發的方式，重現最初的那個靠北工程師。</p>
                        </div>
                    </div>
                    <div class="timeline">
                        <div class="timeline-icon"><i class="fa fa-poo"></i></div>
                        <span class="year">2019</span>
                        <div class="timeline-content">
                            <h5 class="title animated fadeInRight delay-1s">你</h5>
                            <p class="description animated fadeInRight delay-1s">來到這裡發文。</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-4">
        <section class="my-5 text-white">
            <h2 class="h1-responsive font-weight-bold text-center my-5">這裡能給你什麼？</h2>
            <p class="lead grey-text text-center w-responsive mx-auto mb-5"></p>

            <div class="row"><!-- Grid row -->
                <div class="col-md-4 mb-md-0 mb-5"><!-- Grid column -->
                    <div class="row"><!-- Grid row -->
                        <div class="col-lg-2 col-md-3 col-2"><!-- Grid column -->
                            <i class="fas fa-dog blue-text fa-2x shake-hard shake-constant shake-constant--hover"></i>
                        </div><!-- Grid column -->
                        <div class="col-lg-10 col-md-9 col-10"><!-- Grid column -->
                            <h4 class="font-weight-bold">汪汪汪汪汪汪</h4>
                            <p class="grey-text">汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪汪</p>
                            <a href="{{ route('frontend.social.cards.create') }}" class="btn btn-rainbow btn-block btn-lg"><i class="fas fa-heart shake-little shake-constant shake-constant--hover"> 汪汪汪</i></a>
                        </div><!-- Grid column -->
                    </div><!-- Grid row -->
                </div><!-- Grid column -->

                <div class="col-md-4 mb-md-0 mb-5"><!-- Grid column -->
                    <div class="row"><!-- Grid row -->
                        <div class="col-lg-2 col-md-3 col-2"><!-- Grid column -->
                            <i class="fas fa-cat pink-text fa-2x shake-hard shake-constant shake-constant--hover"></i>
                        </div><!-- Grid column -->
                        <div class="col-lg-10 col-md-9 col-10"><!-- Grid column -->
                            <h4 class="font-weight-bold">喵喵喵喵喵喵</h4>
                            <p class="grey-text">喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵</p>
                            <a href="{{ route('frontend.social.cards.create') }}" class="btn btn-rainbow btn-block btn-lg"><i class="fas fa-heart shake-little shake-constant shake-constant--hover"> 喵喵喵</i></a>
                        </div><!-- Grid column -->
                    </div><!-- Grid row -->
                </div><!-- Grid column -->

                <div class="col-md-4"><!-- Grid column -->
                    <div class="row"><!-- Grid row -->
                        <div class="col-lg-2 col-md-3 col-2"><!-- Grid column -->
                            <i class="fas fa-bug purple-text fa-2x shake-hard shake-constant shake-constant--hover"></i>
                        </div><!-- Grid column -->
                        <div class="col-lg-10 col-md-9 col-10"><!-- Grid column -->
                            <h4 class="font-weight-bold">哞哞哞哞哞哞</h4>
                            <p class="grey-text">哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞哞</p>
                            <a href="{{ route('frontend.social.cards.create') }}" class="btn btn-rainbow btn-block btn-lg"><i class="fas fa-heart shake-little shake-constant shake-constant--hover"> 哞哞哞</i></a>
                        </div><!-- Grid column -->
                    </div><!-- Grid row -->
                </div><!-- Grid column -->
            </div><!-- Grid row -->
        </section>
    </div><!-- Container -->
@endsection
