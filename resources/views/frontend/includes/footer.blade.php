<footer class="footer">
    <div class="footer-copyright py-1">
        <p class="m-0">&nbsp;root@kantai235 > footer -al</p>
    </div>

    <div class="footer-copyright text-center py-1">
            <!-- Footer Links -->
    <div class="container text-center text-md-left mt-5">

        <!-- Grid row -->
        <div class="row mt-3">

            <!-- Grid column -->
            <div class="col-12 col-md-6 mx-auto mb-4">
                <!-- Content -->
                <h3 class="font-weight-bold">關於我們</h3>
                <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px;">
                <p>台灣最大工程師交友網站，你可以不會寫程式，但你不能不知道純靠北工程師，有工程師的讚、大心、加油、哈、哇、嗚及怒到豹斃，這裡絕對有你的感動被留下，我要你天天來發文。</p>
                <hr class="my-4">
                <p class="text-center pt-2">「我不會寫程式。」</p>
                <p class="text-right">—— Powered by 乾太</p>
                <h3 class="font-weight-bold">Our Team</h3>
                <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px;">
                <p><a href="{{ route('frontend.team') }}">關於我們團隊</a></p>
                <hr class="my-4">
                <p class="text-left"><a href="https://www.facebook.com/kantai.zeng"><i class="fab fa-facebook-square mr-3"></i> Kan-Tai Zeng</a></p>
                <p class="text-left"><a href="mailto:kantai.developer@gmail.com"><i class="fas fa-envelope mr-3"></i> kantai.developer@gmail.com</a></p>
            </div>

            <!-- Grid column -->
            <div class="col-6 col-md-3 mx-auto mb-4">
                <!-- Links -->
                <h3 class="font-weight-bold">網站規範</h3>
                <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px;">
                <p><a href="{{ route('frontend.policies') }}">{{ __('navs.frontend.policies') }}</a></p>

                <!-- Links -->
                <h3 class="font-weight-bold mt-5">行動應用程式</h3>
                <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px;">
                <p><a href="https://play.google.com/store/apps/details?id=engineer.kaobei" target="_blank"><img class="rounded" style="max-width: 100%; width: 100%;" src="{{ asset('img/frontend/banner/get-it-on-google-play.png') }}" alt="Get it on Google Play"></a></p>
                <p><a href="javascript:void(0);" onclick="Swal.fire('噢哦！', '我們還沒上架到 App Store 當中，但是有 <a href=\'https\:\/\/testflight.apple.com\/join\/8ZSMJ5fZ\' target=\'_blank\'>TestFlight Beta Testing</a> 可以參與測試計畫。', 'warning');"><img class="rounded" style="max-width: 100%; width: 100%;" src="{{ asset('img/frontend/banner/download-on-the-app-store.png') }}" alt="Download on the App Store"></a></p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-6 col-md-3 mx-auto mb-4">
                <!-- Links -->
                <h3 class="font-weight-bold">Podcast</h3>
                <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px;">
                <p><a href="https://podcasts.apple.com/podcast/id1555933629" target="_blank"><img class="rounded" style="max-width: 100%; width: 100%;" src="{{ asset('img/frontend/banner/listen-on-apple-podcasts.png') }}" alt="Listen on Apple Podcasts"></a></p>
                <p><a href="javascript:void(0);" onclick="Swal.fire('噢哦！', '好像還沒上架，因為 Google 還在審核當中，你可以試試其他平台？', 'warning');"><img class="rounded" style="max-width: 100%; width: 100%;" src="{{ asset('img/frontend/banner/listen-on-google-podcasts.png') }}" alt="Listen on Google Podcasts"></a></p>
                <p><a href="https://open.firstory.me/user/kantai235" target="_blank"><img class="rounded" style="max-width: 100%; width: 100%;" src="{{ asset('img/frontend/banner/listen-on-firstory-podcasts.png') }}" alt="Listen on Firstory Podcasts"></a></p>
                <p><a href="https://open.spotify.com/show/547wJSj4gNMVavGm3X6USM" target="_blank"><img class="rounded" style="max-width: 100%; width: 100%;" src="{{ asset('img/frontend/banner/listen-on-spotify-podcasts.png') }}" alt="Listen on Spotify Podcasts"></a></p>
                <p><a href="https://podcast.kkbox.com/channel/KtJNI76NqwOGJbYV9y" target="_blank"><img class="rounded" style="max-width: 100%; width: 100%;" src="{{ asset('img/frontend/banner/listen-on-kkbox-podcasts.png') }}" alt="Listen on KKBOX Podcasts"></a></p>
                <p><a href="https://pca.st/wijp2bzn" target="_blank"><img class="rounded" style="max-width: 100%; width: 100%;" src="{{ asset('img/frontend/banner/listen-on-pocket-casts-podcasts.png') }}" alt="Listen on Pocket Casts Podcasts"></a></p>
                {{-- <p><a href="#" target="_blank"><img class="rounded" style="max-width: 100%; width: 100%;" src="{{ asset('img/frontend/banner/listen-on-soundon-podcasts.png') }}" alt="Listen on SoundOn Podcasts"></a></p> --}}
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-12 mx-auto mb-md-0 mb-4 text-center">
                <h3 class="m-0 pt-4 font-weight-bold">社群平台</h3>
                <hr class="accent-2 m-0 d-inline-block" style="width: 100%;">
                <div style="display: flex; flex-wrap: wrap; justify-content: center;">
                    <a href="https://www.facebook.com/init.kobeengineer" target="_blank"><img class="img-fluid rounded m-1" style="width: 12rem; max-width: 100%;" src="{{ asset('img/frontend/banner/follow-on-facebook-official.png') }}" alt="Follow on Facebook Official" /></a>
                    <a href="https://www.facebook.com/kaobei.engineer" target="_blank"><img class="img-fluid rounded m-1" style="width: 12rem; max-width: 100%;" src="{{ asset('img/frontend/banner/follow-on-facebook-testing.png') }}" alt="Follow on Facebook Testing" /></a>
                    <a href="https://twitter.com/kaobei_engineer" target="_blank"><img class="img-fluid rounded m-1" style="width: 12rem; max-width: 100%;" src="{{ asset('img/frontend/banner/follow-on-twitter-official.png') }}" alt="Follow on Twitter Official" /></a>
                    <a href="https://www.plurk.com/kaobei_engineer" target="_blank"><img class="img-fluid rounded m-1" style="width: 12rem; max-width: 100%;" src="{{ asset('img/frontend/banner/follow-on-plurk-official.png') }}" alt="Follow on Plurk Official" /></a>
                    <a href="https://mewe.com/p/init.kobeengineer" target="_blank"><img class="img-fluid rounded m-1" style="width: 12rem; max-width: 100%;" src="{{ asset('img/frontend/banner/follow-on-mewe-official.png') }}" alt="Follow on MeWe Official" /></a>
                    <a href="https://www.instagram.com/kaobei.engineer" target="_blank"><img class="img-fluid rounded m-1" style="width: 12rem; max-width: 100%;" src="{{ asset('img/frontend/banner/follow-on-instagram-official.png') }}" alt="Follow on Instagram Official" /></a>
                    <a href="https://kaobei-engineer.tumblr.com" target="_blank"><img class="img-fluid rounded m-1" style="width: 12rem; max-width: 100%;" src="{{ asset('img/frontend/banner/follow-on-tumblr-official.png') }}" alt="Follow on Tumblr Official" /></a>
                    <a href="https://t.me/init_engineer" target="_blank"><img class="img-fluid rounded m-1" style="width: 12rem; max-width: 100%;" src="{{ asset('img/frontend/banner/follow-on-telegram-official.png') }}" alt="Follow on Telegram Official" /></a>
                    <a href="https://discord.gg/pRuFQPC" target="_blank"><img class="img-fluid rounded m-1" style="width: 12rem; max-width: 100%;" src="{{ asset('img/frontend/banner/join-on-discord-guild.png') }}" alt="Join on Discord Guild" /></a>
                    <a href="https://line.me/ti/g2/ln-BcNGvIkD6Kj_-v9DRYg" target="_blank"><img class="img-fluid rounded m-1" style="width: 12rem; max-width: 100%;" src="{{ asset('img/frontend/banner/join-on-line-community.png') }}" alt="Join on Line Community" /></a>
                </div>
            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </div>
    <!-- Copyright -->
        <p class="mt-4">{!! __('strings.frontend.general.all_rights_reserved', ['year' => date('Y'), 'app_name' => app_name()]) !!}</p>
    </div>
    <!-- Copyright -->

    <div class="footer-copyright py-1">
        <p class="m-0">&nbsp;root@kantai235 > ▋</p>
    </div>
</footer>
<!-- Footer -->
