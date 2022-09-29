@if (config('boilerplate.google_analytics') !== 'UA-XXXXX-X')
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('boilerplate.google_analytics') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ config("boilerplate.google_analytics") }}');
    </script>
@endif
