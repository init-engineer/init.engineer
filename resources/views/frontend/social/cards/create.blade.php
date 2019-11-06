@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col col-12 align-self-center">
                <social-cards-create></social-cards-create>
            </div><!--col-->
        </div><!--row-->
    </div><!--container-->
@endsection
