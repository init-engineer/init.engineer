@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<div class="container-fluid">
    <div class="row my-2">
        <div class="col-12 col-md-4 col-lg-3 mx-auto" style="display: flex; flex-direction: column; justify-content: center;">
            <img class="w-100" src="/img/frontend/banner/logo.png" alt="LOGO">
        </div>
        <div class="col-12 col-md-8 col-lg-7 mx-auto px-0" style="display: flex; flex-direction: column; justify-content: center;">
            <div class="w-100">
                <search-engine></search-engine>
            </div>
            <div class="w-100">
                <p>
                    熱門話題:
                    <a class="color-danger" style="text-decoration: underline;" href="https://github.com/init-engineer/init.engineer">純靠北工程師</a>
                    <a class="color-color-primary" style="text-decoration: underline;" href="https://www.php.net/releases/8.0/en.php">PHP 8 Released</a>
                    <a class="color-color-primary" style="text-decoration: underline;" href="https://www.ruby-lang.org/en/news/2020/12/25/ruby-3-0-0-released">Ruby 3 Released</a>
                    <a class="color-primary" style="text-decoration: underline;" href="https://www.apple.com/tw/mac/m1/">Apple M1 晶片</a>
                    <a class="color-color-primary" style="text-decoration: underline;" href="https://www.cyberpunk.net">電馭叛客 2077</a>
                    <a class="color-warning" style="text-decoration: underline; border-style: dashed;" href="javascript:void(0);">提供</a>
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
            <label class="col-label bg-color-primary color-color-primary">《炎上Hot》</label>
            <div class="w-100 mb-2 bg-color-primary">
                <a href="https://kaobei.engineer/cards/show/5616">
                    <img class="p-2 w-100" src="https://kaobei.engineer/storage/cards/images/P5uwRGeHtz09KF21GPxVOo8K8ksikHNn0Ad9oaCIyP76X9JFD7KqtBKD5ZiAS9dzE4UYnET5r9KdtaD3oxh638LGiU9v3HWwSc7V7Ybj7BB3PAWii681lrZkMKyUgP6j.jpeg">
                </a>
            </div>

            <label class="pt-2 col-label bg-color-primary color-color-primary">公告欄</label>
            <div class="w-100 mb-2 bg-color-primary">
                <p class="p-1 mx-2 my-0">2020/12/27 (週日)</p>
                <hr class="p-0 mx-2 my-0" style="border: 1px var(--font-primary-color) solid;">
                <p class="pt-2 mx-2 my-0 text-center"><strong>更新首頁</strong></p>
                <p class="pb-2 mx-2 my-0">把首頁整個大翻新，並提供了閃亮模式、暗黑模式，</p>
            </div>

            <label class="pt-2 col-label bg-color-primary color-color-primary">暫定</label>
            <div class="w-100 mb-2 bg-color-primary">
                <div class="w-100 m-0 p-1">
                    <div class="w-100 my-2 color-warning" style="height: 3rem; border-style: dashed;">
                        <p class="text-center py-2">提&nbsp;供</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 col-lg-6 mx-auto my-2 px-0">
            <div class="w-100 bg-color-primary">
                <table class="table table-sm table-hover color-color-primary">
                    <tbody>
                        <tr><th scope="row" style="border-top: 0px; border-bottom: 1px solid var(--font-primary-color);">
                            ["平台功能":[
                            "<a href="{{ route('frontend.animal.index') }}">大頭菜計算機</a>",&nbsp;
                            "<a href="{{ route('frontend.social.cards.create') }}">發表文章</a>",&nbsp;
                            "<a href="{{ route('frontend.social.cards.review') }}">群眾審核</a>"]]
                        </th></tr>
                        <tr><th scope="row" style="border-top: 0px;">
                            ["研討會":[
                            "<a href="https://mopcon.org">MOPCON</a>",&nbsp;
                            "<a href="https://sitcon.org">SITCON</a>",&nbsp;
                            "<a href="https://hitcon.org">HITCON</a>",&nbsp;
                            "<a href="https://coscup.org">COSCUP</a>"]]
                        </th></tr>
                        <tr><th scope="row" style="border-top: 0px;">
                            ["undefined": null]
                        </th></tr>
                        <tr><th scope="row" style="border-top: 0px;">
                            ["undefined": null]
                        </th></tr>
                        <tr><th scope="row" style="border-top: 0px;">
                            ["undefined": null]
                        </th></tr>
                        <tr><th scope="row" style="border-top: 0px;">
                            ["undefined": null]
                        </th></tr>
                        <tr><th scope="row" style="border-top: 0px;">
                            ["undefined": null]
                        </th></tr>
                    </tbody>
                </table>
            </div>
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
                    <a class="my-2" href="{{ route('frontend.social.cards.create') }}"><img class="w-100" src="/img/frontend/banner/navbar02.png" alt="發表文章"></a>
                </div>
                <div class="col-6 mt-0 mb-1 pr-1 pl-0">
                    <a class="my-2" href="{{ route('frontend.social.cards.review') }}"><img class="w-100" src="/img/frontend/banner/navbar03.png" alt="群眾審核"></a>
                </div>
                <div class="col-6 mt-0 mb-1 pr-1 pl-0">
                    <a class="my-2" href="{{ route('frontend.animal.index') }}"><img class="w-100" src="/img/frontend/banner/navbar01.png" alt="大頭菜計算機"></a>
                </div>
            </div>

            <label class="pt-2 col-label bg-color-primary color-color-primary">暫定</label>
            <div class="w-100 mb-2 bg-color-primary">
                <div class="w-100 m-0 p-1">
                    <div class="w-100 my-2 color-warning" style="height: 3rem; border-style: dashed;">
                        <p class="text-center py-2">提&nbsp;供</p>
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
</style>
@endpush
