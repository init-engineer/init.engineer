@extends('frontend.layouts.app')

@section('title', __('Reset Password'))
@section('meta_title', appName() . ' | ' . __('Reset Password'))
@section('meta_description', appName() . ' | ' . __('Reset Password'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-frontend.card>
                    <x-slot name="header">
                        <h1 class="py-2 my-2 text-center">@lang('Reset Password')</h1>
                    </x-slot>

                    <x-slot name="body">
                        <x-forms.post :action="route('frontend.auth.password.email')">
                            <div class="form-group row mb-2">
                                <label for="email" class="col-md-12 col-form-label text-md-right pb-1">@lang('E-mail Address')</label>

                                <div class="col-md-12">
                                    <input type="email" name="email" id="email" class="form-control form-control-lg input-black" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row mb-0">
                                <div class="col">
                                    <button class="btn btn-dos btn-lg btn-block my-4" type="submit">@lang('Send Password Reset Link')</button>
                                </div>
                            </div><!--form-group-->
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
@endsection
