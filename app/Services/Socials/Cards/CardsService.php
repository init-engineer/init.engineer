<?php

namespace App\Services\Socials\Cards;

use App\Models\Auth\User;
use App\Models\Social\Cards;
use App\Services\BaseService;
use App\Jobs\Social\MediaCards\PlurkPrimaryDestory;
use App\Jobs\Social\MediaCards\PlurkPrimaryPublish;
use App\Jobs\Social\MediaCards\TwitterPrimaryPublish;
use App\Jobs\Social\MediaCards\TwitterPrimaryDestory;
use App\Jobs\Social\MediaCards\FacebookPrimaryDestory;
use App\Jobs\Social\MediaCards\FacebookPrimaryPublish;
use App\Jobs\Social\MediaCards\FacebookSecondaryDestory;
use App\Jobs\Social\MediaCards\FacebookSecondaryPublish;

/**
 * Class CardsService.
 */
class CardsService extends BaseService implements CardsContract
{
    /**
     * @param Cards $cards
     * @return void
     */
    public function publish(Cards $cards)
    {
        if (env('FACEBOOK_PRIMARY_CREATE_POST', false)) { FacebookPrimaryPublish::dispatch($cards); }
        if (env('FACEBOOK_SECONDARY_CREATE_POST', false)) { FacebookSecondaryPublish::dispatch($cards); }
        if (env('TWITTER_CREATE_POST', false)) { TwitterPrimaryPublish::dispatch($cards); }
        if (env('PLURK_CREATE_POST', false)) { PlurkPrimaryPublish::dispatch($cards); }
    }

    /**
     * @param User  $user
     * @param Cards $cards
     * @param array $options
     * @return void
     */
    public function destory(User $user, Cards $cards, array $options)
    {
        FacebookPrimaryDestory::dispatch($user, $cards, $options);
        FacebookSecondaryDestory::dispatch($user, $cards, $options);
        TwitterPrimaryDestory::dispatch($user, $cards, $options);
        PlurkPrimaryDestory::dispatch($user, $cards, $options);
    }
}
