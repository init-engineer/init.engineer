@extends('frontend.layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row mb-4">
            <div class="col">
                <div class="text-white">
                    <div class="card-header display-4">
                        <strong>
                            <i class="fas fa-tachometer-alt"></i> {{ __('labels.frontend.user.dashboard.dashboard_text') }}
                        </strong>
                    </div><!--card-header-->

                    <div class="card-body">
                        <div class="row">
                            <div class="col col-sm-4 text-dark order-1 order-sm-2 mb-4">
                                <div class="nav nav-tabs" role="tablist">
                                    <a href="#cards" class="my-2 btn btn-block btn-dos rounded-0 active" aria-controls="cards" role="tab" data-toggle="tab">@lang('navs.frontend.user.cards')</a>
                                    <a href="#profile" class="my-2 btn btn-block btn-dos rounded-0" aria-controls="profile" role="tab" data-toggle="tab">@lang('navs.frontend.user.profile')</a>
                                    <a href="#edit" class="my-2 btn btn-block btn-dos rounded-0" aria-controls="edit" role="tab" data-toggle="tab">@lang('labels.frontend.user.profile.update_information')</a>
                                    <a href="#authorized" class="my-2 btn btn-block btn-dos rounded-0" aria-controls="authorized" role="tab" data-toggle="tab">授權列表</a>
                                    @if($logged_in_user->isJuniorUser())
                                        <a href="#clients" class="my-2 btn btn-block btn-dos rounded-0" aria-controls="clients" role="tab" data-toggle="tab">我的應用程式(OAuth)</a>
                                    @endif
                                    @if($logged_in_user->canChangePassword())
                                        <a href="#password" class="my-2 btn btn-block btn-dos rounded-0" aria-controls="password" role="tab" data-toggle="tab">@lang('navs.frontend.user.change_password')</a>
                                    @endif
                                </div>

                                <hr class="border border-w-3">

                                <div class="card mb-4 bg-img-rock text-white rounded-0 border border-w-6">
                                    <img class="card-img-top" src="{{ $logged_in_user->picture }}" alt="Profile Picture">

                                    <div class="card-body">
                                        <h4 class="card-title">
                                            {{ $logged_in_user->name }}<br/>
                                        </h4>

                                        <p class="card-text">
                                            <small>
                                                <i class="fas fa-envelope"></i> {{ $logged_in_user->email }}<br/>
                                                <i class="fas fa-calendar-check"></i> @lang('strings.frontend.general.joined') {{ timezone()->convertToLocal($logged_in_user->created_at, 'F jS, Y') }}
                                            </small>
                                        </p>

                                        @can('view backend')
                                        <p class="card-text">
                                            <a href="{{ route('admin.dashboard')}}" class="btn btn-danger btn-block btn-lg">
                                                <i class="fas fa-user-secret"></i> @lang('navs.frontend.user.administration')
                                            </a>
                                        </p>
                                        @endcan
                                    </div>
                                </div>

                                <hr class="border border-w-3">

                                <div class="card mb-4 bg-img-rock text-white rounded-0 border border-w-6">
                                    <ins class="adsbygoogle"
                                        style="display:block"
                                        data-ad-client="ca-pub-3028179090690423"
                                        data-ad-slot="7777514837"
                                        data-ad-format="auto"
                                        data-full-width-responsive="true"></ins>
                                </div>
                            </div><!--col-md-4-->

                            <div class="col-md-8 order-2 order-sm-1">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade show active pt-3" id="cards" aria-labelledby="cards-tab">
                                        <social-cards-dashboard></social-cards-dashboard>
                                    </div><!--tab panel profile-->

                                    <div role="tabpanel" class="tab-pane fade show pt-3" id="profile" aria-labelledby="profile-tab">
                                        @include('frontend.user.account.tabs.profile')
                                    </div><!--tab panel profile-->

                                    <div role="tabpanel" class="tab-pane fade show pt-3" id="edit" aria-labelledby="edit-tab">
                                        @include('frontend.user.account.tabs.edit')
                                    </div><!--tab panel profile-->

                                    <div role="tabpanel" class="tab-pane fade show pt-3" id="authorized" aria-labelledby="authorized-tab">
                                        <authorized-clients></authorized-clients>
                                    </div><!--tab panel profile-->

                                    @if($logged_in_user->isJuniorUser())
                                        <div role="tabpanel" class="tab-pane fade show pt-3" id="clients" aria-labelledby="clients-tab">
                                            <clients></clients>
                                            <personal-access-tokens></personal-access-tokens>
                                        </div><!--tab panel profile-->
                                    @endif

                                    @if($logged_in_user->canChangePassword())
                                        <div role="tabpanel" class="tab-pane fade show pt-3" id="password" aria-labelledby="password-tab">
                                            @include('frontend.user.account.tabs.change-password')
                                        </div><!--tab panel change password-->
                                    @endif
                                </div><!--tab content-->

                            </div><!--col-md-8-->
                        </div><!-- row -->
                    </div> <!-- card-body -->
                </div><!-- card -->
            </div><!-- row -->
        </div><!-- row -->
    </div><!--container-->
@endsection

@push('after-scripts')
    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
@endpush
