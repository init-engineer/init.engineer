<?php

namespace App\Domains\Social\Models\Traits\Relationship;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Comments;
use App\Domains\Social\Models\Platform;

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
        return $this->hasOne(User::class, 'id', 'blockade_by');
    }

    /**
     * Get the comments for the card.
     *
     * @return Comments
     */
    public function replys()
    {
        return $this->hasMany(Comments::class, 'reply', 'comment_id');
    }
}
