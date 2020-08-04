@extends('backend.layouts.app')

@section('title', __('labels.backend.social.cards.management') . ' | ' . __('labels.backend.social.cards.view'))

@section('breadcrumb-links')
@include('backend.social.cards.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.social.cards.management')
                    <small class="text-muted">@lang('labels.backend.social.cards.view')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            @include('backend.social.cards.show.tabs.overview')
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('labels.backend.access.users.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($card->created_at) }} ({{ $card->created_at->diffForHumans() }}),
                    <strong>@lang('labels.backend.access.users.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($card->updated_at) }} ({{ $card->updated_at->diffForHumans() }})
                    @if($card->trashed())
                        <strong>@lang('labels.backend.access.users.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($card->deleted_at) }} ({{ $card->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
