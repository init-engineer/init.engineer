<!-- 駭客任務 Neo -->
<div class="carousel slide d-none d-md-block" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            {{-- 吉祥物 --}}
            {{-- <img class="position-fixed" style="right: 24px; max-width: 192px; bottom: 0px;z-index: 1;" src="https://upload.cc/i1/2018/11/07/7l1RGe.gif" alt="贊助吉祥物"> --}}
            <img src="{{ asset("img/frontend/background/rlaVme5.png") }}" class="d-block w-100" alt="你是工程師嗎">
            <div class="carousel-caption text-left mb-5 pb-5 text-dark">
                <h1 class="text-black-stroke display-3">純靠北工程師</h1>
                <p class="lead">發源自臉書──全台最大工程師廢文社群</p>
                <a class="btn btn-warning btn-lg shake-slow shake-constant shake-constant--hover" href="{{ route('frontend.social.cards.create') }}" role="button">開始去發廢文 <i class="fas fa-poop"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="carousel slide d-md-none" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            {{-- 吉祥物 --}}
            {{-- <img class="position-fixed" style="right: 0px; max-width: 128px; bottom: 0px; z-index: 1;" src="https://upload.cc/i1/2018/11/07/7l1RGe.gif" alt="贊助吉祥物"> --}}
            <img src="{{ asset("img/frontend/background/vznInUz.png") }}" class="d-block w-100" alt="你是工程師嗎">
            <div class="carousel-caption text-left mb-5 text-dark">
                <h3 class="text-black-stroke">純靠北工程師</h3>
                <a class="btn btn-warning btn-md shake-slow shake-constant shake-constant--hover" href="{{ route('frontend.social.cards.create') }}" role="button">開始去發廢文 <i class="fas fa-poop"></i></a>
            </div>
        </div>
    </div>
</div>
