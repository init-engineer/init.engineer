<x-utils.link
    :href="route('frontend.auth.social.login', 'bitbucket')"
    class="btn btn-lg btn-block btn-bitbucket rounded border border-w-3 p-2"
    icon="fab fa-bitbucket"
    :text="__('Login with Bitbucket')"
    :hide="!config('services.bitbucket.active')" />

<x-utils.link
    :href="route('frontend.auth.social.login', 'facebook')"
    class="btn btn-lg btn-block btn-facebook rounded border border-w-3 p-2"
    icon="fab fa-facebook"
    :text="__('Login with Facebook')"
    :hide="!config('services.facebook.active')" />

<x-utils.link
    :href="route('frontend.auth.social.login', 'google')"
    class="btn btn-lg btn-block btn-google rounded border border-w-3 p-2"
    icon="fab fa-google"
    :text="__('Login with Google')"
    :hide="!config('services.google.active')" />

<x-utils.link
    :href="route('frontend.auth.social.login', 'github')"
    class="btn btn-lg btn-block btn-github rounded border border-w-3 p-2"
    icon="fab fa-github"
    :text="__('Login with Github')"
    :hide="!config('services.github.active')" />

<x-utils.link
    :href="route('frontend.auth.social.login', 'linkedin')"
    class="btn btn-lg btn-block btn-linkedin rounded border border-w-3 p-2"
    icon="fab fa-linkedin"
    :text="__('Login with Linkedin')"
    :hide="!config('services.linkedin.active')" />

<x-utils.link
    :href="route('frontend.auth.social.login', 'twitter')"
    class="btn btn-lg btn-block btn-twitter rounded border border-w-3 p-2"
    icon="fab fa-twitter"
    :text="__('Login with Twitter')"
    :hide="!config('services.twitter.active')" />
