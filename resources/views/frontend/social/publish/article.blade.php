@extends('frontend.layouts.app')

@section('title', __('Publish article'))
@section('meta_title', appName() . ' | ' . __('Publish article'))
@section('meta_description', appName() . ' | ' . __('Publish article'))

@section('content')
    <publish-article></publish-article>
@endsection
