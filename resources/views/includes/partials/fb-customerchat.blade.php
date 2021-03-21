@if(config('facebook.customerchat') && config('facebook.customerchat') !== '0000000000000000')
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                xfbml: true,
                version: 'v5.0'
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/zh_TW/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Your customer chat code -->
    <div class="fb-customerchat"
        attribution="setup_tool"
        page_id="{{ config('facebook.customerchat') }}"
        theme_color="#13cf13"
        greeting_dialog_display="hide"
        logged_in_greeting="哈囉，因為版主不在家，所以這邊整理一些常見問題來給你們自己找答案，如果有其他問題，您可以靜待版主回來再回覆您。

        投稿、發表文章
        https://init.engineer/cards/create

        參與群眾審核
        https://init.engineer/cards/review

        參與專案開發
        https://github.com/init-engineer/init.engineer"
        logged_out_greeting="哈囉，因為版主不在家，所以這邊整理一些常見問題來給你們自己找答案，如果有其他問題，您可以靜待版主回來再回覆您。

        投稿、發表文章
        https://init.engineer/cards/create

        參與群眾審核
        https://init.engineer/cards/review

        參與專案開發
        https://github.com/init-engineer/init.engineer">
    </div>
@endif
