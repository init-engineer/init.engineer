<?php

namespace App\Models\Social\Traits\Method;

/**
 * Trait CardPostMethod.
 */
trait CardPostMethod
{
    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        $config = sprintf(
            'social.%s.%s.post_path',
            $this->social_type,
            $this->social_connections
        );

        return config($config) . $this->social_card_id;
    }
}
