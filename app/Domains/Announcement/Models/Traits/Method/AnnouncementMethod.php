<?php

namespace App\Domains\Announcement\Models\Traits\Method;

/**
 * Class AnnouncementMethod.
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
