@extends('errors::minimal')

@section('title', __('Page Success'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Page Success'))
