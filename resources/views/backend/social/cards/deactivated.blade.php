@extends('backend.layouts.app')

@section('title', __('Deactivated Cards'))

@section('breadcrumb-links')
    @include('backend.social.cards.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deactivated Cards')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.social-cards-table status="deactivated" />
        </x-slot>
    </x-backend.card>
@endsection
