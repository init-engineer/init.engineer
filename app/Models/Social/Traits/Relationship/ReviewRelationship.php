<?php

namespace App\Models\Social\Traits\Relationship;

use App\Models\Social\Cards;

/**
 * Trait ReviewRelationship.
 */
trait ReviewRelationship
{
    /**
     * Get all of the owning user models.
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * Get the card for the comment.
     *
     * @return Cards
     */
    public function card()
    {
        return $this->hasOne(Cards::class, 'id', 'card_id');
    }
}
