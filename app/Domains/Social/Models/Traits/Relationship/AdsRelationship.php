<?php

namespace App\Domains\Social\Models\Traits\Relationship;

use App\Models\Social\CardPost;
use App\Models\Social\Comments;
use App\Models\Social\Images;
use App\Models\Social\Review;

/**
 * Trait AdsRelationship.
 */
trait AdsRelationship
{
    /**
     * Get all of the owning user models.
     */
    public function model()
    {
        return $this->morphTo();
    }
}
