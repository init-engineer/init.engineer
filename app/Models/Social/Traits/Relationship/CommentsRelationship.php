<?php

namespace App\Models\Social\Traits\Relationship;

use App\Models\Social\Cards;
use App\Models\Social\MediaCards;

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
     * Get the media for the comment.
     *
     * @return MediaCards
     */
    public function media()
    {
        return $this->hasOne(MediaCards::class, 'id', 'media_id');
    }
}
