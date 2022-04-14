@extends('frontend.layouts.app')

@section('title', __('My Account'))
@section('meta_title', appName() . ' | ' . __('My Account'))
@section('meta_description', appName() . ' | ' . __('My Account'))

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
                            <p style="font-size: 24px; max-width: 1200px;">@lang('Advertising content 3')</p>
                        </marquee>
                    </x-slot>

                    <x-slot name="body">
                        <div class="tab-content" id="my-profile-tabsContent">
                            {{-- 關於我 --}}
                            <div class="tab-pane fade show active" id="my-profile" role="tabpanel" aria-labelledby="my-profile-tab">
                                @include('frontend.user.account.tabs.profile')
                            </div><!--tab-profile-->

                            {{-- 編輯訊息 --}}
                            <div class="tab-pane fade" id="information" role="tabpanel" aria-labelledby="information-tab">
                                @include('frontend.user.account.tabs.information')
                            </div><!--tab-information-->

                            {{-- 設定密碼 --}}
                            @if (! $logged_in_user->isSocial())
                                <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                    @include('frontend.user.account.tabs.password')
                                </div><!--tab-password-->
                            @endif

                            {{-- 雙重身分驗證 --}}
                            <div class="tab-pane fade" id="two-factor-authentication" role="tabpanel" aria-labelledby="two-factor-authentication-tab">
                                @include('frontend.user.account.tabs.two-factor-authentication')
                            </div><!--tab-f2a-->
                        </div><!--tab-content-->
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-9-->

            <div class="col-md-3 order-md-last order-first">
                <div class="nav flex-column nav-tabs border-0" id="nav-tab" role="tablist">
                    {{-- 關於我 --}}
                    <x-utils.link
                        :text="__('My Profile')"
                        class="nav-link rounded btn btn-dos py-3 mb-4 active"
                        id="my-profile-tab"
                        data-toggle="pill"
                        href="#my-profile"
                        role="tab"
                        aria-controls="my-profile"
                        aria-selected="true" />

                    {{-- 編輯訊息 --}}
                    <x-utils.link
                        :text="__('Edit Information')"
                        class="nav-link rounded btn btn-dos py-3 mb-4"
                        id="information-tab"
                        data-toggle="pill"
                        href="#information"
                        role="tab"
                        aria-controls="information"
                        aria-selected="false"/>

                    {{-- 設定密碼 --}}
                    @if (! $logged_in_user->isSocial())
                        <x-utils.link
                            :text="__('Reset Password')"
                            class="nav-link rounded btn btn-dos py-3 mb-4"
                            id="password-tab"
                            data-toggle="pill"
                            href="#password"
                            role="tab"
                            aria-controls="password"
                            aria-selected="false" />
                    @endif

                    {{-- 雙重身分驗證 --}}
                    <x-utils.link
                        :text="__('Two Factor Authentication')"
                        class="nav-link rounded btn btn-dos py-3 mb-4"
                        id="two-factor-authentication-tab"
                        data-toggle="pill"
                        href="#two-factor-authentication"
                        role="tab"
                        aria-controls="two-factor-authentication"
                        aria-selected="false"/>
                </div>
            </div><!--col-md-3-->
        </div><!--row-->
    </div>
@endsection
