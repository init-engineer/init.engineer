@extends('frontend.layouts.app')

@section('title', __('Init.Engineer Show - #:nid(:id) :content', ['id' => $cards->id, 'nid' => base_convert($cards->id,
    10, 36), 'content' => Str::limit($cards->content, 64, '...')]))
@section('meta_title', __('#:app:nid | :content', ['app' => appName(), 'nid' => base_convert($cards->id, 10, 36),
    'content' => Str::limit($cards->content, 32, '...')]))
@section('meta_description', Str::limit($cards->content, 128, '...'))
@section('meta_image', $cards->getPicture())
@section('meta_type', 'article')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            {{-- 如果文章被封鎖了，那貼出封鎖資訊 --}}
            @if ($cards->isBlockade())
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
                @if ($cards->isActive())
                    {{-- 社群連結 --}}
                    <card-tag-list :cid="{{ $cards->id }}"></card-tag-list>
                @endif

                {{-- 文章主體 --}}
                <div class="card">
                    {{-- 匿名資訊 --}}
                    <div class="card-header">
                        <div class="media">
                            <img src="/img/frontend/user/nopic_192.gif" class="rounded mx-auto d-block"
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
                    <gallery-slideshow _style="max-height: 360px; border-radius: 0px;" _class="card-img-top"
                        :height="360" src="{{ $cards->getPicture() }}">
                    </gallery-slideshow>

                    {{-- 文章內容 --}}
                    <div class="card-body">
                        <pre class="card-text">{{ $cards->content }}<br />更多精彩文章，盡在純靠北工程師。</pre>
                        <hr class="border" />
                        <h3 class="text-center">純靠北工程師 版權宣告</h3>

                        <p><strong>最後更新日期：2025年9月25日</strong></p>

                        <hr>

                        <p><strong>【重要條款更新通知】</strong></p>

                        <p><strong>本次宣告更新包含溯及既往條款。自 2025年10月1日 起，所有內容將適用最新的「專屬授權」條款。針對在此之前發布的內容，原投稿人若不同意新條款，可「隨時」聯繫本網站管理員申請下架。詳情請見第六條。</strong></p>

                        <hr>

                        <p>歡迎使用純靠北工程師（以下簡稱「本網站」）。提交任何內容至本網站前，請詳細閱讀本版權宣告。一旦提交，即代表您已同意並接受所有條款。</p>

                        <h4><strong>第一條：網站程式碼與設計</strong></h4>

                        <p>本網站之軟體、原始程式碼、網站架構與網頁設計，係依據 <a href="https://github.com/init-engineer/init.engineer/blob/main/LICENSE">MIT License</a> 開源授權。此授權範圍<strong>不包含</strong>本網站之商標（如「純靠北工程師」名稱與標誌），亦<strong>不包含</strong>任何使用者投稿內容。</p>

                        <h4><strong>第二條：使用者投稿內容之專屬授權</strong></h4>

                        <ol>
                            <li><strong>著作權歸屬</strong>：您所投稿原創內容之著作權，仍歸屬於您本人。</li>

                            <li><strong>專屬授權（Exclusive License）</strong>：您一旦投稿，即同意授予本網站一份<strong>「專屬、無償、永久、不可撤銷且可轉授權」</strong>的權利。此授權包含：
                                <ul>
                                    <li><strong>獨家權利</strong>：僅有本網站能在全球範圍內，公開使用、散布、展示您的投稿內容。</li>
                                    <li><strong>您的義務</strong>：作為專屬授權的對價，您不得再將「同一份」投稿內容，發布於任何其他公開平台，包含但不限於您的個人社群媒體或部落格。</li>
                                    <li><strong>永久性</strong>：此授權為永久有效，無法撤銷。</li>
                                    <li><strong>無償性</strong>：本網站使用您的內容不支付任何費用。</li>
                                    <li><strong>可轉授權</strong>：本網站可將上述權利轉授權予第三方。</li>
                                </ul>
                            </li>

                            <li><strong>內容保證</strong>：您保證投稿內容為原創，且未侵害任何第三方權利。若引發法律糾紛，將由您個人承擔全部責任。</li>
                        </ol>

                        <h4><strong>第三條：內容使用與分享</strong></h4>

                        <ol>
                            <li><strong>允許的分享</strong>：內容可透過本網站的「分享」功能或頁面網址進行分享。所有分享皆須清楚標示來源為「純靠北工程師」。</li>

                            <li><strong>禁止的行為</strong>：除前項允許的分享方式外，嚴格禁止任何人（包含原投稿人）以複製、截圖、下載等方式，重製或轉載本網站的任何內容。</li>
                        </ol>

                        <h4><strong>第四條：本網站之權利與責任</strong></h4>

                        <ol>
                            <li><strong>侵權維護</strong>：基於此專屬授權，當第三方盜用或抄襲投稿內容時，本網站有權以自身名義採取警告、訴訟等法律行動。</li>

                            <li><strong>免責聲明</strong>：本網站為匿名平台，無法審核內容之真實性與合法性。所有內容僅代表投稿人立場，與本網站無關。</li>

                            <li><strong>侵權通知</strong>：若您認為網站上有內容侵害您的著作權，請與我們聯繫，我們將依法處理。</li>
                        </ol>

                        <h4><strong>第五條：法律責任與條款修改</strong></h4>

                        <p>任何違反本宣告之行為，均屬侵權或違約，本網站將保留法律追訴權，並要求賠償所有損失（含律師費與訴訟費用）。本網站有權隨時修改本宣告，修改後將直接公布於網站，不另行通知。建議您定期查看最新條款。</p>

                        <h4><strong>第六條：條款溯及既往與權利區分</strong></h4>

                        <ol>
                            <li><strong>效力溯及</strong>：本版權宣告（特別是第二條之專屬授權），將溯及既往適用於所有曾發布於本網站的內容。</li>

                            <li><strong>新舊文章之權利區分</strong>：
                                <ul>
                                    <li><strong>關於 2025年10月1日 前發布之內容</strong>：若您是此日期前發布內容的原投稿人且不同意本宣告之專屬授權條款，您<strong>隨時</strong>有權聯繫本網站管理員，在提供適當證明後申請下架您的投稿。在您申請下架前，該內容將依本宣告條款進行管理。</li>
                                    <li><strong>關於 2025年10月1日 (含當日) 起發布之內容</strong>：所有在此日期後送出的投稿，一經發布即代表投稿人已閱讀、理解並同意本宣告的所有條款，此專屬授權為永久且不可撤銷。</li>
                                </ul>
                            </li>
                        </ol>
                    </div>

                    @if ($cards->isPublish())
                        {{-- 文章留言 --}}
                        <div class="card-footer">
                            @guest
                                <div class="content">
                                    <div class="inputGroup">
                                        <img class="rounded mx-auto text-left" style="height: 64px;"
                                            src="/img/frontend/user/nopic_192.gif" alt="Default Picture" />
                                        <div style="font-size: 18px; display: inline-block;">
                                            <p class="mb-0 ml-2">尚未登入</p>
                                        </div>
                                        <textarea class="form-control cards-editor mt-2" rows="3" placeholder="您需要先登入，才能夠留言。" disabled="disabled"></textarea>
                                    </div>
                                    <div class="buttons text-right my-2">
                                        <x-utils.link :href="route('frontend.auth.login', [
                                            'redirect' => route('frontend.social.cards.show', ['id' => $cards->id]),
                                        ])" :text="__('Login')" class="btn btn-info btn-lg" />
                                    </div>
                                </div>
                            @else
                                <comments-reply name="{{ $logged_in_user->name }}" picture="{{ $logged_in_user->avatar }}"
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
