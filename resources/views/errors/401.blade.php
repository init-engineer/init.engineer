@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('codeMessage', __('需要授權以回應請求'))
@section('code', '401')
@section('message', __('需要授權以回應請求。'))
