@extends('backend.layouts.app')

@section('title', __('Platform Management'))

@section('breadcrumb-links')
    @include('backend.social.platform.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Platform Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.social.platform.create')"
                    :text="__('Create Platform')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.social-platform-table />
        </x-slot>
    </x-backend.card>
@endsection
