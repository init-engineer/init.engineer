@extends('frontend.layouts.app')

@section('title', __('Init.Engineer Submit'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-9 order-md-first order-last">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Init.Engineer Submit')
                    </x-slot>

                    <x-slot name="body">
                        <livewire:frontend.social-cards-table livewire:dirty.class="border-red-500"  />
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-9-->

            <div class="col-md-3 order-md-last order-first">
                <x-utils.link
                    {{-- :href="route('frontend.forum.index')" --}}
                    {{-- :active="activeClass(Route::is('frontend.forum.index'))" --}}
                    :text="__('Create Submit')"
                    class="nav-link btn btn-dos py-3 mb-4" />
                <x-utils.link
                    {{-- :href="route('frontend.forum.index')" --}}
                    {{-- :active="activeClass(Route::is('frontend.forum.index'))" --}}
                    :text="__('Picture Submit')"
                    class="nav-link btn btn-dos py-3 mb-4" />
                <x-utils.link
                    {{-- :href="route('frontend.forum.index')" --}}
                    {{-- :active="activeClass(Route::is('frontend.forum.index'))" --}}
                    :text="__('Review Submit')"
                    class="nav-link btn btn-dos py-3 mb-4" />
            </div><!--col-md-3-->
        </div><!--row-->
    </div><!--container-->
@endsection
