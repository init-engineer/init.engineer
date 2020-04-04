@extends('frontend.layouts.app')

@section('title', app_name() . ' | 動物森友會 - 大頭菜計算機')
@section('meta_keyword', app_name() . ' | 動物森友會 - 大頭菜計算機')
@section('meta_description', app_name() . ' | 動物森友會 - 大頭菜計算機，計算你的大頭菜')
@section('meta_og_title', app_name() . ' | 動物森友會 - 大頭菜計算機')
@section('meta_og_image', asset('img/frontend/banner/KohlrabiComputer.png'))
@section('meta_og_description', app_name() . ' | 動物森友會 - 大頭菜計算機，計算你的大頭菜')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col col-12 align-self-center">
                <img class="img-fluid rounded mb-5 w-100" src="{{ asset('img/frontend/banner/KohlrabiComputer.png') }}" />
                <kohlrabi-computer></kohlrabi-computer>
            </div><!--col-->
        </div><!--row-->
    </div><!--container-->
@endsection
