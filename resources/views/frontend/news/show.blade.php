@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.social.cards.index'))

@section('content')
    <div class="container mt-4 p-2 bg-white rounded">
        <h1 class="display-4">{{ $news->title }}</h1>
    </div><!--container-->
    <div class="container mt-2 p-4 bg-white rounded">
        @markdown($news->content)
    </div><!--container-->
@endsection

@push('after-styles')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.17.1/build/styles/a11y-dark.min.css">
@endpush

@push('after-scripts')
    <script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.17.1/build/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@endpush
