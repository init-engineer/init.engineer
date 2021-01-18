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
    {!! script('js/animal/kohlrabi/predictions.min.js?date=20200507') !!}
@endpush
