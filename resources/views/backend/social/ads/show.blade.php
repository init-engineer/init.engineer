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
                    <td><img src="{{ $ads->getPicture() }}" class="img-fluid rounded" style="max-width: 100%;" alt="{{ old('name') ?? $ads->name }}" /></td>
                </tr>

                <tr>
                    <th>@lang('Author')</th>
                    <td>
                        <a href="{{ route('admin.auth.user.show', ['user' => $ads->model]) }}">
                            <img src="{{ $ads->model->avatar }}" class="img-fluid rounded user-profile-image">
                            <div class="m-2" style="display: inline; position: absolute;">
                                <strong style="font-weight: 600; font-size: 24px; color: #597a96; display: inherit;">{{ $ads->model->name }}</strong>
                                <span style="font-size: 16px; font-weight: 400; color: #aab8c2;">{{ $ads->model->email }}</span>
                            </div>
                        </a>
                    </td>
                </tr>

                <tr>
                    <th>@lang('Type')</th>
                    <td>{{ __($ads->type) }}</td>
                </tr>

                <tr>
                    <th>@lang('Name')</th>
                    <td>{{ $ads->name }}</td>
                </tr>

                <tr>
                    <th>@lang('Content')</th>
                    @if (isset($ads->content))
                        <td>{{ $ads->content }}</td>
                    @else
                        <td>{{ __('Undefined') }}</td>
                    @endif
                </tr>

                <tr>
                    <th>@lang('Probability')</th>
                    <td><strong style="font-weight: 600; font-size: 24px; color: #597a96; display: inherit;">{{ number_format($ads->probability / 100, 2) }}%</strong></td>
                </tr>

                <tr>
                    <th>@lang('Starts At')</th>
                    <td>
                        <div style="position: inherit;">
                            <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">{{ $ads->starts_at->toDateString() }}</strong>
                            <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">{{ $ads->starts_at->diffForHumans() }}</span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>@lang('Ends At')</th>
                    <td>
                        <div style="position: inherit;">
                            <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">{{ $ads->ends_at->toDateString() }}</strong>
                            <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">{{ $ads->ends_at->diffForHumans() }}</span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>@lang('Status')</th>
                    <td>@include('backend.social.ads.includes.render', ['ads' => $ads])</td>
                </tr>

                <tr>
                    <th>@lang('Status')</th>
                    <td>@include('backend.social.ads.includes.active', ['ads' => $ads])</td>
                </tr>

                <tr>
                    <th>@lang('Payment Status')</th>
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
