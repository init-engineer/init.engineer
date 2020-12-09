@extends('backend.layouts.app')

@section('title', __('Deleted Platform'))

@section('breadcrumb-links')
    @include('backend.social.platform.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deleted Platform')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.social-platform-table status="deleted" />
        </x-slot>
    </x-backend.card>
@endsection
