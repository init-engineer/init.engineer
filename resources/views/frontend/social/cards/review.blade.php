@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.social.cards.review'))

@section('content')
    <div class="container my-4">
        <social-cards-point></social-cards-point>
        <social-cards-review :is-admin="{{ $logged_in_user->isAdmin()? 1 : 0 }}"></social-cards-review>
        <social-cards-review-top :id="{{ $logged_in_user->id }}"></social-cards-review-top>
    </div><!--container-->
@endsection
