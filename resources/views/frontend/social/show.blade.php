@extends('frontend.layouts.app')

@section('title', __('Init.Engineer Show - #:nid(:id) :content', ['id' => $cards->id, 'nid' => base_convert($cards->id, 10, 36), 'content' => Str::limit($cards->content, 64, '...')]))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="media">
                            <img src="/img/frontend/user/nopic_192.gif"
                                class="rounded mx-auto d-block"
                                style="height: 64px;" />
                            <div class="media-body pl-2">
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
                                <img src="/img/frontend/user/nopic_192.gif"
                                    class="rounded mx-auto text-left"
                                    style="height: 64px;" />
                                <p class="mb-0 ml-2" style="font-size: 18px; display: inline-block;">留下你的回覆：</p>
                                <textarea
                                    class="form-control cards-editor mt-2"
                                    rows="3"
                                    minlength="30"
                                    maxlength="4096"
                                    placeholder="你在想什麼？"
                                    required></textarea>
                            </div>
                            <div class="buttons text-right my-2">
                                <button class="next" disabled>{{ __('Submit') }}</button>
                            </div>
                        </div>
                        <comments-list :cid="{{ $cards->id }}"></comments-list>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
