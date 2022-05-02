<nav class="navbar navbar-expand-lg navbar-bg fixed-top" id="navbar">
    <div class="container-fluid">
        {{-- Brand --}}
        <x-utils.link :href="route('frontend.index')" :text="appName()" class="navbar-brand" />

        {{-- Toggler button --}}
        <button class="navbar-toggler navbar-toggler-right border-0 collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon icon-bar top-bar"></span>
            <span class="navbar-toggler-icon icon-bar middle-bar"></span>
            <span class="navbar-toggler-icon icon-bar bottom-bar"></span>
        </button>

        {{-- Offcanvas --}}
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            {{-- Offcanvas Header --}}
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            {{-- Offcanvas Body --}}
            <div class="offcanvas-body">
                {{-- Right --}}
                <ul class="navbar-nav justify-content-start flex-grow-1">
                    {{-- 文章列表 --}}
                    <li class="nav-item">
                        <x-utils.link
                            class="nav-link"
                            :href="route('frontend.social.cards.index')"
                            :active="activeClass(Route::is('frontend.social.cards.index'))"
                            :text="__('Posts List')" />
                    </li>

                    {{-- 文章投稿 --}}
                    <li class="nav-item">
                        <x-utils.link
                            class="nav-link"
                            :href="route('frontend.social.cards.publish.article')"
                            :active="activeClass(Route::is('frontend.social.cards.publish.article'))"
                            :text="__('Create Submit')" />
                    </li>

                    {{-- 圖片投稿 --}}
                    <li class="nav-item">
                        <x-utils.link
                            class="nav-link"
                            :href="route('frontend.social.cards.publish.picture')"
                            :active="activeClass(Route::is('frontend.social.cards.publish.picture'))"
                            :text="__('Picture Submit')" />
                    </li>

                    {{-- 群眾審核 --}}
                    <li class="nav-item">
                        <x-utils.link
                            class="nav-link"
                            :href="route('frontend.social.cards.review')"
                            :active="activeClass(Route::is('frontend.social.cards.review'))"
                            :text="__('Review Submit')" />
                    </li>

                    {{-- 小工具 --}}
                    <li class="nav-item dropdown">
                        <x-utils.link
                            class="nav-link dropdown-toggle"
                            id="navbarDropdownTools"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            :active="activeClass(Route::is('frontend.tools.fortunes') || Route::is('frontend.tools.kohlrabi'))"
                            :text="__('Init.Engineer Tools')" />

                        <div class="dropdown-menu" aria-labelledby="navbarDropdownTools">
                            <x-utils.link
                                class="dropdown-item"
                                :href="route('frontend.tools.fortunes')"
                                :active="activeClass(Route::is('frontend.tools.fortunes'))"
                                :text="__('Fortunes')" />
                            <x-utils.link
                                class="dropdown-item"
                                :href="route('frontend.tools.kohlrabi')"
                                :active="activeClass(Route::is('frontend.tools.kohlrabi'))"
                                :text="__('Kohlrabi')" />
                        </div>
                    </li>
                </ul>

                {{-- Left --}}
                <ul class="navbar-nav justify-content-end flex-grow-2">
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
                                aria-expanded="false">

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
                                        class="dropdown-item"
                                        :href="route('admin.dashboard')"
                                        :text="__('Administration')" />

                                    {{-- OPCache 監控 --}}
                                    <x-utils.link
                                        class="dropdown-item"
                                        :href="route('frontend.monitor.opcache.index')"
                                        :text="__('OPCache Monitor')" />

                                    {{-- Queue 監控 --}}
                                    <x-utils.link
                                        class="dropdown-item"
                                        :href="route('frontend.monitor.queue-monitor::index')"
                                        :text="__('Queue Monitor')" />
                                @endif

                                {{-- 儀表板 --}}
                                <x-utils.link
                                    class="dropdown-item"
                                    :href="route('frontend.user.dashboard')"
                                    :active="activeClass(Route::is('frontend.user.dashboard'))"
                                    :text="__('Dashboard')" />

                                {{-- 我的帳號 --}}
                                <x-utils.link
                                    class="dropdown-item"
                                    :href="route('frontend.user.account')"
                                    :active="activeClass(Route::is('frontend.user.account'))"
                                    :text="__('My Account')" />

                                {{-- 登出 --}}
                                <x-utils.link
                                    class="dropdown-item"
                                    :text="__('Logout')"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <x-slot name="text">
                                        @lang('Logout')
                                        <x-forms.post
                                            class="d-none"
                                            id="logout-form"
                                            :action="route('frontend.auth.logout')" />
                                    </x-slot>
                                </x-utils.link>
                            </div>
                        </li>
                    @endguest

                    {{-- 主題切換 --}}
                    <theme-switch></theme-switch>
                </ul>
            </div>
        </div>
    </div>
</nav>
