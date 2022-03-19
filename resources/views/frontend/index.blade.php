@extends('frontend.layouts.app')

@section('title', __('Home'))

@push('after-scripts')
<script>
    /**
     * 讓右邊的 Title 也能有一點關心使用者的感覺
     */
    const now = new Date();
    let title = '想來靠北些什麼？';
    if (now.getHours() >= 0 && now.getHours() < 6) {
        title = '凌晨安安\n' + title;
    } else if (now.getHours() >= 6 && now.getHours() < 12) {
        title = '早上安安\n' + title;
    } else if (now.getHours() >= 12 && now.getHours() < 18) {
        title = '下午安安\n' + title;
    } else {
        title = '晚上安安\n' + title;
    }

    new Typed('#title', {
        /**
         * @property {string} stringsElement ID of element containing string children
         */
         strings: [title],

        /**
         * @property {number} typeSpeed type speed in milliseconds
         */
        typeSpeed: 120,

        /**
         * @property {boolean} showCursor show cursor
         * @property {string} cursorChar character for cursor
         * @property {boolean} autoInsertCss insert CSS for cursor and fadeOut into HTML <head>
         */
        showCursor: false,
        cursorChar: '|',
        autoInsertCss: true,
    });

    /**
     * JavaScript 載入後先等 3 秒跑 Title，再去跑 Subtitle 的內容。
     * 透過 Typed.js 讓 #subtitle 能夠自動 Typeing 內容。
     */
     setTimeout(function(){
        new Typed('#subtitle', {
            /**
             * @property {array} strings strings to be typed
             */
            strings: [
                '『大象呢，你的大象呢』\n『把你的大象找出來』\n『算了先看我的大象』\n『我們一起看喔』\n...',
                '一個測試工程師走進一家酒吧，要了一杯啤酒\n一個測試工程師走進一家酒吧，要了一杯咖啡\n一個測試工程師走進一家酒吧，要了 999999999 杯啤酒\n一個測試工程師走進一家酒吧，要了 0 杯啤酒\n一個測試工程師走進一家酒吧，要了 -1 杯啤酒，\n...',
                '這案子已經完成了 90%，\n接下來就交給你收尾了。',
                'PHP 睡太久了\nPHP 這二、三十年來\nPHP 沒有好好稱霸開發者生態\n偉大的 PHP 這個巨人\n要清醒囉！',
                '大佬：「我大佬」\n學霸：「我學霸」\n神仙：「我神仙」\n天才：「我天才」\n裝弱的電神：「我弱」\n大佬、電神、學霸、神仙、天才：「我弱」\n...'
            ],

            /**
             * @property {number} typeSpeed type speed in milliseconds
             */
            typeSpeed: 120,

            /**
             * @property {number} backSpeed backspacing speed in milliseconds
             */
            backSpeed: 80,

            /**
             * @property {boolean} smartBackspace only backspace what doesn't match the previous string
             */
            smartBackspace: true,

            /**
             * @property {boolean} loop loop strings
             * @property {number} loopCount amount of loops
             */
            loop: true,
            loopCount: Infinity,

            /**
             * @property {boolean} showCursor show cursor
             * @property {string} cursorChar character for cursor
             * @property {boolean} autoInsertCss insert CSS for cursor and fadeOut into HTML <head>
             */
            showCursor: false,
            cursorChar: '|',
            autoInsertCss: true,
        });
    }, 3000);
</script>
@endpush

@section('content')
<div class="container-fluid py-4" style="max-width: 100vw;">
    <div class="row justify-content-center">
        <div class="col-md-9 order-md-first order-last">
            {{-- ... --}}
        </div><!--col-md-9-->

        <div class="col-md-3 order-md-last order-first text-center">
            <h2 class="my-5 mx-auto" id="title"></h2>
            <div class="form-group">
                <textarea class="form-control form-control-lg" id="subtitle" rows="6" disabled></textarea>
            </div>
            <a class="btn btn-success btn-lg h1 py-2 px-5 my-5" href="{{ route('frontend.social.cards.index') }}">前往投稿</a>
        </div><!--col-md-3-->
    </div>
    <!--row-->
</div>
<!--container-->
@endsection
