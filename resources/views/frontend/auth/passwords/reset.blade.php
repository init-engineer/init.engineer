@extends('frontend.layouts.app')

@section('title', __('Reset Password'))
@section('meta_title',  __('Reset Password'))
@section('meta_description',  __('Reset Password'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-frontend.card>
                    <x-slot name="header">
                        <h1 class="py-2 my-2 text-center">@lang('Reset Password')</h1>
                    </x-slot>

                    <x-slot name="body">
                        <x-forms.post :action="route('frontend.auth.password.update')">
                            <input type="hidden" name="token" value="{{ $token }}" />

                            <div class="form-group row mb-2">
                                <label for="email" class="col-md-12 col-form-label text-md-right pb-1">@lang('E-mail Address')</label>

                                <div class="col-md-12">
                                    <input type="email" name="email" id="email" class="form-control form-control-lg input-black" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row mb-2">
                                <label for="password" class="col-md-12 col-form-label text-md-right pb-1">@lang('Password')</label>

                                <div class="col-md-12">
                                    <input type="password" name="password" id="password" class="form-control form-control-lg input-black" placeholder="{{ __('Password') }}" maxlength="255" required autofocus autocomplete="email" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">@lang('E-mail Address')</label>

                                <div class="col-md-6">
                                    <input type="email" name="email" id="email" class="form-control form-control-lg input-black" placeholder="{{ __('E-mail Address') }}" value="{{ $email ?? old('email') }}" maxlength="255" required autofocus autocomplete="email" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">@lang('Password')</label>

                                <div class="col-md-6">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg input-black" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="password" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">@lang('Password Confirmation')</label>

                                <div class="col-md-6">
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg input-black" placeholder="{{ __('Password Confirmation') }}" maxlength="100" required autocomplete="new-password" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary" type="submit">@lang('Reset Password')</button>
                                </div>
                            </div><!--form-group-->
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
@endsection
