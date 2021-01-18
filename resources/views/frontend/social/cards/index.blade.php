@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.social.cards.index'))

@section('content')
    <div class="container mt-3">
        <label class="col-label">這裡是 Ads 廣告</label>
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-3028179090690423"
            data-ad-slot="2486547757"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
    </div>

    <div class="container my-3">
        <social-cards-list></social-cards-list>
    </div><!--container-->
@endsection
