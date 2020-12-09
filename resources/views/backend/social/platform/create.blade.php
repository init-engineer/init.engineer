@inject('model', '\App\Domains\Social\Models\Platform')

@extends('backend.layouts.app')

@section('title', __('Create Platform'))

@section('content')
    <x-forms.post :action="route('admin.social.platform.store')" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Platform')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.social.platform.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div x-data="{platformName : '{{ $model::PLATFORM_PRIMARY }}', platformType : '{{ $model::TYPE_FACEBOOK }}'}">
                    <div class="form-group row" >
                        <label for="platformName" class="col-md-2 col-form-label">@lang('Platform Name')</label>

                        <div class="col-md-10">
                            <select name="platformName" class="form-control" required x-on:change="platformName = $event.target.value">
                                <option value="{{ $model::PLATFORM_PRIMARY }}">@lang('Primary')</option>
                                <option value="{{ $model::PLATFORM_SECONDARY }}">@lang('Secondary')</option>
                                <option value="{{ $model::PLATFORM_TESTING }}">@lang('Testing')</option>
                            </select>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="platformType" class="col-md-2 col-form-label">@lang('Platform Type')</label>

                        <div class="col-md-10">
                            <select name="platformType" class="form-control" required x-on:change="platformType = $event.target.value">
                                <option value="{{ $model::TYPE_FACEBOOK }}">@lang('Facebook')</option>
                                <option value="{{ $model::TYPE_TWITTER }}">@lang('Twitter')</option>
                                <option value="{{ $model::TYPE_PLURK }}">@lang('Plurk')</option>
                            </select>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="active" class="col-md-2 col-form-label">@lang('Active')</label>

                        <div class="col-md-10">
                            <div class="form-check">
                                <input name="active" id="active" class="form-check-input" type="checkbox" value="1" {{ old('active', true) ? 'checked' : '' }} />
                            </div><!--form-check-->
                        </div>
                    </div><!--form-group-->

                    <hr />

                    <div class="form-group row">
                        <label for="type" class="col-md-2 col-form-label">@lang('Config')</label>

                        <div class="col-md-10">
                            <input type="text" name="user_id" id="user_id" class="form-control mb-2" placeholder="{{ __('User ID') }}" x-show="platformType === '{{ $model::TYPE_FACEBOOK }}'" />
                            <input type="text" name="app_id" id="app_id" class="form-control mb-2" placeholder="{{ __('App ID') }}" x-show="platformType === '{{ $model::TYPE_FACEBOOK }}'" />
                            <input type="text" name="app_secret" id="app_secret" class="form-control mb-2" placeholder="{{ __('App Secret') }}" x-show="platformType === '{{ $model::TYPE_FACEBOOK }}'" />
                            <input type="text" name="graph_version" id="graph_version" class="form-control mb-2" placeholder="{{ __('Graph Version') }}" x-show="platformType === '{{ $model::TYPE_FACEBOOK }}'" />
                            <input type="text" name="consumer_key" id="consumer_key" class="form-control mb-2" placeholder="{{ __('Consumer Key') }}" x-show="platformType === '{{ $model::TYPE_TWITTER }}'" />
                            <input type="text" name="consumer_secret" id="consumer_secret" class="form-control mb-2" placeholder="{{ __('Consumer Secret') }}" x-show="platformType === '{{ $model::TYPE_TWITTER }}'" />
                            <input type="text" name="access_token" id="access_token" class="form-control mb-2" placeholder="{{ __('Access Token') }}" x-show="platformType === '{{ $model::TYPE_FACEBOOK }}' || platformType === '{{ $model::TYPE_TWITTER }}'" />
                            <input type="text" name="access_token_secret" id="access_token_secret" class="form-control mb-2" placeholder="{{ __('Access Token Secret') }}" x-show="platformType === '{{ $model::TYPE_TWITTER }}'" />
                            <input type="text" name="client_id" id="client_id" class="form-control mb-2" placeholder="{{ __('Client ID') }}" x-show="platformType === '{{ $model::TYPE_PLURK }}'" />
                            <input type="text" name="client_secret" id="client_secret" class="form-control mb-2" placeholder="{{ __('Client Secret') }}" x-show="platformType === '{{ $model::TYPE_PLURK }}'" />
                            <input type="text" name="token" id="token" class="form-control mb-2" placeholder="{{ __('Token') }}" x-show="platformType === '{{ $model::TYPE_PLURK }}'" />
                            <input type="text" name="token_secret" id="token_secret" class="form-control mb-2" placeholder="{{ __('Token Secret') }}" x-show="platformType === '{{ $model::TYPE_PLURK }}'" />
                            <input type="text" name="pages_name" id="pages_name" class="form-control mb-2" placeholder="{{ __('Pages Name') }}" />
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Platform')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
