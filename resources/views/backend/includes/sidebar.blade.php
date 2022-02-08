<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <img src="{{ asset('img/brand/logo-light.png') }}" width="128" alt="INIT.ENGINEER Logo">
        {{-- <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#full') }}"></use>
        </svg> --}}
        {{-- <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#signet') }}"></use>
        </svg> --}}
    </div><!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.dashboard')"
                :active="activeClass(Route::is('admin.dashboard'), 'c-active')"
                icon="c-sidebar-nav-icon cil-speedometer"
                :text="__('Dashboard')" />
        </li>

        <li class="c-sidebar-nav-title">@lang('System')</li>

        @if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.access.user.list') ||
                $logged_in_user->can('admin.access.user.deactivate') ||
                $logged_in_user->can('admin.access.user.reactivate') ||
                $logged_in_user->can('admin.access.user.clear-session') ||
                $logged_in_user->can('admin.access.user.impersonate') ||
                $logged_in_user->can('admin.access.user.change-password')
            )
        )
            <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.auth.user.*') ||
                                                             Route::is('admin.auth.role.*'), 'c-open c-show') }}">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-user"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Access')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.access.user.list') ||
                            $logged_in_user->can('admin.access.user.deactivate') ||
                            $logged_in_user->can('admin.access.user.reactivate') ||
                            $logged_in_user->can('admin.access.user.clear-session') ||
                            $logged_in_user->can('admin.access.user.impersonate') ||
                            $logged_in_user->can('admin.access.user.change-password')
                        )
                    )
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.user.index')"
                                class="c-sidebar-nav-link"
                                :text="__('User Management')"
                                :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                        </li>
                    @endif

                    @if ($logged_in_user->hasAllAccess())
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.role.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Role Management')"
                                :active="activeClass(Route::is('admin.auth.role.*'), 'c-active')" />
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.announcement.list') ||
                $logged_in_user->can('admin.announcement.deactivate') ||
                $logged_in_user->can('admin.announcement.reactivate')
            )
        )
            <li class="c-sidebar-nav-item {{ activeClass(Route::is('admin.annnouncement.*'), 'c-open c-show') }}">
                <x-utils.link
                    :href="route('admin.announcement.index')"
                    icon="c-sidebar-nav-icon cil-book"
                    class="c-sidebar-nav-link"
                    :text="__('Announcement Management')"
                    :active="activeClass(Route::is('admin.annnouncement.*'), 'c-active')" />
            </li>
        @endif

        @if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.social') ||
                $logged_in_user->can('admin.social.platform') ||
                $logged_in_user->can('admin.social.platform.list') ||
                $logged_in_user->can('admin.social.platform.deactivate') ||
                $logged_in_user->can('admin.social.platform.reactivate') ||
                $logged_in_user->can('admin.social.ads') ||
                $logged_in_user->can('admin.social.ads.list') ||
                $logged_in_user->can('admin.social.ads.deactivate') ||
                $logged_in_user->can('admin.social.ads.reactivate') ||
                $logged_in_user->can('admin.social.cards') ||
                $logged_in_user->can('admin.social.cards.list') ||
                $logged_in_user->can('admin.social.cards.deactivate') ||
                $logged_in_user->can('admin.social.cards.reactivate') ||
                $logged_in_user->can('admin.social.comments') ||
                $logged_in_user->can('admin.social.comments.list') ||
                $logged_in_user->can('admin.social.comments.deactivate') ||
                $logged_in_user->can('admin.social.comments.reactivate') ||
                $logged_in_user->can('admin.social.reviews') ||
                $logged_in_user->can('admin.social.reviews.list') ||
                $logged_in_user->can('admin.social.reviews.deactivate') ||
                $logged_in_user->can('admin.social.reviews.reactivate')
            )
        )
            <li class="c-sidebar-nav-dropdown {{activeClass(
                Route::is('admin.social.platform.*') ||
                Route::is('admin.social.ads.*') ||
                Route::is('admin.social.cards.*') ||
                Route::is('admin.social.comments.*') ||
                Route::is('admin.social.reviews.*'), 'c-open c-show') }}">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-chat-bubble"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Social Sidebar')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.social.platform') ||
                            $logged_in_user->can('admin.social.platform.list') ||
                            $logged_in_user->can('admin.social.platform.deactivate') ||
                            $logged_in_user->can('admin.social.platform.reactivate')
                        )
                    )
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.social.platform.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Platform Management')"
                                :active="activeClass(Route::is('admin.social.platform.*'), 'c-active')" />
                        </li>
                    @endif

                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.social.ads') ||
                            $logged_in_user->can('admin.social.ads.list') ||
                            $logged_in_user->can('admin.social.ads.deactivate') ||
                            $logged_in_user->can('admin.social.ads.reactivate')
                        )
                    )
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.social.ads.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Ads Management')"
                                :active="activeClass(Route::is('admin.social.ads.*'), 'c-active')" />
                        </li>
                    @endif

                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.social.cards') ||
                            $logged_in_user->can('admin.social.cards.list') ||
                            $logged_in_user->can('admin.social.cards.deactivate') ||
                            $logged_in_user->can('admin.social.cards.reactivate')
                        )
                    )
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.social.cards.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Cards Management')"
                                :active="activeClass(Route::is('admin.social.cards.*'), 'c-active')" />
                        </li>
                    @endif

                    {{-- @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.social.comments') ||
                            $logged_in_user->can('admin.social.comments.list') ||
                            $logged_in_user->can('admin.social.comments.deactivate') ||
                            $logged_in_user->can('admin.social.comments.reactivate')
                        )
                    )
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.social.comments.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Comments Management')"
                                :active="activeClass(Route::is('admin.social.comments.*'), 'c-active')" />
                        </li>
                    @endif --}}

                    {{-- @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.social.reviews') ||
                            $logged_in_user->can('admin.social.reviews.list') ||
                            $logged_in_user->can('admin.social.reviews.deactivate') ||
                            $logged_in_user->can('admin.social.reviews.reactivate')
                        )
                    )
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.social.reviews.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Reviews Management')"
                                :active="activeClass(Route::is('admin.social.reviews.*'), 'c-active')" />
                        </li>
                    @endif --}}
                </ul>
            </li>
        @endif

        @if ($logged_in_user->hasAllAccess())
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-list"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Logs')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::dashboard')"
                            class="c-sidebar-nav-link"
                            :text="__('Dashboard')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::logs.list')"
                            class="c-sidebar-nav-link"
                            :text="__('Logs')" />
                    </li>
                </ul>
            </li>
        @endif
    </ul>

    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div><!--sidebar-->
