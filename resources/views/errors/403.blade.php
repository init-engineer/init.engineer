@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('codeMessage', __('您無訪問權限'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: '用戶端並無訪問權限，例如未被授權，所以伺服器拒絕給予應有的回應。不同於 401，伺服端知道用戶端的身份。'))
