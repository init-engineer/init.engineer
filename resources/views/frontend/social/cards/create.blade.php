@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.social.cards.create'))

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col col-12 align-self-center">
                <social-cards-create :is-admin="{{ $logged_in_user->isAdmin()? 1 : 0 }}"></social-cards-create>
            </div><!--col-->
        </div><!--row-->
    </div><!--container-->
@endsection
