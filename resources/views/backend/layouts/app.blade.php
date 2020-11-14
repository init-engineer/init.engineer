<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="authorization" content="{{ (Auth::user()) ? Auth::user()->api_token : '' }}">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', __('meta.og.description'))">
    <meta name="keyword" content="@yield('meta_keyword', __('meta.og.keyword'))">
    <meta name="author" content="@yield('meta_author', app_name())">
    <meta name="google-site-verification" content="@yield('meta_google_site_verification', __('meta.google.site_verification'))" />

    <!-- Social: Twitter -->
    <meta name="twitter:card" content="@yield('meta_og_title', __('meta.twitter.card'))">
    <meta name="twitter:site" content="@yield('meta_og_title', __('meta.twitter.site'))">
    <meta name="twitter:title" content="@yield('meta_og_title', __('meta.og.title'))">
    <meta name="twitter:description" content="@yield('meta_og_description', __('meta.og.description'))">
    <meta property="twitter:image:src" content="@yield('meta_og_image', __('meta.og.image'))">

    <!-- Social: Facebook / Open Graph -->
    <meta property="og:url" content="@yield('meta_og_url', URL::full())" />
    <meta property="og:title" content="@yield('meta_og_title', __('meta.og.title'))" />
    <meta property="og:image" content="@yield('meta_og_image', __('meta.og.image'))" />
    <meta property="og:description" content="@yield('meta_og_description', __('meta.og.description'))" />
    <meta property="og:site_name" content="@yield('title', app_name())">
    <meta property="og:type" content="@yield('meta_og_type', __('meta.og.type'))" />
    <meta property="fb:app_id" content="@yield('meta_og_app_id', __('meta.facebook.app_id'))" />

    <!-- Social: Google+ / Schema.org  -->
    <meta itemprop="name" content="@yield('meta_og_title', __('meta.og.title'))"/>
    <meta itemprop="description" content="@yield('meta_og_description', __('meta.og.description'))">
    <meta itemprop="image" content="@yield('meta_og_image', __('meta.og.image'))"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <!-- Apple Touch Icons -->
    <link rel="apple-touch-icon" href="/assets/img/icons/   .png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/icons/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/icons/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/icons/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/img/icons/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/img/icons/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/icons/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/icons/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/img/icons/apple-touch-icon-152x152.png" />

    @yield('meta')

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(mix('css/backend.css')) }}

    @stack('after-styles')
</head>

{{--
     * CoreUI BODY options, add following classes to body to change options
     * // Header options
     * 1. '.header-fixed'					- Fixed Header
     *
     * // Sidebar options
     * 1. '.sidebar-fixed'					- Fixed Sidebar
     * 2. '.sidebar-hidden'				- Hidden Sidebar
     * 3. '.sidebar-off-canvas'		    - Off Canvas Sidebar
     * 4. '.sidebar-minimized'			    - Minimized Sidebar (Only icons)
     * 5. '.sidebar-compact'			    - Compact Sidebar
     *
     * // Aside options
     * 1. '.aside-menu-fixed'			    - Fixed Aside Menu
     * 2. ''			    - Hidden Aside Menu
     * 3. '.aside-menu-off-canvas'	        - Off Canvas Aside Menu
     *
     * // Breadcrumb options
     * 1. '.breadcrumb-fixed'			    - Fixed Breadcrumb
     *
     * // Footer options
     * 1. '.footer-fixed'					- Fixed footer
--}}
<body class="app header-fixed sidebar-fixed aside-menu-off-canvas sidebar-lg-show">
    @include('backend.includes.header')

    <div class="app-body">
        @include('backend.includes.sidebar')

        <main class="main">
            @include('includes.partials.read-only')
            @include('includes.partials.logged-in-as')
            {!! Breadcrumbs::render() !!}

            <div id="app" class="container-fluid">
                <div class="animated fadeIn">
                    <div class="content-header">
                        @yield('page-header')
                    </div><!--content-header-->

                    @include('includes.partials.messages')
                    @yield('content')
                </div><!--animated-->
            </div><!--container-fluid-->
        </main><!--main-->

        @include('backend.includes.aside')
    </div><!--app-body-->

    @include('backend.includes.footer')

    <!-- Scripts -->
    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}
    @stack('after-scripts')

    @include('includes.partials.ga')
</body>
</html>
