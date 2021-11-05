@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <h1 class="mt-5 mx-auto" style="font-size: 48px;">今天又有什麼靠北事？</h1>
                <p class="my-0 text-center">大家好，病媒防治工程師です ...</p>
                <p class="my-0 text-center">一個測試工程師走進一家酒吧，要了一杯啤酒 ...</p>
                <p class="my-0 text-center">偉大的 PHP 這個巨人，要清醒囉！</p>
                <h1 class="my-5 mx-auto"><a class="btn btn-success btn-lg" href="{{ route('frontend.social.cards.index') }}">前往投稿</a></h1>
                <p class="my-0 pt-5 text-center">其實我也不曉得首頁要放些甚麼才好，有想法的可以<a href="https://discord.gg/tPhnrs2">來 Discord 頻道</a>給我們意見🥺🥺</p>
            </div><!--col-md-12-->
        </div><!--row-->
    </div><!--container-->
@endsection
