@extends('frontend.layouts.app')

@section('title', app_name() . ' | 線上求籤服務')

@section('content')
    <div class="container my-3">
        <fortunes-tools></fortunes-tools>
    </div><!--container-->
@endsection
