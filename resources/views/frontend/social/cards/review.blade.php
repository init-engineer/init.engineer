@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.social.cards.review'))

@section('content')
    <div class="container my-4">
        <social-cards-point></social-cards-point>
        <social-cards-review :is-admin="{{ $logged_in_user->isAdmin()? 1 : 0 }}"></social-cards-review>
        <social-cards-review-top :id="{{ $logged_in_user->id }}"></social-cards-review-top>

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
