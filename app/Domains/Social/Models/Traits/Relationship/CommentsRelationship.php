<?php

namespace App\Domains\Social\Models\Traits\Relationship;

use App\Models\Social\Cards;
use App\Models\Social\Platform;

/**
 * Trait CommentsRelationship.
 */
trait CommentsRelationship
{
    /**
     * Get the card for the comment.
     *
     * @return Cards
     */
    public function card()
    {
        return $this->hasOne(Cards::class, 'id', 'card_id');
    }

    /**
     * Get the platform for the comment.
     *
     * @return Platform
     */
    public function platform()
    {
        return $this->hasOne(Platform::class, 'id', 'platform_id');
    }

    /**
     * Get the blockade user for the card.
     *
     * @return User
     */
    public function blockade()
    {
        return $this->hasOne(User::class, 'blockade_by', 'id');
    }
}