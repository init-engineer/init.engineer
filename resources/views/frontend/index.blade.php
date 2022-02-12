@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('content')
<section class="flex flex-col items-center justify-center h-screen gap-6" style="transform: rotate(5deg)">
    <x-home.slogan />
    <x-home.navigations />
</section>
@endsection
