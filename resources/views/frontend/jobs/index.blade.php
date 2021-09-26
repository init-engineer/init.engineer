@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('content')
    <div class="container-fluid py-4" style="max-width: 100vw;">
        <div class="row justify-content-center">
            {{-- 職缺列表 --}}
            <div class="col-md-9">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Dashboard')
                    </x-slot>

                    <x-slot name="body">
                        @lang('Welcome to the Dashboard')
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-9-->

            {{-- 聲明指引 --}}
            <div class="col-md-3">
                <div class="jumbotron bg-dark text-white p-4 alert alert-dismissible fade show" style="top: 0px;" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h1>嗨囉！</h1>
                    <p class="lead">其實媒合職缺這件事並不是我們的主要項目，因此在使用我們的職缺媒合服務的同時，我們也推薦使用其他我們覺得不錯的求職平台。</p>
                    <a href="https://www.yourator.co/">
                        <img class="rounded mx-auto d-block mt-2 w-100" src="https://gblobscdn.gitbook.com/assets%2F-LQCD6tYJNxEjh5b4OTC%2F-LQCWxAhG8poPXtd3jMf%2F-LQCXcbmEryZAh1RCjDj%2FYouratorImg.png?alt=media&token=5564bb36-534c-4036-9f02-547a44fa1c56" alt="Yourator">
                    </a>
                    <a href="https://www.cakeresume.com/">
                        <img class="rounded mx-auto d-block mt-2 w-100" src="https://spa-assets.cakeresume.com/assets/4b129a8f0a7bb722f9f1d26d2dcc6472.png" alt="CakeResume">
                    </a>
                    <a href="https://meet.jobs/">
                        <img class="rounded mx-auto d-block mt-2 w-100" src="https://assets.meet.jobs/uploads/marketing/zh-TW/11/consulting-01.jpg" alt="Meet.jobs">
                    </a>
                </div>
            </div><!--col-md-3-->
        </div><!--row-->
    </div><!--container-->
@endsection
