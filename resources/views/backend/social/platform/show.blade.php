@extends('backend.layouts.app')

@section('title', __('View Platform'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('View Platform')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.social.platform.index')" :text="__('Back')" />
        </x-slot>

        <x-slot name="body">
            <table class="table table-hover">
                <tr>
                    <th>@lang('Platform Name')</th>
                    <td>{{ $platform->name }}</td>
                </tr>

                <tr>
                    <th>@lang('Platform Type')</th>
                    <td>{{ $platform->type }}</td>
                </tr>

                <tr>
                    <th>@lang('Status')</th>
                    <td>@include('backend.social.platform.includes.active', ['platform' => $platform])</td>
                </tr>
            </table>
        </x-slot>

        <x-slot name="footer">
            <small class="float-right text-muted">
                <strong>@lang('Platform Created'):</strong> @displayDate($platform->created_at) ({{ $platform->created_at->diffForHumans() }}),
                <strong>@lang('Last Updated'):</strong> @displayDate($platform->updated_at) ({{ $platform->updated_at->diffForHumans() }})

                @if($platform->trashed())
                    <strong>@lang('Platform Deleted'):</strong> @displayDate($platform->deleted_at) ({{ $platform->deleted_at->diffForHumans() }})
                @endif
            </small>
        </x-slot>
    </x-backend.card>
@endsection
