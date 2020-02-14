@extends('frontend.layouts.app')

{{-- @section('title', '') --}}
{{-- @section('meta_keyword', '') --}}
{{-- @section('meta_description', '') --}}
{{-- @section('meta_og_title', '') --}}
{{-- @section('meta_og_image', '') --}}
{{-- @section('meta_og_description', '') --}}

@section('content')
    <div class="container-fluid p-0 m-0">
        <div id="all-wrap" class="row d-flex d-md-flex flex-column p-0 m-0">
            <!-- Something code -->
            <section id="leaderBoard-entrance" class="parallax-window" data-parallax="scroll" data-image-src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/entrance-bg.jpg') }}">
                <div class="title-wrap">
                    <p class="entrance-title">純靠北工程師</p>
                    <br>
                    <p class="entrance-title-2">2019年度排行</p>
                </div>
                <div class="scroll-line"></div>
            </section>

            <section id="years-accumulation" class="col-12 p-0 m-0 parallax-window-2" data-parallax="scroll" data-image-src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/years-accumulation-bg.jpg') }}">
                <div class="container p-0">
                    <div class="row  p-0 m-0">
                        <div class="col-12 years-accumulation-wrap p-0 m-0">
                            <div class="years-accumulation-item">
                                <p>年度累積文章數</p>
                                <div id="year-acc-1" class="accumulation-num" data-val=2248></div>
                            </div>
                        </div>
                        <div class="col-12 years-accumulation-wrap p-0 m-0">
                            <div class="years-accumulation-item">
                                <p>年度累積響應數</p>
                                <div id="year-acc-2" class="accumulation-num" data-val=57300></div>
                            </div>
                        </div>
                        <div class="col-12 years-accumulation-wrap p-0 m-0">
                            <div class="years-accumulation-item">
                                <p>年度散播靠北數</p>
                                <div id="year-acc-3" class="accumulation-num" data-val=22920></div>
                            </div>
                        </div>
                        <div class="col-12 years-accumulation-wrap p-0 m-0">
                            <div class="years-accumulation-item">
                                <p>年度收割拇指數</p>
                                <div id="year-acc-4" class="accumulation-num" data-val=430864></div>
                            </div>
                        </div>
                        <div class="col-12 years-accumulation-wrap p-0 m-0">
                            <div class="years-accumulation-item">
                                <p>年度刪除文章數</p>
                                <div id="year-acc-5" class="accumulation-num" data-val=233></div>
                            </div>
                        </div>
                        <div class="col-12 years-accumulation-wrap p-0 m-0">
                            <div class="years-accumulation-item">
                                <p>年度被消失人數</p>
                                <div id="year-acc-6" class="accumulation-num" data-val=77></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="best-articles" class="m-0">
                <div class="container p-0">
                    <div class="row p-0 m-0">
                        <div class="col-sm-12 col-md-6 col-lg-3 article-block p-0" data-aos="fade-up">
                            <div class="article-top">
                                <p class="article-title">年度最多讚</p>
                                <p class="article-number"><a href="https://kaobei.engineer/cards/show/3241">#3241</a></p>
                            </div>
                            <a class="article-img" href="https://kaobei.engineer/storage/cards/custom/UoQNrcnKqptUza9asCHal3ofsRDkWPBfzmstFK3aXSTTijiyzGIaFcyuZLME44LOk8vRrsrlKVWkg7VUo8aOvM0GSqaEWdrKLooY4aQ3QFLvXEpGiBThvaySFVfeVP3n.png" data-lightbox="1">
                                <img src="https://kaobei.engineer/storage/cards/custom/UoQNrcnKqptUza9asCHal3ofsRDkWPBfzmstFK3aXSTTijiyzGIaFcyuZLME44LOk8vRrsrlKVWkg7VUo8aOvM0GSqaEWdrKLooY4aQ3QFLvXEpGiBThvaySFVfeVP3n.png" alt="年度最多讚">
                            </a>
                            <div class="article-likes">
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-fb.png') }}" alt="Facebook">
                                    <p class="sns-num">4702</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-twitter.png') }}" alt="Twitter">
                                    <p class="sns-num">190</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-plurk.png') }}" alt="Plurk">
                                    <p class="sns-num">7</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 article-block p-0" data-aos="fade-up">
                            <div class="article-top">
                                <p class="article-title">年度次多讚</p>
                                <p class="article-number"><a href="https://kaobei.engineer/cards/show/1557">#1557</a></p>
                            </div>
                            <a class="article-img" href="https://kaobei.engineer/storage/cards/images/xdYMeuROqBeTgJWRkxlOoEuXr0OxHkN4DjOKK5wu0ojZeSQmmmAj40wVkRguoLbEmDL32i46iwnhLQ5cV37uizGeZvzfNMrNuRpHC4lp3hF0kbqN2Nra2RPM9KJWg3zk.jpeg" data-lightbox="2">
                                <img src="https://kaobei.engineer/storage/cards/images/xdYMeuROqBeTgJWRkxlOoEuXr0OxHkN4DjOKK5wu0ojZeSQmmmAj40wVkRguoLbEmDL32i46iwnhLQ5cV37uizGeZvzfNMrNuRpHC4lp3hF0kbqN2Nra2RPM9KJWg3zk.jpeg" alt="年度次多讚">
                            </a>
                            <div class="article-likes">
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-fb.png') }}" alt="Facebook">
                                    <p class="sns-num">4173</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-twitter.png') }}" alt="Twitter">
                                    <p class="sns-num">2</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-plurk.png') }}" alt="Plurk">
                                    <p class="sns-num">30</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 article-block p-0" data-aos="fade-up">
                            <div class="article-top">
                                <p class="article-title">年度最佳釣魚</p>
                                <p class="article-number"><a href="https://kaobei.engineer/cards/show/2438">#2438</a></p>
                            </div>
                            <a class="article-img" href="https://kaobei.engineer/storage/cards/images/Zh6myk3QtLlL8GHP3yRYwAmyXzbxgnzWhIvsUXMbjXmwNvUfXjvkCx7KkHRGZkWS6wgOb2uj2rc8BFZqNLu5iVYE5OdFLkq0iNZO8ZycwkFrRJKoZFOFiwqbdH3YDCFn.jpeg" data-lightbox="3">
                                <img src="https://kaobei.engineer/storage/cards/images/Zh6myk3QtLlL8GHP3yRYwAmyXzbxgnzWhIvsUXMbjXmwNvUfXjvkCx7KkHRGZkWS6wgOb2uj2rc8BFZqNLu5iVYE5OdFLkq0iNZO8ZycwkFrRJKoZFOFiwqbdH3YDCFn.jpeg" alt="年度最佳釣魚">
                            </a>
                            <div class="article-likes">
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-fb.png') }}" alt="Facebook">
                                    <p class="sns-num">148</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-twitter.png') }}" alt="Twitter">
                                    <p class="sns-num">0</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-plurk.png') }}" alt="Plurk">
                                    <p class="sns-num">0</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 article-block p-0" data-aos="fade-up">
                            <div class="article-top">
                                <p class="article-title">精選</p>
                                <p class="article-number"><a href="https://kaobei.engineer/cards/show/3151">#3151</a></p>
                            </div>
                            <a class="article-img" href="https://kaobei.engineer/storage/cards/images/rexsFhZMwu7tDs1IN2Ui5u00iY1yw32PEX6DiLI8yhoDuLRBDCKXhwIAyW6zoFcSnaZ0cMpDemGarEeGiWwLZmPThMyiHNMQYbfydpXnGnmkGrPQ3vXtGL6vR1gLBsCz.jpeg" data-lightbox="4">
                                <img src="https://kaobei.engineer/storage/cards/images/rexsFhZMwu7tDs1IN2Ui5u00iY1yw32PEX6DiLI8yhoDuLRBDCKXhwIAyW6zoFcSnaZ0cMpDemGarEeGiWwLZmPThMyiHNMQYbfydpXnGnmkGrPQ3vXtGL6vR1gLBsCz.jpeg" alt="精選">
                            </a>
                            <div class="article-likes">
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-fb.png') }}" alt="Facebook">
                                    <p class="sns-num">3665</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-twitter.png') }}" alt="Twitter">
                                    <p class="sns-num">118</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-plurk.png') }}" alt="Plurk">
                                    <p class="sns-num">5</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 article-block p-0" data-aos="fade-up">
                            <div class="article-top">
                                <p class="article-title">精選</p>
                                <p class="article-number"><a href="https://kaobei.engineer/cards/show/2189">#2189</a></p>
                            </div>
                            <a class="article-img" href="https://kaobei.engineer/storage/cards/custom/e8iGpYnoiLQjmLIdtu0tDAt771GxwZRiB0ia04fkQDddFuN49cm1yNNaEoP31bcDEJJE7AjJwWGiqEwp4HIqA78X3lSH5PRgkUmk95ewnYFoKOxaxCbxnOeRDR0syzIh.png" data-lightbox="5">
                                <img src="https://kaobei.engineer/storage/cards/custom/e8iGpYnoiLQjmLIdtu0tDAt771GxwZRiB0ia04fkQDddFuN49cm1yNNaEoP31bcDEJJE7AjJwWGiqEwp4HIqA78X3lSH5PRgkUmk95ewnYFoKOxaxCbxnOeRDR0syzIh.png" alt="精選">
                            </a>
                            <div class="article-likes">
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-fb.png') }}" alt="Facebook">
                                    <p class="sns-num">3651</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-twitter.png') }}" alt="Twitter">
                                    <p class="sns-num">1</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-plurk.png') }}" alt="Plurk">
                                    <p class="sns-num">6</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 article-block p-0" data-aos="fade-up">
                            <div class="article-top">
                                <p class="article-title">精選</p>
                                <p class="article-number"><a href="https://kaobei.engineer/cards/show/1303">#1303</a></p>
                            </div>
                            <a class="article-img" href="https://kaobei.engineer/storage/cards/images/gYhf9Ac0rXg8rvMQD23J43o7wGV1l0ZJJyIU4VSvOCMEEpb48BrVH0BRaF5prl7jfIKba8cETRxUiJy1KyW1nWGU3pN0scx95JPljGZJ8P2zxkocKy7q8KQYHyJY3UcK.jpeg" data-lightbox="6">
                                <img src="https://kaobei.engineer/storage/cards/images/gYhf9Ac0rXg8rvMQD23J43o7wGV1l0ZJJyIU4VSvOCMEEpb48BrVH0BRaF5prl7jfIKba8cETRxUiJy1KyW1nWGU3pN0scx95JPljGZJ8P2zxkocKy7q8KQYHyJY3UcK.jpeg" alt="精選">
                            </a>
                            <div class="article-likes">
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-fb.png') }}" alt="Facebook">
                                    <p class="sns-num">3129</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-twitter.png') }}" alt="Twitter">
                                    <p class="sns-num">0</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-plurk.png') }}" alt="Plurk">
                                    <p class="sns-num">6</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 article-block p-0" data-aos="fade-up">
                            <div class="article-top">
                                <p class="article-title">精選</p>
                                <p class="article-number"><a href="https://kaobei.engineer/cards/show/1504">#1504</a></p>
                            </div>
                            <a class="article-img" href="https://kaobei.engineer/storage/cards/custom/5cvCYc5BWHycoV7CFCUPrtWffHDM0SEDqgZ298lhi2mni6zdmUnq5UuWcM805jJd3HOwPZINzscqV7heyMDDgZtjURrDo1uzsoprwXT3VAdrZw2XYycLwlGhVt3knrmd.jpg" data-lightbox="7">
                                <img src="https://kaobei.engineer/storage/cards/custom/5cvCYc5BWHycoV7CFCUPrtWffHDM0SEDqgZ298lhi2mni6zdmUnq5UuWcM805jJd3HOwPZINzscqV7heyMDDgZtjURrDo1uzsoprwXT3VAdrZw2XYycLwlGhVt3knrmd.jpg" alt="精選">
                            </a>
                            <div class="article-likes">
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-fb.png') }}" alt="Facebook">
                                    <p class="sns-num">2668</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-twitter.png') }}" alt="Twitter">
                                    <p class="sns-num">0</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-plurk.png') }}" alt="Plurk">
                                    <p class="sns-num">9</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 article-block p-0" data-aos="fade-up">
                            <div class="article-top">
                                <p class="article-title">精選</p>
                                <p class="article-number"><a href="https://kaobei.engineer/cards/show/2261">#2261</a></p>
                            </div>
                            <a class="article-img" href="https://kaobei.engineer/storage/cards/custom/myXrdM2uUnD9SY0vkTePaY8jkqJSyrsNdUBjKwHiJaDetLaegaitkwon5rcfbLJcboJTsU3rLKiIwqw6zVm1Gg9dD4RkvuS7tPhMo4QNvc572AoUZOfPWoU7D115bg1X.jpeg" data-lightbox="8">
                                <img src="https://kaobei.engineer/storage/cards/custom/myXrdM2uUnD9SY0vkTePaY8jkqJSyrsNdUBjKwHiJaDetLaegaitkwon5rcfbLJcboJTsU3rLKiIwqw6zVm1Gg9dD4RkvuS7tPhMo4QNvc572AoUZOfPWoU7D115bg1X.jpeg" alt="精選">
                            </a>
                            <div class="article-likes">
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-fb.png') }}" alt="Facebook">
                                    <p class="sns-num">2370</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-twitter.png') }}" alt="Twitter">
                                    <p class="sns-num">2</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-plurk.png') }}" alt="Plurk">
                                    <p class="sns-num">2</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 article-block p-0" data-aos="fade-up">
                            <div class="article-top">
                                <p class="article-title">精選</p>
                                <p class="article-number"><a href="https://kaobei.engineer/cards/show/1926">#1926</a></p>
                            </div>
                            <a class="article-img" href="https://kaobei.engineer/storage/cards/images/Ax7UsM05ntfSCn0Kl8nmI4d7eqJNbyZEoDn0b32BkDyDGDaL4q0hGG7HyoPfefJA9o5eTlSGFVz0gAGX3BkiH0uVXck8OtAB9Rqtkb7xOSZz5seIVKhqcxccdsR3RyjG.jpeg" data-lightbox="9">
                                <img src="https://kaobei.engineer/storage/cards/images/Ax7UsM05ntfSCn0Kl8nmI4d7eqJNbyZEoDn0b32BkDyDGDaL4q0hGG7HyoPfefJA9o5eTlSGFVz0gAGX3BkiH0uVXck8OtAB9Rqtkb7xOSZz5seIVKhqcxccdsR3RyjG.jpeg" alt="精選">
                            </a>
                            <div class="article-likes">
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-fb.png') }}" alt="Facebook">
                                    <p class="sns-num">2064</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-twitter.png') }}" alt="Twitter">
                                    <p class="sns-num">1</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-plurk.png') }}" alt="Plurk">
                                    <p class="sns-num">5</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 article-block p-0" data-aos="fade-up">
                            <div class="article-top">
                                <p class="article-title">精選</p>
                                <p class="article-number"><a href="https://kaobei.engineer/cards/show/2207">#2207</a></p>
                            </div>
                            <a class="article-img" href="https://kaobei.engineer/storage/cards/images/9ZFTHMEG3aNaGBrquvL7Zd5ahRnSDY4nbJ8KAsWWly6K641SGWjYYKQPLpYigUgLttwxLcRGH71Vwf9izGqJiOszhFgCMuf1tbDkty1oW4P817qVEu5QWxVLC86PJmWS.jpeg" data-lightbox="10">
                                <img src="https://kaobei.engineer/storage/cards/images/9ZFTHMEG3aNaGBrquvL7Zd5ahRnSDY4nbJ8KAsWWly6K641SGWjYYKQPLpYigUgLttwxLcRGH71Vwf9izGqJiOszhFgCMuf1tbDkty1oW4P817qVEu5QWxVLC86PJmWS.jpeg" alt="精選">
                            </a>
                            <div class="article-likes">
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-fb.png') }}" alt="Facebook">
                                    <p class="sns-num">1853</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-twitter.png') }}" alt="Twitter">
                                    <p class="sns-num">1</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-plurk.png') }}" alt="Plurk">
                                    <p class="sns-num">0</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 article-block p-0" data-aos="fade-up">
                            <div class="article-top">
                                <p class="article-title">精選</p>
                                <p class="article-number"><a href="https://kaobei.engineer/cards/show/1821">#1821</a></p>
                            </div>
                            <a class="article-img" href="https://kaobei.engineer/storage/cards/custom/gAXadvCGWX9TwaIDnIljTMhjv5Vx4VuaY3VqwplhrQ0xA09CFQRqMJitvO2JuNmxduLShv3ymlzXXHUZNZRGoyaauikjJGfWJY5aGshqO4Vqs2aZllm92BoOMeGj0Js8.png" data-lightbox="11">
                                <img src="https://kaobei.engineer/storage/cards/custom/gAXadvCGWX9TwaIDnIljTMhjv5Vx4VuaY3VqwplhrQ0xA09CFQRqMJitvO2JuNmxduLShv3ymlzXXHUZNZRGoyaauikjJGfWJY5aGshqO4Vqs2aZllm92BoOMeGj0Js8.png" alt="精選">
                            </a>
                            <div class="article-likes">
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-fb.png') }}" alt="Facebook">
                                    <p class="sns-num">1714</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-twitter.png') }}" alt="Twitter">
                                    <p class="sns-num">0</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-plurk.png') }}" alt="Plurk">
                                    <p class="sns-num">5</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 article-block p-0" data-aos="fade-up">
                            <div class="article-top">
                                <p class="article-title">精選</p>
                                <p class="article-number"><a href="https://kaobei.engineer/cards/show/1743">#1743</a></p>
                            </div>
                            <a class="article-img" href="https://kaobei.engineer/storage/cards/images/c3oKNvmtc3oUXP4csoTcfFLIXhOdGxzr8Nc4HCL1lTzA93rS3ePT3zYIY4ZzSpZwRojKKu47Y6JfxV90AIF6JWx1T4KyDaFBAYimhvi7caDKBCqACtEgLHpOIXZazTz4.jpeg" data-lightbox="12">
                                <img src="https://kaobei.engineer/storage/cards/images/c3oKNvmtc3oUXP4csoTcfFLIXhOdGxzr8Nc4HCL1lTzA93rS3ePT3zYIY4ZzSpZwRojKKu47Y6JfxV90AIF6JWx1T4KyDaFBAYimhvi7caDKBCqACtEgLHpOIXZazTz4.jpeg" alt="精選">
                            </a>
                            <div class="article-likes">
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-fb.png') }}" alt="Facebook">
                                    <p class="sns-num">1683</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-twitter.png') }}" alt="Twitter">
                                    <p class="sns-num">2</p>
                                </div>
                                <div class="sns">
                                    <img src="{{ asset('/img/frontend/leaderboard/2019/yuu-chien/sns-plurk.png') }}" alt="Plurk">
                                    <p class="sns-num">5</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('after-styles')
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <!-- LightBox CSS -->
    {{ style('css/leaderboard/2019/yuu-chien/lightbox.min.css') }}
    <!-- yuu-chien CSS -->
    {{ style('css/leaderboard/2019/yuu-chien/yuu-chien.min.css') }}
    <!-- Using font -->
    <link href="https://fonts.googleapis.com/css?family=Black+Ops+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
@endpush

@push('after-scripts')
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- parallax JS -->
    <script src="https://cdn.jsdelivr.net/parallax.js/1.4.2/parallax.min.js"></script>
    <!-- MOVING LETTERS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <!-- CountUp JS -->
    {!! script('js/leaderboard/2019/yuu-chien/countUp.js') !!}
    <!-- LightBox JS -->
    {!! script('js/leaderboard/2019/yuu-chien/lightbox.min.js') !!}
    <!-- yuu-chien JS -->
    {!! script('js/leaderboard/2019/yuu-chien/yuu-chien.min.js') !!}
@endpush
