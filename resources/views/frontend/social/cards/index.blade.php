@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.social.cards.index'))

@section('content')
    <div class="container mt-3">
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

    <div class="container my-3">
        <social-cards-list></social-cards-list>

        <div class="row">
            <div class="col col-12">
                <label class="col-label">這裡是 Ads 廣告</label>
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-3028179090690423"
                    data-ad-slot="2486547757"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
            </div><!--col-->
        </div><!--row-->
    </div><!--container-->
@endsection
