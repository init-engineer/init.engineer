@extends('frontend.layouts.app')

@section('title', __('Init.Engineer Submit'))

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
                    {{-- :href="route('frontend.forum.index')" --}}
                    {{-- :active="activeClass(Route::is('frontend.forum.index'))" --}}
                    :text="__('Create Submit')"
                    class="nav-link btn btn-dos mb-4" />

                <x-utils.link
                    {{-- :href="route('frontend.forum.index')" --}}
                    {{-- :active="activeClass(Route::is('frontend.forum.index'))" --}}
                    :text="__('Review Submit')"
                    class="nav-link btn btn-dos mb-4" />
            </div><!--col-md-3-->
        </div><!--row-->
    </div><!--container-->
@endsection
