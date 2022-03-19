@extends('frontend.layouts.app')

@section('title', '動物森友會 - 大頭菜計算機')
@section('meta_keyword', appName() . ' | 動物森友會 - 大頭菜計算機')
@section('meta_description', appName() . ' | 動物森友會 - 大頭菜計算機，計算你的大頭菜')
@section('meta_og_title', appName() . ' | 動物森友會 - 大頭菜計算機')
@section('meta_og_image', asset('img/frontend/banner/turnips-computer.png'))
@section('meta_og_description', appName() . ' | 動物森友會 - 大頭菜計算機，計算你的大頭菜')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center w-100 my-2"><span>大頭菜計算機，計算你的大頭菜</span></h1>
            </div>
            <img class="card-img-top" src="{{ asset('img/frontend/banner/turnips-computer.png') }}" alt="Card image cap">
            <div class="card-body">
                <kohlrabi-computer></kohlrabi-computer>
            </div>
            <div class="card-footer">
                <label class="col-label d-table">這裡是 Ads 廣告</label>
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-3028179090690423"
                    data-ad-slot="2486547757"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
            </div>
        </div>
    </div>
    <!--container-->
@endsection

@push('before-scripts')
    <script src="/js/animal/kohlrabi/predictions.min.js?date=20200507"></script>
@endpush
