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
                    <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" maxlength="255" required />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="ads_banner" class="col-md-2 col-form-label">@lang('Ads Banner')</label>

                    <div class="col-md-10">
                        <input type="file" name="ads_banner" class="form-control" placeholder="{{ __('Ads Banner') }}" value="{{ old('ads_banner') }}" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="number_max" class="col-md-2 col-form-label">@lang('Number Max')</label>

                    <div class="col-md-10">
                        <input type="number" name="number_max" class="form-control" placeholder="{{ __('Number Max') }}" value="{{ old('number_max') }}" max="1000" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="number_min" class="col-md-2 col-form-label">@lang('Number Min')</label>

                    <div class="col-md-10">
                        <input type="number" name="number_min" class="form-control" placeholder="{{ __('Number Min') }}" value="{{ old('number_min') }}" min="1" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="incidence" class="col-md-2 col-form-label">@lang('Incidence')</label>

                    <div class="col-md-10">
                        <input type="number" name="incidence" class="form-control" placeholder="{{ __('Incidence') }}" value="{{ old('incidence') }}" max="10000" min="1" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="started_at" class="col-md-2 col-form-label">@lang('Started At')</label>

                    <div class="col-md-10">
                        <input type="date" name="started_at" class="form-control" placeholder="{{ __('Started At') }}" value="{{ old('started_at') }}" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="ended_at" class="col-md-2 col-form-label">@lang('Ended At')</label>

                    <div class="col-md-10">
                        <input type="date" name="ended_at" class="form-control" placeholder="{{ __('Ended At') }}" value="{{ old('ended_at') }}" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="payment" class="col-md-2 col-form-label">@lang('Payment')</label>

                    <div class="col-md-10">
                        <div class="form-check">
                            <input name="payment" id="payment" class="form-check-input" type="checkbox" value="1" {{ old('payment', true) ? 'checked' : '' }} />
                        </div><!--form-check-->
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
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Ads')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
