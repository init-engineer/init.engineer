@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . $card->content)
@section('meta_keyword', app_name() . ' | ' . $card->content)
@section('meta_description', app_name() . ' | ' . $card->content)
@section('meta_og_title', app_name() . ' | ' . $card->content)
@section('meta_og_image', $image)
@section('meta_og_description', app_name() . ' | ' . $card->content)

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col col-12 align-self-center">
                <social-cards-show id="{{ $card->id }}" content="{{ $card->content }}" image="{{ $image }}" created="{{ $card->created_at->diffForHumans() }}"></social-cards-show>
            </div><!--col-->

            <div class="col col-12">
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

@push('after-scripts')
    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
@endpush
