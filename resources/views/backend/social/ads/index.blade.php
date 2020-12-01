@extends('backend.layouts.app')

@section('title', __('Ads Management'))

@section('breadcrumb-links')
    @include('backend.social.ads.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Ads Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.social.ads.create')"
                    :text="__('Create Ads')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.social-ads-table />
        </x-slot>
    </x-backend.card>
@endsection
