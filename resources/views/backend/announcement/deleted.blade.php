@extends('backend.layouts.app')

@section('title', __('Deleted Announcement'))

@section('breadcrumb-links')
    @include('backend.announcement.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deleted Announcement')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.announcement-table status="deleted" />
        </x-slot>
    </x-backend.card>
@endsection
