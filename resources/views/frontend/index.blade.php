@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<div class="container-fluid">
    <div class="row my-2">
        <div class="col-12 col-md-4 col-lg-3 mx-auto" style="display: flex; flex-direction: column; justify-content: center;">
            <img class="w-100" src="{{ asset('img/frontend/logo.png') }}" alt="LOGO">
        </div>
        <div class="col-12 col-md-8 col-lg-7 mx-auto px-0" style="display: flex; flex-direction: column; justify-content: center;">
            <div class="w-100">
                <search-engine></search-engine>
            </div>
            <div class="w-100">
                <p>
                    熱門話題:
                    <a class="color-danger" style="text-decoration: underline;" href="https://github.com/init-engineer/init.engineer" target="_blank">純靠北工程師</a>
                    <a class="color-color-primary" style="text-decoration: underline;" href="https://www.youtube.com/watch?v=_6TtTRrno3E&list=PL12UaAf_xzfq1Qw3hO43WvcgAo_Sju6Ix" target="_blank">天竺鼠車車</a>
                    <a class="color-danger" style="text-decoration: underline;" href="https://www.youtube.com/watch?v=rU4k1jRAO3I" target="_blank">HowHow 素材</a>
                    <a class="color-primary" style="text-decoration: underline;" href="https://www.youtube.com/watch?v=072tU1tamd0" target="_blank">統神端火鍋</a>
                    <a class="color-primary" style="text-decoration: underline;" href="https://news.pts.org.tw/article/514964" target="_blank">全民買鳳梨</a>
                </p>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-2 mx-auto" style="display: flex; flex-direction: column; justify-content: center;">
            <div class="w-100 bg-color-primary card">
                <div class="card-body p-2">
                    <p class="card-text">不習慣新介面嗎？如果需要，您可以透過我們的時光機，切換成經典版純靠北工程師。</p>
                    <button class="btn btn-block btn-primary-bg" onclick="Swal.fire('噢哦！', '版主並沒有寫「切換回經典版 純靠北工程師」的功能。', 'warning');">我想回去舊版頁面</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row flex-column-reverse flex-md-row my-2">
        <div class="col-12 col-md-4 col-lg-2 mx-auto my-2">
            <music-player></music-player>

            <label class="col-label bg-color-primary color-color-primary">《近日熱門文章》</label>
            <div class="w-100 mb-2 bg-color-primary">
                <a href="https://kaobei.engineer/cards/show/5905">
                    <img class="p-2 w-100" src="https://kaobei.engineer/storage/cards/custom/JMBif6Zd6dZMcRpE826QEKN4a6Q2vThCVrxWO1eElTj6kPOmUDGTFCbcRHm9cxgrQ0X0tCTLbETftQIfmZrVbs1doetASNBI69xA8jQLkGq5o2PQ9inaSbimjBhqXbAN.jpg">
                </a>
            </div>

            <bulletin-board></bulletin-board>
        </div>
        <div class="col-12 col-md-8 col-lg-6 mx-auto my-2 px-0">
            <label class="col-label bg-color-primary color-color-primary">快捷選單</label>
            <div class="w-100 bg-color-primary">
                <table class="table table-sm table-hover color-color-primary">
                    <tbody>
                        <tr><th scope="row" style="border-top: 0px; border-bottom: 1px solid var(--font-primary-color);">
                            ["平台功能":[
                            "<a class="color-warning" href="{{ route('frontend.animal.index') }}">大頭菜計算機</a>",&nbsp;
                            "<a class="color-warning" href="{{ route('frontend.social.cards.create') }}">發表文章</a>",&nbsp;
                            "<a class="color-warning" href="{{ route('frontend.social.cards.review') }}">群眾審核</a>",&nbsp;
                            "<a class="color-warning" href="{{ route('frontend.social.cards.index') }}">文章列表</a>"]]
                        </th></tr>
                        <tr><th scope="row" style="border-top: 0px;">
                            ["研討會":[
                            "<a href="https://mopcon.org" target="_blank"><img src="https://t.kfs.io/upload_images/102093/Image_from_iOS_original.jpg" alt=""> MOPCON</a>",&nbsp;
                            "<a href="https://sitcon.org" target="_blank"><img src="https://sitcon.org/2016/image/stone.png" alt="sitcon"> SITCON</a>",&nbsp;
                            "<a href="https://hitcon.org" target="_blank"><img src="https://ctf.hitcon.org/img/og_img.png" alt="hitcon"> HITCON</a>",&nbsp;
                            "<a href="https://coscup.org" target="_blank"><img src="https://coscup.org/2019/avatar.jpg" alt="coscup"> COSCUP</a>"]]
                        </th></tr>
                        <tr><th scope="row" style="border-top: 0px;">
                            ["臉書社團":[
                            "<a href="https://www.facebook.com/groups/1182255762153380" target="_blank">程式語言讀書會</a>",&nbsp;
                            "<a href="https://www.facebook.com/groups/kaobei.engineer" target="_blank">純靠北工程師 同溫層</a>",&nbsp;
                            "<a href="https://www.facebook.com/groups/616369245163622" target="_blank">Backend 台灣</a>"]]
                        </th></tr>
                        <tr><th scope="row" style="border-top: 0px;">
                            ["瀏覽器":[
                            "<a href="https://www.mozilla.org/zh-TW/firefox/new" target="_blank"><img src="https://www.flaticon.com/svg/static/icons/svg/183/183320.svg" alt="firefox"> Firefox</a>",&nbsp;
                            "<a href="https://www.google.com/intl/zh-TW/chrome" target="_blank"><img src="https://www.flaticon.com/svg/static/icons/svg/183/183316.svg" alt="chrome"> Chrome</a>",&nbsp;
                            "<a href="https://www.opera.com/zh-cn" target="_blank"><img src="https://www.flaticon.com/svg/static/icons/svg/732/732233.svg" alt="opera"> Opera</a>",&nbsp;
                            "<a href="https://brave.com/zh" target="_blank"><img src="https://brave.com/wp-content/uploads/2019/03/brave-logo.png" alt="brave"> Brave</a>"]]
                        </th></tr>
                        <tr><th scope="row" style="border-top: 0px;">
                            ["undefined": null]
                        </th></tr>
                    </tbody>
                </table>
            </div>

            <label class="col-label bg-color-primary color-color-primary">純靠北工程師 Discord</label>
            <iframe src="https://discord.com/widget?id=508513350964084736&theme=dark" width="100%" height="400" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
        </div>

        <div class="col-12 col-lg-4 mx-auto my-2">
            @guest
                <login-tools></login-tools>
            @else
                <login-tools :login="true" avatar="{{ $logged_in_user->picture }}" username="{{ $logged_in_user->name }}" email="{{ $logged_in_user->email }}"></login-tools>
            @endguest

            <label class="mt-2 col-label bg-color-primary color-color-primary">我的工具</label>
            <div class="row mb-2 m-0 p-2 bg-color-primary text-center">
                <div class="col-12 mt-0 mb-1 pr-1 pl-0">
                    <a class="my-2" href="{{ route('frontend.social.cards.create') }}"><img class="w-100" src="{{ asset('/img/frontend/button/tools-button-post-publish.png') }}" alt="發表文章"></a>
                </div>
                <div class="col-6 mt-0 mb-1 pr-1 pl-0">
                    <a class="my-2" href="{{ route('frontend.fortunes.index') }}"><img class="w-100" src="{{ asset('/img/frontend/button/tools-button-fortunes.png') }}" alt="線上抽籤系統"></a>
                </div>

                <div class="col-6 mt-0 mb-1 pr-1 pl-0">
                    <a class="my-2" href="{{ route('frontend.social.cards.review') }}"><img class="w-100" src="{{ asset('/img/frontend/button/tools-button-post-review.png') }}" alt="群眾審核"></a>
                </div>
                <div class="col-6 mt-0 mb-1 pr-1 pl-0">
                    <a class="my-2" href="{{ route('frontend.animal.index') }}"><img class="w-100" src="{{ asset('/img/frontend/button/tools-button-turnips-computer.png') }}" alt="大頭菜計算機"></a>
                </div>
                <div class="col-6 mt-0 mb-1 pr-1 pl-0">
                    <a class="my-2" href="{{ route('frontend.social.cards.index') }}"><img class="w-100" src="{{ asset('/img/frontend/button/tools-button-post-list.png') }}" alt="文章列表"></a>
                </div>
            </div>

            <financial-status></financial-status>
        </div>
    </div>
</div>
@endsection

@push('before-styles')
<style>
tr {
    color: var(--color-gray) !important;
}
tr:hover {
    color: var(--font-secondary-color) !important;
}
tr a {
    color: var(--font-primary-color) !important;
}
tr a:hover {
    color: var(--color-info) !important;
}
tr img {
    max-width: 24px;
    max-height: 24px;
    border-radius: 4px;
}
</style>
@endpush
