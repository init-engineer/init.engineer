<?php

namespace App\Domains\Announcement\Models\Traits\Method;

/**
 * Trait AnnouncementMethod.
 */
trait AnnouncementMethod
{
    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
