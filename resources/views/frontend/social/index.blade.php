@extends('frontend.layouts.app')

@section('title', __('Init.Engineer Submit'))

@push('after-styles')
    <style>
        .card-header {
            padding: 2px !important;
            margin: 0px !important;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-9 order-md-first order-last">
                <x-frontend.card>
                    <x-slot name="header">
                        <marquee style="height: 32px;">
                            <p style="font-size: 24px;">@lang('Advertising content 1')</p>
                        </marquee>
                    </x-slot>

                    <x-slot name="body">
                        <livewire:frontend.social-cards-table livewire:dirty.class="border-red-500"  />
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-9-->

            <div class="col-md-3 order-md-last order-first">
                <x-utils.link
                    :href="route('frontend.social.cards.publish.article')"
                    :text="__('Create Submit')"
                    class="nav-link btn btn-dos py-3 mb-4" />
                <x-utils.link
                    :href="route('frontend.social.cards.publish.picture')"
                    :text="__('Picture Submit')"
                    class="nav-link btn btn-dos py-3 mb-4" />
                <x-utils.link
                    {{-- :href="route('frontend.forum.index')" --}}
                    :text="__('Review Submit')"
                    class="nav-link btn btn-dos py-3 mb-4" />
            </div><!--col-md-3-->
        </div><!--row-->
    </div><!--container-->
@endsection
