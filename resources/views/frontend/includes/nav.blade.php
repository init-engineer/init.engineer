<nav class="navbar navbar-expand-sm navbar-bg bg-black" style="font-size: 90%;">
    <a href="{{ route('frontend.index') }}" class="navbar-brand mr-1" style="font-size: 100%;">🏠純靠首頁</a>
    <a href="javascript:void(0);" class="nav-item px-1">幫助中心</a>
    <a href="javascript:void(0);" class="nav-item px-1">網站地圖</a>
    <a href="javascript:void(0);" class="nav-item px-1">加入最愛</a>

    <button class="navbar-toggler navbar-toggler-right border-0 collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('labels.general.toggle_navigation')">
        <span class="navbar-toggler-icon icon-bar top-bar"></span>
        <span class="navbar-toggler-icon icon-bar middle-bar"></span>
        <span class="navbar-toggler-icon icon-bar bottom-bar"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li><a class="nav-link">{{ date('m月d日') }}(週{{ ['日', '一', '二', '三', '四', '五', '六'][date('w')] }}) 回暖了些</a></li>
            @guest
                <li class="nav-item"><a href="{{ route('frontend.auth.login') }}" class="nav-link {{ active_class(Route::is('frontend.auth.login')) }}">@lang('navs.frontend.login')</a></li>
                <li class="nav-item"><a href="{{ route('frontend.auth.register') }}" class="nav-link {{ active_class(Route::is('frontend.auth.register')) }}">@lang('navs.frontend.register')</a></li>
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuUser" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                       <img src="{{ $logged_in_user->picture }}" class="img-avatar rounded" alt="{{ $logged_in_user->email }}">
                        {{ $logged_in_user->name }}
                    </a>

                    <div class="dropdown-menu animated fadeInDown faster rounded-0 mb-2" aria-labelledby="navbarDropdownMenuUser">
                        @can('view backend')
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item py-2">@lang('navs.frontend.user.administration')</a>
                        @endcan
                        <a href="{{ route('frontend.user.dashboard') }}" class="dropdown-item py-2">@lang('navs.frontend.dashboard')</a>

                        <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item py-2">@lang('navs.general.logout')</a>
                    </div>
                </li>
            @endguest

            <li class="nav-item"><theme-switcher></theme-switcher></li>
        </ul>
    </div>
</nav>
