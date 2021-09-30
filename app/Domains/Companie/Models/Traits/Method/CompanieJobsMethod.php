<?php

namespace App\Domains\Companie\Models\Traits\Method;

/**
 * Trait CompanieJobsMethod.
 */
trait CompanieJobsMethod
{
    /**
     * @return bool
     */
    public function isPublish(): bool
    {
        return $this->publish;
    }

    /**
     * @return bool
     */
    public function isClosure(): bool
    {
        return $this->closure;
    }

    /**
     * @return bool
     */
    public function isBlockade(): bool
    {
        return $this->blockade;
    }
}
