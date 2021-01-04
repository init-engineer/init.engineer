@extends('frontend.layouts.app')

@section('title', app_name() . ' | 線上求籤服務')
@section('meta_keyword', app_name() . ' | 線上求籤服務，問天、問地、問自己，不如問問純靠北工程師《線上求籤服務》，想幫朋友求籤嗎？先承認你就是你朋友。')
@section('meta_description', app_name() . ' | 問天、問地、問自己，不如問問純靠北工程師《線上求籤服務》，想幫朋友求籤嗎？先承認你就是你朋友。')
@section('meta_og_title', app_name() . ' | 線上求籤服務')
@section('meta_og_image', '/img/frontend/banner/navbar05.png')
@section('meta_og_description', app_name() . ' | 問天、問地、問自己，不如問問純靠北工程師《線上求籤服務》，想幫朋友求籤嗎？先承認你就是你朋友。')

@section('content')
    <div class="container my-3">
        <fortunes-switch></fortunes-switch>

        <label class="col-label bg-color-primary color-color-primary mt-2">資料來源</label>
        <div class="w-100 m-0 p-2 bg-color-primary">
            <ul class="mb-0 pl-4">
                <li><a class="color-color-primary" href="http://www.chance.org.tw">籤詩網‧淺草觀音寺一百籤</a></li>
                <li><a class="color-color-primary" href="https://omikuji-guide.com">おみくじ1～100番の解説まとめ</a></li>
            </ul>
        </div>
    </div><!--container-->
@endsection
