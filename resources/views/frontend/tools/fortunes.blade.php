@extends('frontend.layouts.app')

@section('title', '線上求籤服務')
@section('meta_keyword', appName() . ' | 線上求籤服務，問天、問地、問自己，不如問問純靠北工程師《線上求籤服務》，想幫朋友求籤嗎？先承認你就是你朋友。')
@section('meta_description', appName() . ' | 問天、問地、問自己，不如問問純靠北工程師《線上求籤服務》，想幫朋友求籤嗎？先承認你就是你朋友。')
@section('meta_og_title', appName() . ' | 線上求籤服務')
@section('meta_og_description', appName() . ' | 問天、問地、問自己，不如問問純靠北工程師《線上求籤服務》，想幫朋友求籤嗎？先承認你就是你朋友。')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center w-100 my-2"><span>自助、免費、抽籤算命</span></h1>
            </div>
            <div class="card-body">
                <fortunes-switch></fortunes-switch>
            </div>
            <div class="card-footer">
                <label class="col-label d-table bg-color-primary color-color-primary mt-2">資料來源</label>
                <div class="w-100 m-0 p-2 bg-color-primary">
                    <ul class="mb-0 pl-4">
                        <li><a class="color-primary" href="http://www.chance.org.tw">籤詩網‧淺草觀音寺一百籤</a></li>
                        <li><a class="color-primary" href="https://omikuji-guide.com">おみくじ1～100番の解説まとめ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!--container-->
@endsection
