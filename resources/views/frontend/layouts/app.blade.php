<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl class="theme-dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, viewport-fit=cover, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ appName() }} | @yield('title')</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="content-type" content="text/html, charset=utf-8">
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'kantai.developer@gmail.com')">

    <meta name="application-name" content="{{ appName() }}">
    <meta property="al:android:app_name" content="純靠北工程師">
    <meta property="al:android:package" content="engineer.kaobei">

    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="url" itemprop="url" content="{{ url()->current() }}">
    <link rel="alternate" href="{{ url()->current() }}" hreflang="x-default">

    <link rel="fluid-icon" href="{{ asset('/img/frontend/background/hold-a-sign-logo.jpg') }}" title="{{ appName() }}">
    <link rel="shortcut icon" href="{{ asset('/img/frontend/background/hold-a-sign-logo.jpg') }}" title="{{ appName() }}">
    <meta name="image" itemprop="image" content="@yield('meta_image', asset('/img/frontend/background/cute-banner.jpg'))">

    <link rel="icon" type="image/png" sizes="48x48" href="/img/fluid/48.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/fluid/96.png">
    <link rel="icon" type="image/png" sizes="144x144" href="/img/fluid/144.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/img/fluid/192.png">

    <link rel="apple-touch-icon" type="image/png" sizes="57x57" href="/img/fluid/57.png">
    <link rel="apple-touch-icon" type="image/png" sizes="72x72" href="/img/fluid/72.png">
    <link rel="apple-touch-icon" type="image/png" sizes="76x76" href="/img/fluid/76.png">
    <link rel="apple-touch-icon" type="image/png" sizes="114x114" href="/img/fluid/114.png">
    <link rel="apple-touch-icon" type="image/png" sizes="120x120" href="/img/fluid/120.png">
    <link rel="apple-touch-icon" type="image/png" sizes="144x144" href="/img/fluid/144.png">
    <link rel="apple-touch-icon" type="image/png" sizes="152x152" href="/img/fluid/152.png">
    <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="/img/fluid/180.png">

    <meta property="article:tag" content="Init Engineer">
    <meta property="article:tag" content="純靠北工程師">
    <meta property="article:tag" content="科技業">
    <meta property="article:tag" content="軟體">
    <meta property="article:tag" content="硬體">
    <meta property="article:tag" content="韌體">

    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:publisher" content="https://www.facebook.com/init.kobeengineer">
    <meta property="og:title" content="@yield('meta_title', appName())">
    <meta property="og:description" content="@yield('meta_description', appName())">
    <meta property="og:image" content="@yield('meta_image', asset('/img/frontend/background/cute-banner.jpg'))">
    <meta property="og:image:alt" content="@yield('meta_description', appName())">
    <meta property="og:image:secure_url" content="@yield('meta_image', asset('/img/frontend/background/cute-banner.jpg'))">
    <meta property="og:type" content="@yield('meta_type', 'website')">
    <meta property="og:site_name" content="{{ appName() }}">
    <meta property="og:author" content="https://www.facebook.com/init.kobeengineer">
    <meta property="og:locale" content="zh_TW">

    <meta name="twitter:site" content="@InitEngineer">
    <meta name="twitter:title" content="@yield('meta_title', appName())">
    <meta name="twitter:description" content="@yield('meta_description', appName())">
    <meta name="twitter:image" content="@yield('meta_image', asset('/img/frontend/background/cute-banner.jpg'))">
    <meta name="twitter:image:src" content="@yield('meta_image', asset('/img/frontend/background/cute-banner.jpg'))">
    <meta name="twitter:card" content="summary_large_image">

    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <meta property="fb:app_id" content="137466300263351">
    <meta property="fb:admins" content="100015671404819">
    <meta property="fb:pages" content="1309707529076258">

    <meta name="msapplication-TileColor" content="#293134">

    <meta name="google-site-verification" content="CB-mlSwYjbeWfQShnfoB47hjVGtmaRQMoKMJCaz8x9s">
    <meta name="facebook-domain-verification" content="1bp1nl4wvjbrhh2xcko06r131zb98a">

    <meta name="application-name" content="{{ appName() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="theme-color" content="#293134">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="supported-color-schemes" content="dark light">

    @yield('meta')

    @stack('before-styles')
    @livewireStyles()
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    @stack('after-styles')
</head>
<body>
    @include('frontend.includes.github')
    @include('includes.partials.read-only')
    @include('includes.partials.logged-in-as')
    @include('includes.partials.announcements')

    <div id="app">
        @include('frontend.includes.nav')
        @if (config('boilerplate.frontend_breadcrumbs'))
            @include('frontend.includes.partials.breadcrumbs')
        @endif
        @include('includes.partials.messages')

        <main>
            @yield('content')
        </main>
        <!--main-->

        @include('frontend.includes.footer')
    </div>
    <!--app-->

    @stack('before-scripts')
    @livewireScripts()
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/frontend.js') }}"></script>
    @stack('after-scripts')
</body>
</html>
