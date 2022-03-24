@extends('frontend.layouts.app')

@section('title', __('Publish picture'))
@section('meta_title', appName() . ' | ' . __('Publish picture'))
@section('meta_description', appName() . ' | ' . __('Publish picture'))

@section('content')
    <publish-picture></publish-picture>
@endsection
