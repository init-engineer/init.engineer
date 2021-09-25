<?php

namespace App\Domains\Social\Models\Traits\Relationship;

use App\Domains\Auth\Models\User;
use App\Domains\Social\Models\Comments;
use App\Domains\Social\Models\PlatformCards;
use App\Domains\Social\Models\Reviews;

/**
 * Trait CardsRelationship.
 */
trait CardsRelationship
{
    /**
     * Get all of the owning user models.
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * Get the platform cards for the card.
     *
     * @return PlatformCards
     */
    public function platformCards()
    {
        return $this->hasMany(PlatformCards::class, 'card_id', 'id');
    }

    /**
     * Get the comments for the card.
     *
     * @return Comments
     */
    public function comments()
    {
        return $this->hasMany(Comments::class, 'card_id', 'id');
    }

    /**
     * Get the reviews for the card.
     *
     * @return Review
     */
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'card_id', 'id');
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
}
