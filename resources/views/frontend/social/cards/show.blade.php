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
        </div><!--row-->
    </div><!--container-->
@endsection
