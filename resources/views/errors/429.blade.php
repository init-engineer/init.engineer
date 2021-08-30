@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('codeMessage', __('短時間發送過多請求'))
@section('code', '429')
@section('message', __('我勸你是不要給我亂搞ㄛ'))
