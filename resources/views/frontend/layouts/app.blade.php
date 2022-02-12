<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl class="theme-dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'kantai.developer@gmail.com')">
    @yield('meta')

    @stack('before-styles')
    @livewireStyles()
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ mix('css/font.css') }}" rel="stylesheet">
    <link href="{{ mix('css/tailwind.css') }}" rel="stylesheet">
    @stack('after-styles')
</head>

<body class="bg-neutral-900">
    {{-- @include('frontend.includes.github') --}}
    {{-- @include('includes.partials.read-only')
    @include('includes.partials.logged-in-as')
    @include('includes.partials.announcements') --}}

    <x-navbar.navbar />

    <div class="flex justify-center" id="app"
        style="background: url('/images/home-background.png'); background-size: contain;">
        <main class="max-w-screen-lg">
            @yield('content')
        </main>
    </div>
    <!--app-->

    @stack('before-scripts')
    @livewireScripts()
    {{-- <script src="{{ mix('js/manifest.js') }}"></script> --}}
    {{-- <script src="{{ mix('js/vendor.js') }}"></script> --}}
    {{-- <script src="{{ mix('js/frontend.js') }}"></script> --}}
    @stack('after-scripts')
</body>

</html>
