@extends('frontend.layouts.app')

@section('title', app_name() . ' | 動物森友會 - 大頭菜計算機')
@section('meta_keyword', app_name() . ' | 動物森友會 - 大頭菜計算機')
@section('meta_description', app_name() . ' | 動物森友會 - 大頭菜計算機，計算你的大頭菜')
@section('meta_og_title', app_name() . ' | 動物森友會 - 大頭菜計算機')
@section('meta_og_image', asset('img/frontend/banner/KohlrabiComputer.png'))
@section('meta_og_description', app_name() . ' | 動物森友會 - 大頭菜計算機，計算你的大頭菜')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col col-12">
                <div class="jumbotron py-4">
                    <h1>2020-05-07 UPDATE</h1>
                    <ul>
                        <li>1. 更新大頭菜計算公式。</li>
                        <li>2. 將傳統計算公式與預測價格分開，以後只需要輸入價格，系統會自動預測價格。</li>
                        <li>3. 計算結果按鈕功能更改為傳統計算公式（彈跳視窗）。</li>
                    </ul>
                    <hr/>
                    <p>首先感謝您使用「<a href="https://kaobei.engineer/animal/kohlrabi">大頭菜計算機</a>」作為您的大頭菜致富首選，計算機的進步仰賴各位的回報，在此推薦<a href="https://discord.gg/MuXVATX" target="_blank">純靠北工程師的 Discord 群組</a>，可以加入裡面一同回報使用狀況，無論是 Bug、許願、瞎聊 ... 之類的，群組不限於是否是工程師，也可以來跟版主大頭菜互助會一下，以上，感謝您的閱讀 m(_ _)m。</p>
                    <a class="btn btn-primary btn-lg" href="https://discord.gg/MuXVATX" target="_blank" role="button">點我加入 Discord</a>
                </div>
            </div>
            <!--col-->
            <div class="col col-12 col-md-6">
                <img class="img-fluid rounded mb-5 w-100" src="{{ asset('img/frontend/banner/KohlrabiComputer.png') }}" />
            </div>
            <!--col-->
            <div class="col-12">
                <kohlrabi-computer></kohlrabi-computer>
            </div>
            <!--col-->
            <div class="col-12 mt-3">
                <label class="col-label">這裡是 Ads 廣告</label>
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-3028179090690423"
                    data-ad-slot="2486547757" data-ad-format="auto" data-full-width-responsive="true"></ins>
            </div>
        </div>
        <!--row-->
    </div>
    <!--container-->
@endsection

@push('before-scripts')
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
    {!! script('js/animal/kohlrabi/predictions.min.js') !!}
@endpush
