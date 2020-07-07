<footer class="footer bg-black text-white page-footer font-small unique-color-dark">
    <div class="container">
        <!-- Grid row-->
        <div class="row py-4 d-flex align-items-center">
            <!-- Grid column -->
            <div class="col-md-12 col-lg-12 text-center text-md-left mb-4 mb-md-0">
                {{-- <h6 class="mb-0">感謝 <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/1280px-Google_2015_logo.svg.png" style="max-height: 32px;" alt="Google" /> 沒有成為本月伺服器費用贊助商。</h6> --}}
                {{-- <h6 class="mb-0">感謝 <img src="https://scontent.fkhh1-2.fna.fbcdn.net/v/t1.0-9/p960x960/60632115_2551107844909833_885379350264807424_o.jpg?_nc_cat=108&_nc_eui2=AeEz0HxH3HlmTBVYb4VD93bYdgn5MHAS5Ga3__DArrW-3aIWjklB4S-aZ6D3RIgGvx-o7nCyONudBo6f3pORE-j2J6Vv9fQ6RgDso65AZE_Qcw&_nc_ohc=BPa64WCT-s8AQm5nVLdf1d_NeHH99T4IOjeoux6Vq6Sku3Dcn9bEQrPug&_nc_ht=scontent.fkhh1-2.fna&oh=93250fd43302feb72a8178d62c9891c7&oe=5E4B2E41" class="rounded" style="max-height: 32px;" alt="海豹"> 贊助了 10 塊錢，大約是 8.4 個小時的伺服器費用。</h6> --}}
                <h6 class="mb-3">感謝 <img src="/img/frontend/background/WsOFRId.png" alt="Sean" class="rounded" style="max-height: 32px;"> 贊助了 87 塊錢，大約是 52.4 個小時的伺服器費用。</h6>
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row-->
    </div>

    <!-- Footer Links -->
    <div class="container text-center text-md-left mt-5">

        <!-- Grid row -->
        <div class="row mt-3">

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Content -->
                <h6 class="text-white font-weight-bold">關於本站</h6>
                <hr class="bg-white accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 32px;">
                <p><img class="img-fluid rounded w-100" src="{{ asset('/img/frontend/background/WsOFRId.png') }}" alt="就看你能多有梗" /></p>
            </div>

            <!-- Grid column -->
            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-white font-weight-bold">聯絡我們</h6>
                <hr class="bg-white accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 32px;">
                <p><i class="fas fa-envelope mr-3"></i> kantai.developer@gmail.com</p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-white font-weight-bold">服務項目</h6>
                <hr class="bg-white accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 32px;">
                <p><a href="{{ route('frontend.policies') }}">{{ __('navs.frontend.policies') }}</a></p>
                <p><a href="{{ route('frontend.social.cards.index') }}">{{ __('navs.frontend.social.cards.index') }}</a></p>
                <p><a href="{{ route('frontend.social.cards.create') }}">{{ __('navs.frontend.social.cards.create') }}</a></p>
                <p><a href="{{ route('frontend.social.cards.review') }}">群眾審核</a></p>
                <p><a href="{{ route('frontend.animal.index') }}">大頭菜計算機</a></p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-md-0 mb-4">
                <!-- Links -->
                <h6 class="text-white font-weight-bold">社群平台</h6>
                <hr class="bg-white accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 32px;">
                <p><a href="https://kaobei.engineer"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/Zl6Mrfs.png') }}" alt="官方網站" /></a></p>
                <p><a href="https://www.facebook.com/kaobei.engineer"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/zgwvd6x.png') }}" alt="Facebook 測試機" /></a></p>
                <p><a href="https://www.facebook.com/init.kobeengineer"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/3qOl69x.png') }}" alt="Facebook 正式機" /></a></p>
                <p><a href="https://twitter.com/kaobei_engineer"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/aPI28fr.png') }}" alt="Twitter" /></a></p>
                <p><a href="https://www.plurk.com/kaobei_engineer"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/SFcRaLN.png') }}" alt="Plurk" /></a></p>
                <p><a href="https://www.instagram.com/kaobei.engineer"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/6FgkF3R.png') }}" alt="Instagram" /></a></p>
                <p><a href="https://kaobei-engineer.tumblr.com"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/dffwOx9.png') }}" alt="Tumblr" /></a></p>
                <p><a href="https://discord.gg/tPhnrs2"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/tknHq2i.png') }}" alt="Discord" /></a></p>
            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center text-white py-3">
        <p class="m-0">{!! __('strings.frontend.general.all_rights_reserved', ['year' => date('Y'), 'app_name' => app_name()]) !!}</p>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
