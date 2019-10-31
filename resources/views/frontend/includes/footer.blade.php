<footer class="footer bg-black text-white page-footer font-small unique-color-dark">
    <div class="container">
        <!-- Grid row-->
        <div class="row py-4 d-flex align-items-center">
            <!-- Grid column -->
            <div class="col-md-12 col-lg-12 text-center text-md-left mb-4 mb-md-0">
                <h6 class="mb-0">感謝 <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/1280px-Google_2015_logo.svg.png" style="max-height: 32px;" alt="Google" /> 沒有成為本月伺服器費用贊助商。</h6>
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
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                <!-- Content -->
                <h6 class="text-white font-weight-bold">關於本站</h6>
                <hr class="bg-white accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 32px;">
                <p>
                    @if (app_imgur())
                        <img class="img-fluid rounded w-100" src="https://i.imgur.com/WsOFRId.png" alt="就看你能多有梗" />
                    @else
                        <img class="img-fluid rounded w-100" src="{{ asset('/img/frontend/background/WsOFRId.png') }}" alt="就看你能多有梗" />
                    @endif
                </p>
            </div>

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-white font-weight-bold">Contact</h6>
                <hr class="bg-white accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 32px;">
                <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
                <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
                <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-white font-weight-bold">服務項目</h6>
                <hr class="bg-white accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 32px;">
                <p><a href="#!">喝ㄋㄟㄋㄟ</a></p>
                <p><a href="#!">Become an Affiliate</a></p>
                <p><a href="#!">Shipping Rates</a></p>
                <p><a href="#!">Help</a></p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <!-- Links -->
                <h6 class="text-white font-weight-bold">社群平台</h6>
                <hr class="bg-white accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 32px;">
                @if (app_imgur())
                    <p><a href="https://kaobei.engineer"><img class="img-fluid rounded" src="https://i.imgur.com/Zl6Mrfs.png" alt="官方網站" /></a></p>
                    <p><a href="https://www.facebook.com/kaobei.engineer"><img class="img-fluid rounded" src="https://i.imgur.com/zgwvd6x.png" alt="Facebook 測試機" /></a></p>
                    <p><a href="https://www.facebook.com/init.kobeengineer"><img class="img-fluid rounded" src="https://i.imgur.com/3qOl69x.png" alt="Facebook 正式機" /></a></p>
                    <p><a href="https://twitter.com/kaobei_engineer"><img class="img-fluid rounded" src="https://i.imgur.com/aPI28fr.png" alt="Twitter" /></a></p>
                    <p><a href="https://www.plurk.com/kaobei_engineer"><img class="img-fluid rounded" src="https://i.imgur.com/SFcRaLN.png" alt="Plurk" /></a></p>
                    <p><a href="https://www.instagram.com/kaobei.engineer"><img class="img-fluid rounded" src="https://i.imgur.com/6FgkF3R.png" alt="Instagram" /></a></p>
                    <p><a href="https://kaobei-engineer.tumblr.com"><img class="img-fluid rounded" src="https://i.imgur.com/dffwOx9.png" alt="Tumblr" /></a></p>
                    <p><a href="https://discord.gg/tPhnrs2"><img class="img-fluid rounded" src="https://i.imgur.com/tknHq2i.png" alt="Discord" /></a></p>
                @else
                    <p><a href="https://kaobei.engineer"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/Zl6Mrfs.png') }}" alt="官方網站" /></a></p>
                    <p><a href="https://www.facebook.com/kaobei.engineer"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/zgwvd6x.png') }}" alt="Facebook 測試機" /></a></p>
                    <p><a href="https://www.facebook.com/init.kobeengineer"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/3qOl69x.png') }}" alt="Facebook 正式機" /></a></p>
                    <p><a href="https://twitter.com/kaobei_engineer"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/aPI28fr.png') }}" alt="Twitter" /></a></p>
                    <p><a href="https://www.plurk.com/kaobei_engineer"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/SFcRaLN.png') }}" alt="Plurk" /></a></p>
                    <p><a href="https://www.instagram.com/kaobei.engineer"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/6FgkF3R.png') }}" alt="Instagram" /></a></p>
                    <p><a href="https://kaobei-engineer.tumblr.com"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/dffwOx9.png') }}" alt="Tumblr" /></a></p>
                    <p><a href="https://discord.gg/tPhnrs2"><img class="img-fluid rounded" src="{{ asset('img/frontend/banner/tknHq2i.png') }}" alt="Discord" /></a></p>
                @endif
            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center text-white py-3">
        <p class="m-0">Copyright © 2019 {{ app_name() }}.<br class="d-block d-md-none">All rights reserved.</p>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
