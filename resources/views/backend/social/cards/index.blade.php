@extends('backend.layouts.app')

@section('title', __('Cards Management'))

@section('breadcrumb-links')
    @include('backend.social.cards.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Cards Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess() |
             $logged_in_user->can('admin.social') ||
             $logged_in_user->can('admin.social.cards') ||
             $logged_in_user->can('admin.social.cards.list') ||
             $logged_in_user->can('admin.social.cards.deactivate') ||
             $logged_in_user->can('admin.social.cards.reactivate'))
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.social.cards.create')"
                    :text="__('Create Cards')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.social-cards-table />
        </x-slot>
    </x-backend.card>
@endsection
