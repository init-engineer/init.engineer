@switch($platform->type)
    @case('facebook')
        <img src="{{ asset('img/icon/facebook.png') }}" class="img-fluid" style="width: 32px;" alt="Facebook"  />
        @break

    @case('twitter')
        <img src="{{ asset('img/icon/twitter.png') }}" class="img-fluid" style="width: 32px;" alt="Twitter" />
        @break

    @case('plurk')
        <img src="{{ asset('img/icon/plurk.png') }}" class="img-fluid" style="width: 32px;" alt="Plurk" />
        @break

    @case('tumblr')
        <img src="{{ asset('img/icon/tumblr.png') }}" class="img-fluid" style="width: 32px;" alt="Tumblr" />
        @break

    @case('telegram')
        <img src="{{ asset('img/icon/telegram.png') }}" class="img-fluid" style="width: 32px;" alt="Telegram" />
        @break

    @case('discord')
        <img src="{{ asset('img/icon/discord.png') }}" class="img-fluid" style="width: 32px;" alt="Discord" />
        @break

    @default
        <img src="{{ asset('img/icon/data-server.png') }}" class="img-fluid" style="width: 32px;" alt="Localhost" />
        @break
@endswitch
