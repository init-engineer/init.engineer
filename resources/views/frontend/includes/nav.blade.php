<nav class="navbar navbar-expand-lg navbar-full-bg navbar-dark bg-black fixed-top pt-0 pb-0 border-bottom border-white border-w-3">
    <div>
        <a href="{{ route('frontend.index') }}" class="navbar-brand">{{ app_name() }}</a>
        <a class="mr-2" href="{{ env('FACEBOOK_PRIMARY_SOCIAL_URL') }}"><img src="https://image.flaticon.com/icons/svg/220/220200.svg" alt="Facebook" class="rounded" width="30" height="30"></a>
        <a class="mr-2" href="{{ env('TWITTER_SOCIAL_URL') }}"><img src="https://image.flaticon.com/icons/svg/124/124021.svg" alt="Twitter" class="rounded" width="30" height="30"></a>
        <a class="mr-2" href="{{ env('PLURK_SOCIAL_URL') }}"><img src="https://image.flaticon.com/icons/svg/124/124026.svg" alt="Plurk" class="rounded" width="30" height="30"></a>
    </div>

    <button class="navbar-toggler navbar-toggler-right border-0 collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('labels.general.toggle_navigation')">
        <span class="navbar-toggler-icon icon-bar top-bar"></span>
        <span class="navbar-toggler-icon icon-bar middle-bar"></span>
        <span class="navbar-toggler-icon icon-bar bottom-bar"></span>
        {{-- <span class="navbar-toggler-icon"></span> --}}
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            {{-- @if(config('locale.status') && count(config('locale.languages')) > 1)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownLanguageLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">@lang('menus.language-picker.language') ({{ strtoupper(app()->getLocale()) }})</a>

                    @include('includes.partials.lang')
                </li>
            @endif --}}

            @auth
                <li class="nav-item"><a href="{{route('frontend.user.dashboard')}}" class="nav-link {{ active_class(Route::is('frontend.user.dashboard')) }}">@lang('navs.frontend.dashboard')</a></li>
            @endauth

            @guest
                <li class="nav-item"><a href="{{route('frontend.auth.login')}}" class="nav-link {{ active_class(Route::is('frontend.auth.login')) }}">@lang('navs.frontend.login')</a></li>

                @if(config('access.registration'))
                    <li class="nav-item"><a href="{{route('frontend.auth.register')}}" class="nav-link {{ active_class(Route::is('frontend.auth.register')) }}">@lang('navs.frontend.register')</a></li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuUser" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">{{ $logged_in_user->name }}</a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuUser">
                        @can('view backend')
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item">@lang('navs.frontend.user.administration')</a>
                        @endcan

                        <a href="{{ route('frontend.user.account') }}" class="dropdown-item {{ active_class(Route::is('frontend.user.account')) }}">@lang('navs.frontend.user.account')</a>
                        <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item">@lang('navs.general.logout')</a>
                    </div>
                </li>
            @endguest

            {{-- <li class="nav-item"><a href="{{route('frontend.contact')}}" class="nav-link {{ active_class(Route::is('frontend.contact')) }}">@lang('navs.frontend.contact')</a></li> --}}
        </ul>
    </div>
</nav>
