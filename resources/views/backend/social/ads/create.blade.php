@inject('model', '\App\Domains\Social\Models\Ads')

@extends('backend.layouts.app')

@section('title', __('Create Ads'))

@section('content')
    <x-forms.post :action="route('admin.social.ads.store')" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Ads')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.social.ads.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="form-group row">
                    <label for="type" class="col-md-2 col-form-label">@lang('Type')</label>

                    <div class="col-md-10">
                        <select name="type" class="form-control" required>
                            <option value="{{ $model::TYPE_ALL }}">@lang('Draw All')</option>
                            <option value="{{ $model::TYPE_BANNER }}">@lang('Draw Banner')</option>
                            <option value="{{ $model::TYPE_CONTENT }}">@lang('Draw Content')</option>
                        </select>
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" maxlength="255" required />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="content" class="col-md-2 col-form-label">@lang('Content')</label>

                    <div class="col-md-10">
                        <textarea class="form-control" name="content" id="content" rows="3" placeholder="{{ __('Content') }}" maxlength="1024" required>{{ old('content') }}</textarea>
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="ads_banner" class="col-md-2 col-form-label">@lang('Ads Banner')</label>

                    <div class="col-md-10">
                        <input type="file" name="ads_banner" class="form-control" placeholder="{{ __('Ads Banner') }}" value="{{ old('ads_banner') }}" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="probability" class="col-md-2 col-form-label">@lang('Probability')</label>

                    <div class="col-md-10">
                        <input type="number" name="probability" class="form-control" placeholder="{{ __('Probability') }}" value="{{ old('probability') }}" max="10000" min="1" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="starts_at" class="col-md-2 col-form-label">@lang('Starts At')</label>

                    <div class="col-md-10">
                        <input type="date" name="starts_at" class="form-control" placeholder="{{ __('Starts At') }}" value="{{ old('starts_at') }}" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="ends_at" class="col-md-2 col-form-label">@lang('Ends At')</label>

                    <div class="col-md-10">
                        <input type="date" name="ends_at" class="form-control" placeholder="{{ __('Ends At') }}" value="{{ old('ends_at') }}" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="render" class="col-md-2 col-form-label">@lang('Render')</label>

                    <div class="col-md-10">
                        <div class="form-check">
                            <input type="checkbox" name="render" id="render" class="form-check-input" value="1" {{ old('render', true) ? 'checked' : '' }} />
                            <label for="render" class="check-box"></label>
                        </div><!--form-check-->
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="payment" class="col-md-2 col-form-label">@lang('Payment')</label>

                    <div class="col-md-10">
                        <div class="form-check">
                            <input type="checkbox" name="payment" id="payment" class="form-check-input" value="1" {{ old('payment', true) ? 'checked' : '' }} />
                            <label for="payment" class="check-box"></label>
                        </div><!--form-check-->
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
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Ads')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
