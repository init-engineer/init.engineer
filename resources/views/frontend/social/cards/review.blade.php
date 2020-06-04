@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.social.cards.review'))

@section('content')
    <div class="container my-4">
        <social-cards-point></social-cards-point>
        <social-cards-review></social-cards-review>
    </div><!--container-->

    <hr>

    <div class="container mt-3">
        <label class="col-label">這裡是 Ads 廣告</label>
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-3028179090690423"
            data-ad-slot="2486547757"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
    </div>
@endsection

@push('after-scripts')
    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
@endpush
