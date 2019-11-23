<?php

namespace App\Models\Social\Traits\Relationship;

use App\Models\Social\Images;
use App\Models\Social\Comments;
use App\Models\Social\MediaCards;

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
     * Get the media for the card.
     *
     * @return Media
     */
    public function medias()
    {
        return $this->hasMany(MediaCards::class, 'card_id', 'id');
    }

    /**
     * Get the images for the card.
     *
     * @return Images
     */
    public function images()
    {
        return $this->hasMany(Images::class, 'card_id', 'id');
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
}
