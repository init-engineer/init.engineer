@extends('backend.layouts.app')

@section('title', __('Deactivated Platform'))

@section('breadcrumb-links')
    @include('backend.social.platform.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deactivated Platform')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.social-platform-table status="deactivated" />
        </x-slot>
    </x-backend.card>
@endsection
