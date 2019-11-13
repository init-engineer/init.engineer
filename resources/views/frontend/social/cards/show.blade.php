@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . $card->content)

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col col-12 align-self-center">
                <social-cards-show id="{{ $card->id }}"></social-cards-show>
            </div><!--col-->
        </div><!--row-->
    </div><!--container-->
@endsection
