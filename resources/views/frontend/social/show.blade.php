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
                        @guest
                            <div class="content">
                                <div class="inputGroup">
                                    <img class="rounded mx-auto text-left" style="height: 64px;" src="/img/frontend/user/nopic_192.gif" alt="Default Picture" />
                                    <div style="font-size: 18px; display: inline-block;">
                                        <p class="mb-0 ml-2">尚未登入</p>
                                    </div>
                                    <textarea
                                        class="form-control cards-editor mt-2"
                                        rows="3"
                                        placeholder="您需要先登入，才能夠留言。"
                                        disabled="disabled"></textarea>
                                </div>
                                <div class="buttons text-right my-2">
                                    <x-utils.link
                                        :href="route('frontend.auth.login', ['redirect' => route('frontend.social.cards.show', ['id' => $cards->id])])"
                                        :text="__('Login')"
                                        class="btn btn-info btn-lg" />
                                </div>
                            </div>
                        @else
                            <comments-reply name="{{ $logged_in_user->name }}"
                                picture="{{ $logged_in_user->avatar }}"
                                :cid="{{ $cards->id }}"></comments-reply>
                        @endguest
                        <comments-list :cid="{{ $cards->id }}"></comments-list>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
