@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center align-items-center">
            <div class="col col-sm-8 align-self-center">
                <label class="col-label">register.blade.php</label>
                <div class="card text-white bg-img-rock rounded-0 border border-w-6">
                    <div class="card-header display-1">
                        <strong>
                            @lang('labels.frontend.auth.register_box_title')
                        </strong>
                    </div><!--card-header-->

                    <div class="card-body">
                        {{ html()->form('POST', route('frontend.auth.register.post'))->open() }}
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }}

                                        {{ html()->text('first_name')
                                            ->class('form-control form-control-lg text-white input-black')
                                            ->placeholder(__('validation.attributes.frontend.first_name'))
                                            ->attribute('maxlength', 191)
                                            ->required()}}
                                    </div><!--col-->
                                </div><!--row-->

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}

                                        {{ html()->text('last_name')
                                            ->class('form-control form-control-lg text-white input-black')
                                            ->placeholder(__('validation.attributes.frontend.last_name'))
                                            ->attribute('maxlength', 191)
                                            ->required() }}
                                    </div><!--form-group-->
                                </div><!--col-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                        {{ html()->email('email')
                                            ->class('form-control form-control-lg text-white input-black')
                                            ->placeholder(__('validation.attributes.frontend.email'))
                                            ->attribute('maxlength', 191)
                                            ->required() }}
                                    </div><!--form-group-->
                                </div><!--col-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                                        {{ html()->password('password')
                                            ->class('form-control form-control-lg text-white input-black')
                                            ->placeholder(__('validation.attributes.frontend.password'))
                                            ->required() }}
                                    </div><!--form-group-->
                                </div><!--col-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}

                                        {{ html()->password('password_confirmation')
                                            ->class('form-control form-control-lg text-white input-black')
                                            ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                            ->required() }}
                                    </div><!--form-group-->
                                </div><!--col-->
                            </div><!--row-->

                            @if(config('access.captcha.registration'))
                                <div class="row">
                                    <div class="col">
                                        @captcha
                                        {{ html()->hidden('captcha_status', 'true') }}
                                    </div><!--col-->
                                </div><!--row-->
                            @endif

                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 clearfix">
                                        {{ form_submit(__('labels.frontend.auth.register_button'), 'btn btn-dos btn-lg btn-block my-4') }}
                                    </div><!--form-group-->
                                </div><!--col-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group text-left">
                                    <a href="{{ route('frontend.policies') }}">@lang('labels.frontend.policies.policies_text')</a>
                                    </div>
                                    <!--form-group-->
                                </div>
                                <!--col-->
                            </div>
                            <!--row-->
                        {{ html()->form()->close() }}

                        <hr class="border-bottom border-w-6">
                        <!--border-->

                        <div class="row">
                            <div class="col">
                                <div class="text-center">
                                    @include('frontend.auth.includes.socialite')
                                </div>
                            </div><!--/ .col -->
                        </div><!-- / .row -->
                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col-md-8 -->
        </div><!-- row -->
    </div><!--container-->

    <img class="nyan mb-5" style="margin-left: -25vw; width: 80vw; height: auto;" src="https://ziad-saab.github.io/nyan/nyan.gif">
@endsection

@push('after-scripts')
    @if(config('access.captcha.registration'))
        @captchaScripts
    @endif
@endpush
