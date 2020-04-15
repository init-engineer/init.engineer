@extends('frontend.layouts.app')

@section('title', '純靠北工程師 2019 年度排行榜 | Author by @dong-gua-lemon')
@section('meta_keyword', '純靠北工程師 2019 年度排行榜 | Author by @dong-gua-lemon')
@section('meta_description', '純靠北工程師 2019 年度排行榜 | Author by @dong-gua-lemon')
@section('meta_og_title', '純靠北工程師 2019 年度排行榜 | Author by @dong-gua-lemon')
@section('meta_og_image', 'https://i.imgur.com/zXQhFp2.png')
@section('meta_og_description', '純靠北工程師 2019 年度排行榜 | Author by @dong-gua-lemon')

@section('content')
    <div class="container desk">
        @include('frontend.leaderboard.2019.dong-gua-lemon.doodle')

        <div class="d-none d-md-flex position-relative align-items-center vh-100 vw-100 justify-content-center flex-column">
            <div class="firstilte">
                <div class="engtitle">
                    <img src="{{ asset('/img/frontend/leaderboard/2019/dong-gua-lemon/logo.png') }}" class="engimg">
                </div>
            </div>
            <div class="titlearea">
                <div class="titleinfo" id="titleactive">
                    <div class="flextitle">
                        <div class="article_title">
                            <h4>2019 年累積的文章數量</h4>
                        </div>
                        <div>
                            <img src="{{ asset('/img/frontend/leaderboard/2019/dong-gua-lemon/JOJO.png') }}" width="200" height="285">
                        </div>
                        <div class="hp">
                            <div class="hpboard">
                                <div class="hpinfo">
                                    <h4>LP</h4>
                                    <p>2,248</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="titleinfo" id="titleactive">
                    <div class="flextitle">
                        <div class="community_title">
                            <h4>2019 年累積的社群留言</h4>
                        </div>
                        <div>
                            <img src="{{ asset('/img/frontend/leaderboard/2019/dong-gua-lemon/howdareu.png') }}" width="200" height="285">
                        </div>
                        <div class="hp">
                            <div class="hpboard">
                                <div class="hpinfo">
                                    <h4>LP</h4>
                                    <p>57,300</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="titleinfo" id="titleactive">
                    <div class="flextitle">
                        <div class="liked_title">
                            <h4>2019 年累積的按讚數量</h4>
                        </div>
                        <div>
                            <img src="{{ asset('/img/frontend/leaderboard/2019/dong-gua-lemon/ode.png') }}" width="200"
                                height="285">
                        </div>
                        <div class="hp">
                            <div class="hpboard">
                                <div class="hpinfo">
                                    <h4>LP</h4>
                                    <p>430,864</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="titleinfo" id="titleactive">
                    <div class="flextitle">
                        <div class="share_title">
                            <h4>2019 年累積的分享數量</h4>
                        </div>
                        <div>
                            <img src="{{ asset('/img/frontend/leaderboard/2019/dong-gua-lemon/kodare.png') }}" width="200" height="285">
                        </div>
                        <div class="hp">
                            <div class="hpboard">
                                <div class="hpinfo">
                                    <h4>LP</h4>
                                    <p>22,920</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="imgarea" id="imagearea" onclick="toggle()">
                <div class="rotatey">
                    <div class="cardimg">
                        <img src="{{ asset('/img/frontend/leaderboard/2019/dong-gua-lemon/card.png') }}" width="200" height="285">
                        <h4 class="alert">翻開覆蓋的卡</h4>
                    </div>
                    <div class="miximg">
                        <img src="{{ asset('/img/frontend/leaderboard/2019/dong-gua-lemon/mutriple.png') }}" width="200" height="285">
                    </div>
                </div>
            </div>
        </div>

        <!-- 手機版 -->
        <div class="d-md-none vh-100 vw-100 align-items-center d-flex a">
            <!-- Something code ... -->
            <div class="mobiletitlearea">
                <div class="mobiletitleinfo" id="titleactive">
                    <div class="mobileflextitle">
                        <div class="article_title">
                            <h4>2019 年累積的</h4>
                            <h4>文章數量</h4>
                        </div>
                        <div>
                            <img src="{{ asset('/img/frontend/leaderboard/2019/dong-gua-lemon/JOJO.png') }}" width="200" height="250">
                        </div>
                        <div class="hp">
                            <div class="hpboard">
                                <div class="hpinfo">
                                    <h4>LP</h4>
                                    <p>2,248</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobiletitleinfo" id="titleactive">
                    <div class="mobileflextitle">
                        <div class="article_title">
                            <h4>2019 年累積的</h4>
                            <h4>社群留言</h4>
                        </div>
                        <div>
                            <img src="{{ asset('/img/frontend/leaderboard/2019/dong-gua-lemon/howdareu.png') }}" width="200" height="250">
                        </div>
                        <div class="hp">
                            <div class="hpboard">
                                <div class="hpinfo">
                                    <h4>LP</h4>
                                    <p>57,300</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobiletitleinfo" id="titleactive">
                    <div class="mobileflextitle mobileflex">
                        <div class="article_title">
                            <h4>2019 年累積的</h4>
                            <h4>按讚數量</h4>
                        </div>
                        <div>
                            <img src="{{ asset('/img/frontend/leaderboard/2019/dong-gua-lemon/ode.png') }}" width="200" height="250">
                        </div>
                        <div class="hp">
                            <div class="hpboard">
                                <div class="hpinfo">
                                    <h4>LP</h4>
                                    <p>430,864</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobiletitleinfo" id="titleactive">
                    <div class="mobileflextitle mobileflex">
                        <div class="article_title">
                            <h4>2019 年累積的</h4>
                            <h4>分享數量</h4>
                        </div>
                        <div>
                            <img src="{{ asset('/img/frontend/leaderboard/2019/dong-gua-lemon/kodare.png') }}" width="200" height="250">
                        </div>
                        <div class="hp">
                            <div class="hpboard">
                                <div class="hpinfo">
                                    <h4>LP</h4>
                                    <p>22,920</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5 py-5 animated fadeIn">
        <div class="row">
            <div class="col-md-12 text-center text-white">
                <h1 class="m-2">Author by</h1>
                <img src="https://avatars2.githubusercontent.com/u/31680128" class="rounded" width="128" height="128" />
                <h2 class="m-2"><a href="https://github.com/DongGuaLemon">@DongGuaLemon</a></h2>
            </div>
        </div>
    </div>

    <div class="container">
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-3028179090690423"
            data-ad-slot="2486547757"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
    </div>
@endsection

@push('after-styles')
    <!-- dong-gua-lemon CSS -->
    {{ style('css/leaderboard/2019/dong-gua-lemon/dong-gua-lemon.min.css') }}
@endpush

@push('after-scripts')
    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>

    <!-- dong-gua-lemon JS -->
    {!! script('js/leaderboard/2019/dong-gua-lemon/dong-gua-lemon.min.js') !!}
@endpush
