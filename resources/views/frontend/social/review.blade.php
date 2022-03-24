@extends('frontend.layouts.app')

@section('title', __('Review Submit'))
@section('meta_title', __('Review Submit'))
@section('meta_description', __('Review Submit'))

@push('after-styles')
    <style>
        .card-header {
            padding: 2px !important;
            margin: 0px !important;
        }
        .svg-image {
            display: block;
            width: 48px;
            height: 48px;
            position: absolute;
            right: 16px;
            transform: rotate(36deg);
            filter: invert(70%) opacity(70%);
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4" style="max-width: 100vw;">
        <div class="row justify-content-center">
            <div class="col-md-9 order-md-first order-last">
                <x-frontend.card>
                    <x-slot name="header">
                        <marquee style="height: 32px;">
                            <p style="font-size: 24px; max-width: 1200px;">@lang('Advertising content 2')</p>
                        </marquee>
                    </x-slot>

                    <x-slot name="body">
                        <livewire:frontend.social-cards-review-table />
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-9-->

            <div class="col-md-3 order-md-last order-first">
                <div class="nav flex-column nav-tabs border-0" id="nav-tab" role="tablist">
                    {{-- 文章投稿的按鈕 --}}
                    <div>
                        <img class="svg-image" src="/img/icon/paper.svg" alt="{{ __('Create Submit') }}" />
                        <x-utils.link
                            :href="route('frontend.social.cards.publish.article')"
                            :text="__('Create Submit')"
                            class="nav-link rounded btn btn-dos py-3 mb-4" />
                    </div>
                    {{-- 圖片投稿的按鈕 --}}
                    <div>
                        <img class="svg-image" src="/img/icon/painting.svg" alt="{{ __('Picture Submit') }}" />
                        <x-utils.link
                            :href="route('frontend.social.cards.publish.picture')"
                            :text="__('Picture Submit')"
                            class="nav-link rounded btn btn-dos py-3 mb-4" />
                    </div>
                    {{-- 文章列表的按鈕 --}}
                    <div>
                        <img class="svg-image" src="/img/icon/clipboard.svg" alt="{{ __('Init.Engineer Submit') }}" />
                        <x-utils.link
                            :href="route('frontend.social.cards.index')"
                            :text="__('Init.Engineer Submit')"
                            class="nav-link rounded btn btn-dos py-3 mb-4" />
                    </div>
                </div>
            </div><!--col-md-3-->
        </div><!--row-->
    </div><!--container-->
@endsection
