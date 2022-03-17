@extends('frontend.layouts.app')

@section('title', __('Home'))

@push('after-scripts')
<script>
    new Typed('#subtitle', {
        /**
         * @property {array} strings strings to be typed
         * @property {string} stringsElement ID of element containing string children
         */
        strings: [
            '『大象呢，你的大象呢』\n『把你的大象找出來』\n『算了先看我的大象』\n『我們一起看喔』\n...',
            '一個測試工程師走進一家酒吧，要了一杯啤酒\n一個測試工程師走進一家酒吧，要了一杯咖啡\n一個測試工程師走進一家酒吧，要了 999999999 杯啤酒\n一個測試工程師走進一家酒吧，要了 0 杯啤酒\n一個測試工程師走進一家酒吧，要了 -1 杯啤酒，\n...',
            '這案子已經完成了 90%，\n接下來就交給你收尾了。',
            'PHP 睡太久了\nPHP 這二、三十年來\nPHP 沒有好好稱霸開發者生態\n偉大的 PHP 這個巨人\n要清醒囉！',
            '大佬：「我大佬」\n學霸：「我學霸」\n神仙：「我神仙」\n天才：「我天才」\n裝弱的電神：「我弱」\n大佬、電神、學霸、神仙、天才：「我弱」\n...'
        ],
        stringsElement: null,

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
</script>
@endpush

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <h2 class="my-5 mx-auto">今天又有什麼靠北事？</h2>
            <div class="form-group">
                <textarea class="form-control form-control-lg" id="subtitle" rows="6" disabled></textarea>
            </div>
            <a class="btn btn-success btn-lg h1 py-2 px-5 my-5" href="{{ route('frontend.social.cards.index') }}">前往投稿</a>
            <p class="my-0 pt-5 text-center">其實我也不曉得首頁要放些甚麼才好，有想法的可以<a href="https://discord.gg/tPhnrs2">來 Discord 頻道</a>給我們意見🥺🥺</p>
        </div>
        <!--col-md-12-->
    </div>
    <!--row-->
</div>
<!--container-->
@endsection
