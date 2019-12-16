@extends('backend.layouts.app')

@section('title', __('labels.backend.news.management') . ' | ' . __('labels.backend.news.create'))

@section('breadcrumb-links')
    @include('backend.news.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->modelForm($logged_in_user, 'POST', route('admin.news.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.news.management')
                            <small class="text-muted">@lang('labels.backend.news.create')</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.news.title'))->class('col-md-2 form-control-label')->for('title') }}

                            <div class="col-md-10">
                                {{ html()->text('title')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.news.title'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.news.image'))->class('col-md-2 form-control-label')->for('image') }}

                            <div class="col-md-10">
                                {{ html()->file('image')
                                    ->class('form-control')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.news.url'))->class('col-md-2 form-control-label')->for('url') }}

                            <div class="col-md-10">
                                {{ html()->text('url')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.news.url'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.news.hashtag'))->class('col-md-2 form-control-label')->for('hashtag') }}

                            <div class="col-md-10">
                                {{ html()->text('hashtag')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.news.hashtag')) }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.news.layout'))->class('col-md-2 form-control-label')->for('layout') }}

                            <div class="col-md-10">
                                {{ html()->text('layout')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.news.layout')) }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.news.content'))->class('col-md-12 form-control-label')->for('content') }}

                            <div class="col-md-12">
                                {{ html()->textarea('content')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.news.content'))
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.news.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->closeModelForm() }}
@endsection

@push('after-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endpush

@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script>
        let simplemde = new SimpleMDE({ element: document.getElementById("content") });
    </script>
@endpush
