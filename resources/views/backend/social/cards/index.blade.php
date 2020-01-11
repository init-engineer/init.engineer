@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.social.cards.management'))

@section('breadcrumb-links')
    @include('backend.social.cards.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.social.cards.management') }} <small class="text-muted">{{ __('labels.backend.social.cards.active') }}</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('labels.backend.social.cards.table.id')</th>
                                <th>@lang('labels.backend.social.cards.table.user')</th>
                                <th>@lang('labels.backend.social.cards.table.content')</th>
                                <th>@lang('labels.backend.social.cards.table.socials')</th>
                                <th>@lang('labels.backend.social.cards.table.last_updated')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cards as $card)
                                <tr>
                                    <td><h4><span class="badge badge-dark" data-toggle="tooltip" data-placement="top" title="ID: {{ $card->id }}">#{{ app_name() . base_convert($card->id, 10, 36) }}</span></h4></td>
                                    <td>
                                        <div class="media">
                                            <div class="media-left">
                                                <img class="media-object img-fluid rounded mr-1" src="{{ $card->model->getPicture() }}" style="max-width: 48px;max-height: 48px;" alt="{{ $card->model->email }}">
                                            </div>
                                            <div class="media-body p-0">
                                                <h4 class="media-heading">{{ $card->model->full_name }}</h4>
                                                <p>{{ $card->model->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="max-width: 24rem;">
                                        <div class="media">
                                            <div class="media-left">
                                                <img class="media-object img-fluid rounded mr-1" src="{{ $card->images->first()->getPicture() }}" style="max-width: 128px;max-height: 128px;" alt="{{ $card->content }}">
                                            </div>
                                            <div class="media-body p-0">
                                                <p class="lead">{{ $card->content }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($card->medias as $media)
                                                <li>{{ $media->social_type }} - {{ $media->social_connections }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $card->updated_at->diffForHumans() }}</td>
                                    <td>@include('backend.social.cards.includes.actions', ['card' => $card])</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $cards->total() !!} {{ trans_choice('labels.backend.social.cards.table.total', $cards->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $cards->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
