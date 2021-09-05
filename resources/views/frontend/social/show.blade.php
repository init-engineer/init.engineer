@extends('frontend.layouts.app')

@section('title', __('Init.Engineer Show - #:nid(:id) :content', ['id' => $cards->id, 'nid' => base_convert($cards->id, 10, 36), 'content' => Str::limit($cards->content, 64, '...')]))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="media">
                            <img src="https://s.abcnews.com/images/Lifestyle/ht_pudding_the_fox_03_mt_140821_4x3t_992.jpg"
                                class="rounded mx-auto d-block pr-2"
                                style="height: 64px;" />
                            <div class="media-body">
                                <h4 class="mt-0">匿名 ಠ_ಠ</h4>
                                <p class="text-right mb-0">{{ $cards->created_at->toDateString() }}</p>
                                <p class="text-right mb-0">{{ $cards->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    <gallery-slideshow
                        _style="max-height: 360px; border-radius: 0px;"
                        _class="card-img-top"
                        height="360"
                        src="{{ $cards->getPicture() }}">
                    </gallery-slideshow>
                    <div class="card-body">
                        <pre class="card-text">{{ $cards->content }}</pre>
                    </div>
                    <div class="card-footer">
                        <div class="content">
                            <div class="inputGroup">
                                <img src="https://s.abcnews.com/images/Lifestyle/ht_pudding_the_fox_03_mt_140821_4x3t_992.jpg"
                                    class="rounded mx-auto text-left pr-2 pb-2"
                                    style="height: 64px;" />
                                <p class="mb-0" style="font-size: 18px; display: inline-block;">留下你的回覆：</p>
                                {{-- <label for="name">跟大家分享你的靠北事吧。</label> --}}
                                <textarea
                                    class="form-control cards-editor"
                                    rows="3"
                                    minlength="30"
                                    maxlength="4096"
                                    placeholder="你在想什麼？"
                                    required></textarea>
                            </div>
                            <div class="buttons text-right my-2">
                                <button class="next" disabled>Submit</button>
                            </div>
                        </div>
                        <comments-list :cid="{{ $cards->id }}"></comments-list>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="container-fluid py-4 card" style="max-width: 100vw;">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <img src="{{ $cards->getPicture() }}" class="rounded img-fluid w-100" alt="{{ Str::limit($cards->content, 64, '...') }}">
            </div>
            <div class="col-md-4 content">
                <pre style="font-size: 24px; white-space: pre-line;">{{ $cards->content }}</pre>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <img src="https://init.engineer/img/frontend/user/nopic_192.gif" class="mr-2" style="width: 48px; height: 48px;">
                    <div class="media-body">
                        <h5 class="mt-0">匿名</h5>
                        <p>這是一則範例留言。</p>
                    </div>
                </div>
                <div class="media">
                    <img src="https://init.engineer/img/frontend/user/nopic_192.gif" class="mr-2" style="width: 48px; height: 48px;">
                    <div class="media-body">
                        <h5 class="mt-0">匿名</h5>
                        <p>這是一則範例留言。</p>
                    </div>
                </div>
                <div class="media">
                    <img src="https://init.engineer/img/frontend/user/nopic_192.gif" class="mr-2" style="width: 48px; height: 48px;">
                    <div class="media-body">
                        <h5 class="mt-0">匿名</h5>
                        <p>這是一則範例留言。</p>
                        <div class="media mt-2">
                            <a class="mr-2" href="#">
                                <img src="https://init.engineer/img/frontend/user/nopic_192.gif" style="width: 48px; height: 48px;">
                            </a>
                            <div class="media-body">
                                <h5 class="mt-0">匿名</h5>
                                <p>這是一則範例留言。</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="media">
                    <img src="https://init.engineer/img/frontend/user/nopic_192.gif" class="mr-2" style="width: 48px; height: 48px;">
                    <div class="media-body">
                        <h5 class="mt-0">匿名</h5>
                        <p>這是一則範例留言。</p>
                    </div>
                </div>
                <div class="media">
                    <img src="https://init.engineer/img/frontend/user/nopic_192.gif" class="mr-2" style="width: 48px; height: 48px;">
                    <div class="media-body">
                        <h5 class="mt-0">匿名</h5>
                        <p>這是一則範例留言。</p>
                    </div>
                </div>
                <div class="media">
                    <img src="https://init.engineer/img/frontend/user/nopic_192.gif" class="mr-2" style="width: 48px; height: 48px;">
                    <div class="media-body">
                        <h5 class="mt-0">匿名</h5>
                        <p>這是一則範例留言。</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
