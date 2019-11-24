<?php

namespace App\Services\Socials\Cards;

use App\Models\Social\Cards;

/**
 * Interface CardsContract.
 */
interface CardsContract
{
    public function publish(Cards $cards);

    public function destory(User $user, Cards $cards, array $options);
}
