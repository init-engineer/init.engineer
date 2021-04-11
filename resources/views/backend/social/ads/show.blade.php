@extends('backend.layouts.app')

@section('title', __('View Ads'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('View Ads')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.social.ads.index')" :text="__('Back')" />
        </x-slot>

        <x-slot name="body">
            <table class="table table-hover">
                <tr>
                    <th>@lang('Ads Banner')</th>
                    <td><img src="{{ $ads->getBanner() }}" class="img-fluid rounded" style="max-width: 720px;" /></td>
                </tr>

                <tr>
                    <th>@lang('Name')</th>
                    <td>{{ $ads->name }}</td>
                </tr>

                <tr>
                    <th>@lang('Creator')</th>
                    <td>{!! $ads->getProfileHtml() !!}</td>
                </tr>

                <tr>
                    <th>@lang('Number Max')</th>
                    <td>{{ $ads->number_max }}</td>
                </tr>

                <tr>
                    <th>@lang('Number Min')</th>
                    <td>{{ $ads->number_min }}</td>
                </tr>

                <tr>
                    <th>@lang('Incidence')</th>
                    <td>{{ $ads->incidence / 100 }}%</td>
                </tr>

                <tr>
                    <th>@lang('Starts At')</th>
                    <td>{{ $ads->starts_at->toDateString() }}</td>
                </tr>

                <tr>
                    <th>@lang('Ends At')</th>
                    <td>{{ $ads->ends_at->toDateString() }}</td>
                </tr>

                <tr>
                    <th>@lang('Status')</th>
                    <td>@include('backend.social.ads.includes.active', ['ads' => $ads])</td>
                </tr>

                <tr>
                    <th>@lang('Payment')</th>
                    <td>@include('backend.social.ads.includes.payment', ['ads' => $ads])</td>
                </tr>
            </table>
        </x-slot>

        <x-slot name="footer">
            <small class="float-right text-muted">
                <strong>@lang('Ads Created'):</strong> @displayDate($ads->created_at) ({{ $ads->created_at->diffForHumans() }}),
                <strong>@lang('Last Updated'):</strong> @displayDate($ads->updated_at) ({{ $ads->updated_at->diffForHumans() }})

                @if($ads->trashed())
                    <strong>@lang('Ads Deleted'):</strong> @displayDate($ads->deleted_at) ({{ $ads->deleted_at->diffForHumans() }})
                @endif
            </small>
        </x-slot>
    </x-backend.card>
@endsection
