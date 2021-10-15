@extends('frontend.layouts.app')

@section('title', __('Init.Engineer Companie'))

@push('after-styles')
    <style>
        .card-header {
            padding: 2px !important;
            margin: 0px !important;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4" style="max-width: 100vw;">
        <div class="row justify-content-center">
            {{-- 職缺列表 --}}
            <div class="col-md-9">
                <x-frontend.card>
                    <x-slot name="header">
                        <marquee style="height: 32px;">
                            <p style="font-size: 24px; max-width: 1200px;">@lang('Advertising content 5')</p>
                        </marquee>
                    </x-slot>

                    <x-slot name="body">
                        <livewire:frontend.companie-self-table :user="$logged_in_user" />
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-9-->

            {{-- 聲明指引 --}}
            <div class="col-md-3">
                {{-- 相關連結 --}}
                <div class="nav flex-column nav-tabs border-0" id="nav-tab" role="tablist">
                    {{-- 建立公司資訊 --}}
                    <x-utils.link
                        :href="route('frontend.companie.create')"
                        :text="__('Companie Create')"
                        class="nav-link rounded btn btn-dos py-3 mb-5" />
                </div>

                {{-- 教學引導 --}}
                <div class="jumbotron bg-dark text-white p-4 mb-0 alert alert-dismissible fade show" style="top: 0px;" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h1>教學引導</h1>
                    <p class="lead">我們提供基本的職缺刊登服務，這項服務的流程如下：</p>

                    <div class="col-md-12" id="flowchart">
                        <div class="row">
                            <ul class="col-12">
                                <li class="flow-step flow-light">
                                    <p class="mb-0">來到「公司管理」</p>
                                    <h5>
                                        <span class="badge badge-pill badge-secondary">您現在在這裡</span>
                                    </h5>
                                </li>
                                <li class="flow-arrow">
                                    <i class="fas fa-arrow-down"></i>
                                </li>
                                <li class="flow-step flow-light">
                                    <p class="mb-0">建立公司資訊</p>
                                    <a href="{{ route('frontend.companie.create') }}" class="p-0">
                                        <h5>
                                            <span class="badge badge-pill badge-primary">前往建立</span>
                                        </h5>
                                    </a>
                                </li>
                                <li class="flow-arrow">
                                    <i class="fas fa-arrow-down"></i>
                                </li>
                                <li class="flow-step flow-light">
                                    <p class="mb-0">選擇指定公司</p>
                                </li>
                                <li class="flow-arrow">
                                    <i class="fas fa-arrow-down"></i>
                                </li>
                                <li class="flow-step flow-light">
                                    <p class="mb-0">新增職缺</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!--col-md-3-->
        </div><!--row-->
    </div><!--container-->
@endsection
