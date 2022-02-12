@extends('frontend.layouts.app')

@section('title', __('Home'))

@section('content')
<section class="flex flex-col items-center justify-center h-screen gap-6 -py-4" style="transform: rotate(5deg)">
    <x-home.slogan />
    <x-home.navigations />
</section>
@endsection

{{-- 這裡是首頁的全幅 background --}}
@push("after-styles")
<style>
    body {
        background: url('/images/home-background.png');
        background-size: cover;
    }
</style>
@endpush
