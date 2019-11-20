@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.passwords.expired_password_box_title'))

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center align-items-center">
            <div class="col col-sm-6 align-self-center">
                <label class="col-label">expired-password.blade.php</label>
                <div class="card text-white bg-img-rock rounded-0 border border-w-6">
                    <div class="card-header display-1">
                        <strong>
                            @lang('labels.frontend.passwords.expired_password_box_title')
                        </strong>
                    </div><!--card-header-->

                    <div class="card-body">
                        {{ html()->form('PATCH', route('frontend.auth.password.expired.update'))->class('form-horizontal')->open() }}

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        {{ html()->label(__('validation.attributes.frontend.old_password'))->for('old_password') }}

                                        {{ html()->password('old_password')
                                            ->class('form-control form-control-lg text-white input-black')
                                            ->placeholder(__('validation.attributes.frontend.old_password'))
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

                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 clearfix">
                                        {{ form_submit(__('labels.frontend.passwords.update_password_button'), 'btn btn-dos btn-lg btn-block my-4') }}
                                    </div><!--form-group-->
                                </div><!--col-->
                            </div><!--row-->

                        {{ html()->form()->close() }}
                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col-6 -->
        </div><!-- row -->
    </div><!--container-->

    <img class="nyan mb-5" style="margin-left: -25vw; width: 80vw; height: auto;" src="https://ziad-saab.github.io/nyan/nyan.gif">
@endsection
