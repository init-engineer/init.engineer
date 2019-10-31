<?php

namespace App\Models\Social\Traits\Relationship;

use App\Models\Social\Images;
use App\Models\Social\Comments;
use App\Models\Social\MediaCards;

/**
 * Class CardsRelationship.
 */
trait CardsRelationship
{
    /**
     * @return mixed
     */
    public function images()
    {
        return $this->hasMany(Images::class, 'card_id', 'id');
    }

    /**
     * @return mixed
     */
    public function medias()
    {
        return $this->hasMany(MediaCards::class, 'card_id', 'id');
    }

    /**
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany(Comments::class, 'card_id', 'id');
    }
}
