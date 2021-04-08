@extends('backend.layouts.app')

@section('title', __('Deactivated Announcement'))

@section('breadcrumb-links')
    @include('backend.announcement.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deactivated Announcement')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.announcement-table status="deactivated" />
        </x-slot>
    </x-backend.card>
@endsection
