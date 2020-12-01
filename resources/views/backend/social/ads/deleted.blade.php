@extends('backend.layouts.app')

@section('title', __('Deleted Ads'))

@section('breadcrumb-links')
    @include('backend.social.ads.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deleted Ads')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.social-ads-table status="deleted" />
        </x-slot>
    </x-backend.card>
@endsection
