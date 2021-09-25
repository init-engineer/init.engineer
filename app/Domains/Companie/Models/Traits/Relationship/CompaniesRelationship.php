<?php

namespace App\Domains\Companie\Models\Traits\Relationship;

/**
 * Trait CompaniesRelationship.
 */
trait CompaniesRelationship
{
    /**
     * Get all of the owning user models.
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * Get the blockade user for the job.
     *
     * @return User
     */
    public function blockade()
    {
        return $this->hasOne(User::class, 'id', 'blockade_by');
    }
}
