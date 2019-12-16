@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.news.management'))

@section('breadcrumb-links')
    @include('backend.news.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="news-title mb-0">
                    {{ __('labels.backend.news.management') }} <small class="text-muted">{{ __('labels.backend.news.active') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.news.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('labels.backend.news.table.id')</th>
                                <th>@lang('labels.backend.news.table.content')</th>
                                <th>@lang('labels.backend.news.table.last_updated')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $article)
                                <tr>
                                    <td>#{{ $article->id }}</td>
                                    <td style="max-width: 24rem;">
                                        <div class="media">
                                            <div class="media-left">
                                                <img class="media-object img-fluid rounded mr-1" src="{{ $article->getPicture() }}" style="max-width: 128px;max-height: 128px;">
                                            </div>
                                            <div class="media-body p-0">
                                                <p class="lead">{{ $article->title }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $article->updated_at->diffForHumans() }}</td>
                                    <td>@include('backend.news.includes.actions', ['news' => $article])</td>
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
                    {!! $news->total() !!} {{ trans_choice('labels.backend.news.table.total', $news->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $news->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--news-body-->
</div><!--news-->
@endsection
