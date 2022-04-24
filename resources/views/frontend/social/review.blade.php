@extends('frontend.layouts.app')

@section('title', __('Review Submit'))
@section('meta_title', appName() . ' | ' . __('Review Submit'))
@section('meta_description', appName() . ' | ' . __('Review Submit'))

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
            <div class="col order-md-first order-last">
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
            </div><!--col-->
        </div><!--row-->
    </div><!--container-->
@endsection
