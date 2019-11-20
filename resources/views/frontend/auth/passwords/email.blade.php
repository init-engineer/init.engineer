@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.passwords.reset_password_box_title'))

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center align-items-center">
            <div class="col col-sm-6 align-self-center">
                <label class="col-label">forgot-password.blade.php</label>
                <div class="card text-white bg-img-rock rounded-0 border border-w-6">
                    <div class="card-header display-1">
                        <strong>
                            @lang('labels.frontend.passwords.reset_password_box_title')
                        </strong>
                    </div><!--card-header-->

                    <div class="card-body">

                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ html()->form('POST', route('frontend.auth.password.email.post'))->open() }}
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                        {{ html()->email('email')
                                            ->class('form-control form-control-lg text-white input-black')
                                            ->placeholder(__('validation.attributes.frontend.email'))
                                            ->attribute('maxlength', 191)
                                            ->required()
                                            ->autofocus() }}
                                    </div><!--form-group-->
                                </div><!--col-->
                            </div><!--row-->

                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-0 clearfix">
                                        {{ form_submit(__('labels.frontend.passwords.send_password_reset_link_button'), 'btn btn-dos btn-lg btn-block my-4') }}
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
