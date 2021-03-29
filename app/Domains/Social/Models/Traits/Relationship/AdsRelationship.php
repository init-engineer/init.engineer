<?php

namespace App\Domains\Social\Models\Traits\Relationship;

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
