@inject('model', '\App\Domains\Social\Models\Platform')

@extends('backend.layouts.app')

@section('title', __('Update Platform'))

@section('content')
    <x-forms.patch :action="route('admin.social.platform.update', $platform)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Platform')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.social.platform.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div x-data="{platformName : '{{ $platform->name }}', platformType : '{{ $platform->type }}'}">
                    <div class="form-group row" >
                        <label for="platformName" class="col-md-2 col-form-label">@lang('Platform Name')</label>

                        <div class="col-md-10">
                            <select name="platformName" class="form-control" required x-on:change="platformName = $event.target.value">
                                <option value="{{ $model::PLATFORM_PRIMARY }}" {{ $platform->name === $model::PLATFORM_PRIMARY ? 'selected' : '' }}>@lang('Primary')</option>
                                <option value="{{ $model::PLATFORM_SECONDARY }}" {{ $platform->name === $model::PLATFORM_SECONDARY ? 'selected' : '' }}>@lang('Secondary')</option>
                                <option value="{{ $model::PLATFORM_TESTING }}" {{ $platform->name === $model::PLATFORM_TESTING ? 'selected' : '' }}>@lang('Testing')</option>
                            </select>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="platformType" class="col-md-2 col-form-label">@lang('Platform Type')</label>

                        <div class="col-md-10">
                            <select name="platformType" class="form-control" required x-on:change="platformType = $event.target.value">
                                <option value="{{ $model::TYPE_FACEBOOK }}" {{ $platform->type === $model::TYPE_FACEBOOK ? 'selected' : '' }}>@lang('Facebook')</option>
                                <option value="{{ $model::TYPE_TWITTER }}" {{ $platform->type === $model::TYPE_TWITTER ? 'selected' : '' }}>@lang('Twitter')</option>
                                <option value="{{ $model::TYPE_PLURK }}" {{ $platform->type === $model::TYPE_PLURK ? 'selected' : '' }}>@lang('Plurk')</option>
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
                            <input type="text" name="user_id" id="user_id" class="form-control mb-2" value="{{ $config['user_id'] ?? null }}" placeholder="{{ __('User ID') }}" x-show="platformType === '{{ $model::TYPE_FACEBOOK }}'" />
                            <input type="text" name="app_id" id="app_id" class="form-control mb-2" value="{{ $config['app_id'] ?? null }}" placeholder="{{ __('App ID') }}" x-show="platformType === '{{ $model::TYPE_FACEBOOK }}'" />
                            <input type="text" name="app_secret" id="app_secret" class="form-control mb-2" value="{{ $config['app_secret'] ?? null }}" placeholder="{{ __('App Secret') }}" x-show="platformType === '{{ $model::TYPE_FACEBOOK }}'" />
                            <input type="text" name="graph_version" id="graph_version" class="form-control mb-2" value="{{ $config['graph_version'] ?? null }}" placeholder="{{ __('Graph Version') }}" x-show="platformType === '{{ $model::TYPE_FACEBOOK }}'" />
                            <input type="text" name="consumer_key" id="consumer_key" class="form-control mb-2" value="{{ $config['consumer_key'] ?? null }}" placeholder="{{ __('Consumer Key') }}" x-show="platformType === '{{ $model::TYPE_TWITTER }}'" />
                            <input type="text" name="consumer_secret" id="consumer_secret" class="form-control mb-2" value="{{ $config['consumer_secret'] ?? null }}" placeholder="{{ __('Consumer Secret') }}" x-show="platformType === '{{ $model::TYPE_TWITTER }}'" />
                            <input type="text" name="access_token" id="access_token" class="form-control mb-2" value="{{ $config['access_token'] ?? null }}" placeholder="{{ __('Access Token') }}" x-show="platformType === '{{ $model::TYPE_FACEBOOK }}' || platformType === '{{ $model::TYPE_TWITTER }}'" />
                            <input type="text" name="access_token_secret" id="access_token_secret" class="form-control mb-2" value="{{ $config['access_token_secret'] ?? null }}" placeholder="{{ __('Access Token Secret') }}" x-show="platformType === '{{ $model::TYPE_TWITTER }}'" />
                            <input type="text" name="client_id" id="client_id" class="form-control mb-2" value="{{ $config['client_id'] ?? null }}" placeholder="{{ __('Client ID') }}" x-show="platformType === '{{ $model::TYPE_PLURK }}'" />
                            <input type="text" name="client_secret" id="client_secret" class="form-control mb-2" value="{{ $config['client_secret'] ?? null }}" placeholder="{{ __('Client Secret') }}" x-show="platformType === '{{ $model::TYPE_PLURK }}'" />
                            <input type="text" name="token" id="token" class="form-control mb-2" value="{{ $config['token'] ?? null }}" placeholder="{{ __('Token') }}" x-show="platformType === '{{ $model::TYPE_PLURK }}'" />
                            <input type="text" name="token_secret" id="token_secret" class="form-control mb-2" value="{{ $config['token_secret'] ?? null }}" placeholder="{{ __('Token Secret') }}" x-show="platformType === '{{ $model::TYPE_PLURK }}'" />
                            <input type="text" name="pages_name" id="pages_name" class="form-control mb-2" value="{{ $config['pages_name'] ?? null }}" placeholder="{{ __('Pages Name') }}" />
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Platform')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
