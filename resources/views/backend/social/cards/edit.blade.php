@inject('model', '\App\Domains\Social\Models\Cards')

@extends('backend.layouts.app')

@section('title', __('Update Cards'))

@section('content')
    <x-forms.patch :action="route('admin.social.cards.update', $cards)" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Cards')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.social.cards.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="form-group row">
                    <label for="author" class="col-md-2 col-form-label">@lang('Author')</label>

                    <div class="col-md-10">
                        <a href="{{ route('admin.auth.user.show', ['user' => $cards->model]) }}">
                            <img src="{{ $cards->model->avatar }}" class="img-fluid rounded user-profile-image">
                            <div class="m-2" style="display: inline; position: absolute;">
                                <strong style="font-weight: 600; font-size: 24px; color: #597a96; display: inherit;">{{ $cards->model->name }}</strong>
                                <span style="font-size: 16px; font-weight: 400; color: #aab8c2;">{{ $cards->model->email }}</span>
                            </div>
                        </a>
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                    <div class="col-md-10">
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $cards->name }}" maxlength="255" required />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="cards_banner" class="col-md-2 col-form-label">@lang('Cards Banner')</label>

                    <div class="col-md-10">
                        <img src="{{ $cards->getPicture() }}" class="img-fluid rounded mb-2" style="max-width: 100%;" alt="{{ old('name') ?? $cards->name }}" />
                        <input type="file" name="cards_banner" class="form-control" placeholder="{{ __('Cards Banner') }}" value="{{ old('cards_banner') }}" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="probability" class="col-md-2 col-form-label">@lang('Probability')</label>

                    <div class="col-md-10">
                        <input type="number" name="probability" class="form-control" placeholder="{{ __('Probability') }}" value="{{ old('probability') ?? $cards->probability }}" max="10000" min="1" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="starts_at" class="col-md-2 col-form-label">@lang('Starts At')</label>

                    <div class="col-md-10">
                        <input type="date" name="starts_at" class="form-control" placeholder="{{ __('Starts At') }}" value="{{ old('starts_at') ?? $cards->starts_at->toDateString() }}" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="ends_at" class="col-md-2 col-form-label">@lang('Ends At')</label>

                    <div class="col-md-10">
                        <input type="date" name="ends_at" class="form-control" placeholder="{{ __('Ends At') }}" value="{{ old('ends_at') ?? $cards->ends_at->toDateString() }}" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="payment" class="col-md-2 col-form-label">@lang('Payment')</label>

                    <div class="col-md-10">
                        <div class="form-check">
                            <input type="checkbox" name="payment" id="payment" class="form-check-input" value="1" {{ old('payment', $cards->payment) ? 'checked' : '' }} />
                            <label for="payment" class="check-box"></label>
                        </div><!--form-check-->
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="active" class="col-md-2 col-form-label">@lang('Active')</label>

                    <div class="col-md-10">
                        <div class="form-check">
                            <input type="checkbox" name="active" id="active" class="form-check-input" value="1" {{ old('active', $cards->active) ? 'checked' : '' }} />
                            <label for="active" class="check-box"></label>
                        </div><!--form-check-->
                    </div>
                </div><!--form-group-->
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Cards')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
