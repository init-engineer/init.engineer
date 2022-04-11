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
                <p>告訴你一個神秘的地方 ♪ 一個孩子們的快樂天堂 ♪</p>
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
            <label class="col-label bg-color-primary color-color-primary">純靠北工程師 Discord</label>
            <iframe src="https://discord.com/widget?id=508513350964084736&theme=dark" width="100%" height="400" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>

        </div>
        <div class="col-12 col-md-8 col-lg-6 mx-auto my-2 px-0">
            <div style="border-width:3px; border-style:dashed; padding:5px; min-height: 480px;" class="d-flex align-items-center">
                <div class="w-100">
                    <h1 class="text-center">我還沒想到這裡要放甚麼 :-)<h1>
                    <br />
                    <h3 class="text-center">過了好幾天了，我還是想不到這裏要放甚麼 :-(<h3>
                </div>
            </div>
            {{-- <label class="col-label bg-color-primary color-color-primary">快捷選單</label>
            <div class="w-100 bg-color-primary mb-3">
                <div class="github-card" data-github="kantai235" data-theme="default"></div>
                <div class="github-card" data-github="init-engineer/init.engineer" data-theme="default"></div>
                <script src="//cdn.jsdelivr.net/github-cards/latest/widget.js"></script>
            </div> --}}
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

            <div class="pb-2">
                <label class="pt-2 col-label bg-color-primary color-color-primary">好心人斗內一下</label>
                <div class="w-100 mb-2 p-2 bg-color-primary">
                    <div class="text-center">
                        <a class="btn btn-success" href="https://p.ecpay.com.tw/1ADBA06" target="_blank">單筆小額贊助</a>
                        <a class="btn btn-success" href="https://p.ecpay.com.tw/3D1AF5E" target="_blank">定期定額贊助</a>
                    </div>
                </div>
            </div>
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
