@extends('backend.layouts.app')

@section('title', __('Deleted Cards'))

@section('breadcrumb-links')
    @include('backend.social.cards.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deleted Cards')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.social-cards-table status="deleted" />
        </x-slot>
    </x-backend.card>
@endsection
