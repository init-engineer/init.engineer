@extends('errors::minimal')

@section('title', __('Server Success'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Server Success'))
