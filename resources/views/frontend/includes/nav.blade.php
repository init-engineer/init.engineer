<nav class="navbar navbar-expand-lg navbar-bg" id="navbar">
    <x-utils.link
        :href="route('frontend.index')"
        :text="appName()"
        class="navbar-brand" />

    <button class="navbar-toggler navbar-toggler-right border-0 collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('Toggle navigation')">
        <span class="navbar-toggler-icon icon-bar top-bar"></span>
        <span class="navbar-toggler-icon icon-bar middle-bar"></span>
        <span class="navbar-toggler-icon icon-bar bottom-bar"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        {{-- 在左邊的功能 --}}
        <ul class="navbar-nav mr-auto p-auto">
            {{-- 文章列表 --}}
            <li class="nav-item">
                <x-utils.link
                    :href="route('frontend.social.cards.index')"
                    :active="activeClass(Route::is('frontend.social.cards.index'))"
                    :text="__('Posts List')"
                    class="nav-link" />
            </li>

            {{-- 文章投稿 --}}
            <li class="nav-item">
                <x-utils.link
                    :href="route('frontend.social.cards.publish.article')"
                    :active="activeClass(Route::is('frontend.social.cards.publish.article'))"
                    :text="__('Create Submit')"
                    class="nav-link" />
            </li>

            {{-- 圖片投稿 --}}
            <li class="nav-item">
                <x-utils.link
                    :href="route('frontend.social.cards.publish.picture')"
                    :active="activeClass(Route::is('frontend.social.cards.publish.picture'))"
                    :text="__('Picture Submit')"
                    class="nav-link" />
            </li>

            {{-- 群眾審核 --}}
            <li class="nav-item">
                <x-utils.link
                    :href="route('frontend.social.cards.review')"
                    :active="activeClass(Route::is('frontend.social.cards.review'))"
                    :text="__('Review Submit')"
                    class="nav-link" />
            </li>

            {{-- 工作 --}}
            {{-- <li class="nav-item">
                <x-utils.link
                    :href="route('frontend.jobs.index')"
                    :active="activeClass(Route::is('frontend.jobs.*') || Route::is('frontend.companie.*'))"
                    :text="__('Init.Engineer Jobs')"
                    class="nav-link"
                    style="opacity: 0.6;"
                    data-container="body"
                    data-toggle="popover"
                    data-placement="bottom"
                    :data-content="__('To be continued.')" />
            </li> --}}

            {{-- 接案 --}}
            {{-- <li class="nav-item">
                <x-utils.link
                    :href="route('frontend.case.index')"
                    :active="activeClass(Route::is('frontend.case.*'))"
                    :text="__('Init.Engineer Case')"
                    class="nav-link"
                    style="opacity: 0.6;"
                    data-container="body"
                    data-toggle="popover"
                    data-placement="bottom"
                    :data-content="__('To be continued.')" />
            </li> --}}

            {{-- 社群 --}}
            {{-- <li class="nav-item">
                <x-utils.link
                    :href="route('frontend.group.index')"
                    :active="activeClass(Route::is('frontend.group.*'))"
                    :text="__('Init.Engineer Group')"
                    class="nav-link"
                    style="opacity: 0.6;"
                    data-container="body"
                    data-toggle="popover"
                    data-placement="bottom"
                    :data-content="__('To be continued.')" />
            </li> --}}

            {{-- 活動 --}}
            {{-- <li class="nav-item">
                <x-utils.link
                    :href="route('frontend.events.index')"
                    :active="activeClass(Route::is('frontend.events.*'))"
                    :text="__('Init.Engineer Events')"
                    class="nav-link"
                    style="opacity: 0.6;"
                    data-container="body"
                    data-toggle="popover"
                    data-placement="bottom"
                    :data-content="__('To be continued.')"  />
            </li> --}}

            {{-- 研討會 --}}
            {{-- <li class="nav-item">
                <x-utils.link
                    :href="route('frontend.conference.index')"
                    :active="activeClass(Route::is('frontend.conference.*'))"
                    :text="__('Init.Engineer Conference')"
                    class="nav-link"
                    style="opacity: 0.6;"
                    data-container="body"
                    data-toggle="popover"
                    data-placement="bottom"
                    :data-content="__('To be continued.')"  />
            </li> --}}

            {{-- 小工具 --}}
            <li class="nav-item dropdown">
                <x-utils.link
                    :active="activeClass(Route::is('frontend.tools.fortunes') || Route::is('frontend.tools.kohlrabi'))"
                    :text="__('Init.Engineer Tools')"
                    class="nav-link dropdown-toggle"
                    id="navbarDropdownTools"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false" />

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownTools">
                    <x-utils.link class="dropdown-item pt-1 pb-1"
                        :href="route('frontend.tools.fortunes')"
                        :active="activeClass(Route::is('frontend.tools.fortunes'))"
                        :text="__('Fortunes')" />
                    <x-utils.link class="dropdown-item pt-1 pb-1"
                        :href="route('frontend.tools.kohlrabi')"
                        :active="activeClass(Route::is('frontend.tools.kohlrabi'))"
                        :text="__('Kohlrabi')" />
                </div>
            </li>
        </ul>

        {{-- 在右邊的功能 --}}
        <ul class="navbar-nav ml-auto p-auto">
            {{-- @if(config('boilerplate.locale.status') && count(config('boilerplate.locale.languages')) > 1)
                <li class="nav-item dropdown">
                    <x-utils.link
                        :text="__(getLocaleName(app()->getLocale()))"
                        class="nav-link dropdown-toggle"
                        id="navbarDropdownLanguageLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false" />

                    @include('includes.partials.lang')
                </li>
            @endif --}}

            @guest
                {{-- 登入 --}}
                <li class="nav-item">
                    <x-utils.link
                        :href="route('frontend.auth.login')"
                        :active="activeClass(Route::is('frontend.auth.login'))"
                        :text="__('Login')"
                        class="nav-link" />
                </li>

                {{-- 註冊 --}}
                @if (config('boilerplate.access.user.registration'))
                    <li class="nav-item">
                        <x-utils.link
                            :href="route('frontend.auth.register')"
                            :active="activeClass(Route::is('frontend.auth.register'))"
                            :text="__('Register')"
                            class="nav-link" />
                    </li>
                @endif
            @else
                {{-- 個人資料 --}}
                <li class="nav-item dropdown">
                    <x-utils.link
                        href="#"
                        id="navbarDropdown"
                        class="nav-link dropdown-toggle"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        v-pre>

                        {{-- 大頭貼 --}}
                        <x-slot name="text">
                            <img class="rounded-circle" style="max-height: 20px" src="{{ $logged_in_user->avatar }}" />
                            {{ $logged_in_user->name }} <span class="caret"></span>
                        </x-slot>
                    </x-utils.link>

                    <div class="dropdown-menu dropdown-menu-right animate__animated animate__slideInDown animate__faster" aria-labelledby="navbarDropdown">
                        @if ($logged_in_user->isAdmin())
                            {{-- 管理後台 --}}
                            <x-utils.link
                                :href="route('admin.dashboard')"
                                :text="__('Administration')"
                                class="dropdown-item" />
                            {{-- OPCache 監控 --}}
                            <x-utils.link
                                :href="route('frontend.monitor.opcache.index')"
                                :text="__('OPCache Monitor')"
                                class="dropdown-item" />
                            {{-- Queue 監控 --}}
                            <x-utils.link
                                :href="route('frontend.monitor.queue-monitor::index')"
                                :text="__('Queue Monitor')"
                                class="dropdown-item" />
                        @endif

                        {{-- 儀表板 --}}
                        <x-utils.link
                            :href="route('frontend.user.dashboard')"
                            :active="activeClass(Route::is('frontend.user.dashboard'))"
                            :text="__('Dashboard')"
                            class="dropdown-item" />

                        {{-- 我的帳號 --}}
                        <x-utils.link
                            :href="route('frontend.user.account')"
                            :active="activeClass(Route::is('frontend.user.account'))"
                            :text="__('My Account')"
                            class="dropdown-item" />

                        {{-- 登出 --}}
                        <x-utils.link
                            :text="__('Logout')"
                            class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <x-slot name="text">
                                @lang('Logout')
                                <x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
                            </x-slot>
                        </x-utils.link>
                    </div>
                </li>
            @endguest

            {{-- 主題切換 --}}
            <theme-switch></theme-switch>
        </ul>
    </div><!--navbar-collapse-->
</nav>
