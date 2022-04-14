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
                <div x-data="{type : '{{ $platform->type }}'}">
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ $platform->name }}" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="action" class="col-md-2 col-form-label">@lang('Platform Name')</label>

                        <div class="col-md-10">
                            <select name="action" class="form-control" required>
                                <option value="{{ $model::ACTION_INACTION }}" {{ $platform->action === $model::ACTION_INACTION ? 'selected' : '' }}>@lang('Inaction')</option>
                                <option value="{{ $model::ACTION_NOTIFICATION }}" {{ $platform->action === $model::ACTION_NOTIFICATION ? 'selected' : '' }}>@lang('Notification')</option>
                                <option value="{{ $model::ACTION_PUBLISH }}" {{ $platform->action === $model::ACTION_PUBLISH ? 'selected' : '' }}>@lang('Publish')</option>
                            </select>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="type" class="col-md-2 col-form-label">@lang('Platform Type')</label>

                        <div class="col-md-10">
                            <select name="type" class="form-control type-select" required x-on:change="type = $event.target.value">
                                <option value="{{ $model::TYPE_LOCAL }}" {{ $platform->type === $model::TYPE_LOCAL ? 'selected' : '' }}>@lang('Local')</option>
                                <option value="{{ $model::TYPE_FACEBOOK }}" {{ $platform->type === $model::TYPE_FACEBOOK ? 'selected' : '' }}>@lang('Facebook')</option>
                                <option value="{{ $model::TYPE_TWITTER }}" {{ $platform->type === $model::TYPE_TWITTER ? 'selected' : '' }}>@lang('Twitter')</option>
                                <option value="{{ $model::TYPE_PLURK }}" {{ $platform->type === $model::TYPE_PLURK ? 'selected' : '' }}>@lang('Plurk')</option>
                                <option value="{{ $model::TYPE_TUMBLR }}" {{ $platform->type === $model::TYPE_TUMBLR ? 'selected' : '' }}>@lang('Tumblr')</option>
                                <option value="{{ $model::TYPE_TELEGRAM }}" {{ $platform->type === $model::TYPE_TELEGRAM ? 'selected' : '' }}>@lang('Telegram')</option>
                                <option value="{{ $model::TYPE_DISCORD }}" {{ $platform->type === $model::TYPE_DISCORD ? 'selected' : '' }}>@lang('Discord')</option>
                            </select>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="active" class="col-md-2 col-form-label">@lang('Active')</label>

                        <div class="col-md-10">
                            <div class="form-check">
                                <input type="checkbox" name="active" id="active" class="form-check-input" value="1" {{ $platform->isActive() ? 'checked' : '' }} />
                                <label for="active" class="check-box"></label>
                            </div><!--form-check-->
                        </div>
                    </div><!--form-group-->

                    <hr />

                    <div class="form-group row">
                        <label for="config" class="col-md-2 col-form-label">@lang('Config')</label>

                        <div class="col-md-10">
                            <p x-show="type === '{{ $model::TYPE_LOCAL }}'">@lang('Local does not need to set.')</p>

                            <input x-show="type === '{{ $model::TYPE_FACEBOOK }}' ||
                                           type === '{{ $model::TYPE_TWITTER }}' ||
                                           type === '{{ $model::TYPE_PLURK }}' ||
                                           type === '{{ $model::TYPE_TUMBLR }}' ||
                                           type === '{{ $model::TYPE_TELEGRAM }}'"
                                value="{{ isset($config['pages_name']) ? $config['pages_name'] : null }}"
                                type="text" name="pages_name" id="pages_name" class="form-control mb-2" placeholder="{{ __('Pages Name') }}" />

                            <input x-show="type === '{{ $model::TYPE_FACEBOOK }}' ||
                                           type === '{{ $model::TYPE_TUMBLR }}'"
                                value="{{ isset($config['user_id']) ? $config['user_id'] : null }}"
                                type="text" name="user_id" id="user_id" class="form-control mb-2" placeholder="{{ __('User ID or Blog Name.') }}" />

                            <input x-show="type === '{{ $model::TYPE_TWITTER }}' ||
                                           type === '{{ $model::TYPE_TUMBLR }}' ||
                                           type === '{{ $model::TYPE_PLURK }}'"
                                value="{{ isset($config['consumer_app_key']) ? $config['consumer_app_key'] : null }}"
                                type="text" name="consumer_app_key" id="consumer_app_key" class="form-control mb-2" placeholder="{{ __('Consumer Key for authentication.') }}" />

                            <input x-show="type === '{{ $model::TYPE_TWITTER }}' ||
                                           type === '{{ $model::TYPE_PLURK }}' ||
                                           type === '{{ $model::TYPE_TUMBLR }}'"
                                value="{{ isset($config['consumer_app_secret']) ? $config['consumer_app_secret'] : null }}"
                                type="text" name="consumer_app_secret" id="consumer_app_secret" class="form-control mb-2" placeholder="{{ __('Consumer Secret for authentication.') }}" />

                            <input x-show="type === '{{ $model::TYPE_FACEBOOK }}' ||
                                           type === '{{ $model::TYPE_TWITTER }}' ||
                                           type === '{{ $model::TYPE_PLURK }}' ||
                                           type === '{{ $model::TYPE_TUMBLR }}' ||
                                           type === '{{ $model::TYPE_TELEGRAM }}'"
                                value="{{ isset($config['access_token']) ? $config['access_token'] : null }}"
                                type="text" name="access_token" id="access_token" class="form-control mb-2" placeholder="{{ __('Access Token for authentication.') }}" />

                            <input x-show="type === '{{ $model::TYPE_TWITTER }}' ||
                                           type === '{{ $model::TYPE_PLURK }}' ||
                                           type === '{{ $model::TYPE_TUMBLR }}'"
                                value="{{ isset($config['access_token_secret']) ? $config['access_token_secret'] : null }}"
                                type="text" name="access_token_secret" id="access_token_secret" class="form-control mb-2" placeholder="{{ __('Access Token Secret for authentication.') }}" />

                            <input x-show="type === '{{ $model::TYPE_TELEGRAM }}'"
                                value="{{ isset($config['chat_id']) ? $config['chat_id'] : null }}"
                                type="text" name="chat_id" id="chat_id" class="form-control mb-2" placeholder="{{ __('Unique identifier for the target chat or username of the target channel (in the format @channelusername).') }}" />

                            <input x-show="type === '{{ $model::TYPE_DISCORD }}'"
                                value="{{ isset($config['discord_id']) ? $config['discord_id'] : null }}"
                                type="text" name="discord_id" id="discord_id" class="form-control mb-2" placeholder="{{ __('Discord ID') }}" />

                            <input x-show="type === '{{ $model::TYPE_DISCORD }}'"
                                value="{{ isset($config['channel_id']) ? $config['channel_id'] : null }}"
                                type="text" name="channel_id" id="channel_id" class="form-control mb-2" placeholder="{{ __('Channel ID') }}" />

                            <input x-show="type === '{{ $model::TYPE_DISCORD }}'"
                                value="{{ isset($config['webhook']) ? $config['webhook'] : null }}"
                                type="text" name="webhook" id="webhook" class="form-control mb-2" placeholder="{{ __('HTTPS url to send updates to. Use an empty string to remove webhook integration.') }}" />
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
