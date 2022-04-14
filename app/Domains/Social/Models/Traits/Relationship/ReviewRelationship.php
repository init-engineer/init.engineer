<?php

namespace App\Domains\Social\Models\Traits\Relationship;

use Illuminate\Database\Eloquent\Relations\HasOne;

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
     * Get the card associated with the review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function card(): HasOne
    {
        return $this->hasOne(Card::class, 'id', 'card_id');
    }
}
