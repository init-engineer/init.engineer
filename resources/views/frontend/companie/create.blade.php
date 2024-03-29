@extends('frontend.layouts.app')

@section('title', __('Companie Create'))
@section('meta_title', appName() . ' | ' . __('Companie Create'))
@section('meta_description', appName() . ' | ' . __('Companie Create'))

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
            <div class="col">
                <x-frontend.card>
                    <x-slot name="header">
                        <marquee style="height: 32px;">
                            <p style="font-size: 24px; max-width: 1200px;">@lang('Advertising content 3')</p>
                        </marquee>
                    </x-slot>

                    <x-slot name="body">
                        <create-companie></create-companie>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-9-->
        </div><!--row-->
    </div><!--container-->
@endsection
