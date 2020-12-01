@extends('backend.layouts.app')

@section('title', __('Deactivated Ads'))

@section('breadcrumb-links')
    @include('backend.social.ads.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deactivated Ads')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.social-ads-table status="deactivated" />
        </x-slot>
    </x-backend.card>
@endsection
