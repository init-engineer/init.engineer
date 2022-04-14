<?php

namespace App\Domains\Social\Models\Traits\Relationship;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Trait PlatformCardsRelationship.
 */
trait PlatformCardsRelationship
{
    /**
     * Get the platform associated with the cards.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function platform(): HasOne
    {
        return $this->hasOne(Platform::class, 'id', 'platform_id');
    }

    /**
     * Get the card associated with the cards.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function card(): HasOne
    {
        return $this->hasOne(Cards::class, 'id', 'card_id');
    }
}
