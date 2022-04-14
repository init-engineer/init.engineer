@extends('backend.layouts.app')

@section('title', __('Announcement Management'))

@section('breadcrumb-links')
    @include('backend.announcement.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Announcement Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess() |
             $logged_in_user->can('admin.announcement') ||
             $logged_in_user->can('admin.announcement.list') ||
             $logged_in_user->can('admin.announcement.deactivate') ||
             $logged_in_user->can('admin.announcement.reactivate'))
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.social.ads.create')"
                    :text="__('Create Ads')"
                />
            </x-slot>
        @endif

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.announcement.create')"
                :text="__('Create Announcement')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.announcement-table />
        </x-slot>
    </x-backend.card>
@endsection
