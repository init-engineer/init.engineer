@extends('frontend.layouts.app')

@section('title', __('Init.Engineer Show - #:nid(:id) :content', ['id' => $cards->id, 'nid' => base_convert($cards->id, 10, 36), 'content' => Str::limit($cards->content, 64, '...')]))
@section('meta_title', __('#:app:nid | :content', ['app' => appName(), 'nid' => base_convert($cards->id, 10, 36), 'content' => Str::limit($cards->content, 32, '...')]))
@section('meta_description', Str::limit($cards->content, 128, '...'))
@section('meta_image', $cards->getPicture())
@section('meta_type', 'article')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            {{-- 如果文章被封鎖了，那貼出封鎖資訊 --}}
            @if($cards->isBlockade())
                <div class="col-md-12 mb-2">
                    <div class="alert alert-danger position-static rounded" role="alert">
                        <h4 class="alert-heading">這篇文章已經封鎖！</h4>
                        <p>封鎖原因：<strong>{{ $cards->blockade_remarks }}</strong></p>
                        <hr>
                        <p class="mb-1">被封鎖的文章將會有以下處置：</p>
                        <ul class="mb-0">
                            <li>會移除同步發表於各大社群平台當中的文章。</li>
                            <li>文章社群連結功能將會關閉，不會提供各大社群的超連結。</li>
                            <li>文章列表當中將不會顯示該篇文章。</li>
                            <li>文章留言功能將會關閉，也不會提供歷史留言的瀏覽。</li>
                        </ul>
                    </div>
                </div>
            @elseif ($cards->isInactive())
            <div class="col-md-12 mb-2">
                <div class="alert alert-warning position-static rounded" role="alert">
                    <h4 class="alert-heading">這篇文章尚未通過群眾審核。</h4>
                    <hr>
                    <p class="mb-1">尚未通過群眾審核的文章，僅只會開啟以下功能：</p>
                    <ul class="mb-0">
                        <li>文章留言功能。</li>
                    </ul>
                </div>
            </div>
            @endif

            <div class="col-md-8">
                @if($cards->isActive())
                    {{-- 社群連結 --}}
                    <card-tag-list :cid="{{ $cards->id }}"></card-tag-list>
                @endif

                {{-- 文章主體 --}}
                <div class="card">
                    {{-- 匿名資訊 --}}
                    <div class="card-header">
                        <div class="media">
                            <img src="/img/frontend/user/nopic_192.gif"
                                class="rounded mx-auto d-block"
                                style="height: 64px;" />
                            <div class="media-body d-flex justify-content-between pl-2">
                                <h4 class="text-left">
                                    <p>匿名 ಠ_ಠ</p>
                                    <p>#{{ appName() . base_convert($cards->id, 10, 36) }}</p>
                                </h4>
                                <h4 class="text-right">
                                    <p>{{ $cards->created_at->toDateString() }}</p>
                                    <p>{{ $cards->created_at->diffForHumans() }}</p>
                                </h4>
                            </div>
                        </div>
                    </div>

                    {{-- 圖片預覽 --}}
                    <gallery-slideshow
                        _style="max-height: 360px; border-radius: 0px;"
                        _class="card-img-top"
                        :height="360"
                        src="{{ $cards->getPicture() }}">
                    </gallery-slideshow>

                    {{-- 文章內容 --}}
                    <div class="card-body">
                        <pre class="card-text">{{ $cards->content }}</pre>
                    </div>

                    @if($cards->isPublish())
                        {{-- 文章留言 --}}
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
