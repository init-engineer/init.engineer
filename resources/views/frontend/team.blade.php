@extends('frontend.layouts.app')

@section('title', app_name() . ' | Our Team')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <p class="display-3">MEET OUR TEAM</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2">{{-- 乾太 --}}
            <div class="our-team">
                <div class="picture">
                    <img class="img-fluid" src="https://avatars.githubusercontent.com/u/11679504">
                </div>
                <div class="team-content">
                    <h3 class="name">乾太</h3>
                    <h4 class="title">中央委員會總書記</h4>
                    <span class="badge badge-pill badge-danger">主服務</span><br />
                    <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px; background: var(--font-primary-color);">
                    <p>我覺得我不會寫程式。</p>
                </div>
                <ul class="social">
                    <li><a href="https://github.com/Kantai235" class="fab fa-github" aria-hidden="true"></a></li>
                    <li><a href="https://www.facebook.com/kantai.zeng" class="fab fa-facebook" aria-hidden="true"></a></li>
                    <li><a href="https://kantai235.github.io" class="fas fa-globe" aria-hidden="true"></a></li>
                    <li><a href="mailto:kantai.developer@gmail.com" class="fas fa-envelope" aria-hidden="true"></a></li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2">{{-- Flexolk --}}
            <div class="our-team">
                <div class="picture">
                    <img class="img-fluid" src="https://avatars.githubusercontent.com/u/25818802">
                </div>
                <div class="team-content">
                    <h3 class="name">Flexolk</h3>
                    <h4 class="title">開發組</h4>
                    <span class="badge badge-pill badge-light">Android</span><br />
                    <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px; background: var(--font-primary-color);">
                    <p>目前就讀國立臺灣海洋大學資訊工程系，UwU 同時也是獸控。</p>
                </div>
                <ul class="social">
                    <li><a href="https://github.com/SmoothieNoIce" class="fab fa-github" aria-hidden="true"></a></li>
                    <li><a href="https://flexolk.xyz" class="fas fa-globe" aria-hidden="true"></a></li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2">{{-- Kagamine Rin --}}
            <div class="our-team">
                <div class="picture">
                    <img class="img-fluid" src="https://avatars.githubusercontent.com/u/17496418">
                </div>
                <div class="team-content">
                    <h3 class="name">Kagamine Rin</h3>
                    <h4 class="title">開發組</h4>
                    <span class="badge badge-pill badge-light">iOS</span><br />
                    <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px; background: var(--font-primary-color);">
                    <p>Medical Informatics & Teacher Education @ Tzu Chi University. 同時也是一位鈴醬控。</p>
                </div>
                <ul class="social">
                    <li><a href="https://github.com/tico88612" class="fab fa-github" aria-hidden="true"></a></li>
                    <li><a href="https://blog.yangjerry.tw" class="fas fa-globe" aria-hidden="true"></a></li>
                    <li><a href="mailto:tico88612@gmail.com" class="fas fa-envelope" aria-hidden="true"></a></li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2">{{-- money626 --}}
            <div class="our-team">
                <div class="picture">
                    <img class="img-fluid" src="https://avatars.githubusercontent.com/u/36372865">
                </div>
                <div class="team-content">
                    <h3 class="name">money626</h3>
                    <h4 class="title">開發組</h4>
                    <span class="badge badge-pill badge-light">Discord Bot</span><br />
                    <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px; background: var(--font-primary-color);">
                    <p>りしれ跨さ小</p>
                </div>
                <ul class="social">
                    <li><a href="https://github.com/money626" class="fab fa-github" aria-hidden="true"></a></li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2">{{-- 威力 --}}
            <div class="our-team">
                <div class="picture">
                    <img class="img-fluid" src="https://avatars.githubusercontent.com/u/30784371">
                </div>
                <div class="team-content">
                    <h3 class="name">威力</h3>
                    <h4 class="title">開發組</h4>
                    <span class="badge badge-pill badge-light">電競徽章</span><br />
                    <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px; background: var(--font-primary-color);">
                    <p>Arduino 好好玩 ...</p>
                </div>
                <ul class="social">
                    <li><a href="https://github.com/willie183tw" class="fab fa-github" aria-hidden="true"></a></li>
                    <li><a href="https://www.facebook.com/willie183tw" class="fab fa-facebook" aria-hidden="true"></a></li>
                    <li><a href="https://home.gamer.com.tw/willie183tw" class="fas fa-globe" aria-hidden="true"></a></li>
                    <li><a href="mailto:willie183tw@gmail.com" class="fas fa-envelope" aria-hidden="true"></a></li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2">{{-- 阿任 --}}
            <div class="our-team">
                <div class="picture">
                    <img class="img-fluid" src="https://avatars.githubusercontent.com/u/25150003">
                </div>
                <div class="team-content">
                    <h3 class="name">阿任</h3>
                    <h4 class="title">公關組</h4>
                    <span class="badge badge-pill badge-info">MeWe 社群</span>
                    <span class="badge badge-pill badge-success">Line 社群</span><br />
                    <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px; background: var(--font-primary-color);">
                    <p>尼豪，我是阿任，是一名快爆肝的大學生。</p>
                </div>
                <ul class="social">
                    <li><a href="https://github.com/haer0248" class="fab fa-github" aria-hidden="true"></a></li>
                    <li><a href="https://www.facebook.com/haer0248" class="fab fa-facebook" aria-hidden="true"></a></li>
                    <li><a href="https://haer0248.me" class="fas fa-globe" aria-hidden="true"></a></li>
                    <li><a href="mailto:admin@haer0248.me" class="fas fa-envelope" aria-hidden="true"></a></li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2">{{-- 沃克 --}}
            <div class="our-team">
                <div class="picture">
                    <img class="img-fluid" src="https://avatars.githubusercontent.com/u/34863780">
                </div>
                <div class="team-content">
                    <h3 class="name">沃克</h3>
                    <h4 class="title">公關組</h4>
                    <span class="badge badge-pill badge-primary">Facebook 社群</span><br />
                    <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px; background: var(--font-primary-color);">
                    <p>後端小廢物。</p>
                </div>
                <ul class="social">
                    <li><a href="https://github.com/Geekgryphon" class="fab fa-github" aria-hidden="true"></a></li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2">{{-- FizzyElt --}}
            <div class="our-team">
                <div class="picture">
                    <img class="img-fluid" src="https://avatars.githubusercontent.com/u/43887006">
                </div>
                <div class="team-content">
                    <h3 class="name">FizzyElt</h3>
                    <h4 class="title">公關組</h4>
                    <span class="badge badge-pill badge-success">Line 社群</span><br />
                    <hr class="accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 128px; background: var(--font-primary-color);">
                    <p>一位平凡的前端技術追求者，JavaScript 高深莫測，永遠學不好，偶爾會用 Golang 取暖。</p>
                </div>
                <ul class="social">
                    <li><a href="https://github.com/FizzyElt" class="fab fa-github" aria-hidden="true"></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-scripts')
