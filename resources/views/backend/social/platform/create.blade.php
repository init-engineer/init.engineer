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
                <div x-data="{type : '{{ $model::TYPE_LOCAL }}'}">
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="action" class="col-md-2 col-form-label">@lang('Platform Name')</label>

                        <div class="col-md-10">
                            <select name="action" class="form-control" required>
                                <option value="{{ $model::ACTION_INACTION }}" selected>@lang('Inaction')</option>
                                <option value="{{ $model::ACTION_NOTIFICATION }}">@lang('Notification')</option>
                                <option value="{{ $model::ACTION_PUBLISH }}">@lang('Publish')</option>
                            </select>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="type" class="col-md-2 col-form-label">@lang('Platform Type')</label>

                        <div class="col-md-10">
                            <select name="type" class="form-control" required x-on:change="type = $event.target.value">
                                <option value="{{ $model::TYPE_LOCAL }}" selected>@lang('Local')</option>
                                <option value="{{ $model::TYPE_FACEBOOK }}">@lang('Facebook')</option>
                                <option value="{{ $model::TYPE_TWITTER }}">@lang('Twitter')</option>
                                <option value="{{ $model::TYPE_PLURK }}">@lang('Plurk')</option>
                                <option value="{{ $model::TYPE_TUMBLR }}">@lang('Tumblr')</option>
                                <option value="{{ $model::TYPE_TELEGRAM }}">@lang('Telegram')</option>
                                <option value="{{ $model::TYPE_DISCORD }}">@lang('Discord')</option>
                            </select>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="active" class="col-md-2 col-form-label">@lang('Active')</label>

                        <div class="col-md-10">
                            <div class="form-check">
                                <input type="checkbox" name="active" id="active" class="form-check-input" value="1" {{ old('active', true) ? 'checked' : '' }} />
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
                                type="text" name="pages_name" id="pages_name" class="form-control mb-2" placeholder="{{ __('Pages Name') }}" />

                            <input x-show="type === '{{ $model::TYPE_FACEBOOK }}' ||
                                           type === '{{ $model::TYPE_TUMBLR }}'"
                                type="text" name="user_id" id="user_id" class="form-control mb-2" placeholder="{{ __('User ID or Blog Name.') }}" />

                            <input x-show="type === '{{ $model::TYPE_TWITTER }}' ||
                                           type === '{{ $model::TYPE_TUMBLR }}' ||
                                           type === '{{ $model::TYPE_PLURK }}'"
                                type="text" name="consumer_app_key" id="consumer_app_key" class="form-control mb-2" placeholder="{{ __('Consumer Key for authentication.') }}" />

                            <input x-show="type === '{{ $model::TYPE_TWITTER }}' ||
                                           type === '{{ $model::TYPE_PLURK }}' ||
                                           type === '{{ $model::TYPE_TUMBLR }}'"
                                type="text" name="consumer_app_secret" id="consumer_app_secret" class="form-control mb-2" placeholder="{{ __('Consumer Secret for authentication.') }}" />

                            <input x-show="type === '{{ $model::TYPE_FACEBOOK }}' ||
                                           type === '{{ $model::TYPE_TWITTER }}' ||
                                           type === '{{ $model::TYPE_PLURK }}' ||
                                           type === '{{ $model::TYPE_TUMBLR }}' ||
                                           type === '{{ $model::TYPE_TELEGRAM }}'"
                                type="text" name="access_token" id="access_token" class="form-control mb-2" placeholder="{{ __('Access Token for authentication.') }}" />

                            <input x-show="type === '{{ $model::TYPE_TWITTER }}' ||
                                           type === '{{ $model::TYPE_PLURK }}' ||
                                           type === '{{ $model::TYPE_TUMBLR }}'"
                                type="text" name="access_token_secret" id="access_token_secret" class="form-control mb-2" placeholder="{{ __('Access Token Secret for authentication.') }}" />

                            <input x-show="type === '{{ $model::TYPE_TELEGRAM }}'"
                                type="text" name="chat_id" id="chat_id" class="form-control mb-2" placeholder="{{ __('Unique identifier for the target chat or username of the target channel (in the format @channelusername).') }}" />

                            <input x-show="type === '{{ $model::TYPE_DISCORD }}'"
                                type="text" name="discord_id" id="discord_id" class="form-control mb-2" placeholder="{{ __('Discord ID') }}" />

                            <input x-show="type === '{{ $model::TYPE_DISCORD }}'"
                                type="text" name="channel_id" id="channel_id" class="form-control mb-2" placeholder="{{ __('Channel ID') }}" />

                            <input x-show="type === '{{ $model::TYPE_DISCORD }}'"
                                type="text" name="webhook" id="webhook" class="form-control mb-2" placeholder="{{ __('HTTPS url to send updates to. Use an empty string to remove webhook integration.') }}" />
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
