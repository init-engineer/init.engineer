@extends('frontend.layouts.app')

@section('title', __('Dashboard'))
@section('meta_title', appName() . ' | ' . __('Dashboard'))
@section('meta_description', appName() . ' | ' . __('Dashboard'))

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
            <div class="col-md-9 order-md-first order-last">
                <x-frontend.card>
                    <x-slot name="header">
                        <marquee style="height: 32px;">
                            <p style="font-size: 24px; max-width: 1200px;">@lang('Advertising content 4')</p>
                        </marquee>
                    </x-slot>

                    <x-slot name="body">
                        <div class="tab-content" id="dashboard-tabsContent">
                            {{-- 投稿列表 --}}
                            <div class="tab-pane fade show active" id="publish-list" role="tabpanel" aria-labelledby="publish-list-tab">
                                @include('frontend.user.dashboard.tabs.publish-list')
                            </div><!--tab-publish-->
                        </div><!--tab-content-->
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-9-->

            <div class="col-md-3 order-md-last order-first">
                <div class="nav flex-column nav-tabs border-0" id="nav-tab" role="tablist">
                    {{-- 關於我 --}}
                    <x-utils.link
                        :text="__('Publish List')"
                        class="nav-link rounded btn btn-dos py-3 mb-4 active"
                        id="publish-list"
                        data-toggle="pill"
                        href="#publish-list"
                        role="tab"
                        aria-controls="publish-list"
                        aria-selected="true" />
                </div>
            </div><!--col-md-3-->
        </div><!--row-->
    </div>
@endsection
