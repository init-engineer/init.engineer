@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('content')
<section class="flex items-center h-screen">
    <x-home.slogan />
</section>
@endsection
