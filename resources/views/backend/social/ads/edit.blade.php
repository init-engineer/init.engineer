@inject('model', '\App\Domains\Social\Models\Ads')

@extends('backend.layouts.app')

@section('title', __('Update Ads'))

@section('content')
    <x-forms.patch :action="route('admin.social.ads.update', $ads)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Ads')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.social.ads.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $ads->name }}" maxlength="255" required />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="ads_banner" class="col-md-2 col-form-label">@lang('Ads Banner')</label>

                    <div class="col-md-10">
                        <img src="{{ old('ads_path') ?? $ads->getBanner() }}" alt="{{ old('name') ?? $ads->name }}" class="rounded w-100 mb-2">
                        <input type="file" name="ads_banner" class="form-control" placeholder="{{ __('Ads Banner') }}" value="{{ old('ads_banner') }}" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="number_max" class="col-md-2 col-form-label">@lang('Number Max')</label>

                    <div class="col-md-10">
                        <input type="number" name="number_max" class="form-control" placeholder="{{ __('Number Max') }}" value="{{ old('number_max') ?? $ads->number_max }}" max="1000" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="number_min" class="col-md-2 col-form-label">@lang('Number Min')</label>

                    <div class="col-md-10">
                        <input type="number" name="number_min" class="form-control" placeholder="{{ __('Number Min') }}" value="{{ old('number_min') ?? $ads->number_min }}" min="1" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="incidence" class="col-md-2 col-form-label">@lang('Incidence')</label>

                    <div class="col-md-10">
                        <input type="number" name="incidence" class="form-control" placeholder="{{ __('Incidence') }}" value="{{ old('incidence') ?? $ads->incidence }}" max="10000" min="1" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="started_at" class="col-md-2 col-form-label">@lang('Started At')</label>

                    <div class="col-md-10">
                        <input type="date" name="started_at" class="form-control" placeholder="{{ __('Started At') }}" value="{{ old('started_at') ?? $ads->started_at->toDateString() }}" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="ended_at" class="col-md-2 col-form-label">@lang('Ended At')</label>

                    <div class="col-md-10">
                        <input type="date" name="ended_at" class="form-control" placeholder="{{ __('Ended At') }}" value="{{ old('ended_at') ?? $ads->ended_at->toDateString() }}" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="payment" class="col-md-2 col-form-label">@lang('Payment')</label>

                    <div class="col-md-10">
                        <div class="form-check">
                            <input type="checkbox" name="payment" id="payment" class="form-check-input" value="1" {{ old('payment', $ads->payment) ? 'checked' : '' }} />
                            <label for="payment" class="check-box"></label>
                        </div><!--form-check-->
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="active" class="col-md-2 col-form-label">@lang('Active')</label>

                    <div class="col-md-10">
                        <div class="form-check">
                            <input type="checkbox" name="active" id="active" class="form-check-input" value="1" {{ old('active', $ads->active) ? 'checked' : '' }} />
                            <label for="active" class="check-box"></label>
                        </div><!--form-check-->
                    </div>
                </div><!--form-group-->
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Ads')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
