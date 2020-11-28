<?php

namespace App\Domains\Social\Models\Traits\Relationship;

use App\Models\Social\Cards;
use App\Models\Social\Platform;

/**
 * Trait CardPostRelationship.
 */
trait CardPostRelationship
{
    /**
     * Get the card for the post.
     *
     * @return CardPost
     */
    public function card()
    {
        return $this->hasOne(Cards::class, 'id', 'card_id');
    }

    /**
     * Get the platform for the post.
     *
     * @return Platform
     */
    public function platform()
    {
        return $this->hasOne(Platform::class, 'id', 'platform_id');
    }
}
