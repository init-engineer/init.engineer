@extends('frontend.layouts.app')

@section('title', __('Please confirm your password before continuing.'))
@section('meta_title', appName() . ' | ' . __('Please confirm your password before continuing.'))
@section('meta_description', appName() . ' | ' . __('Please confirm your password before continuing.'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-frontend.card>
                    <x-slot name="header">
                        <h1 class="py-2 my-2 text-center">@lang('Please confirm your password before continuing.')</h1>
                    </x-slot>

                    <x-slot name="body">
                        <x-forms.post :action="route('frontend.auth.password.confirm')">
                            <div class="form-group row mb-2">
                                <label for="password" class="col-md-12 col-form-label text-md-right pb-1">@lang('Password')</label>

                                <div class="col-md-12">
                                    <input type="password" name="password" id="password" class="form-control form-control-lg input-black" placeholder="{{ __('Password') }}" maxlength="255" required autofocus autocomplete="email" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary" type="submit">@lang('Confirm Password')</button>
                                </div>
                            </div><!--form-group-->
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
@endsection
