@extends('frontend.layouts.app')

@section('title', '純靠北工程師 2019 年度排行榜 | Author by @fizzy-elt')
@section('meta_keyword', '純靠北工程師 2019 年度排行榜 | Author by @fizzy-elt')
@section('meta_description', '純靠北工程師 2019 年度排行榜 | Author by @fizzy-elt')
@section('meta_og_title', '純靠北工程師 2019 年度排行榜 | Author by @fizzy-elt')
@section('meta_og_image', 'https://i.imgur.com/pAGZXNU.png')
@section('meta_og_description', '純靠北工程師 2019 年度排行榜 | Author by @fizzy-elt')

@section('content')
    <div class="d-none d-md-flex align-self-md-center justify-content-md-center align-items-md-center vh-100 title-background">
        <div class="title-box">
            <h1 class="title">2019</h1>
            <h1 class="title"><span>純</span>靠北工程師</h1>
        </div>
        <ul class="homepage-title-list">
            <li>
                <h3>累積的文章數量</h3>
                <h4>2,248</h4>
                <img src="{{ asset('/img/frontend/leaderboard/2019/fizzy-elt/cat.jpg') }}" class="rounded">
            </li>
            <li>
                <h3>累積的社群留言</h3>
                <h4>57,300</h4>
                <img src="{{ asset('/img/frontend/leaderboard/2019/fizzy-elt/isok.jpg') }}" class="rounded">
            </li>
            <li>
                <h3>累積的按讚數量</h3>
                <h4>430,864</h4>
                <img src="{{ asset('/img/frontend/leaderboard/2019/fizzy-elt/Leonardo.jpg') }}" class="rounded">
            </li>
            <li>
                <h3>累積的分享數量</h3>
                <h4>22,920</h4>
                <img src="{{ asset('/img/frontend/leaderboard/2019/fizzy-elt/shareButton.jpg') }}" class="rounded">
            </li>
        </ul>
    </div>

    <div class="d-md-none vh-100 position-relative mobile-background">
        <div class="mobile-title-box">
            <h2 class="mobile-title">純靠北工程師</h2>
            <h3>2019 年度回顧</h3>
        </div>
        <div class="mobile-slider">
            <ul class="homepage-mobile-title-list">
                <li>
                    <h3>累積的文章數量</h3>
                    <h4>2,248</h4>
                    <img src="{{ asset('/img/frontend/leaderboard/2019/fizzy-elt/cat.jpg') }}" class="rounded">
                </li>
                <li>
                    <h3>累積的社群留言</h3>
                    <h4>57,300</h4>
                    <img src="{{ asset('/img/frontend/leaderboard/2019/fizzy-elt/isok.jpg') }}" class="rounded">
                </li>
                <li>
                    <h3>累積的按讚數量</h3>
                    <h4>430,864</h4>
                    <img src="{{ asset('/img/frontend/leaderboard/2019/fizzy-elt/Leonardo.jpg') }}" class="rounded">
                </li>
                <li>
                    <h3>累積的分享數量</h3>
                    <h4>22,920</h4>
                    <img src="{{ asset('/img/frontend/leaderboard/2019/fizzy-elt/shareButton.jpg') }}" class="rounded">
                </li>
            </ul>
        </div>
    </div>

    <hr class="border border-w-4 my-0">

    @include('frontend.leaderboard.2019.fizzy-elt.cards', [
        'card' => [
            'title' => '2019 年度最多讚文章 !!',
            'id' => 3241,
            'img' => 'https://kaobei.engineer/storage/cards/custom/UoQNrcnKqptUza9asCHal3ofsRDkWPBfzmstFK3aXSTTijiyzGIaFcyuZLME44LOk8vRrsrlKVWkg7VUo8aOvM0GSqaEWdrKLooY4aQ3QFLvXEpGiBThvaySFVfeVP3n.png',
            'facebook_primary_like' => 4193,
            'facebook_secondary_like' => 509,
            'twitter_primary_like' => 190,
            'plurk_primary_like' => 7,
        ],
    ])
    @include('frontend.leaderboard.2019.fizzy-elt.cards', [
        'card' => [
            'title' => '2019 年度次多讚文章 !!',
            'id' => 1557,
            'img' => 'https://kaobei.engineer/storage/cards/images/xdYMeuROqBeTgJWRkxlOoEuXr0OxHkN4DjOKK5wu0ojZeSQmmmAj40wVkRguoLbEmDL32i46iwnhLQ5cV37uizGeZvzfNMrNuRpHC4lp3hF0kbqN2Nra2RPM9KJWg3zk.jpeg',
            'facebook_primary_like' => 2422,
            'facebook_secondary_like' => 1751,
            'twitter_primary_like' => 2,
            'plurk_primary_like' => 30,
        ],
    ])
    @include('frontend.leaderboard.2019.fizzy-elt.cards', [
        'card' => [
            'title' => '2019 年度最釣魚文章 !!',
            'id' => 2438,
            'img' => 'https://kaobei.engineer/storage/cards/images/Zh6myk3QtLlL8GHP3yRYwAmyXzbxgnzWhIvsUXMbjXmwNvUfXjvkCx7KkHRGZkWS6wgOb2uj2rc8BFZqNLu5iVYE5OdFLkq0iNZO8ZycwkFrRJKoZFOFiwqbdH3YDCFn.jpeg',
            'facebook_primary_like' => 140,
            'facebook_secondary_like' => 0,
            'twitter_primary_like' => 0,
            'plurk_primary_like' => 0,
        ],
    ])
    @include('frontend.leaderboard.2019.fizzy-elt.cards', [
        'card' => [
            'title' => '2019 年度精選文章 !!',
            'id' => 3151,
            'img' => 'https://kaobei.engineer/storage/cards/images/rexsFhZMwu7tDs1IN2Ui5u00iY1yw32PEX6DiLI8yhoDuLRBDCKXhwIAyW6zoFcSnaZ0cMpDemGarEeGiWwLZmPThMyiHNMQYbfydpXnGnmkGrPQ3vXtGL6vR1gLBsCz.jpeg',
            'facebook_primary_like' => 3226,
            'facebook_secondary_like' => 439,
            'twitter_primary_like' => 118,
            'plurk_primary_like' => 5,
        ],
    ])
    @include('frontend.leaderboard.2019.fizzy-elt.cards', [
        'card' => [
            'title' => '2019 年度精選文章 !!',
            'id' => 2189,
            'img' => 'https://kaobei.engineer/storage/cards/custom/e8iGpYnoiLQjmLIdtu0tDAt771GxwZRiB0ia04fkQDddFuN49cm1yNNaEoP31bcDEJJE7AjJwWGiqEwp4HIqA78X3lSH5PRgkUmk95ewnYFoKOxaxCbxnOeRDR0syzIh.png',
            'facebook_primary_like' => 2983,
            'facebook_secondary_like' => 668,
            'twitter_primary_like' => 1,
            'plurk_primary_like' => 6,
        ],
    ])
    @include('frontend.leaderboard.2019.fizzy-elt.cards', [
        'card' => [
            'title' => '2019 年度精選文章 !!',
            'id' => 1303,
            'img' => 'https://kaobei.engineer/storage/cards/images/gYhf9Ac0rXg8rvMQD23J43o7wGV1l0ZJJyIU4VSvOCMEEpb48BrVH0BRaF5prl7jfIKba8cETRxUiJy1KyW1nWGU3pN0scx95JPljGZJ8P2zxkocKy7q8KQYHyJY3UcK.jpeg',
            'facebook_primary_like' => 493,
            'facebook_secondary_like' => 2636,
            'twitter_primary_like' => 0,
            'plurk_primary_like' => 6,
        ],
    ])
    @include('frontend.leaderboard.2019.fizzy-elt.cards', [
        'card' => [
            'title' => '2019 年度精選文章 !!',
            'id' => 1504,
            'img' => 'https://kaobei.engineer/storage/cards/custom/5cvCYc5BWHycoV7CFCUPrtWffHDM0SEDqgZ298lhi2mni6zdmUnq5UuWcM805jJd3HOwPZINzscqV7heyMDDgZtjURrDo1uzsoprwXT3VAdrZw2XYycLwlGhVt3knrmd.jpg',
            'facebook_primary_like' => 2138,
            'facebook_secondary_like' => 530,
            'twitter_primary_like' => 0,
            'plurk_primary_like' => 9,
        ],
    ])
    @include('frontend.leaderboard.2019.fizzy-elt.cards', [
        'card' => [
            'title' => '2019 年度精選文章 !!',
            'id' => 2261,
            'img' => 'https://kaobei.engineer/storage/cards/custom/myXrdM2uUnD9SY0vkTePaY8jkqJSyrsNdUBjKwHiJaDetLaegaitkwon5rcfbLJcboJTsU3rLKiIwqw6zVm1Gg9dD4RkvuS7tPhMo4QNvc572AoUZOfPWoU7D115bg1X.jpeg',
            'facebook_primary_like' => 2026,
            'facebook_secondary_like' => 344,
            'twitter_primary_like' => 2,
            'plurk_primary_like' => 2,
        ],
    ])
    @include('frontend.leaderboard.2019.fizzy-elt.cards', [
        'card' => [
            'title' => '2019 年度精選文章 !!',
            'id' => 1926,
            'img' => 'https://kaobei.engineer/storage/cards/images/Ax7UsM05ntfSCn0Kl8nmI4d7eqJNbyZEoDn0b32BkDyDGDaL4q0hGG7HyoPfefJA9o5eTlSGFVz0gAGX3BkiH0uVXck8OtAB9Rqtkb7xOSZz5seIVKhqcxccdsR3RyjG.jpeg',
            'facebook_primary_like' => 1658,
            'facebook_secondary_like' => 406,
            'twitter_primary_like' => 1,
            'plurk_primary_like' => 5,
        ],
    ])
    @include('frontend.leaderboard.2019.fizzy-elt.cards', [
        'card' => [
            'title' => '2019 年度精選文章 !!',
            'id' => 2207,
            'img' => 'https://kaobei.engineer/storage/cards/images/9ZFTHMEG3aNaGBrquvL7Zd5ahRnSDY4nbJ8KAsWWly6K641SGWjYYKQPLpYigUgLttwxLcRGH71Vwf9izGqJiOszhFgCMuf1tbDkty1oW4P817qVEu5QWxVLC86PJmWS.jpeg',
            'facebook_primary_like' => 1677,
            'facebook_secondary_like' => 176,
            'twitter_primary_like' => 1,
            'plurk_primary_like' => 0,
        ],
    ])
    @include('frontend.leaderboard.2019.fizzy-elt.cards', [
        'card' => [
            'title' => '2019 年度精選文章 !!',
            'id' => 1821,
            'img' => 'https://kaobei.engineer/storage/cards/custom/gAXadvCGWX9TwaIDnIljTMhjv5Vx4VuaY3VqwplhrQ0xA09CFQRqMJitvO2JuNmxduLShv3ymlzXXHUZNZRGoyaauikjJGfWJY5aGshqO4Vqs2aZllm92BoOMeGj0Js8.png',
            'facebook_primary_like' => 1507,
            'facebook_secondary_like' => 207,
            'twitter_primary_like' => 0,
            'plurk_primary_like' => 5,
        ],
    ])
    @include('frontend.leaderboard.2019.fizzy-elt.cards', [
        'card' => [
            'title' => '2019 年度精選文章 !!',
            'id' => 1743,
            'img' => 'https://kaobei.engineer/storage/cards/images/c3oKNvmtc3oUXP4csoTcfFLIXhOdGxzr8Nc4HCL1lTzA93rS3ePT3zYIY4ZzSpZwRojKKu47Y6JfxV90AIF6JWx1T4KyDaFBAYimhvi7caDKBCqACtEgLHpOIXZazTz4.jpeg',
            'facebook_primary_like' => 1308,
            'facebook_secondary_like' => 375,
            'twitter_primary_like' => 2,
            'plurk_primary_like' => 5,
        ],
    ])

    <div class="container my-5 py-5 animated fadeIn">
        <div class="row">
            <div class="col-md-12 text-center text-white">
                <h1 class="m-2">Author by</h1>
                <img src="https://avatars2.githubusercontent.com/u/43887006" class="rounded" width="128" height="128" />
                <h2 class="m-2"><a href="https://github.com/FizzyElt">@FizzyElt</a></h2>
            </div>
        </div>
    </div>
@endsection

@push('after-styles')
    <!-- fizzy-elt CSS -->
    {{ style('css/leaderboard/2019/fizzy-elt/fizzy-elt.min.css') }}
@endpush
