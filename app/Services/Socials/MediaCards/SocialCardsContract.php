<?php

namespace App\Services\Socials\MediaCards;

use App\Models\Auth\User;
use App\Models\Social\Cards;

/**
 * Interface SocialCardsContract.
 */
interface SocialCardsContract
{
    public function publish(Cards $cards);

    public function update(Cards $cards);

    public function destory(User $user, Cards $cards, array $options);

    public function buildContent($content = '', array $options = []);
}