@endpush

@push('after-styles')
<style>
.our-team {
    height: 100%;
    padding: 30px 0 40px;
    margin-bottom: 30px;
    background-color: var(--background-primary);
    text-align: center;
    overflow: hidden;
    position: relative;
}

.our-team .picture {
    display: inline-block;
    height: 130px;
    width: 130px;
    margin-bottom: 32px;
    z-index: 1;
    position: relative;
}

.our-team .picture::before {
    content: "";
    width: 100%;
    height: 0;
    border-radius: 50%;
    background-color: var(--color-gray);
    position: absolute;
    bottom: 135%;
    right: 0;
    left: 0;
    opacity: 0.9;
    transform: scale(3);
    transition: all 0.3s linear 0s;
}

.our-team:hover .picture::before {
    height: 100%;
}

.our-team .picture::after {
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background-color: var(--color-gray);
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
}

.our-team .picture img {
    width: 100%;
    height: auto;
    border-radius: 50%;
    transform: scale(1);
    transition: all 0.9s ease 0s;
}

.our-team:hover .picture img {
    box-shadow: 0 0 0 14px #f7f5ec;
    transform: scale(0.7);
}

.our-team .title {
    display: block;
    font-size: 16px;
    color: #a8a8a8;
    text-transform: capitalize;
}

.our-team .social {
    width: 100%;
    padding: 0;
    margin: 0;
    background-color: var(--color-gray);
    position: absolute;
    bottom: -100px;
    left: 0;
    transition: all 0.5s ease 0s;
}

.our-team:hover .social {
    bottom: 0;
}

.our-team .social li {
    display: inline-block;
}

.our-team .social li a {
    display: block;
    padding: 10px;
    font-size: 17px;
    color: white;
    transition: all 0.3s ease 0s;
    text-decoration: none;
}

.our-team .social li a:hover {
    color: var(--background-primary);
    background-color: #f7f5ec;
}
</style>
@endpush
