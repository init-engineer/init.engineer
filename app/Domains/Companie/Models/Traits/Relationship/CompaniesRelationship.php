<?php

namespace App\Domains\Companie\Models\Traits\Relationship;

use App\Domains\Companie\Models\CompanieJobs;
use App\Domains\Companie\Models\CompanieLinks;
use App\Domains\Companie\Models\CompanieMembers;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Get all of the jobs for the CompaniesRelationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(CompanieJobs::class, 'companie_id', 'id');
    }

    /**
     * Get all of the members for the CompaniesRelationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members(): HasMany
    {
        return $this->hasMany(CompanieMembers::class, 'companie_id', 'id');
    }

    /**
     * Get all of the links for the CompaniesRelationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links(): HasMany
    {
        return $this->hasMany(CompanieLinks::class, 'companie_id', 'id');
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
