@extends('frontend.layouts.app')

@section('title', __('Register'))
@section('meta_title', appName() . ' | ' . __('Register'))
@section('meta_description', appName() . ' | ' . __('Register'))

@push('after-scripts')
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>
@endpush

@section('content')
    <div class="container right-panel-active d-none d-md-block" id="container">
        <div class="form-container sign-up-container">
            <x-forms.post :action="route('frontend.auth.register')">
                <h1>{{ __('Register') }}</h1>
                <div class="social-container py-2">
                    @include('frontend.auth.includes.social')
                </div>
                <span class="py-2">{{ __('or use your email for registration') }}</span>
                <div class="form-group row mb-2">
                    <label for="name" class="col-md-12 col-form-label text-md-right pb-1">@lang('Name')</label>

                    <div class="col-md-12">
                        <input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="{{ __('Name') }}" value="{{ old('name') }}" maxlength="255" required autofocus autocomplete="email" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row mb-2">
                    <label for="email" class="col-md-12 col-form-label text-md-right pb-1">@lang('E-mail Address')</label>

                    <div class="col-md-12">
                        <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row mb-2">
                    <label for="password" class="col-md-12 col-form-label text-md-right pb-1">@lang('Password')</label>

                    <div class="col-md-12">
                        <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="{{ __('Password') }}" maxlength="255" required autofocus autocomplete="email" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row mb-2">
                    <label for="password_confirmation" class="col-md-12 col-form-label text-md-right pb-1">@lang('Password Confirmation')</label>

                    <div class="col-md-12">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" placeholder="{{ __('Password Confirmation') }}" maxlength="100" required autocomplete="new-password" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row mt-2">
                    <div class="col">
                        <div class="form-check">
                            <input type="checkbox" name="terms" value="1" id="terms" class="form-check-input" required>
                            <label class="form-check-label check-box" for="terms"></label>
                            <label for="terms" class="check-box-content" style="vertical-align: bottom;">@lang('I agree to the') <a href="{{ route('frontend.pages.terms') }}" target="_blank">@lang('Terms & Conditions')</a></label>
                        </div>
                    </div>
                </div><!--form-group-->
                <button class="btn btn-dos btn-lg btn-block my-4" type="submit">{{ __('Register') }}</button>
            </x-forms.post>
        </div><!--sign-up-container-->

        <div class="form-container sign-in-container">
            <x-forms.post :action="route('frontend.auth.login')">
                <h1>{{ __('Login') }}</h1>
                <div class="social-container py-2">
                    @include('frontend.auth.includes.social')
                </div>
                <span class="py-2">{{ __('or use your account') }}</span>
                <div class="form-group row mb-2">
                    <label for="email" class="col-md-12 col-form-label text-md-right pb-1">@lang('E-mail Address')</label>

                    <div class="col-md-12">
                        <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" />
                    </div>
                </div><!--form-group-->
                <div class="form-group row mb-2">
                    <label for="password" class="col-md-12 col-form-label text-md-right pb-1">@lang('Password')</label>

                    <div class="col-md-12">
                        <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="{{ __('Password') }}" maxlength="255" required autofocus autocomplete="email" />
                    </div>
                </div><!--form-group-->
                <x-utils.link :href="route('frontend.auth.password.request')" class="btn btn-link" :text="__('Forgot Your Password?')" />
                <button class="btn btn-dos btn-lg btn-block my-4" type="submit">{{ __('Login') }}</button>
            </x-forms.post>
        </div><!--sign-in-container-->

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>{{ __('Welcome Back!') }}</h1>
                    <p>{{ __('To keep connected with us please login with your personal info') }}</p>
                    <button class="btn btn-dos btn-lg btn-block my-4" id="signIn">{{ __('Login') }}</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>{{ __('Hello, Friend!') }}</h1>
                    <p>{{ __('Enter your personal details and start journey with us') }}</p>
                    <button class="btn btn-dos btn-lg btn-block my-4" id="signUp">{{ __('Register') }}</button>
                </div>
            </div>
        </div><!--overlay-container-->

        @if(config('boilerplate.access.captcha.registration'))
            <div class="row">
                <div class="col">
                    @captcha
                    <input type="hidden" name="captcha_status" value="true" />
                </div><!--col-->
            </div><!--row-->
        @endif
    </div><!--container-->

    <div id="container" class="container d-block d-md-none" style="width: 90%;">
        <div class="form-container" style="width: 100%; left: 0px;">
            <x-forms.post :action="route('frontend.auth.register')" class="px-3">
                <h1>{{ __('Register') }}</h1>
                <div class="social-container py-2">
                    @include('frontend.auth.includes.social')
                </div>
                <span class="py-2">{{ __('or use your email for registration') }}</span>
                <div class="form-group row mb-2 w-100">
                    <label for="name" class="col-md-12 col-form-label text-md-right pb-1">@lang('Name')</label>

                    <div class="col-md-12">
                        <input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="{{ __('Name') }}" value="{{ old('name') }}" maxlength="255" required autofocus autocomplete="email" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row mb-2 w-100">
                    <label for="email" class="col-md-12 col-form-label text-md-right pb-1">@lang('E-mail Address')</label>

                    <div class="col-md-12">
                        <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row mb-2 w-100">
                    <label for="password" class="col-md-12 col-form-label text-md-right pb-1">@lang('Password')</label>

                    <div class="col-md-12">
                        <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="{{ __('Password') }}" maxlength="255" required autofocus autocomplete="email" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row mb-2 w-100">
                    <label for="password_confirmation" class="col-md-12 col-form-label text-md-right pb-1">@lang('Password Confirmation')</label>

                    <div class="col-md-12">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" placeholder="{{ __('Password Confirmation') }}" maxlength="100" required autocomplete="new-password" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row mt-2 w-100">
                    <div class="col">
                        <div class="form-check">
                            <input type="checkbox" name="terms" value="1" id="terms" class="form-check-input" required>
                            <label class="form-check-label check-box" for="terms"></label>
                            <label for="terms" class="check-box-content" style="vertical-align: bottom;">@lang('I agree to the') <a href="{{ route('frontend.pages.terms') }}" target="_blank">@lang('Terms & Conditions')</a></label>
                        </div>
                    </div>
                </div><!--form-group-->
                <button class="btn btn-dos btn-lg btn-block my-4" type="submit">{{ __('Register') }}</button>
            </x-forms.post>
        </div><!--sign-in-container-->

        @if(config('boilerplate.access.captcha.registration'))
            <div class="row">
                <div class="col">
                    @captcha
                    <input type="hidden" name="captcha_status" value="true" />
                </div><!--col-->
            </div><!--row-->
        @endif
    </div><!--container-->
@endsection
