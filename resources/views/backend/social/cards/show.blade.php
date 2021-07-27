@extends('backend.layouts.app')

@section('title', __('View Cards'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('View Cards')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.social.cards.index')" :text="__('Back')" />
        </x-slot>

        <x-slot name="body">
            <div class="row">
                <div class="col-3">
                    <div class="text-center">
                        <img src="{{ $cards->model->avatar }}" class="img-circle img-thumbnail" style="height: 128px; width: 128px; object-fit: cover;" alt="avatar">
                        <h1>{{ $cards->model->name }}</h1>
                        <h6>{{ $cards->model->email }}</h6>
                    </div>
                </div><!-- col-3 -->

                <div class="col-9">
                    <table class="table table-hover">
                        <tr>
                            <th>@lang('Cards Banner')</th>
                            <td><img src="{{ $cards->getPicture() }}" class="img-fluid rounded" style="max-width: 100%;" alt="{{ old('content') ?? $cards->content }}" /></td>
                        </tr>

                        <tr>
                            <th>@lang('Content')</th>
                            <td><p>{{ $cards->content }}</p></td>
                        </tr>

                        <tr>
                            <th>@lang('Ads Config')</th>
                            <td></td>
                        </tr>

                        <tr>
                            <th>@lang('')</th>
                            <td></td>
                        </tr>
                    </table>
                </div><!-- col-9 -->
            </div><!-- row -->
        </x-slot>

        <x-slot name="footer">
            <small class="float-right text-muted">
                <strong>@lang('Cards Created'):</strong> @displayDate($cards->created_at) ({{ $cards->created_at->diffForHumans() }}),
                <strong>@lang('Last Updated'):</strong> @displayDate($cards->updated_at) ({{ $cards->updated_at->diffForHumans() }})

                @if($cards->trashed())
                    <strong>@lang('Cards Deleted'):</strong> @displayDate($cards->deleted_at) ({{ $cards->deleted_at->diffForHumans() }})
                @endif
            </small>
        </x-slot>
    </x-backend.card>

    <x-backend.card>
        <x-slot name="header">
            @lang('View Platform')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.social.cards.index')" :text="__('Back')" />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.social-platform-table cards="{{ $cards->id }}" />
        </x-slot>
    </x-backend.card>

    <x-backend.card>
        <x-slot name="header">
            @lang('View Comments')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.social.cards.index')" :text="__('Back')" />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.social-comments-table cards="{{ $cards->id }}" />
        </x-slot>
    </x-backend.card>
@endsection
