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
            <div class="col-12 col-md-4 mx-auto mb-4">
                <!-- Content -->
                <h3 class="font-weight-bold">關於我們</h3>
                <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px;">
                <p>台灣最大工程師交友網站，你可以不會寫程式，但你不能不知道純靠北工程師，有工程師的讚、大心、加油、哈、哇、嗚及怒到豹斃，這裡絕對有你的感動被留下，我要你天天來發文。</p>
                <hr class="my-4">
                <p class="text-center pt-2">「我不會寫程式。」</p>
                <p class="text-right">—— Powered by 乾太</p>
            </div>

            <!-- Grid column -->
            <div class="col-6 col-md-5 mx-auto mb-4">
                <h3 class="font-weight-bold">Our Team</h3>
                <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px;">
                <p><a href="{{ route('frontend.team') }}">關於我們團隊</a></p>
                <hr class="my-4">
                <p class="text-left"><a href="https://www.facebook.com/kantai.zeng"><i class="fab fa-facebook-square mr-3"></i> Kan-Tai Zeng</a></p>
                <p class="text-left"><a href="mailto:kantai.developer@gmail.com"><i class="fas fa-envelope mr-3"></i> kantai.developer@gmail.com</a></p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-6 col-md-3 mx-auto mb-4">
                <!-- Links -->
                <h3 class="font-weight-bold">網站規範</h3>
                <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px;">
                <p><a href="{{ route('frontend.policies') }}">{{ __('navs.frontend.policies') }}</a></p>
                <p class="mt-5"><a href="https://play.google.com/store/apps/details?id=engineer.kaobei"><img class="rounded" style="max-width: 100%;width: 12rem;" src="https://www.dashsuites.com/wp-content/uploads/2017/07/android-download.png" alt="Android APP Download"></a></p>
                {{-- <p><a href="{{ route('frontend.social.cards.index') }}">{{ __('navs.frontend.social.cards.index') }}</a></p> --}}
                {{-- <p><a href="{{ route('frontend.social.cards.create') }}">{{ __('navs.frontend.social.cards.create') }}</a></p> --}}
                {{-- <p><a href="{{ route('frontend.social.cards.review') }}">群眾審核</a></p> --}}
                {{-- <p><a href="{{ route('frontend.animal.index') }}">大頭菜計算機</a></p> --}}
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-12 mx-auto mb-md-0 mb-4 text-center">
                <h3 class="m-0 pt-4 font-weight-bold">社群平台</h3>
                <hr class="accent-2 m-0 d-inline-block" style="width: 100%;">
                <div class="col-12 mx-auto mb-md-0 mb-4 text-center">
                    <p style="display: inline-block; margin: 0px; padding: 2px;"><a href="https://kaobei.engineer"><img class="img-fluid rounded" style="width: 100%; max-width: 16rem;" src="{{ asset('img/frontend/banner/Zl6Mrfs.png') }}" alt="官方網站" /></a></p>
                    <p style="display: inline-block; margin: 0px; padding: 2px;"><a href="https://www.facebook.com/kaobei.engineer"><img class="img-fluid rounded" style="width: 100%; max-width: 16rem;" src="{{ asset('img/frontend/banner/zgwvd6x.png') }}" alt="Facebook 測試機" /></a></p>
                    <p style="display: inline-block; margin: 0px; padding: 2px;"><a href="https://www.facebook.com/init.kobeengineer"><img class="img-fluid rounded" style="width: 100%; max-width: 16rem;" src="{{ asset('img/frontend/banner/3qOl69x.png') }}" alt="Facebook 正式機" /></a></p>
                    <p style="display: inline-block; margin: 0px; padding: 2px;"><a href="https://twitter.com/kaobei_engineer"><img class="img-fluid rounded" style="width: 100%; max-width: 16rem;" src="{{ asset('img/frontend/banner/aPI28fr.png') }}" alt="Twitter" /></a></p>
                    <p style="display: inline-block; margin: 0px; padding: 2px;"><a href="https://www.plurk.com/kaobei_engineer"><img class="img-fluid rounded" style="width: 100%; max-width: 16rem;" src="{{ asset('img/frontend/banner/SFcRaLN.png') }}" alt="Plurk" /></a></p>
                    <p style="display: inline-block; margin: 0px; padding: 2px;"><a href="https://www.instagram.com/kaobei.engineer"><img class="img-fluid rounded" style="width: 100%; max-width: 16rem;" src="{{ asset('img/frontend/banner/6FgkF3R.png') }}" alt="Instagram" /></a></p>
                    <p style="display: inline-block; margin: 0px; padding: 2px;"><a href="https://kaobei-engineer.tumblr.com"><img class="img-fluid rounded" style="width: 100%; max-width: 16rem;" src="{{ asset('img/frontend/banner/dffwOx9.png') }}" alt="Tumblr" /></a></p>
                    <p style="display: inline-block; margin: 0px; padding: 2px;"><a href="https://discord.gg/tPhnrs2"><img class="img-fluid rounded" style="width: 100%; max-width: 16rem;" src="{{ asset('img/frontend/banner/tknHq2i.png') }}" alt="Discord" /></a></p>
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
