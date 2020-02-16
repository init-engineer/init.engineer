<div class="d-none d-md-flex align-self-md-center justify-content-md-center align-items-md-center vh-100 content-background">
    <h2>{{ $card['title'] }}</h2>
    <div class="article-container">
        <div class="article-content">
            <h2>編號：#{{ $card['id'] }}</h2>
            <h2>傳送門：<a href="https://kaobei.engineer/cards/show/{{ $card['id'] }}">https://kaobei.engineer/cards/show/{{ $card['id'] }}</a></h2>
            <img src="{{ $card['img'] }}" class="rounded">
        </div>
        <div class="article-content">
            <ul>
                <li><h2>Facebook 正式機讚數：{{ $card['facebook_primary_like'] }}</h2></li>
                <li><h2>Facebook 測試機讚數：{{ $card['facebook_secondary_like'] }}</h2></li>
                <li><h2>Twitter 正式機讚數：{{ $card['twitter_primary_like'] }}</h2></li>
                <li><h2>Plurk 正式機讚數：{{ $card['plurk_primary_like'] }}</h2></li>
                <li><h2>總讚數：{{ $card['facebook_primary_like'] + $card['facebook_secondary_like'] + $card['twitter_primary_like'] + $card['plurk_primary_like'] }} &#9996;</h2></li>
            </ul>
            <img class="content-img" src="{{ asset('/img/frontend/leaderboard/2019/fizzy-elt/contentimg.png') }}" class="rounded">
        </div>
    </div>
</div>

<div class="d-md-none vh-100 position-relative content-mobile-background">
    <div class="article-mobile-container">
        <h2>{{ $card['title'] }}</h2>
        <h3>編號：#{{ $card['id'] }}</h3>
        <h3>傳送門：<a href="https://kaobei.engineer/cards/show/{{ $card['id'] }}">https://kaobei.engineer/cards/show/{{ $card['id'] }}</a></h3>
        <h3>總讚數：{{ $card['facebook_primary_like'] + $card['facebook_secondary_like'] + $card['twitter_primary_like'] + $card['plurk_primary_like'] }} &#9996;</h3>
        <img src="{{ $card['img'] }}" class="rounded">
        <h3>Facebook 正式機讚數：{{ $card['facebook_primary_like'] }}</h3>
        <h3>Facebook 測試機讚數：{{ $card['facebook_secondary_like'] }}</h3>
        <h3>Twitter 正式機讚數：{{ $card['twitter_primary_like'] }}</h3>
        <h3>Plurk 正式機讚數：{{ $card['plurk_primary_like'] }}</h3>
    </div>
</div>
