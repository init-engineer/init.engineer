<?php

namespace App\Domains\Companie\Models\Traits\Relationship;

use App\Domains\Auth\Models\User;
use App\Domains\Companie\Models\Companies;

/**
 * Trait CompanieJobsRelationship.
 */
trait CompanieJobsRelationship
{
    /**
     * Get all of the owning user models.
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * Get the compaine associated with the job
     *
     * @return Companies
     */
    public function compaine()
    {
        return $this->hasOne(Companies::class, 'id', 'companie_id');
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
