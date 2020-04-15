@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.social.cards.index'))

@section('content')
    <div class="container my-5">
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-3028179090690423"
            data-ad-slot="2486547757"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
    </div>

    <div class="container my-5">
        <social-cards-list></social-cards-list>
    </div><!--container-->
@endsection

@push('after-scripts')
    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
@endpush
