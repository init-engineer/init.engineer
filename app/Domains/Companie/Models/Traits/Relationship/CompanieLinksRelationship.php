<?php

namespace App\Domains\Companie\Models\Traits\Relationship;

use App\Domains\Companie\Models\Companies;

/**
 * Trait CompanieLinksRelationship.
 */
trait CompanieLinksRelationship
{
    /**
     * Get all of the owning user models.
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * Get the compaine associated with the link
     *
     * @return Companies
     */
    public function compaine()
    {
        return $this->hasOne(Companies::class, 'id', 'companie_id');
    }
}
