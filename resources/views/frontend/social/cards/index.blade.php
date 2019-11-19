@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.social.cards.index'))

@section('content')
    <div class="container my-5">
        <social-cards-list></social-cards-list>
    </div><!--container-->
@endsection
