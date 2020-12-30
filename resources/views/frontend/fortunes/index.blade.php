@extends('frontend.layouts.app')

@section('title', app_name() . ' | 線上求籤服務')
@section('meta_keyword', app_name() . ' | 線上求籤服務，問天、問地、問自己，不如問問純靠北工程師《線上求籤服務》，想幫朋友求籤嗎？先承認你就是你朋友。')
@section('meta_description', app_name() . ' | 問天、問地、問自己，不如問問純靠北工程師《線上求籤服務》，想幫朋友求籤嗎？先承認你就是你朋友。')
@section('meta_og_title', app_name() . ' | 線上求籤服務')
@section('meta_og_image', '/img/frontend/banner/navbar05.png')
@section('meta_og_description', app_name() . ' | 問天、問地、問自己，不如問問純靠北工程師《線上求籤服務》，想幫朋友求籤嗎？先承認你就是你朋友。')

@section('content')
    <div class="container my-3">
        <fortunes-tools></fortunes-tools>
    </div><!--container-->
@endsection
