@extends('errors::minimal')

@section('title', __('Task failed successfully'))
@section('codeMessage', __('伺服器成功處理了您的錯誤'))
@section('code', '500')
@section('message', __('伺服器端發生未知或無法處理的錯誤，但我們並沒有因此而掛掉，我們成功的處理了這項錯誤，並讓這項錯誤持續發生。'))
