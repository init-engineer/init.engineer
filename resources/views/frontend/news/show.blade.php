@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . $news->title)
@section('meta_keyword', app_name() . ' | ' . $news->content)
@section('meta_description', app_name() . ' | ' . $news->content)
@section('meta_og_title', app_name() . ' | ' . $news->content)
@section('meta_og_image', $news->getPicture())
@section('meta_og_description', app_name() . ' | ' . $news->content)

@section('content')
    <div class="container mt-4 p-2 bg-white rounded text-center">
        <h1 class="display-4 my-4">{{ $news->title }}</h1>
        <img src="{{ $news->getPicture() }}" class="rounded w-100" alt="{{ $news->title }}">
    </div><!--container-->
    <div class="container mt-2 p-4 bg-white rounded news">
        @markdown($news->content)
    </div><!--container-->
@endsection

@push('after-styles')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.17.1/build/styles/a11y-dark.min.css">
    <style>
        .news hr {
            margin-top: 4rem;
        }
    </style>
@endpush

@push('after-scripts')
    <script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.17.1/build/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@endpush
