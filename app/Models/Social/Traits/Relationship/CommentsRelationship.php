<?php

namespace App\Models\Social\Traits\Relationship;

use App\Models\Social\CardPost;
use App\Models\Social\Cards;

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
     * @return CardPost
     */
    public function post()
    {
        return $this->hasOne(CardPost::class, 'id', 'media_id');
    }
}
