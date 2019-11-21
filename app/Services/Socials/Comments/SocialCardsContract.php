<?php

namespace App\Services\Socials\Comments;

use App\Models\Social\Cards;

/**
 * Interface SocialCardsContract.
 */
interface SocialCardsContract
{
    public function getComments(Cards $cards);
}
