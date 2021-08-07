@extends('frontend.layouts.app')

@section('title', __('Create Post'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
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

            <div class="col-md-3">
                <x-utils.link
                    {{-- :href="route('admin.dashboard')" --}}
                    class="btn btn-block p-0">
                    <img src="https://init.engineer/img/frontend/button/tools-button-post-publish.png" class="w-100" style="background-size: cover; background-repeat: no-repeat;" />
                </x-utils.link>

                <x-utils.link
                    {{-- :href="route('admin.dashboard')" --}}
                    class="btn btn-block p-0">
                    <img src="https://init.engineer/img/frontend/button/tools-button-post-review.png" class="w-100" style="background-size: cover; background-repeat: no-repeat;" />
                </x-utils.link>
            </div><!--col-md-3-->
        </div><!--row-->
    </div><!--container-->
@endsection
