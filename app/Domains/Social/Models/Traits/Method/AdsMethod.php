<?php

namespace App\Domains\Social\Models\Traits\Method;

/**
 * Trait AdsMethod.
 */
trait AdsMethod
{
    /**
     * @return bool
     */
    public function isRender(): bool
    {
        return $this->render;
    }

    /**
     * @return bool
     */
    public function isPayment(): bool
    {
        return $this->payment;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
}
