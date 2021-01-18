@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . $card->content)
@section('meta_keyword', app_name() . ' | ' . $card->content)
@section('meta_description', app_name() . ' | ' . $card->content)
@section('meta_og_title', app_name() . ' | ' . $card->content)
@section('meta_og_image', $image)
@section('meta_og_description', app_name() . ' | ' . $card->content)

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col col-12 align-self-center my-2">
                <social-cards-show id="{{ $card->id }}" content="{{ $card->content }}" image="{{ $image }}" created="{{ $card->created_at->diffForHumans() }}"></social-cards-show>
            </div><!--col-->

            <div class="col col-12">
                <label class="col-label">這裡是 Ads 廣告</label>
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-3028179090690423"
                    data-ad-slot="2486547757"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
            </div><!--col-->
        </div><!--row-->
    </div><!--container-->
@endsection

@push('after-styles')
    <style>
        .bg-funky {
        background: #ff1744;
        }
        .heading {
        color: #fff;
        margin: 30px;
        font-weight: 600;
        }
        img {
        max-width: 100%;
        }
        .inbox_msg {
        clear: both;
        overflow: hidden;
        }
        .top_spac {
        margin: 20px 0 0;
        }
        .recent_heading {
        float: left;
        width: 40%;
        }
        .headind_srch {
        padding: 10px 29px 10px 20px;
        overflow: hidden;
        border-bottom: 1px solid #c4c4c4;
        }
        .recent_heading h4 {
        color: #05728f;
        font-size: 21px;
        margin: auto;
        }
        .chat_ib h5 {
        font-size: 15px;
        color: #464646;
        margin: 0 0 8px 0;
        }
        .chat_ib h5 span {
        font-size: 13px;
        float: right;
        }
        .chat_ib p {
        font-size: 14px;
        color: #989898;
        margin: auto;
        }
        .chat_img {
        float: left;
        width: 11%;
        }
        .chat_ib {
        float: left;
        padding: 0 0 0 15px;
        width: 88%;
        }
        .chat_people {
        overflow: hidden;
        clear: both;
        }
        .chat_list {
        border-bottom: 1px solid #c4c4c4;
        margin: 0;
        padding: 18px 16px 10px;
        }
        .inbox_chat {
        /* height: 550px;
        overflow-y: scroll; */
        }
        .active_chat {
        background: #ebebeb;
        }
        .incoming_msg_img {
        display: inline-block;
        width: 6%;
        }
        .received_msg {
        display: inline-block;
        padding: 0 0 0 10px;
        vertical-align: top;
        width: 92%;
        }
        .received_withd_msg p {
        background: #e4e8fb none repeat scroll 0 0;
        border-radius: 3px;
        color: #646464;
        font-size: 18px;
        margin: 0;
        padding: 5px 10px 5px 12px;
        width: 100%;
        }
        .time_date {
        color: #747474;
        display: block;
        font-size: 14px;
        margin: 3px 0 0;
        }
        .received_withd_msg {
        width: 70%;
        }
        .mesgs {
        padding: 40px;
        }
        .sent_msg p {
        background: #3f51b5 none repeat scroll 0 0;
        border-radius: 3px;
        font-size: 18px;
        margin: 0;
        color: #fff;
        padding: 5px 10px 5px 12px;
        width: 100%;
        }
        .outgoing_msg {
        overflow: hidden;
        margin: 4px 0 4px;
        }
        .sent_msg {
        float: right;
        width: auto;
        text-align: right;
        }
        .input_msg_write input {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        color: #4c4c4c;
        font-size: 15px;
        min-height: 48px;
        width: 100%;
        }
        .type_msg {
        border-top: 1px solid #c4c4c4;
        position: relative;
        }
        .msg_send_btn {
        background: #05728f none repeat scroll 0 0;
        border: medium none;
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
        font-size: 17px;
        height: 33px;
        position: absolute;
        right: 0;
        top: 11px;
        width: 33px;
        }
        .messaging {
        background: #fff;
        }
        .msg_history {
        overflow-y: auto;
        }
        .credit {
        margin-bottom: 20px;
        margin-top: 20px;
        }
        .credit a {
        color: #fff;
        font-weight: 300;
        letter-spacing: 2px;
        border-bottom: dotted 1px;
        }
    </style>
@endpush

@push('after-scripts')
    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
@endpush
