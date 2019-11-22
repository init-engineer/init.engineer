<?php

namespace App\Models\Social\Traits\Method;

/**
 * Trait MediaCardsMethod.
 */
trait MediaCardsMethod
{
    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return bool
     */
    public function isPublish()
    {
        return ! $this->is_banned;
    }

    /**
     * @return bool
     */
    public function isBanned()
    {
        return $this->is_banned;
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
