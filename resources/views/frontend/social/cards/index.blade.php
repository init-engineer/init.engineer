@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.social.cards.index'))

@section('content')
    <div class="container mt-3">
        <financial-status></financial-status>
    </div>

    <div class="container my-3">
        <social-cards-list></social-cards-list>
    </div><!--container-->
@endsection
