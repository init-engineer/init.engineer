<?php

namespace App\Domains\Social\Models\Traits\Method;

use Illuminate\Support\Facades\Storage;

/**
 * Trait AdsMethod.
 */
trait AdsMethod
{
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

    /**
     * @return mixed|string
     */
    public function getBanner()
    {
        return Storage::url($this->ads_path);
    }
}
