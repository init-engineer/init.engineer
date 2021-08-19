@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('codeMessage', __('服務無法使用'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: '服務無法使用。'))
